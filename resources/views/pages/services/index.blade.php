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
                                    <th>Status</th>
                                    <th>Payment</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($services as $service)
                                    <tr class="align-middle">
                                        <td class="text-nowrap">{{ $service->no_invoice }}</td>
                                        <td class="text-nowrap">{{ $service->customer->name ?? '-' }}</td>
                                        <td class="text-nowrap">{{ $service->laptop->brand ?? '-' }} {{ $service->laptop->model ?? '-' }}</td>
                                        <td class="text-nowrap">
                                            @if ($service->status == 'accepted')
                                                <span class="badge bg-info">Accepted</span>
                                            @elseif ($service->status == 'in-progress')
                                                <span class="badge bg-warning">In Progress</span>
                                            @elseif ($service->status == 'done')
                                                <span class="badge bg-success">Done</span>
                                            @else
                                                <span class="badge bg-secondary">{{ ucfirst($service->status) }}</span>
                                            @endif
                                        </td>
                                        <td class="text-nowrap">
                                            @if ($service->status_paid == 'paid')
                                                <span class="badge bg-success">Paid</span>
                                            @else
                                                <span class="badge bg-danger">Unpaid</span>
                                            @endif
                                        </td>
                                        <td class="text-nowrap">
                                            <div class="d-inline-flex gap-2 align-items-center">
                                                <a href="{{ route('services.show', $service->id) }}"
                                                    class="btn btn-sm btn-primary">Detail</a>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
