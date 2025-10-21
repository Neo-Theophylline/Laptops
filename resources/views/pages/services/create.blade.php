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
                    <h3>Services</h3>
                    <p class="text-subtitle text-muted">Manage service data</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="">Data</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('services.index') }}">Service</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Create</li>
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
                            <h4 class="card-title">Create Service Data</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <form class="form" action="{{ route('services.store') }}" method="POST"
                                    id="form-add-serviceitem">
                                    <div class="row">
                                        <div class="col-md-12 col-12">

                                            <div class="form-group mb-3">
                                                <label>Customer</label>
                                                <select class="form-select" name="customer" required>
                                                    <option hidden>-- Select Customer --</option>
                                                    <option value="1">Admin</option>
                                                    <option value="2">Technician</option>
                                                </select>
                                            </div>

                                            <div class="form-group mb-3">
                                                <label>Technician</label>
                                                <select class="form-select" name="technician" required>
                                                    <option hidden>-- Select Technician --</option>
                                                    <option value="1">Rehan</option>
                                                    <option value="2">Jordan</option>
                                                </select>
                                            </div>

                                            <div class="form-group mb-3">
                                                <label>Laptop</label>
                                                <select class="form-select" name="laptop" required>
                                                    <option hidden>-- Select Laptop --</option>
                                                    <option value="1">Lenovo X1 Carbon</option>
                                                    <option value="2">Acer Aspire 5</option>
                                                </select>
                                            </div>

                                            <div class="form-group mb-3">
                                                <label>Damage Description</label>
                                                <textarea class="form-control" name="damage_description" rows="3" placeholder="Describe the damage"></textarea>
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
                                        <th style="width:8%">#</th>
                                        <th style="width:40%">Service Item</th>
                                        <th style="width:40%">Price</th>
                                        <th style="width:12%">Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="service-table-body"></tbody>
                            </table>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="button" id="add-row-servicetype" class="btn btn-secondary">Add Service
                                Item</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>

        <section class="section">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Cost</h5>
                </div>
                <div class="row p-3">

                    <div class="col-12 col-md-6">
                        <div class="cost-card card">
                            <div class="cost-overlay"></div>
                            <div class="card-body">
                                <h6 class="text-white mb-1">Total Item Count</h6>
                                <h4 class="text-white fw-bold">0 Items</h4>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <div class="cost-card card">
                            <div class="cost-overlay"></div>
                            <div class="card-body">
                                <h6 class="text-white mb-1">Total Service Cost</h6>
                                <h4 class="text-white fw-bold">Rp 0</h4>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                        <a href="{{ route('services.index') }}" class="btn btn-light-secondary me-1 mb-1">Cancel</a>
                    </div>
                </div>
            </div>

        </section>

    </div>
@endsection
<script>
    document.addEventListener('DOMContentLoaded', function() {
        addRow();
        document.getElementById('add-row-servicetype').addEventListener('click', addRow);
    });

    function addRow() {
        const tbody = document.getElementById('service-table-body');
        const rowIndex = tbody.querySelectorAll('tr').length + 1;

        const tr = document.createElement('tr');
        tr.className = 'align-middle servicetype-row';

        tr.innerHTML = `
            <td class="number">${rowIndex}</td>
            <td>
                <select class="form-select" name="service_item[]" required>
                    <option hidden value="">Select service</option>
                    <option value="lcd">Service LCD</option>
                    <option value="keyboard">Service Keyboard</option>
                    <option value="touchpad">Service Touchpad</option>
                </select>
            </td>
            <td>
                <input type="text" class="form-control" name="price[]" readonly disabled placeholder="0">
            </td>
            <td>
                <button type="button" class="btn btn-sm btn-danger btn-remove" onclick="removeRow(this)">Delete</button>
            </td>
        `;

        tbody.appendChild(tr);
        refreshRowState();
    }

    function removeRow(el) {
        const tr = el.closest('tr');
        if (!tr) return;
        tr.remove();
        refreshRowState();
    }

    function refreshRowState() {
        const rows = document.querySelectorAll('#service-table-body tr');
        rows.forEach((r, i) => {
            const num = r.querySelector('.number');
            if (num) num.textContent = i + 1;
        });
        const removeButtons = document.querySelectorAll('.btn-remove');
        const disable = rows.length === 1;
        removeButtons.forEach(btn => btn.disabled = disable);
    }
</script>
