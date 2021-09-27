<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    public function change(Request $request)
    {
        $user = Auth::user();

        if($request -> has('submit'))
        {

            $user_id = Auth::id();
            $obj_user = User::find($user_id)->first();
                if($request -> has('name')){
                    $obj_user -> name = $request -> input('name');
                }else if($request -> has('password')){
                    $obj_user -> password = Hash::make($request -> input('password'));
                }

            $obj_user -> save();

            $request -> session() -> flash('message', 'Данный обновлены');
            return redirect('dashboard');
        }

        return view('profile', ['user'=>$user]);
    }
}
