<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Model\User;
use App\Http\Requests\AdminLoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class LoginController extends Controller
{
    public function pass(){
        $pass = Hash::make('12345');
        dd($pass);
    }
    
    public function adminLoginIndex(){
        return view('admin/login');
    }

    public function adminLogin(AdminLoginRequest $request){
        try{
            if(Auth::attempt($request->except(['_token']))){
                return redirect('admin/dashboard');
            }else{
                return  Redirect::back()->withErrors(['loginError' => 'Email or password is Wrong.']);
            }
        }catch(\Exception $e){
            return $e;
        }
    }

    public function adminLogout(){
        Auth::logout();
        return redirect('admin/login');
    }

}
