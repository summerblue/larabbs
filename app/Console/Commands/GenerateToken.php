<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class GenerateToken extends Command
{
<<<<<<< HEAD
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'larabbs:generate-token';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '快速为用户生成token';

    /**
     * Create a new command instance.
     *
     * @return void
     */
=======
    protected $signature = 'larabbs:generate-token';

    protected $description = '快速为用户生成 token';

>>>>>>> f2c8031f97e0ba5e7b887e71a847a0cc605b6531
    public function __construct()
    {
        parent::__construct();
    }

<<<<<<< HEAD
    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $userId = $this->ask('输入用户 id');
        $user = User::find($userId);
        if(!$user){
            return $this->error('用户不存在');
        }

        //一年以后过期，单位分钟
=======
    public function handle()
    {
        $userId = $this->ask('输入用户 id');

        $user = User::find($userId);

        if (!$user) {
            return $this->error('用户不存在');
        }

        // 一年以后过期
>>>>>>> f2c8031f97e0ba5e7b887e71a847a0cc605b6531
        $ttl = 365*24*60;
        $this->info(auth('api')->setTTL($ttl)->login($user));
    }
}
