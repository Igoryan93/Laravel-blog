<?php

namespace App\Http\Controllers;

use App\Info;
use App\Mail\VerifyEmail;
use App\User;
use App\Validate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use phpDocumentor\Reflection\Types\Nullable;

class RegController extends Controller
{

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
            $user->token = uniqid(str_random());
            $user->token_date = date('Y-m-d H:i:s');
            if(!$user->save()) {
                Session::flash('danger', 'Что то пошло не так');
                return back();
            } else {
                Mail::to($user->email)->send(new VerifyEmail($user));
                Session::flash('danger', 'Письмо с подтверждением было отправлено на вашу почту');
                return back();
            }
        }
    }

    public function verify($token) {
        $user = User::where('token', $token);

        if(!$user->get()->isEmpty()) {

            $user->update([
                'verify' => true,
                'token' => null,
                'token_date' => null
            ]);
            Session::flash('success', 'Регистрация прошла успешно');
            return redirect()->route('in');
        } else {
            return redirect()->route('404');
        }
    }
}
