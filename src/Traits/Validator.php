<?php
namespace Clockwork\Base\Traits;

use Illuminate\Http\Request;
use Illuminate\Contracts\Validation\Factory;
use Illuminate\Validation\ValidationException;

use Illuminate\Http\JsonResponse;
use Clockwork\Exceptions\EnforcementException;

trait Validator
{
    /**
     * Validate the incomming request.
     *
     * @param string $function
     * @param object $request
     * @return void
     */
    private function validator(string $function, object $request)
    {
        if (isset($this->rules[$function]) && !is_null($this->rules[$function])) {
            $this->validate($request,
                (new $this->rules[$function])->rules()
            );
        }
    }
}