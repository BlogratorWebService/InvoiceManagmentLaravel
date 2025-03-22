@extends('user.layouts.default')
@section('content')
    <div class="container mt-4">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white mb-3">
                <h4 class="mb-0 text-white">New Invoice</h4>
            </div>
            <div class="card-body">
                @if ($errors->any())
                <div class="bg-danger border border-red-400 text-white px-4 py-3 rounded relative mb-4" role="alert">
                    <strong class="font-bold">Whoops!</strong>
                    <span class="block sm:inline"> {{ $errors->first() }}</span>
                    
                </div>
            @endif
                <form method="POST" action="{{ route('invoice.store') }}">
                    @csrf
                    <div class="row mb-3">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Customer <span class="text-danger">*</span></label>
                            <select class="form-select select2" name="customer">
                                <option value="">Select Customer</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Invoice #</label>
                            <input type="text" class="form-control" value="{{ $invoiceNumber }}" readonly name="invoiceNumber">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Invoice Date <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" value="{{ date('Y-m-d') }}" name="invoiceDate">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Due Date <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" value="{{ date('Y-m-d', strtotime('+1 day')) }}" name="dueDate">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Status <span class="text-danger">*</span></label>
                            <select class="form-select" name="status">
                                <option value="unpaid">Unpaid</option>
                                <option value="paid">Paid</option>
                            </select>
                        </div>

                    </div>


                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class="table-secondary">
                                <tr>
                                    <th>#</th>
                                    <th>Product <span class="text-danger">*</span></th>
                                    <th>Qty <span class="text-danger">*</span></th>
                                    <th>Unit Price <span class="text-danger">*</span></th>
                                    <th>Tax (%)</th>
                                    <th>Amount <span class="text-danger">*</span></th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="invoiceItems">
                                <tr>
                                    <td>1</td>
                                    <td><input type="text" class="form-control" placeholder="Enter product" name="product[]"></td>
                                    <td><input type="number" class="form-control qty" min="1" value="1"
                                            oninput="maxHundread(this); calculateAmount(this)" name="quantity[]"></td>
                                    <td><input type="number" class="form-control unit-price" min="0" step="0.01"
                                            oninput="maxHundread(this); calculateAmount(this)" name="unitPrice[]"></td>
                                    <td><input type="number" class="form-control tax" min="0" max="100"
                                            step="0.01" oninput="maxHundread(this); calculateAmount(this)" name="tax[]"></td>
                                    <td class="amount">₹ 0.00 </td>
                                    <td><button type="button" class="btn btn-danger btn-sm"
                                            onclick="removeRow(this)">🗑</button></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <button type="button" class="btn btn-primary mt-4" id="addRow">Add</button>

                    <div class="row mt-4">
                        <div class="col-md-6">
                            <label class="form-label">Discount</label>
                            <div class="input-group">
                                <input type="number" max="100" class="form-control" min="0" value="0"
                                    id="discount" oninput="maxHundread(this); calculateSubtotal()" name="discount">
                                <select class="form-select" id="discountType" onchange="calculateSubtotal()" name="discountType">
                                    <option value="percentage">Percentage</option>
                                    <option value="fixed">Fixed Amount</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 text-end">
                            <h5>Sub Total: <span id="subTotal"> ₹0.00</span></h5>
                        </div>
                    </div>

                    <div class="text-end mt-4">
                        <button type="submit" class="btn btn-success">Save Invoice</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
@endpush
@push('js')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.select2').select2({
                width: '100%', // Ensure full width
                theme: 'bootstrap-5', // Use Bootstrap 5 theme (if applicable)
                placeholder: "Select an option",
                allowClear: true,
                minimumInputLength: 1, // Minimum characters before triggering AJAX request
                ajax: {
                    url: '/api/customers', // Your API endpoint
                    dataType: 'json',
                    delay: 250, // Delay in milliseconds before request is made
                    processResults: function(data) {
                        // Parse the results into the format expected by Select2
                        return {
                            results: $.map(data.items, function(item) {
                                return {
                                    id: item.id,
                                    text: item.text
                                };
                            })
                        };
                    },
                    cache: true
                }
            });
        });

        function calculateAmount(element) {
            let row = element.closest('tr');
            let qty = parseFloat(row.querySelector('.qty').value) || 0;
            let unitPrice = parseFloat(row.querySelector('.unit-price').value) || 0;
            let tax = parseFloat(row.querySelector('.tax').value) || 0;
            let amount = (qty * unitPrice) + ((qty * unitPrice) * (tax / 100));
            row.querySelector('.amount').innerText = '₹ ' + amount.toFixed(2);
            calculateSubtotal();
        }

        function calculateSubtotal() {
            let rows = document.querySelectorAll('#invoiceItems tr');
            let subtotal = 0;
            rows.forEach(row => {
                let amount = parseFloat(row.querySelector('.amount').innerText.replace('₹', '').trim()) || 0;
                subtotal += amount;
            });

            let discount = parseFloat(document.getElementById('discount').value) || 0;
            let discountType = document.getElementById('discountType').value;

            if (discountType === 'percentage') {
                subtotal -= (subtotal * (discount / 100));
            } else if (discountType === 'fixed') {
                subtotal -= discount;
            }

            document.getElementById('subTotal').innerText = '₹ ' + subtotal.toFixed(2);
        }

        function maxHundread(input) {
            if (input.name == 'unitPrice[]') {
                if (input.value > 100000) {
                    input.value = 100000;
                }
            } else {
                if (input.value > 100) {
                    input.value = 100;
                }
            }
            if (input.value < 0) {
                input.value = 0;
            }
        }

        document.getElementById("addRow").addEventListener("click", function() {
            let table = document.getElementById("invoiceItems");
            let rowCount = table.rows.length;
            let row = table.insertRow();
            row.innerHTML = `
        <td>${rowCount + 1}</td>
        <td><input type="text" class="form-control" placeholder="Enter product" name="product[]"></td>
        <td><input type="number" class="form-control qty" min="1" value="1" oninput="maxHundread(this); calculateAmount(this)" name="quantity[]"></td>
        <td><input type="number" class="form-control unit-price" min="0" step="0.01" oninput="calculateAmount(this)" name="unitPrice[]"></td>
        <td><input type="number" class="form-control tax" min="0" max="100" step="0.01" oninput="maxHundread(this); calculateAmount(this)" name="tax[]"></td>
        <td class="amount">₹ 0.00 </td>
        <td><button type="button" class="btn btn-danger btn-sm" onclick="removeRow(this)">🗑</button></td>
    `;
        });

        function removeRow(button) {
            let table = document.getElementById("invoiceItems");

            console.log(table.rows.length);
            if (table.rows.length == 1)
                return false;
            let row = button.closest("tr");
            row.parentNode.removeChild(row);
            calculateSubtotal();
        }
    </script>
@endpush
