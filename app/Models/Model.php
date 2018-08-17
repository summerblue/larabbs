<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as EloquentModel;
use Watson\Rememberable\Rememberable;

class Model extends EloquentModel
{
    use Rememberable;

    public function scopeRecent($query)
    {
        return $query->orderBy('id', 'desc');
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order', 'desc');
    }

    public function visits()
    {
        return visits($this);
    }

}
