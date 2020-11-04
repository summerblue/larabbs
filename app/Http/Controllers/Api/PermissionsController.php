<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\PermissionResource;
use Illuminate\Http\Request;

class PermissionsController extends Controller
{
    /*
     * 当前登录用户的权限列表
     */
    public function index(Request $request){
        $permissions = $request->user()->getAllPermissions();
        PermissionResource::wrap('data');
        return PermissionResource::collection($permissions);
    }
}
