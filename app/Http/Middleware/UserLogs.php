<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Log;
use Closure;
use Illuminate\Http\Request;
use DB;
use Auth;
class UserLogs
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {   
        
        if($request->segment(3)){
           
            if($request->segment(4)){
           
                $message = Auth::user()->first_name .' '. Auth::user()->last_name . ' ('.Auth::user()->id.') ' . $request->segment(2) .'/'. $request->segment(3) .'/'.$request->segment(4);
           
            }else{
           
                $message = Auth::user()->first_name .' '. Auth::user()->last_name . ' ('.Auth::user()->id.') ' . $request->segment(2) .'/'. $request->segment(3);
           
            }
            
        }else{

            $message = Auth::user()->first_name .' '. Auth::user()->last_name . ' ('.Auth::user()->id.') ' . $request->segment(2);
       
        }
        
        Log::channel('crm')->info($message);

        return $next($request);
    }
}
