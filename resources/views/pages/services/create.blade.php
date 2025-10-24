@extends('layouts.app')
@section('content')
    <style>
        .cost-card {
            background: url('{{ asset('assets/img/bg-2.jpg') }}') no-repeat center center;
            background-size: cover;
            border-radius: 15px;
            position: relative;
            overflow: hidden;
            min-height: 130px;
        }

        .cost-card .card-body {
            position: relative;
            z-index: 2;
        }

        .cost-overlay {
            position: absolute;
            inset: 0;
            background: rgba(0, 0, 0, 0.35);
            z-index: 1;
        }
    </style>

    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Create Service</h3>
                    <p class="text-subtitle text-muted">Create new service data</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Data</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('services.index') }}">Service</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Create</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        {{-- FORM --}}
        <form action="{{ route('services.store') }}" method="POST" id="form-service" enctype="multipart/form-data">
            @csrf
            <section id="multiple-column-form">
                <div class="row match-height">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Service Information</h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12 col-12">

                                            <div class="form-group mb-3">
                                                <label>Customer</label>
                                                <select class="form-select" name="customer_id" required>
                                                    <option hidden>-- Select Customer --</option>
                                                    @foreach ($customers as $customer)
                                                        <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="form-group mb-3">
                                                <label>Technician</label>
                                                <select class="form-select" name="technician_id" required>
                                                    <option hidden>-- Select Technician --</option>
                                                    @foreach ($technicians as $technician)
                                                        <option value="{{ $technician->id }}">{{ $technician->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="form-group mb-3">
                                                <label>Laptop</label>
                                                <select class="form-select" name="laptop_id" required>
                                                    <option hidden>-- Select Laptop --</option>
                                                    @foreach ($laptops as $laptop)
                                                        <option value="{{ $laptop->id }}">{{ $laptop->brand }} {{ $laptop->model }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="form-group mb-3">
                                                <label>Damage Description</label>
                                                <textarea class="form-control" name="damage_description" rows="3" placeholder="Describe the damage"></textarea>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            {{-- SERVICE ITEMS --}}
            <section class="section">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Service Items</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th style="width:5%">#</th>
                                        <th style="width:10%">Photo</th>
                                        <th style="width:40%">Service Item</th>
                                        <th style="width:40%">Price</th>
                                        <th style="width:5%">Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="service-table-body"></tbody>
                            </table>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="button" id="add-row-servicetype" class="btn btn-secondary">
                                Add Service Item
                            </button>
                        </div>
                    </div>
                </div>
            </section>

            {{-- COST & PAYMENT --}}
            <section class="section">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Cost & Payment</h5>
                    </div>
                    <div class="row p-3">

                        <div class="col-12 col-md-6">
                            <div class="cost-card card">
                                <div class="cost-overlay"></div>
                                <div class="card-body">
                                    <h6 class="text-white mb-1">Service Amount</h6>
                                    <h4 class="text-white fw-bold" id="total-items">0 Items</h4>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="cost-card card">
                                <div class="cost-overlay"></div>
                                <div class="card-body">
                                    <h6 class="text-white mb-1">Service Item Cost</h6>
                                    <h4 class="text-white fw-bold" id="total-cost">Rp 0</h4>
                                </div>
                            </div>
                        </div>

                        {{-- Hidden inputs untuk kirim data ke controller --}}
                        <input type="hidden" name="estimated_cost" id="estimated_cost">
                        <input type="hidden" name="total_cost" id="total_cost">

                        <div class="col-12 d-flex justify-content-end mt-4">
                            <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                            <a href="{{ route('services.index') }}" class="btn btn-light-secondary me-1 mb-1">Cancel</a>
                        </div>
                    </div>
                </div>
            </section>
        </form>
    </div>

    <script>
        const serviceItems = @json($serviceItems);

        document.addEventListener('DOMContentLoaded', function() {
            addRow();
            document.getElementById('add-row-servicetype').addEventListener('click', addRow);

            const otherCostInput = document.getElementById('other_cost');
            if (otherCostInput) otherCostInput.addEventListener('input', updateSummary);
        });

        // Menambah baris item servis
        function addRow() {
            const tbody = document.getElementById('service-table-body');
            const rowIndex = tbody.querySelectorAll('tr').length + 1;

            let options = '<option hidden value="">Select service</option>';
            serviceItems.forEach(item => {
                options += `<option value="${item.id}" data-price="${item.price}" data-photo="${item.photo || ''}">
                                ${item.service_name}
                            </option>`;
            });

            const tr = document.createElement('tr');
            tr.className = 'align-middle servicetype-row';
            tr.innerHTML = `
                <td class="number">${rowIndex}</td>
                <td class="text-center">
                    <img src="{{ asset('assets/img/wrench.jpg') }}"
                        class="service-photo"
                        style="width: 50px; height: 50px; object-fit: cover; border-radius:8px;">
                </td>
                <td>
                    <select class="form-select service-item-select" name="service_item[]" required>
                        ${options}
                    </select>
                </td>
                <td>
                    <input type="text" class="form-control price-input" name="price[]" readonly placeholder="0">
                </td>
                <td>
                    <button type="button" class="btn btn-sm btn-danger btn-remove" onclick="removeRow(this)">Delete</button>
                </td>
            `;

            tbody.appendChild(tr);
            refreshRowState();
        }

        function removeRow(el) {
            el.closest('tr').remove();
            refreshRowState();
            updateSummary();
        }

        function refreshRowState() {
            const rows = document.querySelectorAll('#service-table-body tr');
            rows.forEach((r, i) => r.querySelector('.number').textContent = i + 1);
            const removeButtons = document.querySelectorAll('.btn-remove');
            removeButtons.forEach(btn => btn.disabled = rows.length === 1);
        }

        document.addEventListener('change', function(e) {
            if (e.target.classList.contains('service-item-select')) {
                const tr = e.target.closest('tr');
                const priceInput = tr.querySelector('.price-input');
                const photoEl = tr.querySelector('.service-photo');
                const selectedOption = e.target.selectedOptions[0];

                const price = parseInt(selectedOption.getAttribute('data-price')) || 0;
                const photo = selectedOption.getAttribute('data-photo');

                priceInput.value = price.toLocaleString('id-ID');
                photoEl.src = photo ? `{{ asset('storage') }}/${photo}` : `{{ asset('assets/img/wrench.jpg') }}`;
                updateSummary();
            }
        });

        function updateSummary() {
            const priceInputs = document.querySelectorAll('.price-input');
            const otherCost = parseInt(document.getElementById('other_cost')?.value.replace(/\./g, '') || 0);
            let totalItems = 0;
            let estimatedCost = 0;

            priceInputs.forEach(input => {
                const value = parseInt(input.value.replace(/\./g, '')) || 0;
                if (value > 0) totalItems++;
                estimatedCost += value;
            });

            const totalCost = estimatedCost + otherCost;

            document.getElementById('total-items').textContent = `${totalItems} Items`;
            document.getElementById('total-cost').textContent = `Rp ${totalCost.toLocaleString('id-ID')}`;

            // Kirim ke input hidden
            document.getElementById('estimated_cost').value = estimatedCost;
            document.getElementById('total_cost').value = totalCost;
        }

        // Fungsi format input Rupiah
        function formatRupiah(el) {
            let val = el.value.replace(/\D/g, '');
            el.value = val.replace(/\B(?=(\d{3})+(?!\d))/g, ".");
            updateSummary();
        }
    </script>
@endsection
