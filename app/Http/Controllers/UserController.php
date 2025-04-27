<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function accountRequestView()
    {
        $users = User::whereHas('role', function ($query) {
            $query->where('name', '!=', 'admin');
        })->get();

        return view('pages.account-request.index', [
            'users' => $users,
        ]);
    }

    public function accountApproval(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $action = $request->input('for');

        if ($action == 'approve') {
            $user->status = 'approved';
            $alert = [
                'title' => 'Berhasil Disetujui',
                'text' => 'Akun pengguna berhasil disetujui.',
                'icon' => 'success',
                'confirmButtonText' => 'OK'
            ];
        } elseif ($action == 'reject') {
            $user->status = 'rejected';
            $alert = [
                'title' => 'Akun Ditolak',
                'text' => 'Akun pengguna berhasil ditolak.',
                'icon' => 'error',
                'confirmButtonText' => 'OK'
            ];
        } else {
            return redirect()->back()->with('sweetalert', [
                'title' => 'Aksi Tidak Valid',
                'text' => 'Tindakan yang Anda pilih tidak dikenali.',
                'icon' => 'warning',
                'confirmButtonText' => 'OK'
            ]);
        }

        $user->save();

        return redirect()->route('account-request.index')->with('sweetalert', $alert);
    }
}
