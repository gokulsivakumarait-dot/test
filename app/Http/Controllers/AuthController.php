<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Psy\Readline\Hoa\_Protocol;
use App\Models\OTP;
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
            session()->flash('success','Registration Successful. Please Login!');
            return redirect()->route('login');
        }else{
            session()->flash('fail','Something went wrong, try again later!');
            return redirect()->back();
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
            session()->flash('fail','Incorrect Credentials, Please try again!');
            return redirect()->back();
        }
    }

    public function index(){
        return view('index');
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
        $mail = $request->email;
        if($user){
            $otp = rand(100000,999999);
            Otp::create([
                'uid' => $user->id,
                'email' => $user->email,
                'otp' => $otp
            ]);
            session()->flash('success','OTP has been sended.');
            return view('resetpassword',compact('mail'));
        }else{
            session()->flash('fail','Email address not found.');
            return redirect()->back();
        }
    }

    public function resetpassword(Request $request){
        $request->validate([
            'otp' => 'required',
            'email' => 'required|email', 
            'password'=>'required|min:5|max:30',
            'cpassword'=>'required|min:5|max:30|same:password'
        ]);

        $user = User::where('email', $request->email)->first();
        $otpRecord = OTP::where('uid', $user->id)->latest()->first();
       if($otpRecord && $request->otp == $otpRecord->otp){
            $user->password = bcrypt($request->password);
            $user->save();
            $otpRecord->delete();
            session()->flash('success','Password changed successfully. Please login!');
            return redirect()->route('login');
        }else{
            session()->flash('fail','Something went wrong, try again later!');
            return redirect()->back();
        }
    }

}
