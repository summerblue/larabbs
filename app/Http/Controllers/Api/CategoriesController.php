<?php

namespace App\Http\Controllers\Api;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Transformers\CategoryTransformer;
use Dingo\Api\Transformer\Factory;

class CategoriesController extends Controller
{
    public function index(Category $category, Factory $transformerFactory, Request $request)
    {
    	if ($request->include == 'children') {
    		$transformerFactory->disableEagerLoading();
    		$categories = $category->defaultOrder()->get()->toTree();
    	} else {
    		$categories = $category->whereIsRoot()->defaultOrder()->get();
    	}

        return $this->response->collection($categories, new CategoryTransformer());
    }
}
