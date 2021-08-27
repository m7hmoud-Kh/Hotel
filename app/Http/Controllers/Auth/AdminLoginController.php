<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;


class AdminLoginController extends Controller
{

    use AuthenticatesUsers;

    protected $redirectTo = 'admin/dashbord';


    public function __construct()
    {
        $this->middleware('guest:admin,admin/dashbord')->except('logout');
    }


    public function showLoginForm()
    {
        return view('auth.admin.login');
    }

    protected function guard()
    {
        return Auth::guard('admin');
    }


}
