@extends('layouts.app')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Daftar Akun Penduduk</h1>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Tabel Daftar Akun Penduduk</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-sm" id="penduduk" style="width:100%;">
                    <thead class="text-nowrap">
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $user->nama }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @if ($user->status == 'approved')
                                        <span class="badge bg-success text-white">Aktif</span>
                                    @else
                                        <span class="badge bg-danger text-white">Tidak Aktif</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex gap-2">
                                        @if($user->status == 'approved')
                                            <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal"
                                                data-bs-target="#rejectModal-{{ $user->id }}">
                                                <i class="fas fa-user-slash"></i> Nonaktifkan
                                            </button>
                                        @else
                                            <button type="button" class="btn btn-sm btn-outline-success" data-bs-toggle="modal"
                                                data-bs-target="#approveModal-{{ $user->id }}">
                                                <i class="fas fa-user-check"></i> Aktifkan
                                            </button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @include('pages.account-list.confirmation-approve')
                            @include('pages.account-list.confirmation-reject')
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
