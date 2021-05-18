<?php

namespace App\Http\Middleware;

use Closure;

class PerformanceDebug
{
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        // 确保在开发环境下
        if (app()->isLocal()) {

            // // 计算包含了多少文件
            // $included_files_count = count(get_included_files());

            // dd($included_files_count);
        }

        return $response;
    }
}
