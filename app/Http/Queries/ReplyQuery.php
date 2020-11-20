<?php
<<<<<<< HEAD
=======

>>>>>>> f2c8031f97e0ba5e7b887e71a847a0cc605b6531
namespace App\Http\Queries;

use App\Models\Reply;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;

class ReplyQuery extends QueryBuilder
{
    public function __construct()
    {
        parent::__construct(Reply::query());

<<<<<<< HEAD
        $this->allowedIncludes('user','topic','topic.user');
=======
        $this->allowedIncludes('user', 'topic', 'topic.user');
>>>>>>> f2c8031f97e0ba5e7b887e71a847a0cc605b6531
    }
}
