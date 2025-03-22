@extends('user.layouts.default')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">

        <!-- Invoice List Widget -->

        <div class="card mb-6">
            <div class="card-widget-separator-wrapper">
                <div class="card-body card-widget-separator">
                    <div class="row gy-4 gy-sm-1">
                        <div class="col-sm-6 col-lg-3">
                            <div
                                class="d-flex justify-content-between align-items-center card-widget-1 border-end pb-4 pb-sm-0">
                                <div>
                                    <h4 class="mb-0">{{ $clientsCount }}</h4>
                                    <p class="mb-0">Clients</p>
                                </div>
                                <div class="avatar me-sm-6 w-px-42 h-px-42">
                                    <span class="avatar-initial rounded bg-label-secondary text-heading">
                                        <i class="icon-base bx bx-user icon-26px"></i>
                                    </span>
                                </div>
                            </div>
                            <hr class="d-none d-sm-block d-lg-none me-6" />
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <div
                                class="d-flex justify-content-between align-items-center card-widget-2 border-end pb-4 pb-sm-0">
                                <div>
                                    <h4 class="mb-0">{{ $invoiceStats->invoicesCount }}</h4>
                                    <p class="mb-0">Invoices</p>
                                </div>
                                <div class="avatar me-lg-6 w-px-42 h-px-42">
                                    <span class="avatar-initial rounded bg-label-secondary text-heading">
                                        <i class="icon-base bx bx-file icon-26px"></i>
                                    </span>
                                </div>
                            </div>
                            <hr class="d-none d-sm-block d-lg-none" />
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <div
                                class="d-flex justify-content-between align-items-center border-end pb-4 pb-sm-0 card-widget-3">
                                <div>
                                    <h4 class="mb-0">₹{{ $invoiceStats->totalPaid }}</h4>
                                    <p class="mb-0">Paid</p>
                                </div>
                                <div class="avatar me-sm-6 w-px-42 h-px-42">
                                    <span class="avatar-initial rounded bg-label-secondary text-heading">
                                        <i class="icon-base bx bx-check-double icon-26px"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h4 class="mb-0">₹{{ $invoiceStats->totalUnpaid }}</h4>
                                    <p class="mb-0">Unpaid</p>
                                </div>
                                <div class="avatar w-px-42 h-px-42">
                                    <span class="avatar-initial rounded bg-label-secondary text-heading">
                                        <i class="icon-base bx bx-error-circle icon-26px"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Invoice List Table -->
        <div class="card">
            <div class="card-datatable table-responsive">
                <div class="row mx-3 justify-content-between align-items-center py-3">
                    <div class="col-md-auto me-auto px-3 pe-md-0 mt-0 d-flex align-items-center">

                        <div class="btn-group mb-3 mb-md-0">
                            <button class="btn btn-primary" onclick="window.location.href='{{ route('invoice.create') }}'"
                                tabindex="0" aria-controls="DataTables_Table_0" type="button">
                                <i class="icon-base icon-16px bx bx-plus me-md-2"></i>
                                <span class="d-md-inline-block d-none">Create Invoice</span>
                            </button>
                        </div>
                    </div>
                    <div
                        class="col-md-auto ms-auto d-flex align-items-center justify-content-md-end justify-content-center flex-wrap gap-3 mt-0 pe-md-3 ps-0">
                        <div class="me-3 mb-3 mb-md-0">
                            <input type="search" class="form-control" id="dt-search-0" placeholder="Search Invoice"
                                aria-controls="DataTables_Table_0">
                        </div>
                        <div>
                            <select id="UserRole" class="form-select">
                                <option value="">Invoice Status</option>
                                <option value="Downloaded" class="text-capitalize">Downloaded</option>
                                <option value="Draft" class="text-capitalize">Draft</option>
                                <option value="Paid" class="text-capitalize">Paid</option>
                                <option value="Partial Payment" class="text-capitalize">Partial Payment</option>
                                <option value="Past Due" class="text-capitalize">Past Due</option>
                                <option value="Sent" class="text-capitalize">Sent</option>
                            </select>
                        </div>
                    </div>
                </div>
                <table class="invoice-list-table table border-top">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Client</th>
                            <th>Total</th>
                            <th>Issued Date</th>
                            <th>Balance</th>
                            <th>Invoice Status</th>
                            <th class="cell-fit">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($invoices as $invoice)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="flex-1">
                                            <h6 class="mb-0">{{ $invoice->customer->name }}</h6>
                                            <p class="mb-0">{{ $invoice->customer->email }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td>₹{{ number_format($invoice->grandTotal, 2) }}</td>
                                <td>{{ $invoice->invoiceDate }}</td>
                                <td>₹{{ number_format($invoice->balance, 2) ?? 0 }}</td>
                                <td>
                                    @if ($invoice->status === 'Paid')
                                        <span class="badge bg-success">Paid</span>
                                    @elseif ($invoice->status === 'Draft')
                                        <span class="badge bg-secondary">Draft</span>
                                    @elseif ($invoice->status === 'unpaid')
                                        <span class="badge bg-warning">Unpaid</span>
                                    @elseif ($invoice->status === 'Past Due')
                                        <span class="badge bg-danger">Past Due</span>
                                    @elseif ($invoice->status === 'Sent')
                                        <span class="badge bg-info">Sent</span>
                                    @elseif ($invoice->status === 'Downloaded')
                                        <span class="badge bg-primary">Downloaded</span>
                                    @else
                                        <span class="badge bg-dark">{{ $invoice->status }}</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-icon btn-icon-only" type="button" data-bs-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false">
                                            <i class="icon-base bx bx-dots-horizontal-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <a class="dropdown-item"
                                                href="{{ route('invoice.show', $invoice->id) }}">View</a>
                                            <a class="dropdown-item"
                                                href="{{ route('invoice.edit', $invoice->id) }}">Edit</a>

                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-between align-items-center mt-3 container">
                    <div>
                        Showing {{ $invoices->firstItem() }} to {{ $invoices->lastItem() }} of {{ $invoices->total() }}
                        entries
                    </div>
                    <div>
                        {{ $invoices->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
            
        </div>

    </div>
@endsection
@push('css')
    <link rel="stylesheet" href="../assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css" />
    <link rel="stylesheet" href="../assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css" />
    <link rel="stylesheet" href="../assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css" />
@endpush
@push('js')
    <script src="../assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js"></script>
    <script src="../assets/js/app-invoice-list.js"></script>
@endpush
