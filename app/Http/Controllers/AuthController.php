<?php

namespace App\Http\Controllers;

use App\User;
use App\Validate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function login() {
        return view('login');
    }

    public function in(Request $request) {
        $validate = Validate::check($request, [
            'email' => 'required|email',
            'password' => 'required|min:5',
        ]);

        if($validate->fails()) {
            return back()->withErrors($validate)->withInput();
        } else {

            $user = User::where('email', $request->email)->get();

            if($user->isEmpty() || !Hash::check($request->password, $user->first()->password)) {
                dd('Пользователь не найден');
            }

            $remember = $request->remember == 'on' ?  true : false;


            if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $remember)) {
                Session::flash('success');
                return redirect()->route('index');
            }
        }
    }
}
