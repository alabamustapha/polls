<?php

namespace App\Http\Middleware;

use Closure;

class VerifyUserIsActive
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


        if (auth()->user()->status == false && !auth()->user()->is_admin && $request->route()->getName() !== 'account_activation') {

            session()->put('activation-message', 'Account suspended');
            return redirect()->route('account_activation');
            
            // return redirect()->route('not-activated');

        }

        session()->forget('activation-message');

        return $next($request);
    }
}
