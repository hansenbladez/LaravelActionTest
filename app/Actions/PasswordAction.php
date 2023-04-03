<?php

namespace App\Actions;

use Lorisleiva\Actions\Concerns\AsAction;
use Illuminate\Http\Request;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class PasswordAction{

    public function storeValidate(Request $request){
        return Auth::guard('web')->validate([
            'email' => $request->user()->email,
            'password' => $request->password,
        ]);
    }
    public function storeConfirmation(Request $request){
        $request->session()->put('auth.password_confirmed_at', time());
    }
    public function update(Request $request){
        $validated = $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', Password::defaults(), 'confirmed'],
        ]);

        $request->user()->update([
            'password' => Hash::make($validated['password']),
        ]);
    }
}