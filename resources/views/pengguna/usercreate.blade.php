@extends('layout.template')

@section('main')
    <div class="card text-center">
        <div class="card-header">
            <h1>Buat Data User Baru</h1>
        </div>
    </div>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('users.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="name">Nama User :</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                value="{{ old('name') }}" required>
            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
            <label for="email">Email :</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email"
                value="{{ old('email') }}" required>
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
            <label for="password">Password :</label>
            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                name="password" required>
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
            <label for="password_confirmation">Confirm Password :</label>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
        </div>

        <div class="form-group">
            <label for="level">Peran :</label>
            <select class="form-control" id="level" name="level">
                <option value="">Pilih Peran</option>
                <option value="Admin" {{ old('level') == 'Admin' ? 'selected' : '' }}>Admin</option>
                <option value="dosen" {{ old('level') == 'dosen' ? 'selected' : '' }}>Dosen</option>
                <option value="kaprodi" {{ old('level') == 'kaprodi' ? 'selected' : '' }}>Kaprodi</option>
                <option value="mahasiswa" {{ old('level') == 'mahasiswa' ? 'selected' : '' }}>Mahasiswa</option>
            </select>
        </div>


        <a href="{{ route('users.index') }}" class="btn btn-secondary mt-3 mb-3">Kembali</a>
        <button type="submit" class="btn btn-primary">Create User</button>
    </form>
@endsection
