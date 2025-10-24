@extends('layouts.app')
@section('content')
    <div class="page-heading">
        <h3>Dashboard</h3>
        <p class="text-subtitle text-muted">Service Laptop</p>
    </div>

    <div class="page-content">
        <section class="row">
            <div class="col-12 col-lg-9">
                {{-- Statistik Utama --}}
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="card">
                            <div class="card-body px-4 py-4-5">
                                <div class="row">
                                    <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                                        <div class="stats-icon blue mb-2">
                                            <i class="iconly-boldDocument"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                        <h6 class="text-muted font-semibold">Total Services</h6>
                                        <h6 class="font-extrabold mb-0">{{ $totalServices ?? 0 }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="card">
                            <div class="card-body px-4 py-4-5">
                                <div class="row">
                                    <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                                        <div class="stats-icon green mb-2">
                                            <i class="iconly-boldWork"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                        <h6 class="text-muted font-semibold">In Progress</h6>
                                        <h6 class="font-extrabold mb-0">{{ $processServices ?? 0 }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="card">
                            <div class="card-body px-4 py-4-5">
                                <div class="row">
                                    <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                                        <div class="stats-icon red mb-2">
                                            <i class="iconly-boldTick-Square"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                        <h6 class="text-muted font-semibold">Completed</h6>
                                        <h6 class="font-extrabold mb-0">{{ $finishedServices ?? 0 }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Tabel Service Terbaru --}}
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h4 class="mb-0">Latest Services</h4>
                                <a href="{{ route('services.index') }}" class="btn btn-primary btn-sm">
                                    View More
                                </a>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped mb-0">
                                        <thead>
                                            <tr>
                                                <th>Invoice No</th>
                                                <th>Customer</th>
                                                <th>Laptop</th>
                                                <th>Status</th>
                                                <th>Total Cost</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($latestServices ?? [] as $service)
                                                <tr>
                                                    <td>{{ $service->no_invoice }}</td>
                                                    <td>{{ $service->customer->name ?? '-' }}</td>
                                                    <td>{{ $service->laptop->brand ?? '-' }}</td>
                                                    <td>
                                                        <span
                                                            class="badge 
                                                            @if ($service->status == 'finished') bg-success 
                                                            @elseif($service->status == 'process') bg-warning 
                                                            @else bg-secondary @endif">
                                                            {{ ucfirst($service->status) }}
                                                        </span>
                                                    </td>
                                                    <td>Rp {{ number_format($service->total_cost, 0, ',', '.') }}</td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="5" class="text-center text-muted">No service data yet</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Profil Admin Login --}}
            <div class="col-12 col-lg-3">
                <div class="card">
                    <div class="card-body text-center py-4 px-4">
                        <div class="avatar avatar-xl mb-3">
                            <img src="{{ Auth::user()->photo ? asset('storage/' . Auth::user()->photo) : asset('assets/img/npc.png') }}"
                                alt="Profile Photo" class="rounded-circle" width="100" height="100">
                        </div>
                        <h5 class="font-bold mb-0">{{ Auth::user()->name }}</h5>
                        <small class="text-muted d-block mb-3">{{ Auth::user()->email }}</small>

                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-outline-danger btn-sm">Logout</button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
