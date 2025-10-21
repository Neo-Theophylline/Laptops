@extends('layouts.app')
@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Service</h3>
                    <p class="text-subtitle text-muted">Service Detail</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Data</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('services.index') }}">Service</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Detail</li>
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
                            <h4 class="card-title mb-1">INV-001</h4>
                            <p class="text-subtitle text-muted">
                                Status :
                                <span style="color: greenyellow">Finish</span>
                            </p>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <form class="form">
                                    <div class="row">

                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label>Customer</label>
                                                <input type="text" class="form-control" value="John Doe" disabled>
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label>Technician</label>
                                                <input type="text" class="form-control" value="Wahyu Saputra" disabled>
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label>Laptop</label>
                                                <input type="text" class="form-control" value="Lenovo X1 Carbon"
                                                    disabled>
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label>Received Date</label>
                                                <input type="text" class="form-control" value="2025-01-12" disabled>
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label>Damage Description</label>
                                                <textarea class="form-control" rows="3" disabled>LCD cracked, no display</textarea>
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label>Completed Date</label>
                                                <input type="text" class="form-control" value="2025-01-15" disabled>
                                            </div>
                                        </div>

                                    </div> <!-- row -->
                                </form>
                            </div> <!-- card-body -->
                        </div> <!-- card-content -->
                    </div> <!-- card -->
                </div>
            </div>
        </section>

        <section class="section">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Service Items</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('services.store') }}" method="POST" id="form-service-items">
                        @csrf
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th style="width:10%">#</th>
                                        <th style="width:45%">Service Item</th>
                                        <th style="width:45%">Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>LCD Replacement</td>
                                        <td>Rp 1.500.000</td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>Keyboard Repair</td>
                                        <td>Rp 450.000</td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>Thermal Paste Cleaning</td>
                                        <td>Rp 150.000</td>
                                    </tr>
                                </tbody>
                            </table>

                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
@endsection
