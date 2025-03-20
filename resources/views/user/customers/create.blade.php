@extends('user.layouts.default')
@section('content')
    <div class="container mt-4">
        <div class="card shadow-sm">
            <div class="card-header bg-secondary text-white mb-3">
                <h4 class="mb-0 text-white">New Customer</h4>
            </div>
            <div class="card-body">
                @if ($errors->any())
                    <div class="bg-danger border border-red-400 text-white px-4 py-3 rounded relative mb-4" role="alert">
                        <strong class="font-bold">Whoops!</strong>
                        <span class="block sm:inline"> {{ $errors->first() }}</span>

                    </div>
                @endif
                <form method="POST" action="{{ route('customer.store') }}">
                    @csrf
                    <div class="row mb-3">

                        <div class="col-md-6">
                            <label class="form-label">Full Name <span class="text-danger">*</span></label>
                            <input type="text" name="fullName" value="{{ old('fullName') }}" class="form-control"
                                placeholder="Enter full name">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Email <span class="text-danger">*</span></label>
                            <input type="email" name="email" class="form-control" value="{{ old('email') }}"
                                placeholder="Enter email">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Phone Number <span class="text-danger">*</span></label>
                            <input type="phone" max="10" name="phoneNumber" class="form-control"
                                value="{{ old('phoneNumber') }}" placeholder="Enter phone number">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Full Address <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="address" value="{{ old('address') }}"
                                placeholder="Enter Full Address">
                        </div>
                    </div>



                    <div class="text-end mt-4">
                        <button type="submit" class="btn btn-primary">Save Customer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
