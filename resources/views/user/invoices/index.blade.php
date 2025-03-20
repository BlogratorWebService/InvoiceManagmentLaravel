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
                                    <h4 class="mb-0">24</h4>
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
                                    <h4 class="mb-0">165</h4>
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
                                    <h4 class="mb-0">$2.46k</h4>
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
                                    <h4 class="mb-0">$876</h4>
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
                            <button class="btn btn-primary" onclick="window.location.href='{{ route('invoice.create') }}'" tabindex="0" aria-controls="DataTables_Table_0"
                                type="button">
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
                            <th class="text-truncate">Issued Date</th>
                            <th>Balance</th>
                            <th>Invoice Status</th>
                            <th class="cell-fit">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            
                            <td>
                                <div class="d-flex align-items-center">
                                   
                                    <div class="flex-1">
                                        <h6 class="mb-0">John
                                            Doe</h6>
                                        <p class="mb-0">john
                                            [email protected]</p>
                                    </div>
                                </div>
                            </td>
                            <td>$1,200</td>
                            <td>12/12/2021</td>
                            <td>$0</td>
                            <td>
                                <span class="badge bg-success">Paid</span>

                            </td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-icon btn-icon-only" type="button" data-bs-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false">
                                        <i class="icon-base bx bx-dots-horizontal-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <a class="dropdown-item" href="#">View</a>
                                        <a class="dropdown-item" href="#">Edit</a>
                                        <a class="dropdown-item" href="#">Delete</a>
                                    </div>
                                </div>
                            </td>
                    </tbody>
                </table>
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
