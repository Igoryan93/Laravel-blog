<?php

namespace App\Http\Controllers;

use App\Info;
use App\User;
use App\Validate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function edit($id, Request $request) {

        $validate = Validate::check($request, [
            'name' => 'required|min:2',
            'job' => 'required|min:2',
            'phone' => 'required|numeric',
            'address' => 'required|min:5'
        ]);

        if($validate->fails()) {
            return back()->withErrors($validate);
        } else {

            $field = $request->only('name', 'job', 'phone', 'address', 'vk', 'inst', 'tg');

            if(Info::where('user_id', $id)->get()->isEmpty() == true) {
                $info = new Info($field);
                $info->user_id = $id;
                if(!$info->save()) {
                    Session::flash('danger', 'Что то пошло не так');
                    return back();
                } else {
                    Session::flash('success', 'Изменения вступили в силу');
                    return back();
                }
            } else {

                $info = Info::where('user_id', $id)->update($field);

                if(!$info) {
                    Session::flash('danger', 'Что то пошло не так');
                    return back();
                } else {
                    Session::flash('success', 'Изменения вступили в силу');
                    return back();
                }
            }
        }
    }

    public function security($id, Request $request) {
        $validate = Validate::check($request, [
            'password' => 'required|min:5',
            'password_again' => 'same:password'
        ]);

        if($validate->fails()) {
            return back()->withErrors($validate);
        } else {
            User::where('id', $id)->update(['password' => Hash::make($request->password)]);
            Session::flash('success', 'Пароль успешно изменен');
            return back();
        }
    }

    public function status($id, Request $request) {
        Info::where('user_id', $id)->update(['status' => $request->status]);
        Session::flash('success', 'Статус успешно изменен');
        return back();
    }

    public function media($id, Request $request) {


        if (!$request->hasFile('image')) {
            Session::flash('danger', 'Необходимо прикрепить файл');
            return back();
        }

        $validate = Validate::check($request, [
            'image' => 'mimes:jpeg,png,jpg',
        ]);

        if($validate->fails()) {
            return back()->withErrors($validate);
        }

        $path = $request->image->store('img');

        File::delete(Info::where('user_id', $id)->first()->image);

        Info::where('user_id', $id)->update(['image' => $path]);

        Session::flash('success', 'Аватар успешно изменен');
        return back();

    }

    public function delete($id) {

        if(Auth::user()->id != $id && !Auth::user()->is_admin) {
            Session::flash('danger', 'У вас не достаточно прав');
            return redirect()->route('index');
        }

        Info::where('user_id', $id)->delete();
        User::where('id', $id)->delete();

        if(Auth::user()->id == $id) {
            Session::flash('success', 'Пользователь успешно удален');
            Auth::logout();
            return redirect()->route('index');
        }
    }
}
