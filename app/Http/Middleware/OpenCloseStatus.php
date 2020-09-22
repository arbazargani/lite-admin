<?php

namespace App\Http\Middleware;

use Closure;
use App\Settings;

class OpenCloseStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $settings = [
            'application_start_time' => Settings::where('name', 'application_start_time')->first(),
            'application_close_time' => Settings::where('name', 'application_close_time')->first(),
        ];

        $now      = date("H:ii");
        $uptime   = $settings['application_start_time']->value;
        $donwtime = $settings['application_close_time']->value;

        if ($now >= $uptime && $now < $donwtime) {
            return $next($request);
        } else {
            return abort('503', 'از ساعت' . " $uptime " . 'سایت در دسترس می باشد.');
        }
    }
}
