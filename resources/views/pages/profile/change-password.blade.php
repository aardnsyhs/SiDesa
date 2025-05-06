@extends('layouts.app')

@section('content')

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Ubah Password</h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Form Ubah Password</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('password.update', auth()->user()->id) }}" method="POST">
                @csrf
                @method('POST')
                <div class="form-group">
                    <label for="old_password">Password Lama</label>
                    <input type="password" class="form-control @error('old_password') is-invalid @enderror"
                        id="old_password" name="old_password">
                    @error('old_password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="new_password">Password Baru</label>
                    <input type="password" class="form-control @error('new_password') is-invalid @enderror"
                        id="new_password" name="new_password">
                    @error('new_password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="d-flex justify-content-end" style="gap: 10px">
                    <a href="/dashboard" class="btn btn-outline-secondary">Kembali</a>
                    <button type="submit" class="btn btn-primary">Perbarui</button>
                </div>
            </form>
        </div>
    </div>

@endsection
