<?php

namespace App\Http\Middleware;

use Closure;
use Request;
use App\Settings;

class CheckRegion
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
        $setting = [
            'check_region' => Settings::where('name', 'check_region')->first(),
        ];

        if (!$setting['check_region']->value) {
            return $next($request);
        }

        $url = "http://ip-api.com/json/" . Request::ip();

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    
        $res = curl_exec($curl);
        $response = json_decode($res);
        curl_close($curl);

        if (isset($response->status)) {
            if ($response->status == 'success' && $response->country == 'Iran' && $response->countryCode == 'IR') {
                return $next($request);
            } else {
                return abort(403, "Country is blocked. if you're under a proxy server or vpn service, please trun it off.");
            }
        } else {
            return $next($request);
        }
    }
}
