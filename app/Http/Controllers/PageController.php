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

    public function showUser_AcceptForm()
    {
        return view('user_acceptForm');
    }

    public function showUser_Renewal()
    {
        return view('user_renewal');
    }

    public function showadmindash()
    {
        return view('admindash');
    }

    public function showAdmin_ScholarMan()
    {
        return view('admin_scholarMan');
    }

    public function showAdmin_UserAppMan()
    {
        return view('admin_userAppMan');
    }

    public function showAdmin_ScholarAward()
    {
        return view('admin_scholarAward');
    }

    public function showAdmin_SAward()
    {
        return view('admin_award');
    }

    public function showAdmin_ReportAna()
    {
        return view('admin_reportAna');
    }

    public function showAdmin_AddNewSem()
    {
        return view('admin_addNewSem');
    }

    public function showAdmin_History()
    {
        return view('admin_history');
    }
}
