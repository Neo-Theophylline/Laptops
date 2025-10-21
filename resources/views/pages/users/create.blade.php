@extends('layouts.app')
@section('content')
    <style>
        #photoPreview {
            width: 100px;
            height: 100px;
            object-fit: cover;
            margin-top: 8px;
            display: none;
            margin-left: 5px;
        }
    </style>

    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Users</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Data</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Users</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Create</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <section id="multiple-column-form">
            <div class="row match-height">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Create User Data</h4>
                            <p class="text-subtitle text-muted">User data</p>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <form class="form" action="{{ route('users.store') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">

                                        {{-- Name --}}
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="name">Name</label>
                                                <input type="text" id="name" class="form-control" name="name"
                                                    placeholder="ex: John Doe" required>
                                            </div>
                                        </div>

                                        {{-- Role --}}
                                        <div class="col-md-6 mb-12">
                                            <fieldset class="form-group">
                                                <label for="role">Role</label>
                                                <select class="form-select" id="role" name="role" required>
                                                    <option hidden>Select role user</option>
                                                    <option value="Admin">Admin</option>
                                                    <option value="Technician">Technician</option>
                                                    <option value="Customer">Customer</option>
                                                </select>
                                            </fieldset>
                                        </div>

                                        {{-- Email --}}
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="email">Email</label>
                                                <input type="email" id="email" class="form-control" name="email"
                                                    placeholder="ex: johndoe@mail.com" required>
                                            </div>
                                        </div>

                                        {{-- Status --}}
                                        <div class="col-md-6 mb-12">
                                            <fieldset class="form-group">
                                                <label for="status">Status</label>
                                                <select class="form-select" id="status" name="status" required>
                                                    <option hidden>Select data status</option>
                                                    <option value="Active">Active</option>
                                                    <option value="Inactive">Inactive</option>
                                                </select>
                                            </fieldset>
                                        </div>

                                        {{-- Phone --}}
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="phone">Phone</label>
                                                <input type="text" id="phone" class="form-control" name="phone"
                                                    placeholder="ex: +62 812 3456 7890" required>
                                            </div>
                                        </div>

                                        {{-- Password --}}
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="password">Password</label>
                                                <input type="password" id="password" class="form-control" name="password"
                                                    placeholder="ex: RmdragAyy123" required>
                                            </div>
                                        </div>

                                        {{-- Photo --}}
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="photo">Photo</label>
                                                <input class="form-control" type="file" id="photo" name="photo"
                                                    accept="image/*" onchange="previewPhoto(event)">
                                                <img id="photoPreview" src="#" alt="Photo Preview">
                                            </div>
                                        </div>

                                        {{-- Address --}}
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="address">Address</label>
                                                <input type="text" id="address" class="form-control" name="address"
                                                    placeholder="ex: Banjar" required>
                                            </div>
                                        </div>

                                        {{-- Buttons --}}
                                        <div class="col-12 d-flex justify-content-end">
                                            <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                            <a href="{{ route('users.index') }}"
                                                class="btn btn-light-secondary me-1 mb-1">Cancel</a>
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

    <script>
        function previewPhoto(event) {
            const file = event.target.files[0];
            const preview = document.getElementById('photoPreview');
            if (file) {
                const reader = new FileReader();
                reader.onload = e => {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                };
                reader.readAsDataURL(file);
            } else {
                preview.src = '#';
                preview.style.display = 'none';
            }
        }
    </script>
@endsection
