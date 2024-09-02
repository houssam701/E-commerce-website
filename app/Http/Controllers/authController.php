<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class authController extends Controller
{
    public function loginPage(){
        return view('login');
    }
    public function signUpPage(){
        return view("signup");
    }
    public function login(Request $request){
        $fields=$request->validate([
            "email"=>['required','email','max:255'],
            "password"=>['required','min:3','max:50']      
        ]);
        if(auth()->attempt(['email'=>$fields['email'],'password'=>$fields['password']]))
        return redirect('/admin/clients')->with('success','Logged in Successfully');
        else
        return redirect('/login')->with("error","wrong credentials");
    }
    public function signUp(Request $request){
        $fields=$request->validate([
            "email"=>['required','email','unique:users,email'],
            "password"=>['required','min:3','max:30']      
        ]);
        $fields['password']= bcrypt($fields['password']);
        $user = User::create($fields);
        
        return redirect('/login')->with('success','Account created successfully');
    }
    
    public function logout(){
        auth()->logout();
        return redirect('/login')->with('failed','Logged out successfully');
    }
}