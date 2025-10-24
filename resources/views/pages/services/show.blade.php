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
                        <h4 class="card-title mb-1">Service Information</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form action="{{ route('services.updateDetail', $service->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label>Invoice Number</label>
                                            <input type="text" class="form-control" value="{{ $service->no_invoice }}" readonly>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label>Service Status</label>
                                            <select name="status" class="form-select">
                                                @foreach (['accepted', 'process', 'finished', 'taken', 'cancelled'] as $status)
                                                    <option value="{{ $status }}" {{ $service->status == $status ? 'selected' : '' }}>
                                                        {{ ucfirst($status) }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label>Received Date</label>
                                            <input type="text" class="form-control" value="{{ $service->received_date ?? '-' }}" readonly>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label>Customer</label>
                                            <input type="text" class="form-control" value="{{ $service->customer->name ?? '-' }}" readonly>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label>Completed Date</label>
                                            <input type="text" class="form-control" value="{{ $service->completed_date ?? '-' }}" readonly>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label>Technician</label>
                                            <input type="text" class="form-control" value="{{ $service->technician->name ?? '-' }}" readonly>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label>Damage Description</label>
                                            <textarea class="form-control" rows="3" readonly>{{ $service->damage_description ?? '-' }}</textarea>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label>Laptop</label>
                                            <input type="text" class="form-control" value="{{ $service->laptop->brand ?? '-' }} {{ $service->laptop->model ?? '' }}" readonly>
                                        </div>
                                    </div>
                                </div>
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
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Item</th>
                                <th>Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($service->details as $index => $detail)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $detail->serviceItem->service_name ?? '-' }}</td>
                                    <td>{{ number_format($detail->price, 0, ',', '.') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-1">Cost Calculation</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <div class="form-group mb-3">
                                <label>Items Cost</label>
                                <input id="items_cost_display" class="form-control" readonly
                                    value="{{ number_format($service->estimated_cost, 0, ',', '.') }}">
                            </div>

                            <div class="form-group mb-3">
                                <label>Other Cost</label>
                                <input type="text" name="other_cost" id="other_cost" class="form-control"
                                    value="{{ number_format($service->other_cost ?? 0, 0, ',', '.') }}"
                                    placeholder="Enter additional cost">
                            </div>

                            <div class="form-group mb-3">
                                <label>Total Cost</label>
                                <input id="total_cost_display" class="form-control" readonly
                                    value="{{ number_format($service->total_cost, 0, ',', '.') }}">
                                <input type="hidden" name="total_cost" id="total_cost"
                                    value="{{ $service->total_cost }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-1">Payment</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">

                            <div class="form-group mb-3">
                                <label>Payment Status</label>
                                <input type="text" id="status_paid_display" class="form-control" readonly
                                    value="{{ ucfirst($service->status_paid) }}">
                                <input type="hidden" name="status_paid" id="status_paid" value="{{ $service->status_paid }}">
                            </div>

                            <div class="form-group mb-3">
                                <label>Payment Method</label>
                                <select name="paymentmethod" class="form-select">
                                    <option value="cash" {{ $service->paymentmethod == 'cash' ? 'selected' : '' }}>Cash</option>
                                    <option value="transfer" {{ $service->paymentmethod == 'transfer' ? 'selected' : '' }}>Transfer</option>
                                </select>
                            </div>

                            <div class="form-group mb-3">
                                <label>Pay</label>
                                <input type="text" name="paid" id="paid" class="form-control"
                                    value="0" placeholder="Enter new payment amount">
                            </div>

                            <div class="form-group mb-3">
                                <label>Paid</label>
                                <input id="total_paid_display" class="form-control" readonly
                                    value="{{ number_format($service->paid, 0, ',', '.') }}">
                            </div>

                            <div class="form-group mb-3">
                                <label>Remaining Payment</label>
                                <input id="remaining_payment" class="form-control" readonly
                                    value="{{ number_format(max(0, $service->total_cost - $service->paid), 0, ',', '.') }}">
                            </div>

                            <div class="form-group mb-3">
                                <label>Change</label>
                                <input id="change_display" class="form-control" readonly
                                    value="{{ number_format(max(0, $service->paid - $service->total_cost), 0, ',', '.') }}">
                            </div>

                            <div class="col-12 d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary me-1 mb-1">Update Service</button>
                                <a href="{{ route('services.index') }}" class="btn btn-light-secondary me-1 mb-1">Back</a>
                            </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const baseCost = {{ $service->estimated_cost ?? 0 }};
        const otherCostInput = document.getElementById("other_cost");
        const totalCostDisplay = document.getElementById("total_cost_display");
        const totalCostHidden = document.getElementById("total_cost");
        const paidInput = document.getElementById("paid");
        const totalPaidDisplay = document.getElementById("total_paid_display");
        const remainingField = document.getElementById("remaining_payment");
        const changeDisplay = document.getElementById("change_display");
        const statusPaidField = document.getElementById("status_paid");
        const statusPaidDisplay = document.getElementById("status_paid_display");
        const initialPaid = {{ $service->paid ?? 0 }};

        function formatNumber(num) {
            return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }

        function cleanNumber(str) {
            return parseInt(str.toString().replace(/[^\d]/g, "")) || 0;
        }

        function updateTotal() {
            const otherCost = cleanNumber(otherCostInput.value);
            const total = baseCost + otherCost;
            totalCostDisplay.value = formatNumber(total);
            totalCostHidden.value = total;
            updatePayment();
        }

        function updatePayment() {
            const total = cleanNumber(totalCostHidden.value);
            const newPaid = cleanNumber(paidInput.value);
            const totalPaid = initialPaid + newPaid;
            const remaining = Math.max(0, total - totalPaid);
            const change = Math.max(0, totalPaid - total);

            totalPaidDisplay.value = formatNumber(totalPaid);
            remainingField.value = formatNumber(remaining);
            changeDisplay.value = formatNumber(change);

            let status = "unpaid";
            if (totalPaid === 0) {
                status = "unpaid";
            } else if (totalPaid < total) {
                status = "debt";
            } else {
                status = "paid";
            }

            statusPaidDisplay.value = status.charAt(0).toUpperCase() + status.slice(1);
            statusPaidField.value = status;
        }

        otherCostInput.addEventListener("input", function() {
            const cleanVal = cleanNumber(this.value);
            this.value = formatNumber(cleanVal);
            updateTotal();
        });

        paidInput.addEventListener("input", function() {
            const cleanVal = cleanNumber(this.value);
            this.value = formatNumber(cleanVal);
            updatePayment();
        });

        updateTotal();
    });
</script>
@endsection
