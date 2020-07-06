<?php

namespace App\Admin\Controllers;


use Illuminate\Http\Request;

class AdminOperationLogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notices = \App\OperationLog::all();
        //var_dump( $notices);exit();
        return view('admin/operationLog/index', compact('notices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
  
}
