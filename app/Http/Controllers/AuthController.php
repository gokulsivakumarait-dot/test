<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    public function loginshow(){
        return view('login');
    }

    public function registershow(){
        return view('register');
    }

    public function register(Request $request){
        $request->validate([
            'name'=>'required',
            'email'=>'required|email|unique:users,email',
            'password'=>'required|min:5|max:30',
            'cpassword'=>'required|min:5|max:30|same:password'
        ]);

        $data = $request->only('name','email','password');
        $data['password'] = bcrypt($data['password']);

        $user = User::create($data);
        
        if($user){
            return redirect()->route('login')->with('success','Registration Successful. Please Login!');
        }else{
            return redirect()->back()->with('fail','Something went wrong, try again later!');   
        }
    }

    public function login(Request $request){
        $request->validate([
            'email'=>'required|email',
            'password'=>'required|min:5|max:30'
        ]);

        $credentials = $request->only('email','password');
        if(Auth::attempt($credentials)){
            return redirect()->route('dashboard');
        }else{
            return redirect()->back()->with('fail','Incorrect Credentials, Please try again!');
        }
    }

    public function index(){
        return view('dashboard');
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('login');
    }

    public function forgotpasswordshow(){
        return view('forgotpassword');
    }

    public function forgotpassword(Request $request){
        $request->validate([
            'email'=>'required|email'
        ]);

        $user = User::where('email', $request->email)->first();
        if($user){
            Maill::to($user->email)->send(new \App\Mail\ForgotPasswordMail($user));
            return redirect()->back()->with('success','Password reset link has been sent to your email address.');
        }else{
            return redirect()->back()->with('fail','Email address not found.');
        }
    }
}
