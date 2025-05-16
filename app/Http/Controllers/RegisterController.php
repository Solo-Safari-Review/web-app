<?php

namespace App\Http\Controllers;

use App\Helpers\HashidsHelper;
use App\Models\Department;
use App\Models\User;
use Exception;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function show()
    {
        $departments = Department::where('name', '!=', 'Admin Review')->get();

        return view('auth.register', compact('departments'));
    }

    public function register(Request $request) {
        $validated = $request->validate([
            'email' => 'required|string|email|max:255|unique:users',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'password' => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required|string|min:8',
            'department' => 'required|string',
        ], [
            'first_name.required' => 'Nama depan harus diisi!',
            'first_name.max' => 'Nama depan maksimal 255 karakter!',
            'last_name.required' => 'Nama belakang harus diisi!',
            'last_name.max' => 'Nama belakang maksimal 255 karakter!',
            'email.required' => 'Email harus diisi!',
            'email.max' => 'Email tidak valid!',
            'email.unique' => 'Email sudah terdaftar!',
            'phone.required' => 'Nomor telepon harus diisi!',
            'phone.max' => 'Nomor telepon tidak valid!',
            'password.required' => 'Password harus diisi!',
            'password.min' => 'Password minimal 8 karakter!',
            'password_confirmation.required' => 'Konfirmasi password harus diisi!',
            'password_confirmation.min' => 'Konfirmasi password minimal 8 karakter!',
            'department.required' => 'Posisi departemen harus diisi!',
        ]);

        try {
            User::create([
                'first_name' => $validated['first_name'],
                'last_name' => $validated['last_name'],
                'email' => $validated['email'],
                'phone' => $validated['phone'],
                'password' => bcrypt($validated['password']),
                'department' => HashidsHelper::decode($validated['department']),
            ]);
        } catch (Exception $e) {
            return back()->with('error', 'Registrasi gagal! Silahkan coba kembali.');
        }

        return redirect()->route('login')->with('success', 'Registrasi berhasil! Silahkan login.');
    }
}
