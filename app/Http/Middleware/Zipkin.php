<?php

namespace App\Http\Middleware;

use App\Core\Zipkin\Tracer;
use Closure;

class Zipkin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        $tracer = tracer();
        $uri = $request->url();
        list($new_tracer, $options) = Tracer::getInstance()->newTrace($tracer, $uri);
        $request['new_tracer'] = $new_tracer;
        $request['options'] = $options;
        $data =  $next($request);

        // 发送方法
        $new_tracer->finish();
        $tracer->flush();
        return $data;
    }
}
