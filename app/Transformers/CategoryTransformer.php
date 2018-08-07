<?php

namespace App\Transformers;

use App\Models\Category;
use League\Fractal\TransformerAbstract;

class CategoryTransformer extends TransformerAbstract
{
	protected $availableIncludes = ['children'];

    public function transform(Category $category)
    {
        return [
            'id' => $category->id,
            'name' => $category->name,
            'description' => $category->description,
        ];
    }

    public function includeChildren(Category $category)
    {
    	$transformer = new self();
    	$transformer->setDefaultIncludes(['children']);
    	return $this->collection($category->children, $transformer);
    }
}
