@extends('layouts.app')
@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Services</h3>
                <p class="text-subtitle text-muted">Service data</p>
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
                    <span>Services</span>
                    <a href="{{ route('services.create') }}" class="btn btn-primary">Add Service</a>
                </h5>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table" id="table1">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>No Invoice</th>
                                <th>Customer</th>
                                <th>Laptop</th>
                                <th>Status</th>
                                <th>Paid Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($services as $service)
                                <tr class="align-middle">
                                    <td>{{ $loop->iteration }}</td>
                                    <td class="text-nowrap">{{ $service->no_invoice ?? '-' }}</td>
                                    <td class="text-nowrap">{{ $service->customer_name ?? '-' }}</td>
                                    <td class="text-nowrap">{{ $service->laptop->name ?? '-' }}</td>

                                    <td class="text-nowrap">
                                        <span class="badge bg-{{ $service->status === 'Completed' ? 'success' : ($service->status === 'On Progress' ? 'warning' : 'secondary') }}">
                                            {{ $service->status }}
                                        </span>
                                    </td>

                                    <td class="text-nowrap">
                                        <span class="badge bg-{{ $service->paid_status === 'Paid' ? 'success' : 'danger' }}">
                                            {{ $service->paid_status }}
                                        </span>
                                    </td>

                                    <td class="text-nowrap">
                                        <div class="d-inline-flex gap-2 align-items-center">
                                            <a href="{{ route('services.show', $service->id) }}" class="btn btn-sm btn-primary">Detail</a>
                                            <a href="{{ route('services.edit', $service->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                            <form action="{{ route('services.destroy', $service->id) }}" method="POST"
                                                  onsubmit="return confirm('Are you sure you want to delete this service?');"
                                                  style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center text-muted">No service data found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
