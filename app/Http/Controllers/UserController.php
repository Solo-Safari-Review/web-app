<?php

namespace App\Http\Controllers;

use App\Helpers\HashidsHelper;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $updateUrl = HashidsHelper::encode($user->id);

        return view('user.index', compact('user', 'updateUrl'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $userId = HashidsHelper::decode($request->route('user'));

        $validated = $request->validate([
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($userId)],
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'password' => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required|string|min:8',
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
        ]);

        $user = User::find($userId);

        try {
            $user->update($validated);
        } catch (Exception $e) {
            abort(500, "Gagal memperbarui informasi akun!");
        }

        return redirect()->route('user.index')->with('success', 'Informasi akun berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
