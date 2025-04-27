<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class LoginController extends Controller
{
    public function show()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ]);

        $user = User::where('email', $credentials['email'])->first();

        if (!$user || !Hash::check($credentials['password'], $user->password)) {
            return back()->withErrors(['email' => 'Email atau password salah.']);
        }

        Auth::login($user);

        // Redirect berdasarkan role
        if ($user->hasRole('Admin Review')) {
            return redirect()->route('admin.review.dashboard');
        } elseif ($user->hasRole('Admin Departemen')) {
            return redirect()->route('admin.departemen.dashboard');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }

    public function showForgotPassword() {
        return view('auth.forgot-password');
    }

    public function sendResetPassword(Request $request) {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        $token = bin2hex(random_bytes(16));

        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $request->email],
            [
                'email' => $request->email,
                'token' => $token,
                'created_at' => Carbon::now()
            ]
        );

        Mail::send('emails.reset-password', ['token' => $token], function($message) use($request) {
            $message->to($request->email);
            $message->subject('no-reply');
        });

        return redirect()->route('reset-password.show')->with('status', 'Link reset password sudah dikirim ke email kamu!');
    }

    public function showResetPassword($token) {
        return view('auth.reset-password', ['token' => $token]);
    }

    public function resetPassword(Request $request) {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|confirmed|min:8',
            'token' => 'required'
        ]);

        $reset = DB::table('password_reset_tokens')->where([
            'email' => $request->email,
            'token' => $request->token
        ])->first();

        if (!$reset) {
            return back()->withErrors(['error' => 'Token tidak valid atau sudah kadaluarsa.']);
        }

        $user = User::where('email', $request->email)->first();
        $user->update(['password' => bcrypt($request->password)]);

        DB::table('password_reset_tokens')->where('email', $request->email)->delete();

        return redirect()->route('login.show')->with('status', 'Password berhasil direset, silahkan login kembali');
    }
}
