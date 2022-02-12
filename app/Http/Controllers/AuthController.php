<?php

namespace App\Http\Controllers;

use DB;
use Hash;
use Session;
use App\Models\User;
use App\Models\Newsletter;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class  AuthController extends Controller
{

    public function index()
    {
        return view('auth.login');
    }


    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended('/')
                        ->with('success','Signed in');
        }

        return back()->with('error','Login details are not valid');
    }



    public function registration()
    {
        return view('auth.sign-up');
    }


    public function register(Request $request)
    {
        $request->validate([
            'fname' => 'required',
            'lname' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        $data = $request->all();
        try {
            DB::beginTransaction();
            $user = User::create([
                'fname' => $request->fname,
                'lname' => $request->lname,
                'email' => $request->email,
                'phone_no' => $request->phone_no,
                'password' => Hash::make($request->password),
            ]);
            $subscriber = Newsletter::create([
                'fname' => $request->fname,
                'lname' => $request->lname,
                'email' => $request->email,
            ]);
            Auth::login($user, true);
            DB::commit();
            return redirect("/")->with('success','Welcome!');

        } catch (\Exception $e) {
            return back()->with(
                'error',
                $e->getMessage()
            );
        }

    }


    // public function dashboard()
    // {
    //     if(Auth::check()){
    //         return view('dashboard');
    //     }

    //     return redirect("login")->withSuccess('You are not allowed to access');
    // }


    public function signOut() {
        Session::flush();
        Auth::logout();

        return Redirect('login');
    }
}
