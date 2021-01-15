<?php

namespace App\Http\Controllers;

use App\Info;
use App\Mail\VerifyEmail;
use App\User;
use App\Validate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    public function create() {
        return view('admin.create');
    }

    public function post(Request $request) {
        $validate = Validate::check($request, [
            'name' => 'required',
            'job' => 'required',
            'phone' => 'required|min:5|numeric',
            'address' => 'required|min:5',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:5',
            'password_again' => 'same:password',
            'image' => 'mimes:jpg,png,jpg',
        ]);

        if($validate->fails()) {
            return back()->withErrors($validate)->withInput();
        }

        $user = new User;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->token = uniqid(str_random());
        $user->token_date = date('Y-m-d H:i:s');
        if($user->save()) {

            $fields = $request->only('name', 'job', 'phone', 'status', 'address', 'vk', 'inst', 'tg');
            $path = $request->image->store('img');

            $info = new Info($fields);
            $info->user_id = $user->id;
            $info->image = $path;
            $info->save();

            Mail::to($user->email)->send(new VerifyEmail($user));
            Session::flash('success', 'Письмо с подтверждением было отправлено пользователю на почту');
            return back();
        }

    }
}
