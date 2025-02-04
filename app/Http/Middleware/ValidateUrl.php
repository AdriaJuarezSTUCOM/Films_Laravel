<?php

    namespace App\Http\Middleware;

    use Closure;
    use Illuminate\Http\Request;

    class ValidateUrl{
        public function handle(Request $request, Closure $next)
        {
            $url = $request->route('url');
    
            // in case year is not numeric go to homepage
            if(isset($url)){
                if(is_null($url)){
                      return redirect('/');
                }
            }
            return $next($request);        
        }
    }