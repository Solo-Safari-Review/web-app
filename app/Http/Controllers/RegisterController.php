<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function show()
    {
        return view('auth.register');
    }

    public function register(Request $request) {
        try {
            $validated = $request->validate([
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'phone' => 'required|string|max:255',
                'password' => 'required|string|min:8|confirmed',
                'password_confirmation' => 'required|string|min:8',
                'isAdminReview' => 'required|boolean',
            ]);

            $user = User::create([
                'first_name' => $validated['first_name'],
                'last_name' => $validated['last_name'],
                'email' => $validated['email'],
                'phone' => $validated['phone'],
                'password' => Hash::make($validated['password']),
            ]);

            if ($validated['isAdminReview'] == true) {
                $user->assignRole('Admin Review');
            } else {
                $user->assignRole('Admin Departemen');
            }

            return redirect()->route('login')->with('success', 'Registrasi berhasil! Silahkan login.');
        } catch (Exception $e) {
            return redirect()->route('register')->with('error', 'Registrasi gagal! Silahkan coba lagi.');
        }
    }
}
