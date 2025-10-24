@extends('layouts.app')
@section('content')
<style>
    #photoPreview {
        width: 100px;
        height: 100px;
        object-fit: cover;
        margin-top: 8px;
        margin-left: 5px;
    }
</style>

<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Edit Service Item</h3>
                <p class="text-subtitle text-muted">Edit data service item</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Data</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('serviceitems.index') }}">Service Items</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <section id="edit-serviceitem-form">
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Edit Service Item Data</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            {{-- Pastikan $serviceItem tidak null --}}
                            @if(isset($serviceItem))
                            <form action="{{ route('serviceitems.update', $serviceItem->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row">

                                    {{-- Service Name --}}
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="service_name">Service Name</label>
                                            <input type="text" id="service_name" name="service_name"
                                                   class="form-control"
                                                   value="{{ old('service_name', $serviceItem->service_name) }}" required>
                                        </div>
                                    </div>

                                    {{-- Price --}}
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="price">Price</label>
                                            <input type="text" id="price" name="price" class="form-control"
                                                   value="{{ old('price', $serviceItem->price) }}" required>
                                        </div>
                                    </div>

                                    {{-- Photo --}}
                                    <div class="col-md-6 col-12 mt-3">
                                        <div class="form-group">
                                            <label for="photo">Photo</label>
                                            <input type="file" class="form-control" id="formFile" name="photo"
                                                   accept="image/*" onchange="previewPhoto(event)">
                                            <img id="photoPreview"
                                                 src="{{ $serviceItem->photo ? asset('storage/' . $serviceItem->photo) : asset('assets/img/wrench.jpg') }}"
                                                 alt="Photo Preview">
                                        </div>
                                    </div>

                                    {{-- Status --}}
                                    <div class="col-md-6 col-12 mt-3">
                                        <div class="form-group">
                                            <label for="status">Status</label>
                                            <select name="status" class="form-select" id="status" required>
                                                <option value="Active" {{ $serviceItem->status == 'Active' ? 'selected' : '' }}>Active</option>
                                                <option value="Inactive" {{ $serviceItem->status == 'Inactive' ? 'selected' : '' }}>Inactive</option>
                                            </select>
                                        </div>
                                    </div>

                                    {{-- Buttons --}}
                                    <div class="col-12 d-flex justify-content-end mt-3">
                                        <button type="submit" class="btn btn-primary me-1 mb-1">Update</button>
                                        <a href="{{ route('serviceitems.index') }}" class="btn btn-light-secondary me-1 mb-1">Cancel</a>
                                    </div>

                                </div>
                            </form>
                            @else
                                <div class="alert alert-danger">Service item data not found.</div>
                            @endif
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
            reader.onload = e => preview.src = e.target.result;
            reader.readAsDataURL(file);
        }
    }
</script>
@endsection
