@extends('layouts.app')
@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Service</h3>
                    <p class="text-subtitle text-muted">Service Edit</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Data</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('services.index') }}">Service</a></li>
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
                            <h4 class="card-title mb-1">Service Detail</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <form class="form" method="POST" action="#">
                                    <div class="row">

                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label>No Invoice</label>
                                                <input type="text" class="form-control" value="INV-001">
                                            </div>
                                        </div>

                                        <div class="col-md-6 mb-12">
                                            <fieldset class="form-group">
                                                <label for="status">Status</label>
                                                <select class="form-select" id="status" name="status" required>
                                                    <option hidden>Select data status</option>
                                                    <option value="Active" selected>Active</option>
                                                    <option value="Inactive">Inactive</option>
                                                </select>
                                            </fieldset>
                                        </div>

                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label>Customer</label>
                                                <input type="text" class="form-control" value="John Doe">
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label>Technician</label>
                                                <input type="text" class="form-control" value="Wahyu Saputra">
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label>Laptop</label>
                                                <input type="text" class="form-control" value="Lenovo X1 Carbon">
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label>Received Date</label>
                                                <input type="date" class="form-control" value="2025-01-12">
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label>Other Cost</label>
                                                <input type="text" class="form-control" value="25.000">
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label>Completed Date</label>
                                                <input type="date" class="form-control" value="2025-01-15">
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label>Damage Description</label>
                                                <textarea class="form-control" rows="3">LCD cracked, no display</textarea>
                                            </div>
                                        </div>

                                        <div class="col-12 d-flex justify-content-end">
                                            <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                            <a href="{{ route('services.index') }}"
                                                class="btn btn-light-secondary me-1 mb-1">Cancel</a>
                                        </div>

                                    </div> <!-- row -->
                                </form>
                            </div> <!-- card-body -->
                        </div> <!-- card-content -->
                    </div> <!-- card -->
                </div>
            </div>
        </section>
    </div>
@endsection
