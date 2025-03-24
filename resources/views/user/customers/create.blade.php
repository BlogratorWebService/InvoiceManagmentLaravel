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
                    <div class="row mb-3 g-3">

                        <div class="col-md-6">
                            <label class="form-label">Full Name <span class="text-danger">*</span></label>
                            <input type="text" name="fullName" value="{{ old('fullName') }}" class="form-control"
                                placeholder="Enter full name">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">GSTIN Number <span class="text-danger"></span></label>
                            <input type="text" name="gstNumber" class="form-control" value="{{ old('gstNumber') }}"
                                placeholder="Enter Gst Number">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Email <span class="text-danger">*</span></label>
                            <input type="email" name="email" class="form-control" value="{{ old('email') }}"
                                placeholder="Enter email">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Phone Number <span class="text-danger">*</span></label>
                            <input type="phone" max="10" name="phoneNumber" class="form-control"
                                value="{{ old('phoneNumber') }}" placeholder="Enter phone number">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Postal Code <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="postal_code" name="postal_code"
                                value="{{ old('postal_code') }}" placeholder="Enter Postal Code">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">State <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="state" value="{{ old('state') }}"
                                placeholder="Enter State">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">District <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="district" value="{{ old('district') }}"
                                placeholder="Enter District">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">City <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="city" name="city"
                                value="{{ old('city') }}" placeholder="Enter City">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Street Address <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="street_address"
                                value="{{ old('street_address') }}" placeholder="Enter Street Address">
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
@push('js')
    <script>
        document.getElementById('postal_code').addEventListener('keyup', function() {
            const postalCode = this.value;
            if (postalCode && postalCode.length === 6) {
                fetch(`https://api.postalpincode.in/pincode/${postalCode}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data[0].Status === "Success") {
                            const postOffice = data[0].PostOffice[0];
                            if (postOffice) {
                                document.querySelector('input[name="state"]').readOnly = true;
                                document.querySelector('input[name="district"]').readOnly = true;
                                document.querySelector('input[name="state"]').value = postOffice.State;
                                document.querySelector('input[name="district"]').value = postOffice.District;
                                document.querySelector('input[name="city"]').value = postOffice.District;
                            }
                        } else {
                            alert('Invalid Postal Code');
                        }
                    })
                    .catch(error => {
                        console.error('Error fetching postal code data:', error);
                        alert('Failed to fetch postal code details');
                    });
            }
        });
    </script>
@endpush
