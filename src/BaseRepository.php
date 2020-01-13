<?php
namespace IlyasDeckers\BaseModule;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use IlyasDeckers\BaseModule\Interfaces\BaseRepositoryInterface;
use IlyasDeckers\BaseModule\BaseQueryBuilder;

abstract class BaseRepository extends BaseQueryBuilder implements BaseRepositoryInterface
{
    protected $model;

    abstract public function store(Request $request) : object;

    abstract public function update(array $data)  : object;

    abstract public function destroy(int $id) : void;

    /**
     * Get a item from the database
     *
     * @param object $request
     * @return item
     */
    public function find(Request $request) : object
    {
        return $this->itemResponse(
            $this->model->where('id', $request->id)
        );
    }

    /**
     * Get a collection from the database
     *
     * @param object $request
     * @return collection
     */
    public function getAll(Request $request) : Collection  
    {   
        return $this->collectionResponse(
            $this->model
        );
    }
}
