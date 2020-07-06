<?php

namespace App\Http\Middleware;

use Closure;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\OperationLog;

class AdminOperationLog
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


    $user_id = 0;

    if(Auth::check()) {

      $user_id = (int) Auth::id();

    }


    if('GET' != $request->method()){

      $input = $request->all();

      $log = new OperationLog(); # 提前创建表、model
      //var_dump($input);exit;

      $log->uid = $user_id;
      
      $log->path = $request->path();

      $log->method = $request->method();

      $log->ip = $_SERVER['REMOTE_ADDR'];
      //var_dump(Auth::id());exit;

      //$log->input = json_encode($input, JSON_UNESCAPED_UNICODE);

      $log->save();  # 记录日志

    }



        return $next($request);
    }
}
