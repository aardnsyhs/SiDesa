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

        $actions = [
            'approve' => [
                'status' => 'approved',
                'alert' => [
                    'title' => 'Berhasil Disetujui',
                    'text' => 'Akun pengguna berhasil disetujui.',
                    'icon' => 'success',
                    'confirmButtonText' => 'OK'
                ],
                'redirect' => 'account-request.index',
            ],
            'reject' => [
                'status' => 'rejected',
                'alert' => [
                    'title' => 'Akun Ditolak',
                    'text' => 'Akun pengguna berhasil ditolak.',
                    'icon' => 'error',
                    'confirmButtonText' => 'OK'
                ],
                'redirect' => 'account-request.index',
            ],
            'activate' => [
                'status' => 'approved',
                'alert' => [
                    'title' => 'Berhasil Diaktifkan',
                    'text' => 'Akun pengguna berhasil diaktifkan.',
                    'icon' => 'success',
                    'confirmButtonText' => 'OK'
                ],
                'redirect' => 'account-list.index',
            ],
            'deactivate' => [
                'status' => 'rejected',
                'alert' => [
                    'title' => 'Akun Dinonaktifkan',
                    'text' => 'Akun pengguna berhasil dinonaktifkan.',
                    'icon' => 'error',
                    'confirmButtonText' => 'OK'
                ],
                'redirect' => 'account-list.index',
            ]
        ];

        if (!array_key_exists($action, $actions)) {
            return redirect()->back()->with('sweetalert', [
                'title' => 'Aksi Tidak Valid',
                'text' => 'Tindakan yang Anda pilih tidak dikenali.',
                'icon' => 'warning',
                'confirmButtonText' => 'OK'
            ]);
        }

        $user->status = $actions[$action]['status'];
        $user->save();

        return redirect()->route($actions[$action]['redirect'])->with('sweetalert', $actions[$action]['alert']);
    }

    public function accountListView()
    {
        $users = User::whereHas('role', function ($query) {
            $query->where('name', '!=', 'admin')
                ->where('status', '!=', 'submitted');
        })->get();

        return view('pages.account-list.index', [
            'users' => $users,
        ]);
    }
}
