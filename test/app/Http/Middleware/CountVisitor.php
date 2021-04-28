<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Visitor; 

class CountVisitor
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
        $ip = $request->ip();
        $date_visited = Date("Y-m-d");
        $visitor = Visitor::firstOrCreate([
            'ip' => $ip, 
            'date_visited' => $date_visited,
            'user_id' => auth()->id(),
            ]);
        DB::table('visitor_count')->where('user_id' , $visitor->user_id)->whereDate('date_visited' , $date_visited)->increment('hits');
        return $next($request);
    }
}
