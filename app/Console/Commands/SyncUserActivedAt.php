<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;

class SyncUserActivedAt extends Command
{
    protected $signature = 'larabbs:sync-user-actived-at';
    protected $description = '将用户最后登录时间从 Redis 同步到数据库中';

    public function handle(User $user)
    {
        $user->syncUserActivedAt();
        $this->info("同步成功！");
    }
}
