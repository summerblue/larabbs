<?php

namespace App\Models;

use Cache;

class Link extends Model
{
    protected $fillable = ['title', 'link'];

    public $rememberCacheTag = 'larabbs_links';
    protected $cache_expire_in_minutes = 1440;

    public function getAllCached()
    {
        return $this->remember($this->cache_expire_in_minutes)->get();
    }
}