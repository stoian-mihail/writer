<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Auth;
use Illuminate\Support\Facades\Redirect;

class ChangePasswordController extends Controller
{
    public function changepassword(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'old-password' => ['required', 'password'],
            'password' => ['required', 'string', 'min:8', 'different:old-password'],
            'password_confirmation' => ['required', 'same:password']
        ]);
        if ($validator->passes()) {
            $validated = $validator->valid();
            $password = $validated['password'];
            $hashed = Hash::make($password);
            $user = Auth::user();
            $user->password = $hashed;
            $user->save();
            return redirect('login')->with(Auth::logout());
        } else {
            return Redirect::back()->withErrors($validator->errors());
        }
    }
}
