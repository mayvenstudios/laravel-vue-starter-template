<?php
namespace App\Http\Middleware;

use Closure;
use Auth;
use Flash;

class IsCustomer
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

        if(!isCustomer()) {
            Flash::error('You need to be a customer to view that page.');

            return redirect()->to(getHomeLink());
        }

        return $next($request);
    }
}
