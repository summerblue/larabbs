<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Category;
use App\ViewModels\TopicViewModel;

class CategoriesController extends Controller
{
    public function show(Category $category, Request $request)
    {
        return (new TopicViewModel($request->order))->setCategory($category)->view('topics.index');
    }
}
