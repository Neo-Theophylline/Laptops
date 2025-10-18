@extends('layouts.app')
@section('content')
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
                        <li class="breadcrumb-item active" aria-current="page">Index</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title d-flex justify-content-between gap-2 flex-wrap">
                    <div>Laptops</div>
                    <div>
                        <a href="{{ route('laptops.create') }}" class="btn btn-primary">Add Laptop</a>
                    </div>
                </h5>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table" id="table1">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Photo</th>
                                <th>Brand</th>
                                <th>Model</th>
                                <th>Released Year</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($laptops as  $laptop)
                            <tr class="align-middle">
                                <td class="text-nowrap">{{ $loop->iteration }}</td>
                                <td class="text-nowrap">
                                    @if($laptop->photo)
                                        <img src="{{ asset('storage/' . $laptop->photo) }}" alt="{{ $laptop->brand }}"
                                            style="width: 50px; height: 50px; object-fit: cover;">
                                    @else
                                        <img src="{{ asset('assets/img/npc.png') }}" alt="No Photo"
                                            style="width: 50px; height: 50px; object-fit: cover;">
                                    @endif
                                </td>
                                <td class="text-nowrap">{{ $laptop->brand }}</td>
                                <td class="text-nowrap">{{ $laptop->model }}</td>
                                <td class="text-nowrap">{{ $laptop->released_year }}</td>
                                <td class="text-nowrap">
                                    <span class="badge {{ $laptop->status == 'Active' ? 'bg-success' : 'bg-danger' }}">
                                        {{ $laptop->status }}
                                    </span>
                                </td>
                                <td class="text-nowrap align-middle">
                                    <div class="d-inline-flex gap-2 align-items-center">
                                        <a href="{{ route('laptops.show', $laptop->id) }}" class="btn btn-sm btn-primary">Detail</a>
                                        <a href="{{ route('laptops.edit', $laptop->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                        <form action="{{ route('laptops.destroy', $laptop->id) }}" method="POST" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this Laptop?')">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
