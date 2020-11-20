<?php

namespace App\Http\Controllers\Api;

<<<<<<< HEAD
use App\Http\Resources\PermissionResource;
use Illuminate\Http\Request;
=======
use Illuminate\Http\Request;
use App\Http\Resources\PermissionResource;
>>>>>>> f2c8031f97e0ba5e7b887e71a847a0cc605b6531

class PermissionsController extends Controller
{
    public function index(Request $request)
    {
        $permissions = $request->user()->getAllPermissions();

        PermissionResource::wrap('data');
<<<<<<< HEAD

=======
>>>>>>> f2c8031f97e0ba5e7b887e71a847a0cc605b6531
        return PermissionResource::collection($permissions);
    }
}
