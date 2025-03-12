<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function showindex()
    {
        return view('index');
    }

    public function showuserdash()
    {
        return view('userdash');
    }

    public function showUser_AppSub()
    {
        return view('user_appSub');
    }

    public function showUser_AppStatus()
    {
        return view('user_appStatus');
    }

    public function showUser_DocUpload()
    {
        return view('user_docUpload');
    }
}
