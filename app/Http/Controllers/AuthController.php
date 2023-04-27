<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
class Authcontroller extends Controller
{

    public function signin(Request $request)
    {

        $request->validate([
            'email' => ['required', 'string', 'email' ],
            'password' => ['required', 'string','min:8','max:50' ],
        ]);
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            $use= User::where('id',Auth::user()->id)->first();
            $use->offline_at=null;
            $use->save();
            return redirect(url('/' . $page='chat'));

        }else{
            return back()->withErrors(
                [
                    'loginerr' => 'The email or password not correct'
                ]
            );
        }
    }


    public function signup(Request $request)
    {
        $this->validate($request , [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],

           ]);

            User::create([
            'name' => $request->name ,
            'email' => $request->email ,
            'offline_at'=>now(),
            'password' => Hash::make($request->password ),
        ]);
        Auth::user();
        return redirect(url('/' .'chat'));
    }
}
