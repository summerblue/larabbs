<?php

namespace App\Http\Controllers\Api;

<<<<<<< HEAD
use App\Handlers\ImageUploadHandler;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ImageRequest;
use App\Http\Resources\ImageResource;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ImagesController extends Controller
{
    public function store(ImageRequest $request,ImageUploadHandler $uploader,Image $image)
    {
        $user = $request->user();
        $size = $request->type == 'avatar'?416:1024;
        $result = $uploader->save($request->image,Str::plural($request->type),$user->id,$size);

        $image->user()->associate($user);
        $image->path = $result['path'];
        $image->type = $request->type;
        $image->save();
=======
use App\Models\Image;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Handlers\ImageUploadHandler;
use App\Http\Resources\ImageResource;
use App\Http\Requests\Api\ImageRequest;

class ImagesController extends Controller
{
    public function store(ImageRequest $request, ImageUploadHandler $uploader, Image $image)
    {
        $user = $request->user();

        $size = $request->type == 'avatar' ? 416 : 1024;
        $result = $uploader->save($request->image, Str::plural($request->type), $user->id, $size);

        $image->path = $result['path'];
        $image->type = $request->type;
        $image->user_id = $user->id;
        $image->save();

>>>>>>> f2c8031f97e0ba5e7b887e71a847a0cc605b6531
        return new ImageResource($image);
    }
}
