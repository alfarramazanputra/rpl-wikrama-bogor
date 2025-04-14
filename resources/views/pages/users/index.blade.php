@extends('layouts.main')

@section('content')
    @if (Session::get('succes'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ Session::get('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-3">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">User</li>
        </ol>
    </nav>

    <h1 class="h4 mb-4">User</h1>

    <!-- Main -->
    <div class="mb-3 text-end">
        <a href="{{ route('users.create') }}" class="btn btn-primary">+ Tambah User</a>
        <a href="{{ route('users.exportUser') }}" class="btn btn-success text-white">Export</a>
    </div>
    
    <div class="card shadow-sm">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th class="text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($data as $key => $item)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $item['name'] }}</td>
                            <td>{{ $item['email'] }}</td>
                            <td>{{ ucfirst($item['role']) }}</td>
                            <td class="text-end d-flex justify-content-end gap-2">
                                <a href="{{ route('users.edit', $item['id']) }}" class="btn btn-warning btn-sm text-white">Edit</a>
                                <form action="{{ route('users.delete', $item['id']) }}" method="POST"
                                    onsubmit="return confirm('Apakah Anda yakin ingin menghapus user {{ $item['name'] }}?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted">Belum ada data user.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>    
@endsection