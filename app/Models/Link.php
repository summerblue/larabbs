<?php

namespace App\Models;

use Cache;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;
use Spatie\Translatable\HasTranslations;

class Link extends Model implements Sortable
{
    use SortableTrait, HasTranslations;

    public $translatable = ['title'];

    public $sortable = [
        'order_column_name' => 'order',
        'sort_when_creating' => true,
    ];

    protected $fillable = ['title', 'link'];

    public $rememberCacheTag = 'larabbs_links';
    protected $cache_expire_in_minutes = 1440;

    public function getAllCached()
    {
        $links = $this->ordered();

        if (!app()->isLocal()) {
            $this->cachePrefix .= app()->getLocale();
            $links->remember($this->cache_expire_in_minutes);
        }

        return $links->get();
    }
}