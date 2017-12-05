<?php

namespace App\Http\Middleware;

use Config;
use Closure;
use Log;

class RequestResponseLogger
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
        return $next($request);
    }

    /**
     * Handle log after termination of a call.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function terminate($request, $response)
    {
        $log_request = config('app.request_logging');
        if(empty($log_request)) {
	    return true;
	}
        $postbody='';
        if ($request->isMethod('get')) {
            $postbody = trim($request->input('data'));
            if (empty($postbody)) {
                $postbody='';
            }
        } elseif ($request->isMethod('post')) {
            // Check for presence of a body in the request (nomatter GET/POST)
            if (count($request->json()->all())) {
                $postbody = $request->json()->all();
            }
            if (is_array($postbody)) {
                $postbody=json_encode($postbody,true);
                if (empty($postbody)) {
                    $postbody = trim($request->all()); 
                }
            } else {
                $postbody = trim($request->input('data'));
            }
        }

        Log::info('requests', [
            'url' => $request->url(),
            'ips' => $request->ips(),
            'headers' => $request->header(),
            'request' => $postbody,
            'response' => json_encode($response)
        ]);
    }
}
