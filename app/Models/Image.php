<?php

namespace App\Models;

<<<<<<< HEAD
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = ['type','path'];
=======
class Image extends Model
{
    protected $fillable = ['type', 'path'];
>>>>>>> f2c8031f97e0ba5e7b887e71a847a0cc605b6531

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
