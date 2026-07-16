@extends('layouts.nice')

@section('content')
<div class="row">
    <div class="col-lg-3 col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-7">
                        <i class="mdi mdi-emoticon font-20 text-info"></i>
                        <p class="font-16 m-b-5">USERS</p>
                    </div>
                    <div class="col-5">
                        <h1 class="font-light text-right mb-0">{{ $totalUsers }}</h1>
                    </div>
                </div>
            </div>
        </div>                        
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-7">
                        <i class="mdi mdi-image font-20 text-success"></i>
                        <p class="font-16 m-b-5">PRODUCT</p>
                    </div>
                    <div class="col-5">
                        <h1 class="font-light text-right mb-0">{{ $totalProducts }}</h1>
                    </div>
                </div>
            </div>
        </div>                        
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-7">
                        <i class="mdi mdi-currency-eur font-20 text-purple"></i>
                        <p class="font-16 m-b-5">ORDERS</p>
                    </div>
                    <div class="col-5">
                        <h1 class="font-light text-right mb-0">{{ $totalOrders }}</h1>
                    </div>
                </div>
            </div>
        </div>                        
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-7">
                        <i class="mdi mdi-poll font-20 text-danger"></i>
                        <p class="font-16 m-b-5">ANIMALS</p>
                    </div>
                    <div class="col-5">
                        <h1 class="font-light text-right mb-0">{{ $totalAnimals }}</h1>
                    </div>
                </div>
            </div>
        </div>                        
    </div>
</div>
<!-- ============================================================== -->
<!-- Sales chart -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- Email campaign chart -->
<!-- ============================================================== -->
<div class="row">
    {{-- <div class="col-lg-8 col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div>
                        <h4 class="card-title">Sales Ratio</h4>
                    </div>
                    <div class="ml-auto">
                        <div class="dl m-b-10">
                            <select class="custom-select border-0 text-muted">
                                <option value="0" selected="">August 2018</option>
                                <option value="1">May 2018</option>
                                <option value="2">March 2018</option>
                                <option value="3">June 2018</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="sales5 ct-charts m-t-30"></div>
                <ul class="list-inline m-t-30 text-center font-12">
                    <li class="list-inline-item text-muted"><i class="fa fa-circle text-info m-r-5"></i> Xtreme Admin</li>
                    <li class="list-inline-item text-muted"><i class="fa fa-circle text-success m-r-5"></i> MaterialPro Admin</li>
                </ul>
            </div>
        </div>
    </div> --}}
    <div class="col-lg-4">
        <div class="card bg-success">
            <div class="card-body">

                <h4 class="text-white">
                    Pendapatan Minggu Ini
                </h4>

                <h2 class="text-white income-value">
                    Rp {{ number_format($weeklyIncome,0,',','.') }}
                </h2>

            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card bg-info">
            <div class="card-body">

                <h4 class="text-white">
                    Pendapatan Bulan Ini
                </h4>

                <h2 class="text-white income-value">
                    Rp {{ number_format($monthlyIncome,0,',','.') }}
                </h2>

            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card bg-primary">
            <div class="card-body">

                <h4 class="text-white">
                    Pendapatan Tahun Ini
                </h4>

                <h2 class="text-white income-value">
                    Rp {{ number_format($yearlyIncome,0,',','.') }}
                </h2>

            </div>
        </div>
    </div>
</div>
<!-- ============================================================== -->
<!-- Email campaign chart -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- Ravenue - page-view-bounce rate -->
<!-- ============================================================== -->
<div class="row">
    <div class="col-sm-12 col-lg-4">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Orders Status</h4>
                <div class="status m-t-30" style="height:280px; width:100%"></div>
                <div class="d-flex text-center mt-3 order-status-wrapper">
                    <div class="order-status-item">
                        <i class="fa fa-circle text-success"></i>
                        <h4 class="mb-1 font-medium">{{ $paidOrders }}</h4>
                        <span>Paid</span>
                    </div>
                    <div class="order-status-item">
                        <i class="fa fa-circle text-warning"></i>
                        <h4 class="mb-1 font-medium">{{ $pendingOrders }}</h4>
                        <span>Pending</span>
                    </div>
                    <div class="order-status-item">
                        <i class="fa fa-circle text-danger"></i>
                        <h4 class="mb-1 font-medium">{{ $failedOrders }}</h4>
                        <span>Failed</span>
                    </div>
                    <div class="order-status-item">
                        <i class="fa fa-circle text-secondary"></i>
                        <h4 class="mb-1 font-medium">{{ $expiredOrders }}</h4>
                        <span>Expired</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-12 col-lg-8">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div>
                        <h4 class="card-title">Pendapatan Tahun {{ date('Y') }}</h4>
                    </div>
                </div>
                <div class="chart1 m-t-40" style="position: relative; height:250px;"></div>
            </div>
        </div>
    </div>
