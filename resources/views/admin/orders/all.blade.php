@extends('admin.layouts.main-layout')
@section('title','Product orders | Orders')
@section('content')
 <!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <div class="d-flex align-items-center flex-wrap mr-2">
                <h5 class="text-blue font-weight-bold mt-2 mb-2 mr-5">
                    Product Orders
                </h5>
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <a href="{{ url('admin/dashboard') }}" class="text-blue font-weight-bold mt-2 mb-2 mr-5">
                    Dashboard
                </a>
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <a href="javascript:void(0)" class="text-dark font-weight-bold mt-2 mb-2 mr-5">
                   Product  Orders
                </a>
            </div>
        </div>
    </div>
    <!--end::Subheader-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class=" container-fluid ">
            <!--begin::Card-->
            @include('alerts.index')
            <div class="card card-custom mt-5">
                <div class="card-body">
                    <form id="filterForm" method="GET" action="{{ url('admin/orders/all') }}">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Customer Name</label>
                                    <input  type="text" class="form-control" name="name" value="{{ request('name') }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Payment Status</label>
                                    <select class="form-control"  name="payment_status" id="payment_status">
                                        <option selected="" value="">Select Payment Status</option>
                                        <option  value="paid" {{ request('payment_status') == 'paid' ? 'selected' : '' }}>Paid</option>
                                        <option  value="pending" {{ request('payment_status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option  value="failed" {{ request('payment_status') == 'failed' ? 'selected' : '' }}>Failed</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Status</label>
                                    <select class="form-control"  name="status" id="status">
                                        <option selected="" value="">Select Payment Status</option>
                                        <option  value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                                        <option  value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option  value="canceled" {{ request('status') == 'canceled' ? 'selected' : '' }}>Canceled</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card card-custom mt-5">
                <div class="card-header flex-wrap">
                    <div class="card-title">
                       Product Orders
                    </div>
                    <div class="card-toolbar">
                        <!--begin::Button-->
                        <!-- <a href="javascript::void(0)" class="btn btn-primary font-weight-bolder">
                            Export
                        </a> -->
                        <!--end::Button-->
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center">Name</th>
                                <th class="text-center">Address</th>
                                <th class="text-center">Price</th>
                                <th class="text-center">Payement Status</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Operations</th>
                            </tr>
                        </thead>
                        <tbody id="table-data">
                            @include('admin.orders.render.product_order_table', ['data' => $data])
                        </tbody>
                    </table>
                        {!! $data->links('admin.pagination') !!}
                </div>
            </div>
            <!--end::Card-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->
</div>
@endsection
@section('script')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function confirmDelete(url) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = url;
            }
        })
    }
    function confirmstatus(url) {
        Swal.fire({
            title: 'Are you sure you Want To Change Status of This Product?',
            text: "If Status is Not Published then This Product Will not show Frontend",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Change it!'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = url;
            }
        })
    }

</script>
<script type="text/javascript">
    $(document).ready(function () {
        function fetchorder() {
            let formData = $('#filterForm').serialize();
            $.ajax({
                url: "{{ url('admin/orders/all') }}",
                type: "GET",
                data: formData,
                success: function (data) {
                    $('#table-data').html(data.tableData);
                    let newUrl = "{{ url('admin/orders/all') }}" + '?' + formData;
                    history.pushState(null, '', newUrl);
                },
                error: function (xhr, status, error) {
                    console.error(error);
                }
            });
        }
        $('#filterForm input, #filterForm select').on('input change', function () {
            fetchorder();
        });
        $('#payment_status, #status').select2({
            placeholder: "Select",
            width: '100%',
            allowClear: true
        });
    });
</script>
@endsection