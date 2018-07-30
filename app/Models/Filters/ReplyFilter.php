<?php

namespace App\Models\Filters;

use EloquentFilter\ModelFilter;

class ReplyFilter extends ModelFilter
{
    /**
    * Related Models that have ModelFilters as well as the method on the ModelFilter
    * As [relationMethod => [input_key1, input_key2]].
    *
    * @var array
    */
    public $relations = [];

    public function replyer($id)
    {
        return $this->where('user_id', $id);
    }
}
