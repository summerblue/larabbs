<?php

namespace App\Http\Controllers\Api;

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
        return new ImageResource($image);
    }
}
