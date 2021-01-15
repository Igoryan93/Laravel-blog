<?php

namespace App\Http\Controllers;

use App\Info;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public function index() {

        $users = User::get();

        return view('index', ['users' => $users]);
    }

    public function login() {
        return view('login');
    }

    public function register() {
        return view('reg');
    }

    public function profile($id) {

        if(Auth::user()->id != $id && !Auth::user()->is_admin) {
            Session::flash('danger', 'У вас не достаточно прав');
            return redirect()->route('index');
        }

        $user = Info::where('user_id', $id)->first();

        if(empty($user)) {
            $user = new Info();
            $userEmail = new User();
        } else {
            $userEmail = $user->user;
        }

        return view('profile', ['user' => $user, 'userEmail' =>  $userEmail]);
    }

    public function edit($id) {

        if(Auth::user()->id != $id && !Auth::user()->is_admin) {
            Session::flash('danger', 'У вас не достаточно прав');
            return redirect()->route('index');
        }

        $user = User::find($id);

        $info = $user->info;

        if(!$info) {
            $info = new Info();
        }
        return view('edit', ['user' => $info, 'user_id' => $user]);
    }

    public function security($id) {

        if(Auth::user()->id != $id && !Auth::user()->is_admin) {
            Session::flash('danger', 'У вас не достаточно прав');
            return redirect()->route('index');
        }

        $user = User::find($id);
        return view('security', ['user' => $user]);
    }

    public function status($id) {

        if(Auth::user()->id != $id && !Auth::user()->is_admin) {
            Session::flash('danger', 'У вас не достаточно прав');
            return redirect()->route('index');
        }

        $user = Info::where('user_id', $id)->first();
        return view('status', ['user' => $user]);
    }

    public function media($id) {
        if(Auth::user()->id != $id && !Auth::user()->is_admin) {
            Session::flash('danger', 'У вас не достаточно прав');
            return redirect()->route('index');
        }

        $user = Info::where('user_id', $id)->first();

        if(empty($user)) {
            $user = new Info();
        }

        return view('media', ['user' => $user]);

    }
}
