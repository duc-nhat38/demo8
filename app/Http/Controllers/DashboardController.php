<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if($this->checkAdmin()) {
            return view('admin.Index');
        }
        
    }

    public function userManager()
    {   
        
        return view('admin.userManagement');
    }

    public function bannerManager()
    {
        return view('admin.bannerManagement');
    }

    public function postManager()
    {
        return view('admin.postManagement');
    }

    public function addressManager()
    {
        return view('admin.addressManagement');
    }
    
    public function checkAdmin(){
        if(Auth::check() && Auth::user()->isAdmin == 1) {
            return true;
        }
        return view('auth.login');
    }
}
