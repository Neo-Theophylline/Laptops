@extends('layouts.app')
@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Service Items</h3>
                <p class="text-subtitle text-muted">Service Items data</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Data</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Service Items</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title d-flex justify-content-between gap-2 flex-wrap">
                    <div>Service Items</div>
                    <div>
                        <a href="{{ route('serviceitems.create') }}" class="btn btn-primary">Add Service Item</a>
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
                                <th>Service Name</th>
                                <th>Price</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($serviceItems as $item) <!-- sesuaikan dengan controller -->
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <img src="{{ $item->photo ? asset('storage/'.$item->photo) : asset('assets/img/npc.png') }}" 
                                         alt="{{ $item->service_name }}" style="width:50px; height:50px; object-fit:cover;">
                                </td>
                                <td>{{ $item->service_name }}</td>
                                <td>Rp. {{ $item->price }}</td>
                                <td>
                                    <span class="badge {{ $item->status == 'Active' ? 'bg-success' : 'bg-danger' }}">
                                        {{ $item->status }}
                                    </span>
                                </td>
                                <td>
                                    <div class="d-inline-flex gap-2 align-items-center">
                                        <a href="{{ route('serviceitems.show', $item->id) }}" class="btn btn-sm btn-primary">Detail</a>
                                        <a href="{{ route('serviceitems.edit', $item->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                        <form action="{{ route('serviceitems.destroy', $item->id) }}" method="POST" style="display:inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this item?')">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center">No service items found.</td>
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
