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
        <section id="multiple-column-form">
            <div class="row match-height">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Calculation</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <form class="form" action="{{ route('services.store') }}" method="POST"
                                    id="form-add-serviceitem">
                                    <div class="row">
                                        <div class="col-md-12 col-12">

                                            <div class="form-group mb-3">
                                                <label>Items Cost</label>
                                                <input class="form-control" disabled value="150.000">
                                            </div>

                                            <div class="form-group mb-3">
                                                <label>Other Cost</label>
                                                <input class="form-control" disabled value="25.000">
                                            </div>

                                            <div class="form-group mb-3">
                                                <label>Total Cost</label>
                                                <input class="form-control" disabled value="175.000">
                                            </div>

                                            <div class="form-group mb-3">
                                                <label>Total Paid</label>
                                                <input class="form-control" disabled value="100.000">
                                            </div>

                                            <div class="form-group mb-3">
                                                <label>Total Change</label>
                                                <input class="form-control" disabled value="0">
                                            </div>

                                            <div class="form-group mb-3">
                                                <label>Outstanding Balance</label>
                                                <input class="form-control" disabled value="75.000">
                                            </div>

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
