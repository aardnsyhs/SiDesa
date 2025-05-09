@extends('layouts.app')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Penduduk</h1>
        <a href="/resident/create" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-plus fa-sm text-white-50"></i> Tambah</a>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Tabel Penduduk</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-sm" id="penduduk" style="width:100%;">
                    <thead class="text-nowrap">
                        <tr>
                            <th>No</th>
                            <th>NIK</th>
                            <th>Nama</th>
                            <th>Jenis Kelamin</th>
                            <th>Tempat, Tgl Lahir</th>
                            <th>Alamat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($residents as $resident)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $resident->nik }}</td>
                                <td>{{ $resident->nama }}</td>
                                <td>{{ $resident->jenis_kelamin }}</td>
                                <td title="{{ $resident->tempat_lahir }}, {{ $resident->tanggal_lahir }}" class="text-truncate">
                                    {{ $resident->tempat_lahir }}, {{ $resident->tanggal_lahir }}
                                </td>
                                <td title="{{ $resident->alamat }}" class="text-truncate">{{ $resident->alamat }}</td>
                                <td class="text-nowrap">
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-light border" type="button"
                                            id="actionDropdown-{{ $resident->id }}" data-bs-toggle="dropdown"
                                            aria-expanded="false">
                                            <i class="fas fa-ellipsis-h"></i>
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="actionDropdown-{{ $resident->id }}">
                                            <li>
                                                <a href="{{ route('resident.edit', $resident) }}"
                                                    class="dropdown-item text-warning">
                                                    <i class="fas fa-pen mr-2"></i>Edit
                                                </a>
                                            </li>
                                            <li>
                                                <button class="dropdown-item text-danger" data-bs-toggle="modal"
                                                    data-bs-target="#deleteModal-{{ $resident->id }}">
                                                    <i class="fas fa-eraser mr-2"></i>Hapus
                                                </button>
                                            </li>
                                            @if(!is_null($resident->user_id))
                                                <li>
                                                    <button class="dropdown-item text-info" data-bs-toggle="modal"
                                                        data-bs-target="#detailAccount-{{ $resident->id }}">
                                                        <i class="fas fa-user mr-2"></i>Lihat Akun
                                                    </button>
                                                </li>
                                            @endif
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            @include('pages.resident.confirmation-delete')
                            @include('pages.resident.detail-account')
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
