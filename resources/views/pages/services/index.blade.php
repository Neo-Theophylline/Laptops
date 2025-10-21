@extends('layouts.app')
@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Service</h3>
                    <p class="text-subtitle text-muted">Services data</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Data</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Services</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <section class="section">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title d-flex justify-content-between align-items-center flex-wrap">
                        <span>Service</span>
                        <a href="{{ route('services.create') }}" class="btn btn-primary">Add Service</a>
                    </h5>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table" id="table1">
                            <thead>
                                <tr>
                                    <th>No invoice</th>
                                    <th>Customer</th>
                                    <th>Laptop</th>
                                    <th>Laptop Models</th>
                                    <th>Status</th>
                                    <th>Payment</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="align-middle">
                                    <td class="text-nowrap">INV-001</td>
                                    <td class="text-nowrap">John Doe</td>
                                    <td class="text-nowrap">Ass us Rough</td>
                                    <td class="text-nowrap">john@example.com</td>
                                    <td class="text-nowrap">
                                        <span class="badge bg-success">Success</span>
                                    </td>
                                    <td class="text-nowrap">
                                        <span class="badge bg-success">Paid</span>
                                    </td>
                                    <td class="text-nowrap">
                                        <div class="d-inline-flex gap-2 align-items-center">
                                            <a href="{{ route('services.show',1) }}" class="btn btn-sm btn-primary">Detail</a>
                                            <a href="{{ route('services.payment',1) }}" class="btn btn-sm btn-success">Payment</a>
                                        </div>
                                    </td>
                                </tr>

                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
