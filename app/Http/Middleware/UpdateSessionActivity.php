<?php

namespace App\Http\Middleware;

//use App\Models\Session;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Session;

class UpdateSessionActivity
{
    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
		if (auth()->check()) {
			$user = auth()->user();

			if ((time() - $user->last_interaction) >= 300) {
				$user->last_interaction = time();
				$user->save();
			}
		}

        return $next($request);
    }
}
