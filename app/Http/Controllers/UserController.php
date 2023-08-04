<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //
    public function registerForm(){
        if(auth()->check()){
            return redirect('/');
        }
        return view('auth.register');
    }
    public function store(Request $request){
        $this->validate($request,[
            'name'=>'required|max:100',
            'email'=>'required|max:100',
            'password'=>'required|min:6',
        ]);
        $user=User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
        ]);
        if(auth()->attempt([
            'email'=>$request->email,
            'password'=>$request->password,
            // 'password'=>Hash::make($request->password),
        ])){
            return redirect('/');
    }
   }


    public function loginForm(){
        if(auth()->check()){
            return redirect('/');
        }
        return view('auth.login');
    }
    public function login(Request $request){
        $this->validate($request,[
            'email'=>'required|max:100',
            'password'=>'required|min:6',
        ]);
        if(auth()->attempt([
            'email'=>$request->email,
            'password'=>$request->password,
            // 'password'=>Hash::make($request->password),
        ])){
            return redirect('/');
        }else{
            return redirect()->route('login')->with([
                'error'=> 'these credentials does not match with any records!'
            ]);

        }
    }

    public function logout(){
      auth()->logout();
      return redirect()->route('login');
      
    }


}
