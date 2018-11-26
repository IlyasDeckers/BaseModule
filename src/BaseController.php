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
    public function index(Request $request) : object
    {
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
    public function store(Request $request) : object
    {
        // Store the resource
        $result = $this->model->store($request);

        // Check if the result is an instance  of Collection. if it
        // contains a collection return a collection resource.
        if ($result instanceof Collection) {
            return $this->resource::collection($result);
        }

        return new $this->resource($result);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    public function show(Request $request) : object
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
    public function update(Request $request) : object
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