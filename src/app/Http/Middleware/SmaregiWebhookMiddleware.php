<?php
declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Log;

class SmaregiWebhookMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        Log::info(json_decode(json_encode($request->toArray(), JSON_UNESCAPED_SLASHES), true));

        $key = $request->header(config('smaregi.webhook.key'));

        if ($key === null) {
            abort(404);
        }
        if ($key !== config('smaregi.webhook.value')) {
            abort(401);
        }

        return $next($request);
    }
}
