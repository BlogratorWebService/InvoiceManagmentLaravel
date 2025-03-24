@extends('user.layouts.default')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">


        <!-- Invoice List Table -->
        <div class="card">
          
            <div class="card-datatable table-responsive">
                
                <div class="row mx-3 justify-content-between align-items-center py-3">
                    @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Whoops!</strong> {{ $errors->first() }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Success!</strong> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                    <div class="col-md-auto me-auto px-3 pe-md-0 mt-0 d-flex align-items-center">

                        <div class="btn-group mb-3 mb-md-0">
                            <button class="btn btn-primary" onclick="window.location.href='{{ route('product.create') }}'"
                                tabindex="0" aria-controls="DataTables_Table_0" type="button">
                                <i class="icon-base icon-16px bx bx-plus me-md-2"></i>
                                <span class="d-md-inline-block d-none">Create Product</span>
                            </button>
                        </div>
                    </div>
                    <div
                        class="col-md-auto ms-auto d-flex align-items-center justify-content-md-end justify-content-center flex-wrap gap-3 mt-0 pe-md-3 ps-0">
                        <div class="me-3 mb-3 mb-md-0">
                            <input type="search" class="form-control" id="dt-search-0" placeholder="Search Product"
                                aria-controls="DataTables_Table_0">
                        </div>
                        <div>
                            <select id="UserRole" class="form-select">

                            </select>
                        </div>
                    </div>
                </div>
                <table class="invoice-list-table table border-top">
                    <thead>
                        <tr>

                            <th>#</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th class="text-truncate">Created Date</th>
                            <th>HSN/SAC</th>
                            <th class="cell-fit">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            <tr>
                                <td>{{ $loop->iteration }}</td>

                                <td>{{ $product->name }}</td>
                                <td>{{ $product->price ?? 0 }}</td>
                                <td>{{ $product->created_at->format('d M Y') }}</td>
                                <td>{{ $product->hscCode ?? 0 }}</td>
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
                            </tr>
                        @endforeach

                    </tbody>
                </table>
                
            </div>
            <div class="d-flex justify-content-between align-items-center my-3 container">
                <div>
                    Showing {{ $products->firstItem() }} to {{ $products->lastItem() }} of {{ $products->total() }}
                    entries
                </div>
                <div>
                    {{ $products->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>

    </div>
@endsection
