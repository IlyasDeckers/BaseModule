<?php
namespace Clockwork\Base;

use DB;
use Route;
use Closure;
Use Exception;
use Illuminate\Http\Request;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Symfony\Component\HttpFoundation\Response;

class ValidatorMiddleware
{
    use ValidatesRequests;

    /**
     * Apply request validation on POST and PUT
     * requests.
     *
     * @param Request $method
     * @param Closure $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next) : Response
    {
        if ($request->isMethod('post') || $request->isMethod('put')) {
            $controller = Route::current()->controller;

            if (method_exists($controller,'getRules')) {
                $this->validator($controller->getRules(), 'update', $request);
            }
        }

        return $next($request);
    }

    /**
     * Validate the incomming request.
     *
     * @param string $function
     * @param object $request
     * @return void
     */
    private function validator($rules, string $function, object $request)
    {
        if (isset($rules[$function]) && !is_null($rules[$function])) {
            return $this->validate($request,
                (new $rules[$function])->rules()
            );
        }
    }
}