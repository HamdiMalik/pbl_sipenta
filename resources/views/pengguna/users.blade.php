@extends('layout.template')

@section('main')
    <div class="card text-center">
        <div class="card-header">
            <h1>Data Users</h1>
        </div>
    </div>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <div class="row py-3">
        <div class="col-md-12 d-flex justify-content-between align-items-center">
            <div>
                <div>
                    <form action="{{ route('users.import') }}" method="POST" enctype="multipart/form-data" class="d-inline">
                        @csrf

                        <button for="file" class="btn btn-success mb-2" type="submit"><i class="fa fa-file">
                                Import</i></button>
                        <a class="btn btn-warning mb-2" href="/exportuser">
                            <i class="fa fa-download"> Ekspor</i>
                        </a>

                        <input type="file" name="file" id="file" class="form-control mb-2" accept=".xlsx">
                    </form>
                </div>
            </div>

            <div id="datatable_info" class="mr-2"></div>

            <div class="col-auto">
                <div>
                    <label>
                        Show
                        <select name="entries" id="entries" class="form-select form-select-sm d-inline-block"
                            style="width: auto; display: inline;">
                            <option value="10">10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>
                        entries
                    </label>
                    <a href="{{ route('users.create') }}" class="btn btn-primary ml-3">Tambah User</a>
                </div>
                {{-- @can('admin-only') --}}

                {{-- @endcan --}}
                {{-- @if (Gate::allows('adminonly')) --}}
                {{-- @if (auth()->user()->level === 'admin') --}}

                {{-- @endif --}}
                {{-- @endif --}}

            </div>
        </div>
    </div>

    <table class="table table-bordered">
        <thead class="table-primary">
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Email</th>
                <th>Peran</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @if ($users->count() > 0)
                @foreach ($users as $user)
                    <tr>
                        <td class="align-middle">{{ $loop->iteration }}</td>
                        <td class="align-middle">{{ $user->name }}</td>
                        <td class="align-middle">{{ $user->email }}</td>
                        <td class="align-middle">{{ $user->level }}</td>
                        <td class="align-middle">
                            <div class="btn-group" role="group" aria-label="Basic example">
                                {{-- @if (auth()->user()->level === 'admin') --}}
                                <a href="{{ route('users.show', $user->id) }}" class="btn btn-info mr-1">Detail</a>
                                {{--  @can('admin-only') --}}
                                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning mr-1">Edit</a>
                                <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline"
                                    onsubmit="return confirm('Delete?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger mr-1">Delete</button>
                                </form>
                                {{-- @endif --}}
                                {{--   @endcan --}}
                            </div>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="6" class="text-center">No users found</td>
                </tr>
            @endif
        </tbody>
    </table>
@endsection
