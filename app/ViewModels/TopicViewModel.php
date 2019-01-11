<?php

namespace App\ViewModels;

use Spatie\ViewModels\ViewModel;
use App\Models\User;
use App\Models\Link;
use App\Models\Topic;
use App\Models\Category;

class TopicViewModel extends ViewModel
{
    protected $ignored = ['setCategory'];

    protected $order;

    public function __construct($order = null)
    {
        $this->order = $order;
    }

    public function setCategory(Category $category)
    {
        $this->category = $category;
        return $this;
    }

    public function topics()
    {
        $topics = Topic::withOrder($this->order);

        if (isset($this->category)) {
            $topics->where('category_id', $this->category->id);
        }

        return $topics->paginate(20);
    }

    public function activeUsers()
    {
        return (new User)->getActiveUsers();
    }

    public function links()
    {
        return (new Link)->getAllCached();
    }
}
