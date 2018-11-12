<?php
namespace Clockwork\Base\Traits;

use DB;
use Exception;

trait Transaction
{
    /**
     * Check if the method exists.
     *
     * @param string $method
     * @return Exeption
     */
    private function methodExists(string $method)
    {
        if (!method_exists($this, $method)) {
            throw new Exception("Method doesn't exist");
        }
    }

    /**
     * Call the private function with database transactions
     * for the methods store, update and delete.
     *
     * When the called function is set to public, __call will
     * be omitted and no transactions are perfomed.
     *
     * @param string $method
     * @param array $args
     * @return void
     */
    public function __call(string $method, array $args)
    {
        DB::beginTransaction();
        
        try {
            $this->methodExists($method);
            $response = call_user_func_array([$this, $method], $args);
        } catch (Exception $e) {
            throw new Exception($e);
            DB::rollback();
        }

        DB::commit();

        return $response;
    }
}
