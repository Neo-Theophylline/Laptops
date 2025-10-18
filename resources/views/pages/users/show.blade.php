@extends('layouts.app')
@section('content')

<style>
    #photoPreview {
        width: 150px;
        height: 150px;
        object-fit: cover;
        margin-top: 8px;
        margin-left: 5px;
    }
</style>

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
                        <li class="breadcrumb-item"><a href="">Data</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Users</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Detail</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <section id="user-detail">
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Detail User Data</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form">

                                <div class="row">

                                    {{-- Name --}}
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="name">Name</label>
                                            <input type="text" id="name" class="form-control" value="{{ $user->name }}" disabled>
                                        </div>
                                    </div>

                                    {{-- Role --}}
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="role">Role</label>
                                            <input type="text" class="form-control" value="{{ $user->role }}" disabled>
                                        </div>
                                    </div>

                                    {{-- Email --}}
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="email" class="form-control" value="{{ $user->email }}" disabled>
                                        </div>
                                    </div>

                                    {{-- Status --}}
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="status">Status</label>
                                            <input type="text" class="form-control" value="{{ $user->status }}" disabled>
                                        </div>
                                    </div>

                                    {{-- Phone --}}
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="phone">Phone</label>
                                            <input type="text" class="form-control" value="{{ $user->phone ?? '-' }}" disabled>
                                        </div>
                                    </div>

                                    {{-- Password --}}
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="password">Password</label>
                                            <input type="password" class="form-control" value="********" disabled>
                                        </div>
                                    </div>

                                    {{-- Photo --}}
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="photo">Photo</label>
                                            <br>
                                            @if ($user->photo)
                                                <img id="photoPreview" src="{{ asset('storage/' . $user->photo) }}" alt="{{ $user->name }}">
                                            @else
                                                <img id="photoPreview" src="{{ asset('assets/img/npc.png') }}" alt="Default">
                                            @endif
                                        </div>
                                    </div>

                                    {{-- Address --}}
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="address">Address</label>
                                            <input type="text" class="form-control" value="{{ $user->address ?? '-' }}" disabled>
                                        </div>
                                    </div>

                                    {{-- Back Button --}}
                                    <div class="col-12 d-flex justify-content-end">
                                        <a href="{{ route('users.index') }}" class="btn btn-light-secondary me-1 mb-1">Back</a>
                                    </div>

                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection
