<?php

namespace App\Models\Filters;

use EloquentFilter\ModelFilter;

class TopicFilter extends ModelFilter
{
    /**
    * Related Models that have ModelFilters as well as the method on the ModelFilter
    * As [relationMethod => [input_key1, input_key2]].
    *
    * @var array
    */
    public $relations = ['replies' => ['replyer_id']];

    public function title($title)
    {
        return $this->whereLike('title', $title);
    }

    public function minViewCount($count)
    {
        return $this->where('view_count', '>=', $count);
    }

    public function category($id)
    {
        return $this->where('category_id', $id);
    }

    public function order($order)
    {
        switch ($order) {
            case 'recent':
                $this->recent();
                break;

            default:
                $this->recentReplied();
                break;
        }
    }

    public function setup()
    {
        if (!$this->input('order')) {
            $this->push('order', 'default');
        }
    }
}
