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
        }else{
            return view('auth.login');
        }
        
    }

    public function userManager()
    {   
        if($this->checkAdmin()) {
            return view('admin.userManagement');
        }else{
            return view('auth.login');
        }
        
    }

    public function bannerManager()
    {
        if($this->checkAdmin()) {
            return view('admin.bannerManagement');
        }else{
            return view('auth.login');
        }
        
    }

    public function postManager()
    {
        if($this->checkAdmin()) {
            return view('admin.postManagement');
        }else{
            return view('auth.login');
        }
        
    }

    public function addressManager()
    {
        if($this->checkAdmin()) {
            return view('admin.addressManagement');
        }else{
            return view('auth.login');
        }
        
    }
    
    public function checkAdmin(){
        if(Auth::check() && Auth::user()->isAdmin == 1) {
            return true;
        }
        return false;
    }
}
