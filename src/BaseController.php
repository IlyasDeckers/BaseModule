<?php
namespace Clockwork\Base;

use Clockwork\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    protected $model;

    protected $resource;

    protected $request = null;

    /**
     * Display a listing of the resource.
     *
     * @return mixed
     */
    public function index(Request $request)
    {
        // $u = \Clockwork\Contracts\Models\Contract::scopes(['active'])->with(['customer', 'user'])->get();
        // $result = [];
        // foreach ($u as $x) {
        //     $result[] = [
        //         'name' => $x->user->name,
        //         'function' => $x->function,
        //         'customer' => $x->customer->name
        //     ];
        // }
        // return $result;
        return $this->resource::collection(
            $this->model->getAll($request)
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    public function store(Request $request)
    {
        return new $this->resource(
            $this->model->store($request)
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    public function show(Request $request)
    {
        return new $this->resource(
            $this->model->find($request)
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    public function update(Request $request)
    {
        return new $this->resource(
            $this->model->update($request)
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return mixed
     */
    public function destroy(int $id)
    {
        //
    }
}