@extends('layouts.app')

@section('content')

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tambah Penduduk</h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Form Tambah Penduduk</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('resident.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="nama">Nama</label>
                    <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama"
                        value="{{ old('nama') }}">
                    @error('nama')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="jenis_kelamin">Jenis Kelamin</label>
                    <select class="form-control @error('jenis_kelamin') is-invalid @enderror" id="jenis_kelamin"
                        name="jenis_kelamin">
                        <option value="">Pilih Jenis Kelamin</option>
                        <option value="pria" {{ old('jenis_kelamin') == 'pria' ? 'selected' : '' }}>Pria</option>
                        <option value="wanita" {{ old('jenis_kelamin') == 'wanita' ? 'selected' : '' }}>Wanita</option>
                    </select>
                    @error('jenis_kelamin')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="tanggal_lahir">Tanggal Lahir</label>
                    <input type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror" id="tanggal_lahir"
                        name="tanggal_lahir" value="{{ old('tanggal_lahir') }}">
                    @error('tanggal_lahir')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="tempat_lahir">Tempat Lahir</label>
                    <input type="text" class="form-control @error('tempat_lahir') is-invalid @enderror" id="tempat_lahir"
                        name="tempat_lahir" value="{{ old('tempat_lahir') }}">
                    @error('tempat_lahir')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <textarea class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat"
                        rows="3">{{ old('alamat') }}</textarea>
                    @error('alamat')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="agama">Agama</label>
                    <input type="text" class="form-control @error('agama') is-invalid @enderror" id="agama" name="agama"
                        value="{{ old('agama') }}">
                    @error('agama')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="status_menikah">Status Menikah</label>
                    <select class="form-control @error('status_menikah') is-invalid @enderror" id="status_menikah"
                        name="status_menikah">
                        <option value="">Pilih Status Menikah</option>
                        <option value="belum_menikah" {{ old('status_menikah') == 'belum_menikah' ? 'selected' : '' }}>Belum
                            Menikah</option>
                        <option value="menikah" {{ old('status_menikah') == 'menikah' ? 'selected' : '' }}>Menikah</option>
                        <option value="cerai" {{ old('status_menikah') == 'cerai' ? 'selected' : '' }}>Cerai</option>
                    </select>
                    @error('status_menikah')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="pekerjaan">Pekerjaan</label>
                    <input type="text" class="form-control @error('pekerjaan') is-invalid @enderror" id="pekerjaan"
                        name="pekerjaan" value="{{ old('pekerjaan') }}">
                    @error('pekerjaan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="telepon">Telepon</label>
                    <input type="text" class="form-control @error('telepon') is-invalid @enderror" id="telepon"
                        name="telepon" value="{{ old('telepon') }}">
                    @error('telepon')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="status">Status</label>
                    <select class="form-control @error('status') is-invalid @enderror" id="status" name="status">
                        <option value="">Pilih Status</option>
                        <option value="aktif" {{ old('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                        <option value="pindah" {{ old('status') == 'pindah' ? 'selected' : '' }}>Pindah</option>
                        <option value="meninggal" {{ old('status') == 'meninggal' ? 'selected' : '' }}>Meninggal</option>
                    </select>
                    @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-end" style="gap: 10px">
                    <a href="/resident" class="btn btn-outline-secondary">Kembali</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>

@endsection