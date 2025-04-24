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
                                <td>
                                    <div class="d-flex gap-2">
                                        <a href="/resident/{id}" class="d-inline-block mr-2 btn btn-sm btn-warning">
                                            <i class="fas fa-pen"></i>
                                        </a>
                                        <a href="/resident/{id}" class="btn btn-sm btn-danger">
                                            <i class="fas fa-eraser"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection