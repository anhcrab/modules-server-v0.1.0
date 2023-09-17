<?php

namespace Modules\Product\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (! Auth()->user()->is_admin) {
            return \response([
                'message' => 'You have no permission to this content.',
            ], 403);

        }
        return $next($request);
    }
}
