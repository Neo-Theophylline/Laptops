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
                <h3>Laptops</h3>
                <p class="text-subtitle text-muted">Laptop data</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="">Data</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('laptops.index') }}">Laptops</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit</li>
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
                        <h4 class="card-title">Edit Laptops Data</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form" action="{{ route('laptops.update', $laptop->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row">

                                    {{-- Brand --}}
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="brand">Brand</label>
                                            <input type="text" id="brand" name="brand" class="form-control"
                                                value="{{ old('brand', $laptop->brand) }}" required>
                                        </div>
                                    </div>

                                    {{-- Model --}}
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="model">Model</label>
                                            <input type="text" id="model" name="model" class="form-control"
                                                value="{{ old('model', $laptop->model) }}" required>
                                        </div>
                                    </div>

                                    {{-- Released Year --}}
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="released_year">Released Year</label>
                                            <input type="text" id="released_year" name="released_year" class="form-control"
                                                value="{{ old('released_year', $laptop->released_year) }}">
                                        </div>
                                    </div>

                                    {{-- Status --}}
                                    <div class="col-md-6 col-12">
                                        <fieldset class="form-group">
                                            <label for="status">Status</label>
                                            <select class="form-select" id="status" name="status" required>
                                                <option hidden>Select status</option>
                                                <option value="Active" {{ $laptop->status == 'Active' ? 'selected' : '' }}>Active</option>
                                                <option value="Inactive" {{ $laptop->status == 'Inactive' ? 'selected' : '' }}>Inactive</option>
                                            </select>
                                        </fieldset>
                                    </div>

                                    {{-- Photo --}}
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="photo">Photo</label>
                                            <input class="form-control" type="file" id="formFile" name="photo" accept="image/*" onchange="previewPhoto(event)">
                                            @if ($laptop->photo)
                                                <img id="photoPreview" src="{{ asset('storage/' . $laptop->photo) }}" alt="Photo Preview">
                                            @else
                                                <img id="photoPreview" src="#" alt="Photo Preview" style="display:none;">
                                            @endif
                                        </div>
                                    </div>

                                    {{-- Buttons --}}
                                    <div class="col-12 d-flex justify-content-end">
                                        <button type="submit" class="btn btn-primary me-1 mb-1">Update</button>
                                        <a href="{{ route('laptops.index') }}" class="btn btn-light-secondary me-1 mb-1">Cancel</a>
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
        @if($laptop->photo)
            preview.src = "{{ asset('storage/' . $laptop->photo) }}";
        @else
            preview.src = '#';
            preview.style.display = 'none';
        @endif
    }
}
</script>
@endsection
