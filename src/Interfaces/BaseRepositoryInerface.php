<?php
namespace IlyasDeckers\BaseModule\Interfaces;

use Illuminate\Http\Request;

interface BaseRepositoryInterface
{
    public function find(int $id) : object;

    public function getAll(Request $request) : object;

    public function store(array $data) : object;

    public function update(array $data) : object;

    public function destroy(int $id) : void;
}
