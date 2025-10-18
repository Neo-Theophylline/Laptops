@extends('layouts.app')
@section('content')

<style>
    #photoPreview {
        width: 150px;
        height: 150px;
        object-fit: cover;
        margin-top: 8px;
        margin-left: 5px;
        display: none;
    }
</style>

<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Laptops</h3>
                <p class="text-subtitle text-muted">Add New Laptop</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="">Data</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('laptops.index') }}">Laptops</a></li>
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
                        <h4 class="card-title">Create Laptop</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form action="{{ route('laptops.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">

                                    {{-- Brand --}}
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="brand">Brand</label>
                                            <input type="text" id="brand" class="form-control" placeholder="ex: ASUS" name="brand" value="{{ old('brand') }}" required>
                                        </div>
                                    </div>

                                    {{-- Model --}}
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="model">Model</label>
                                            <input type="text" id="model" class="form-control" placeholder="ex: ROG Abc" name="model" value="{{ old('model') }}" required>
                                        </div>
                                    </div>

                                    {{-- Released Year --}}
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="released_year">Released Year</label>
                                            <input type="number" id="released_year" class="form-control" placeholder="ex: 2020" name="released_year" value="{{ old('released_year') }}">
                                        </div>
                                    </div>

                                    {{-- Status --}}
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="status">Status</label>
                                            <select class="form-select" id="status" name="status" required>
                                                <option hidden>Select status</option>
                                                <option value="Active" {{ old('status')=='Active' ? 'selected' : '' }}>Active</option>
                                                <option value="Inactive" {{ old('status')=='Inactive' ? 'selected' : '' }}>Inactive</option>
                                            </select>
                                        </div>
                                    </div>

                                    {{-- Photo --}}
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="photo">Photo</label>
                                            <input type="file" class="form-control" id="photo" name="photo" accept="image/*" onchange="previewPhoto(event)">
                                            <img id="photoPreview" src="#" alt="Photo Preview">
                                        </div>
                                    </div>

                                    {{-- Buttons --}}
                                    <div class="col-12 d-flex justify-content-end mt-3">
                                        <button type="submit" class="btn btn-primary me-1">Submit</button>
                                        <a href="{{ route('laptops.index') }}" class="btn btn-light-secondary">Cancel</a>
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
