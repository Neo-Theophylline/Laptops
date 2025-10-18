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
                <h3>Laptops</h3>
                <p class="text-subtitle text-muted">Laptop data</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="">Data</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('laptops.index') }}">Laptops</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Detail</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <section id="laptop-detail">
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Detail Laptop Data</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form">
                                <div class="row">

                                    {{-- Brand --}}
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="brand">Brand</label>
                                            <input type="text" id="brand" class="form-control" value="{{ $laptop->brand }}" disabled>
                                        </div>
                                    </div>

                                    {{-- Model --}}
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="model">Model</label>
                                            <input type="text" id="model" class="form-control" value="{{ $laptop->model }}" disabled>
                                        </div>
                                    </div>

                                    {{-- Released Year --}}
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="released_year">Released Year</label>
                                            <input type="text" id="released_year" class="form-control" value="{{ $laptop->released_year ?? '-' }}" disabled>
                                        </div>
                                    </div>

                                    {{-- Status --}}
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="status">Status</label>
                                            <select class="form-select" id="status" disabled>
                                                <option value="Active" {{ $laptop->status == 'Active' ? 'selected' : '' }}>Active</option>
                                                <option value="Inactive" {{ $laptop->status == 'Inactive' ? 'selected' : '' }}>Inactive</option>
                                            </select>
                                        </div>
                                    </div>

                                    {{-- Photo --}}
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="photo">Photo</label>
                                            <br>
                                            @if ($laptop->photo)
                                                <img id="photoPreview" src="{{ asset('storage/' . $laptop->photo) }}" alt="{{ $laptop->brand }}">
                                            @else
                                                <img id="photoPreview" src="{{ asset('assets/img/npc.png') }}" alt="Default">
                                            @endif
                                        </div>
                                    </div>

                                    {{-- Back Button --}}
                                    <div class="col-12 d-flex justify-content-end">
                                        <a href="{{ route('laptops.index') }}" class="btn btn-light-secondary me-1 mb-1">Back</a>
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
