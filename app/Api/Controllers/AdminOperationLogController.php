<?php

namespace App\Api\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\AdminUser;

class AdminOperationLogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createlog(Request $Request)
    {


     /** $this->validate($Request, [
            'uid' => 'required|min:2',
          'password' => 'required|min:6|max:30',
          'name' => 'required|min:6|max:30',
          'path' => 'required|min:6|max:30',
          'method' => 'required|min:6|max:30',
          'password' => 'required|min:6|max:30',
          'ip' => 'required|min:6|max:30',
      ]);
 */

      $user_id = $Request->input('uid');

        $user = AdminUser::find($user_id);

                if(!$user) {
            return response()->json([
            'code' => '60006',
            'message' => '找不到用户',
            'data' => ''
        ]);
        }

        $tokens = $user->tokens;

      if (Cache::has($tokens)) {

      $params = request(['uid','name','path','method','ip']);

        $res = \App\OperationLog::create($params);
        if($res) {
            return response()->json([
            'code' => '60001',
            'message' => '新增日志成功',
            'data' => ''
]);
        }else{
            return response()->json([
            'code' => '60002',
            'message' => '新增日志失败',
            'data' => ''
]);  
        }


    
} else {
            return response()->json([
            'code' => '60004',
            'message' => '用户未授权',
            'data' => ''
]); 
}

    }




    public function showlog(Request $Request)

    {






        $user_id = $Request->input('uid');

        $user = AdminUser::find($user_id);
        if(!$user) {
            return response()->json([
            'code' => '60006',
            'message' => '找不到用户',
            'data' => ''
]);
        }

        $tokens = $user->tokens;
        //var_dump($tokens);exit();

         if (Cache::has($tokens)) {


        $notices = \App\OperationLog::all();

        if($notices) {

         return $notices->toJson();

        }else{
            return response()->json([
            'code' => '60003',
            'message' => '找不到日志',
            'data' => ''
]);  
        }

        } else {
            return response()->json([
            'code' => '60004',
            'message' => '用户未授权',
            'data' => ''
]);
        }



    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
  
}
