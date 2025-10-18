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
                <h3>Service Items</h3>
                <p class="text-subtitle text-muted">
                    Create new service item
                </p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Data</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('serviceitems.index') }}">Service Items</a></li>
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
                        <h4 class="card-title">Create Service Item</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form" method="POST" action="{{ route('serviceitems.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="row">

                                    {{-- Service Name --}}
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="service_name">Service Name</label>
                                            <input type="text" id="service_name" class="form-control"
                                                placeholder="ex: Ram Upgrade" name="service_name" required>
                                        </div>
                                    </div>

                                    {{-- Price --}}
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="price">Price</label>
                                            <input type="text" id="price" class="form-control"
                                                placeholder="ex: 999.999" name="price" required>
                                        </div>
                                    </div>

                                    {{-- Photo --}}
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="photo">Photo</label>
                                            <input class="form-control" type="file" id="photo" name="photo" accept="image/*" onchange="previewPhoto(event)">
                                            <img id="photoPreview" src="#" alt="Photo Preview">
                                        </div>
                                    </div>

                                    {{-- Status --}}
                                    <div class="col-md-6 col-12">
                                        <fieldset class="form-group">
                                            <label for="status">Status</label>
                                            <select class="form-select" id="status" name="status" required>
                                                <option hidden>ex: Select data status</option>
                                                <option value="Active">Active</option>
                                                <option value="Inactive">Inactive</option>
                                            </select>
                                        </fieldset>
                                    </div>

                                    {{-- Buttons --}}
                                    <div class="col-12 d-flex justify-content-end">
                                        <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                        <a href="{{ route('serviceitems.index') }}" class="btn btn-light-secondary me-1 mb-1">Cancel</a>
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
