<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\LinkResource;
use App\Models\Link;
use Illuminate\Http\Request;

class LinksController extends Controller
{
    public function index(Link $link)
    {
        $links = $link->getAllCached();

        LinkResource::wrap('data');
        return LinkResource::collection($links);
    }
}
