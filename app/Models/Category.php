<?php

namespace App\Models;

use Kalnoy\Nestedset\NodeTrait;

class Category extends Model
{
	use NodeTrait;

    protected $fillable = [
        'name', 'description',
    ];
}
