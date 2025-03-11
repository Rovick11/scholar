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

    public function showAppSub()
    {
        return view('appSub');
    }
}
