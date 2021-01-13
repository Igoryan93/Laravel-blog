<?php

namespace App\Http\Controllers;

use App\User;
use App\Validate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class RegController extends Controller
{
    public function register() {
        return view('reg');
    }

    public function create(Request $request) {

        $validate = Validate::check($request, [
            'email' => 'required|min:5|unique:users|email',
            'password' => 'required|min:5',
            'password_again' => 'required|same:password'
        ]);

        if($validate->fails()) {
            return redirect()->route('reg')->withErrors($validate)->withInput();
        } else {
            $user = new User();
            $user->email = $request->email;
            $user->password = Hash::make($request->password);

            if($user->save()) {
                Session::flash('success', true);
                return redirect()->route('reg');
            } else {
                Session::flash('danger', true);
                return back();
            }
        }

    }
}
