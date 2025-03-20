@extends('user.layouts.default')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row g-3 mb-4">
            <div class="col-md-3">
                <div class="stats-card d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                        <div class="icon-wrapper blue-icon mb-3">
                            <i class="bi bi-box"></i>
                        </div>
                        <div class="ml-3">
                            <div class="value">0</div>
                            <div class="subtitle">Total Products</div>
                        </div>
                    </div>
                    <i class="bi bi-chevron-right"></i>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stats-card d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                        <div class="icon-wrapper green-icon mb-3">
                            <i class="bi bi-people"></i>
                        </div>
                        <div class="ml-3">
                            <div class="value">{{ $customerCount }}</div>
                            <div class="subtitle">Total Customers</div>
                        </div>
                    </div>
                    <i class="bi bi-chevron-right"></i>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stats-card d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                        <div class="icon-wrapper purple-icon mb-3">
                            <i class="bi bi-people"></i>
                        </div>
                        <div class="ml-3">
                            <div class="value">0</div>
                            <div class="subtitle">Total Suppliers</div>
                        </div>
                    </div>
                    <i class="bi bi-chevron-right"></i>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stats-card d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                        <div class="icon-wrapper orange-icon mb-3">
                            <i class="bi bi-layers"></i>
                        </div>
                        <div class="ml-3">
                            <div class="value">0</div>
                            <div class="subtitle">Total Categories</div>
                        </div>
                    </div>
                    <i class="bi bi-chevron-right"></i>
                </div>
            </div>
        </div>

        <!-- Sales and Purchases Row -->
        <div class="row">
            <!-- Sales Section -->
            <div class="col-md-6">
                <div class="section-card">
                    <h2 class="section-title">Sales</h2>
                    <div class="row g-3">
                        <div class="col-md-6 stat-item">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-flex align-items-center">
                                    <div class="icon-wrapper green-icon mb-2">
                                        <i class="bi bi-cart"></i>
                                    </div>
                                    <div class="ml-3">
                                        <div class="value">0</div>
                                        <div class="subtitle">Total Sales</div>
                                    </div>
                                </div>
                                <i class="bi bi-chevron-right"></i>
                            </div>
                        </div>
                        <div class="col-md-6 stat-item">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-flex align-items-center">
                                    <div class="icon-wrapper orange-icon mb-2">
                                        <i class="bi bi-currency-dollar"></i>
                                    </div>
                                    <div class="ml-3">
                                        <div class="value">₹0.00 INR</div>
                                        <div class="subtitle">Total Sales Amount</div>
                                    </div>
                                </div>
                                <i class="bi bi-chevron-right"></i>
                            </div>
                        </div>
                        <div class="col-md-6 stat-item">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-flex align-items-center">
                                    <div class="icon-wrapper pink-icon mb-2">
                                        <i class="bi bi-arrow-return-left"></i>
                                    </div>
                                    <div class="ml-3">
                                        <div class="value">0</div>
                                        <div class="subtitle">Total Sales Return</div>
                                    </div>
                                </div>
                                <i class="bi bi-chevron-right"></i>
                            </div>
                        </div>
                        <div class="col-md-6 stat-item">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-flex align-items-center">
                                    <div class="icon-wrapper purple-icon mb-2">
                                        <i class="bi bi-currency-dollar"></i>
                                    </div>
                                    <div class="ml-3">
                                        <div class="value">₹0.00 INR</div>
                                        <div class="subtitle">Total Sales Return Amount</div>
                                    </div>
                                </div>
                                <i class="bi bi-chevron-right"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Purchases Section -->
            <div class="col-md-6">
                <div class="section-card">
                    <h2 class="section-title">Purchases</h2>
                    <div class="row g-3">
                        <div class="col-md-6 stat-item">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-flex align-items-center">
                                    <div class="icon-wrapper green-icon mb-2">
                                        <i class="bi bi-bag"></i>
                                    </div>
                                    <div class="ml-3">
                                        <div class="value">0</div>
                                        <div class="subtitle">Total Purchases</div>
                                    </div>
                                </div>
                                <i class="bi bi-chevron-right"></i>
                            </div>
                        </div>
                        <div class="col-md-6 stat-item">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-flex align-items-center">
                                    <div class="icon-wrapper orange-icon mb-2">
                                        <i class="bi bi-currency-dollar"></i>
                                    </div>
                                    <div class="ml-3">
                                        <div class="value">₹0.00 INR</div>
                                        <div class="subtitle">Total Purchases Amount</div>
                                    </div>
                                </div>
                                <i class="bi bi-chevron-right"></i>
                            </div>
                        </div>
                        <div class="col-md-6 stat-item">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-flex align-items-center">
                                    <div class="icon-wrapper pink-icon mb-2">
                                        <i class="bi bi-arrow-return-left"></i>
                                    </div>
                                    <div class="ml-3">
                                        <div class="value">0</div>
                                        <div class="subtitle">Total Purchases Return</div>
                                    </div>
                                </div>
                                <i class="bi bi-chevron-right"></i>
                            </div>
                        </div>
                        <div class="col-md-6 stat-item">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-flex align-items-center">
                                    <div class="icon-wrapper purple-icon mb-2">
                                        <i class="bi bi-currency-dollar"></i>
                                    </div>
                                    <div class="ml-3">
                                        <div class="value">₹0.00 INR</div>
                                        <div class="subtitle">Total Purchases Return Amount</div>
                                    </div>
                                </div>
                                <i class="bi bi-chevron-right"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
  
<style>
    .stats-card {
        background: white;
        border-radius: 8px;
        padding: 20px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.05);
    }
    
    .icon-wrapper {
        width: 40px;
        height: 40px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
   
    .pink-icon { background-color: #fff5f7; color: #ec4899; }
    .blue-icon { background-color: #f5f5ff; color: #6366f1; }
    .green-icon { background-color: #f0fdf4; color: #22c55e; }
    .purple-icon { background-color: #faf5ff; color: #a855f7; }
    .orange-icon { background-color: #fff7ed; color: #f97316; }
    
    .subtitle {
        color: #a1a1aa;
        font-size: 0.875rem;
    }
    
    .value {
        font-size: 1.5rem;
        font-weight: 600;
        margin: 0;
    }
    
    .section-card {
        background: white;
        border-radius: 8px;
        padding: 20px;
        margin-top: 20px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.05);
    }
    
    .section-title {
        font-size: 1.25rem;
        font-weight: 600;
        margin-bottom: 20px;
    }
    
    .stat-item {
        margin-bottom: 15px;
    }
    
  
    .ml-3 {
        margin-left: 1rem;
    }
</style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
@endpush
