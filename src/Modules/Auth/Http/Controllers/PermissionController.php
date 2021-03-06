<?php
namespace IlyasDeckers\BaseModule\Modules\Auth\Http\Controllers;

use IlyasDeckers\BaseModule\Modules\Auth\Resources\PermissionResource;
use Clockwork\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    /**
     * List roles
     *
     * @param  Request request
     */
    public function index(Request $request)
    {
        return PermissionResource::collection(
            Permission::get()
        );
    }
}