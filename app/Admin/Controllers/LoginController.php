<?php

namespace App\Admin\Controllers;

use Illuminate\Http\Request;

use App\OperationLog;
use App\AdminUser;

use Illuminate\Support\Facades\Cache;

class LoginController extends Controller
{
    public function index()
    {
        return view('/admin/login/index');
    }

    /*
     * 具体登陆
     */
    public function login(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:2',
            'password' => 'required|min:6|max:30',
        ]);

        $user = request(['name', 'password']);
        // var_dump($user);exit;
        if (true == \Auth::guard('admin')->attempt($user)) {




        $user_id = \Auth::guard("admin")->user()->id;


        $token = self::generateToken();



         $user = AdminUser::find($user_id);
         $user->tokens = $token;
         $user->save();
 
       // var_dump($token);exit();

        Cache::put($token,$user_id,600);


        //var_dump(Cache::put($token,$user_id,600));exit();

        $input = $request->all();

        $log = new OperationLog(); # 提前创建表、model
        // var_dump($input);exit;

        $log->uid = $user_id;
      
        $log->path = $request->path();

        $log->method = $request->method();

        $log->ip = $_SERVER['REMOTE_ADDR'];
        //var_dump(Auth::id());exit;

        //$log->input = json_encode($input, JSON_UNESCAPED_UNICODE);

        $log->save();  # 记录日志


        //var_dump(\Auth::guard("admin")->user()->id);exit();
        return redirect('/admin/home');
        }



       // var_dump(Cache::put($token,$user_id,600));exit();






        return \Redirect::back()->withErrors("用户名密码错误");
    }

    /*
     * 登出操作
     */
    public function logout(Request $request)
    {

      $user_id = \Auth::guard("admin")->user()->id;

      $input = $request->all();

      $log = new OperationLog(); # 提前创建表、model
     // var_dump($input);exit;

      $log->uid = $user_id;
      
      $log->path = $request->path();

      $log->method = $request->method();

      $log->ip = $_SERVER['REMOTE_ADDR'];
      //var_dump(Auth::id());exit;

      //$log->input = json_encode($input, JSON_UNESCAPED_UNICODE);

      $log->save();  # 记录日志


      \Auth::guard('admin')->logout();

      $user = AdminUser::find($user_id);

      $tokens = $user->tokens;

      Cache::forget($tokens);

      return redirect('/admin/login');
    }


        // 生成令牌
    public static function generateToken()
    {
        $randChar = "XtGhtvPn9WlrevgB";
        $timestamp = $_SERVER['REQUEST_TIME_FLOAT'];
        $tokenSalt = "h6aw04VI9i0KEoct";
        return md5($randChar . $timestamp . $tokenSalt);
    }


}
