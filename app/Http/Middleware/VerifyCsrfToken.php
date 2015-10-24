<?php namespace App\Http\Middleware;

use Closure;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;
use Symfony\Component\Security\Core\Util\StringUtils;

class VerifyCsrfToken extends BaseVerifier {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		return parent::handle($request, $next);
	}


	/**
	 * Determine if the session and input CSRF tokens match.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return bool
	 */
	protected function tokensMatch($request)
	{
		//$token = $request->input('_token') ?: $request->session()->getToken();
		//
		//if ( ! $token && $header = $request->header('X-XSRF-TOKEN'))
		//{
		//	$token = $this->encrypter->decrypt($header);
		//}
		//
		//return StringUtils::equals($request->session()->token(), $token);

		return true;
	}

}
