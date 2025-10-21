@extends('layouts.app')
@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Users</h3>
                <p class="text-subtitle text-muted">User data</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Data</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Users</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="card">
            <div class="card-header"> 
                <h5 class="card-title d-flex justify-content-between align-items-center flex-wrap">
                    <span>Users</span>
                    <a href="{{ route('users.create') }}" class="btn btn-primary">Add User</a>
                </h5>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table" id="table1">
                        <thead>
                            <tr>
                                <th>Photo</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($users as $user)
                                <tr class="align-middle">
                                    <td class="text-nowrap">
                                        @if ($user->photo)
                                            <img src="{{ asset('storage/' . $user->photo) }}" alt="{{ $user->name }}"
                                                style="width: 50px; height: 50px; object-fit: cover;">
                                        @else
                                            <img src="{{ asset('assets/img/npc.png') }}" alt="Default"
                                                style="width: 50px; height: 50px; object-fit: cover;">
                                        @endif
                                    </td>

                                    <td class="text-nowrap">{{ $user->name }}</td>
                                    <td class="text-nowrap">{{ $user->email }}</td>

                                    <td class="text-nowrap">
                                        <small
                                            style="color:
                                                {{ $user->role === 'Admin' ? 'rgb(0,183,255)' :
                                                ($user->role === 'Technician' ? 'rgb(255,238,0)' : 'rgb(21,255,0)') }};">
                                            {{ $user->role }}
                                        </small>
                                    </td>

                                    <td class="text-nowrap">
                                        <span class="badge bg-{{ $user->status === 'Active' ? 'success' : 'danger' }}">
                                            {{ $user->status === 'Active' ? 'Active' : 'Inactive' }}
                                        </span>
                                    </td>

                                    <td class="text-nowrap">
                                        <div class="d-inline-flex gap-2 align-items-center">
                                            <a href="{{ route('users.show', $user->id) }}" class="btn btn-sm btn-primary">Detail</a>
                                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                            <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                                                  onsubmit="return confirm('Are you sure you want to delete this user?');"
                                                  style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
