<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    /*
     * 分类列表
     */
    public function show(){
        CategoryResource::wrap('data');
        return CategoryResource::collection(Category::all());

    }
}
