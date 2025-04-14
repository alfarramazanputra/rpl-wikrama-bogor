@extends('layouts.main')

@section('content')
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('users.index') }}">User</a></li>
            <li class="breadcrumb-item active" aria-current="page">Tambah</li>
        </ol>
    </nav>

    <h1 class="h4 mb-4">Tambah User</h1>

    <!-- Form -->
    <div class="card shadow-sm p-4">
        <form action="{{ route('users.store') }}" method="POST">
            @csrf
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="name" class="form-label">Nama<span class="text-danger">*</span></label>
                    <input type="text" id="name" name="name" required class="form-control" />
                </div>
                <div class="col-md-6">
                    <label for="email" class="form-label">Email<span class="text-danger">*</span></label>
                    <input type="email" id="email" name="email" required class="form-control" />
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="role" class="form-label">Role<span class="text-danger">*</span></label>
                    <select id="role" name="role" class="form-select" required>
                        <option disabled selected>Pilih Role</option>
                        <option value="admin">Admin</option>
                        <option value="petugas">Petugas</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="password" class="form-label">Password<span class="text-danger">*</span></label>
                    <input type="password" id="password" name="password" required class="form-control" />
                </div>
            </div>

            <div class="d-flex justify-content-end mt-4">
                <a href="{{ route('users.index') }}" class="btn btn-secondary me-2">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
@endsection