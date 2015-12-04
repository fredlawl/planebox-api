<?php namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SimpleAuthMiddleware {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		$auth = Auth::onceBasic('email');
		if (is_null($auth)) {

			$user = DB::table('users')->where('administrator', '=', 1)->where('email', '=', $request->headers->get('php-auth-user'))->first();
			if (is_null($user)) {
				return response()
					->json('Invalid user.')
					->setStatusCode(403);
			}

			return $next($request);
		}

		return $auth;
	}

}
