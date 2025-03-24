@extends('user.layouts.default')
@section('content')
    <div class="container mt-4">
        <div class="card shadow-sm">
            <div class="card-header bg-secondary text-white mb-3">
                <h4 class="mb-0 text-white">New Product</h4>
            </div>
            <div class="card-body">
                @if ($errors->any())
                    <div class="bg-danger border border-red-400 text-white px-4 py-3 rounded relative mb-4" role="alert">
                        <strong class="font-bold">Whoops!</strong>
                        <span class="block sm:inline"> {{ $errors->first() }}</span>

                    </div>
                @endif
                <form method="POST" action="{{ route('product.store') }}">
                    @csrf
                    <div class="row mb-3">

                        <div class="col-md-6">
                            <label class="form-label">Product Name <span class="text-danger">*</span></label>
                            <input type="text" name="productName" value="{{ old('productName') }}" class="form-control"
                                placeholder="Enter full name">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">HSN/SAC <span class="text-danger">*</span></label>
                            <input type="text" name="hsnCode" class="form-control" value="{{ old('hsnCode') }}"
                                placeholder="Enter HSN/SAC">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Price <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text">₹</span>
                                <input type="number" max="100000" name="price" class="form-control"
                                    value="{{ old('price') }}" placeholder="Enter Price">
                            </div>
                        </div>
                       
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label class="form-label">Description <span class="text-danger"></span></label>
                            <textarea name="description" class="form-control" rows="4" placeholder="Enter product description">{{ old('description') }}</textarea>
                        </div>
                    </div>


                    <div class="text-end mt-4">
                        <button type="submit" class="btn btn-primary">Save Product</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
