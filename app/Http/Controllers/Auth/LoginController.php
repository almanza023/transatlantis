<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm(){
        return view('auth.login');
    }

    public function login(Request $request){
        
        $this->validateLogin($request);      
 
         if (Auth::attempt(['email' => $request->email, 'password' => $request->password])){
             return 1;
         }
        return 2;   

         
     }

     protected function validateLogin(Request $request){
        $this->validate($request,[
            'email' => 'required',
            'password' => 'required|string'
        ]);

    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        return redirect('/');
    }

}
