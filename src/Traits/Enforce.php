<?php
namespace IlyasDeckers\BaseModule\Traits;

use Illuminate\Http\Request;
use Illuminate\Contracts\Validation\Factory;
use Illuminate\Validation\ValidationException;

trait Enforce
{
    /**
     *  Apply rules to the given request
     * 
     * @param $rules
     * @throws ValidationException
     */
    public function enforce($rules, $status = 412)
    {
        $messages = tap(collect(), function ($messages) use ($rules) {
            collect($rules)->each(function ($rule) use ($messages) {
                if (!$rule->passes()) {
                    $messages->push([
                        'code' => $rule->code(),
                        'message' => $rule->message()
                    ]);

                    if ($rule->break()) {
                        return false;
                    }
                }
            });
        });

        $_messages = '';
        foreach ($messages as $message) {
            $_messages = $message['message'] . ', ' . $_messages;
        }

        if (!$messages->isEmpty()) {
            throw new \Exception(
                $_messages
            );
        }
    }

}