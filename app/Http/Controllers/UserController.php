<?php

namespace App\Http\Controllers;

use App\Models\Resident;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function accountRequestView()
    {
        $users = User::whereHas('role', function ($query) {
            $query->where('name', '!=', 'admin');
        })->get();
        $residents = Resident::where('user_id', null)->get();

        return view('pages.account-request.index', [
            'users' => $users,
            'residents' => $residents
        ]);
    }

    public function accountApproval(Request $request, $id)
    {
        $request->validate([
            'for' => ['required', Rule::in(['approve', 'reject', 'activate', 'deactivate'])],
            'resident_id' => ['nullable', 'exists:residents,id']
        ]);
        $user = User::findOrFail($id);
        $action = $request->input('for');

        if ($request->filled('resident_id')) {
            Resident::where('id', $request->resident_id)->update([
                'user_id' => $user->id,
            ]);
        }

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

    public function profileView()
    {
        return view("pages.profile.index");
    }

    public function updateProfile(Request $request, $userId)
    {
        $request->validate([
            'nama' => 'required|min:3'
        ]);

        $user = User::findOrFail($userId);

        if ($request->has('email') && $request->input('email') !== $user->email) {
            return back()->with('sweetalert', [
                'title' => 'Akses Ditolak',
                'text' => 'Anda tidak diizinkan mengubah email.',
                'icon' => 'warning',
                'confirmButtonText' => 'OK'
            ]);
        }

        $user->nama = $request->input('nama');
        $user->save();

        return back()->with('sweetalert', [
            'title' => 'Berhasil Diperbarui',
            'text' => 'Data profil berhasil diperbarui.',
            'icon' => 'success',
            'confirmButtonText' => 'OK'
        ]);
    }

    public function changePasswordView()
    {
        return view("pages.profile.change-password");
    }

    public function changePassword(Request $request, $userId)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|min:8',
        ]);

        $user = User::findOrFail($userId);

        if (!Hash::check($request->input('old_password'), $user->password)) {
            $alert = [
                'title' => 'Gagal Mengubah Password',
                'text' => 'Password lama tidak cocok.',
                'icon' => 'error',
                'confirmButtonText' => 'OK'
            ];
            return back()->with('sweetalert', $alert);
        }

        $user->password = Hash::make($request->input('new_password'));
        $user->save();

        $alert = [
            'title' => 'Berhasil Diperbarui',
            'text' => 'Password berhasil diperbarui.',
            'icon' => 'success',
            'confirmButtonText' => 'OK'
        ];

        return back()->with('sweetalert', $alert);
    }
}