</div>
<!-- ============================================================== -->
<!-- Ravenue - page-view-bounce rate -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- Recent comment and todo -->
<!-- ============================================================== -->
{{-- <div class="row">
    <!-- column -->
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Recent Comments</h4>
            </div>
            <div class="comment-widgets scrollable" style="height:430px;">
                <!-- Comment Row -->
                <div class="d-flex flex-row comment-row m-t-0">
                    <div class="p-2">
                        <img src="../../assets/images/users/1.jpg" alt="user" width="50" class="rounded-circle">
                    </div>
                    <div class="comment-text w-100">
                        <h6 class="font-medium">James Anderson</h6>
                        <span class="m-b-15 d-block">Lorem Ipsum is simply dummy text of the printing and type setting industry. </span>
                        <div class="comment-footer">
                            <span class="text-muted float-right">April 14, 2016</span>
                            <span class="label label-rounded label-primary">Pending</span>
                            <span class="action-icons">
                                <a href="javascript:void(0)">
                                    <i class="ti-pencil-alt"></i>
                                </a>
                                <a href="javascript:void(0)">
                                    <i class="ti-check"></i>
                                </a>
                                <a href="javascript:void(0)">
                                    <i class="ti-heart"></i>
                                </a>
                            </span>
                        </div>
                    </div>
                </div>
                <!-- Comment Row -->
                <div class="d-flex flex-row comment-row">
                    <div class="p-2">
                        <img src="../../assets/images/users/4.jpg" alt="user" width="50" class="rounded-circle">
                    </div>
                    <div class="comment-text active w-100">
                        <h6 class="font-medium">Michael Jorden</h6>
                        <span class="m-b-15 d-block">Lorem Ipsum is simply dummy text of the printing and type setting industry. </span>
                        <div class="comment-footer ">
                            <span class="text-muted float-right">April 14, 2016</span>
                            <span class="label label-success label-rounded">Approved</span>
                            <span class="action-icons active">
                                <a href="javascript:void(0)">
                                    <i class="ti-pencil-alt"></i>
                                </a>
                                <a href="javascript:void(0)">
                                    <i class="icon-close"></i>
                                </a>
                                <a href="javascript:void(0)">
                                    <i class="ti-heart text-danger"></i>
                                </a>
                            </span>
                        </div>
                    </div>
                </div>
                <!-- Comment Row -->
                <div class="d-flex flex-row comment-row">
                    <div class="p-2">
                        <img src="../../assets/images/users/5.jpg" alt="user" width="50" class="rounded-circle">
                    </div>
                    <div class="comment-text w-100">
                        <h6 class="font-medium">Johnathan Doeting</h6>
                        <span class="m-b-15 d-block">Lorem Ipsum is simply dummy text of the printing and type setting industry. </span>
                        <div class="comment-footer">
                            <span class="text-muted float-right">April 14, 2016</span>
                            <span class="label label-rounded label-danger">Rejected</span>
                            <span class="action-icons">
                                <a href="javascript:void(0)">
                                    <i class="ti-pencil-alt"></i>
                                </a>
                                <a href="javascript:void(0)">
                                    <i class="ti-check"></i>
                                </a>
                                <a href="javascript:void(0)">
                                    <i class="ti-heart"></i>
                                </a>
                            </span>
                        </div>
                    </div>
                </div>
                <!-- Comment Row -->
                <div class="d-flex flex-row comment-row m-t-0">
                    <div class="p-2">
                        <img src="../../assets/images/users/2.jpg" alt="user" width="50" class="rounded-circle">
                    </div>
                    <div class="comment-text w-100">
                        <h6 class="font-medium">Steve Jobs</h6>
                        <span class="m-b-15 d-block">Lorem Ipsum is simply dummy text of the printing and type setting industry. </span>
                        <div class="comment-footer">
                            <span class="text-muted float-right">April 14, 2016</span>
                            <span class="label label-rounded label-primary">Pending</span>
                            <span class="action-icons">
                                <a href="javascript:void(0)">
                                    <i class="ti-pencil-alt"></i>
                                </a>
                                <a href="javascript:void(0)">
                                    <i class="ti-check"></i>
                                </a>
                                <a href="javascript:void(0)">
                                    <i class="ti-heart"></i>
                                </a>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- column -->
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center p-b-15">
                    <div>
                        <h4 class="card-title mb-0">To Do List</h4>
                    </div>
                    <div class="ml-auto">
                        <div class="dl">
                            <select class="custom-select border-0 text-muted">
                                <option value="0" selected="">August 2018</option>
                                <option value="1">May 2018</option>
                                <option value="2">March 2018</option>
                                <option value="3">June 2018</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="todo-widget scrollable" style="height:422px;">
                    <ul class="list-task todo-list list-group m-b-0" data-role="tasklist">
                        <li class="list-group-item todo-item" data-role="task">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="customCheck">
                                <label class="custom-control-label todo-label" for="customCheck">
                                    <span class="todo-desc">Simply dummy text of the printing and typesetting</span> <span class="badge badge-pill badge-success float-right">Project</span>
                                </label>
                            </div>
                        </li>
                        <li class="list-group-item todo-item" data-role="task">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="customCheck1">
                                <label class="custom-control-label todo-label" for="customCheck1">
                                    <span class="todo-desc">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been.</span><span class="badge badge-pill badge-danger float-right">Project</span>
                                </label>
                            </div>
                            
                        </li>
                        <li class="list-group-item todo-item" data-role="task">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="customCheck2">
                                <label class="custom-control-label todo-label" for="customCheck2">
                                    <span class="todo-desc">Ipsum is simply dummy text of the printing</span> <span class="badge badge-pill badge-info float-right">Project</span>
                                </label>
                            </div>
                            
                        </li>
                        <li class="list-group-item todo-item" data-role="task">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="customCheck3">
                                <label class="custom-control-label todo-label" for="customCheck3">
                                    <span class="todo-desc">Simply dummy text of the printing and typesetting</span> <span class="badge badge-pill badge-info float-right">Project</span>
                                </label>
                            </div>
                        </li>
                        <li class="list-group-item todo-item" data-role="task">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="customCheck4">
                                <label class="custom-control-label todo-label" for="customCheck4">
                                    <span class="todo-desc">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been.</span> <span class="badge badge-pill badge-purple float-right">Project</span>
                                </label>
                            </div>
                        </li>
                        <li class="list-group-item todo-item" data-role="task">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="customCheck5">
                                <label class="custom-control-label todo-label" for="customCheck5">
                                    <span class="todo-desc">Ipsum is simply dummy text of the printing</span> <span class="badge badge-pill badge-success float-right">Project</span>
                                </label>
                            </div>
                        </li>
                        <li class="list-group-item todo-item" data-role="task">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="customCheck6">
                                <label class="custom-control-label todo-label" for="customCheck6">
                                    <span class="todo-desc">Simply dummy text of the printing and typesetting</span> <span class="badge badge-pill badge-primary float-right">Project</span>
                                </label>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div> --}}

    <script>
        window.orderStatus = {
            paid: {{ $paidOrders }},
            pending: {{ $pendingOrders }},
            failed: {{ $failedOrders }},
            expired: {{ $expiredOrders }}
        };
    </script>

    <script>
        window.revenueData = @json($revenueData);
    </script>

<script src="{{ asset('dist/js/pages/dashboards/dashboard2.js') }}"></script>
@endsection