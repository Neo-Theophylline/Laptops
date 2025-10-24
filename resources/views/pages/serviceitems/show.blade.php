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
                <h3>Service Items</h3>
                <p class="text-subtitle text-muted">Service Item data</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Data</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('serviceitems.index') }}">Service Items</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Detail</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <section id="serviceitem-detail">
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Detail Service Item</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form">
                                <div class="row">

                                    {{-- Service Name --}}
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="service_name">Service Name</label>
                                            <input type="text" class="form-control" value="{{ $serviceItem->service_name }}" disabled>
                                        </div>
                                    </div>

                                    {{-- Price --}}
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="price">Price</label>
                                            <input type="text" class="form-control" value="Rp {{ $serviceItem->price }}" disabled>
                                        </div>
                                    </div>
                                    
                                    {{-- Photo --}}
                                    <div class="col-md-6 col-12 mt-3">
                                        <div class="form-group">
                                            <label for="photo">Photo</label>
                                            <br>
                                            @if ($serviceItem->photo)
                                                <img id="photoPreview" src="{{ asset('storage/' . $serviceItem->photo) }}" alt="{{ $serviceItem->service_name }}">
                                            @else
                                                <img id="photoPreview" src="{{ asset('assets/img/wrench.jpg') }}" alt="Default">
                                            @endif
                                        </div>
                                    </div>
                                    
                                    {{-- Status --}}
                                    <div class="col-md-6 col-12 mt-3">
                                        <div class="form-group">
                                            <label for="status">Status</label>
                                            <input type="text" class="form-control" value="{{ $serviceItem->status }}" disabled>
                                        </div>
                                    </div> 

                                    {{-- Back Button --}}
                                    <div class="col-12 d-flex justify-content-end mt-3">
                                        <a href="{{ route('serviceitems.index') }}" class="btn btn-light-secondary me-1 mb-1">Back</a>
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
