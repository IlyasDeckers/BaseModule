# Routes

## Route middleware
When defining routes in your module we need to apply some middleware for authentication, validation,...
### authentication
```auth:api```

### transaction
When this middleware is applied, database transactions are enabled for all routes in this group, Only `GET` requests get ignored.

### Validator
When request validation is needed the `validator` middleware needs to be specified. When this is enabled, the `$rules` array on your controller will be used for request validation.

```php
Route::middleware(['auth:api', 'transaction', 'validator'])
    ->prefix('api/v2/users')
    ->namespace('Clockwork\Users\Http\Controllers')
    ->group(function () {
        Route::get('/', 'UserController@index');
        Route::post('/', 'UserController@store');
        Route::get('{id}', 'UserController@show');
        Route::put('{id}', 'UserController@update');
        Route::delete('{id}', 'UserController@destroy');
    }
);
```