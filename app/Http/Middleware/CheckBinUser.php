<?php

namespace App\Http\Middleware;

use Closure;

class CheckBinUser
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
        $bin = $request->route('bin');

        if($bin->user_id === $request->user()->id){
            return $next($request);
        }

        return redirect()->back();
    }
}
