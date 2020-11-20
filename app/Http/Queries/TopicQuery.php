<?php

<<<<<<< HEAD

=======
>>>>>>> f2c8031f97e0ba5e7b887e71a847a0cc605b6531
namespace App\Http\Queries;

use App\Models\Topic;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;

class TopicQuery extends QueryBuilder
{
    public function __construct()
    {
        parent::__construct(Topic::query());

<<<<<<< HEAD
        $this->allowedIncludes('user','user.roles','category')
            ->allowedFilters([
=======
        $this->allowedIncludes('user', 'user.roles', 'category')
             ->allowedFilters([
>>>>>>> f2c8031f97e0ba5e7b887e71a847a0cc605b6531
                'title',
                AllowedFilter::exact('category_id'),
                AllowedFilter::scope('withOrder')->default('recentReplied'),
            ]);
    }
}
