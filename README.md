# Laravel base module
This package is aimed at PHP developers who like to write and organize their code in a fast and readable way. Using this package enables you to create CRUD applications while using Domain Driven Design and the repository pattern.

## Why would I use it?
Ever wondered why we recreate so much logic in Laravel? Controllers contain a lot of simmilarities, all our requests need validation, database transactions,... We also need a nice and fluent way to write business logic to interact with our database models. Why not encapsulate all this logic into a single package that handles almost everything without the need to write a lot of code.

## Example Controller
In the example below, we see a fully functioning `UserController` that handles everything we need from a CRUD controller in a handful of lines. Most methods are inherited from the `BaseController`. These methods can be overwritten if needed.

The methods accessible are:
* index
* show
* create
* update
* delete

```php
<?php
namespace Project\Users\Http\Controllers;

use IlyasDeckers\BaseModule\BaseController;
use Project\Users\Http\Requests\StoreRequest;
use Project\Users\Http\Requests\UpdateRequest;
use Project\Users\Http\Resources\UserResource;
use Project\Users\Interfaces\UserRepositoryInterface;

class UserController extends BaseController
{
    protected $model;

    /**
     * Request validation rules
     *
     * @var array
     */
    protected array $rules = [
        'store' => StoreRequest::class,
        'update' => UpdateRequest::class,
    ];

    /**
     * Api resource
     *
     * @var Clockwork\Users\Http\Resources\UserResource
     */
    protected $resource = UserResource::class;
    
    public function __construct (UserRepositoryInterface $user)
    {
        $this->model = $user;
    }
}
```

## Documentation

Full documentation [here](https://github.com/IlyasDeckers/base-module/blob/master/docs/controllers.md)

## Installation
```sh
composer install ilyasdeckers/base-module
```
