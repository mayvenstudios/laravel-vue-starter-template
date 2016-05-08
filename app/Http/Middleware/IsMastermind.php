<?php
namespace App\Http\Middleware;

use Closure;
use Auth;
use Flash;

class IsMastermind
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
        if(!Auth::check()) {
            Flash::error('You need to login first.');
            return redirect()->guest('/login');
        }

        if(!isMastermind()) {
            Flash::error('You need to be a mastermind to view that page.');

            return redirect()->to(getHomeLink());
        }

        return $next($request);
    }
}
