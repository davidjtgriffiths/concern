<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class PasswordController extends Controller
{
    /**
     * Update the user's password.
     */
    public function update(Request $request): RedirectResponse
    {
        if ($request->user()->password_set_by_user){
            $validated = $request->validate([
                'current_password' => ['required', 'current_password'],
                'password' => ['required', Password::defaults(), 'confirmed'],
            ]);
        } else {
            $validated = $request->validate([
                'password' => ['required', Password::defaults(), 'confirmed'],
            ]);
        }


        $request->user()->update([
            'password' => Hash::make($validated['password']),
            'password_set_by_user' => true,
        ]);

        return back();
    }
}
