<?php

namespace App\Http\Controllers;

use App\Helpers\HashidsHelper;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;

class ConfirmAccountsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::whereDoesntHave('roles', function ($query) {
            $query->where('name', 'Admin Review');
        })->orderBy('created_at', 'desc')->paginate(15);

        return view('confirm-accounts.index', compact('users'));
    }

    /**
     * Display the specified resource.
     */
    public function showConfirm(Request $request)
    {
        try {
            $userId = HashidsHelper::decode($request->route('account'));
        } catch (Exception $e) {
            abort(404, 'Akun tidak ditemukan');
        }

        $user = User::find($userId);

        return view('confirm-accounts.show', compact('user'));
    }

    public function destroySome(Request $request)
    {
        foreach ($request->users as $user) {
            try {
                $userId = HashidsHelper::decode($user);
            } catch (Exception $e) {
                abort(404, 'Akun tidak ditemukan');
            }

            try {
                User::find($userId)->delete();
            } catch (Exception $e) {
                abort(404, 'Gagal mengkonfirmasi akun');
            }
        }

        return redirect()->route('confirm-accounts.index')->with('success', 'Berhasil menghapus akun');
    }

    public function confirmSome(Request $request)
    {
        foreach ($request->users as $user) {
            try {
                $userId = HashidsHelper::decode($user);
            } catch (Exception $e) {
                abort(404, 'Akun tidak ditemukan');
            }

            try {
                $user = User::find($userId);
                if ($user->is_validated == 0) {
                    $user->is_validated = 1;
                    $user->assignRole('Admin Departemen');
                    $user->save();
                }
            } catch (Exception $e) {
                abort(404, 'Gagal menghapus akun');
            }
        }

        return redirect()->route('confirm-accounts.index')->with('success', 'Berhasil mengkonfirmasi akun');
    }
}
