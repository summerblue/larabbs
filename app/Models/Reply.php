<?php

namespace App\Models;

use EloquentFilter\Filterable;

class Reply extends Model
{
    use Filterable;

    protected $fillable = ['content'];

    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function replyer()
    {
        return $this->belongsTo(User::class);
    }
}
