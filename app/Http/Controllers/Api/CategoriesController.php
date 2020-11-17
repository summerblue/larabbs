<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function index()
    {
        CategoryResource::wrap('data');
        return CategoryResource::collection(Category::paginate());
    }
}
