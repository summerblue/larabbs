<?php

namespace App\Http\Controllers\Api;

<<<<<<< HEAD
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;
=======
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Resources\CategoryResource;
>>>>>>> f2c8031f97e0ba5e7b887e71a847a0cc605b6531

class CategoriesController extends Controller
{
    public function index()
    {
        CategoryResource::wrap('data');
<<<<<<< HEAD
        return CategoryResource::collection(Category::paginate());
=======
    	return CategoryResource::collection(Category::all());
>>>>>>> f2c8031f97e0ba5e7b887e71a847a0cc605b6531
    }
}
