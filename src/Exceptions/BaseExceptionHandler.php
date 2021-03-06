<?php

namespace IlyasDeckers\BaseModule\Exceptions;

use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class BaseExceptionHandler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        EnforcementException::class,
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        if ($exception instanceof ModelNotFoundException) {
            return $this->handleModelNotFoundException($exception);
        }

        if ($exception instanceof ValidationException) {
            return $this->handleValidationException($exception);
        }

        return response()->json([
            'status' => 'Server error',
            'message' => 'Something went wrong...',
            'error' => $exception->getMessage()
        ], 500);

        return parent::render($request, $exception);
    }

    private function handleValidationException (Exception $exception) : object
    {
        foreach ($exception->errors() as $key => $error) {
            $message = $error[0];
        }

        return response()->json([
            'status' => 'Validation error',
            'message' => $error,
            'error' => $exception->getMessage()
        ], 422);
    }

    private function handleModelNotFoundException (Exception $exception) : object
    {
        return response()->json([
            'status' => 'Model not found',
            'message' => '404. No database entry found!',
            'error' => $exception->getMessage()
        ], 404);
    }
}
