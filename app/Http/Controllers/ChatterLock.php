<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ChatterLock extends Controller
{
    public function lock()
    {
        return view('auth.lockscreen');
    }
     public function unlock(Request $request)
    {
        if(Hash::check($request->password,Auth::user()->password)){

            session()->forget('locked');
            session()->put('last_request',time());

            return redirect()->route('home');
        }
        return redirect('/locked')->withErrors(['password' => 'كلمة المرور غير صحيحة']);
    }
}
