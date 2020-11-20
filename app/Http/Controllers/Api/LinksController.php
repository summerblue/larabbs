<?php

namespace App\Http\Controllers\Api;

<<<<<<< HEAD
use App\Http\Controllers\Controller;
use App\Http\Resources\LinkResource;
use App\Models\Link;
use Illuminate\Http\Request;
=======
use App\Models\Link;
use Illuminate\Http\Request;
use App\Http\Resources\LinkResource;
>>>>>>> f2c8031f97e0ba5e7b887e71a847a0cc605b6531

class LinksController extends Controller
{
    public function index(Link $link)
    {
        $links = $link->getAllCached();

<<<<<<< HEAD
        LinkResource::wrap('data');
=======
		LinkResource::wrap('data');
>>>>>>> f2c8031f97e0ba5e7b887e71a847a0cc605b6531
        return LinkResource::collection($links);
    }
}
