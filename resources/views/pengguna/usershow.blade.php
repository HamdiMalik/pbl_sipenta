@extends('layout.template')

@section('main')
    <div class="row">
        <div class="col">
            <h1 class="mb-4">Detail Data User</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="mb-3">
                <label for="name" class="form-label">Nama User :</label>
                <input type="text" class="form-control" id="name" value="{{ $user->name }}" readonly>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email :</label>
                <input type="email" class="form-control" id="email" value="{{ $user->email }}" readonly>
            </div>
            <div class="mb-3">
                <label for="level" class="form-label">Peran :</label>
                <input type="text" class="form-control" id="level" value="{{ $user->level }}" readonly>
            </div>
            <div class="mb-3">
                <label for="email_verified_at" class="form-label">Email Verified :</label>
                <input type="text" class="form-control" id="email_verified_at"
                    value="{{ $user->email_verified_at ? $user->email_verified_at : 'Not Verified' }}" readonly>
            </div>
        </div>
    </div>
    <a href="{{ route('users.index') }}" class="btn btn-primary mt-3 mb-3">Kembali</a>
@endsection
