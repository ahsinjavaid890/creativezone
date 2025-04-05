@extends('admin.layouts.main-layout')
@section('title','Product orders | Orders')
@section('content')
 <!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <div class="d-flex align-items-center flex-wrap mr-2">
                <h5 class="text-blue font-weight-bold mt-2 mb-2 mr-5">
                    Product Inquires
                </h5>
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <a href="{{ url('admin/dashboard') }}" class="text-blue font-weight-bold mt-2 mb-2 mr-5">
                    Dashboard
                </a>
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <a href="javascript:void(0)" class="text-dark font-weight-bold mt-2 mb-2 mr-5">
                   Product  Inquires
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
                                    <label>Product Name</label>
                                    <select class="form-control"  name="product_id" id="product_id">
                                        <option selected="" value="">Select Product</option>
                                        @foreach(DB::table('buy_products')->get() as $r)
                                        <option  value="{{ $r->id }}" {{ request('product') ==   $r->id  ? 'selected' : '' }}>{{ $r->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Status</label>
                                    <select class="form-control"  name="status" id="status">
                                        <option selected="" value="">Select Status</option>
                                        <option  value="1" {{ request('status') == 1 ? 'selected' : '' }}>Enable</option>
                                        <option  value="2" {{ request('status') == 2 ? 'selected' : '' }}>Disable</option>
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
                       Product Inquires
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
                                <th class="text-center">Product</th>
                                <th class="text-center">Best Find</th>
                                <th class="text-center">Condition</th>
                                <th class="text-center">Storage</th>
                                <th class="text-center">Color</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Operations</th>
                            </tr>
                        </thead>
                        <tbody id="table-data">
                            @include('admin.orders.render.product_inquires_table', ['data' => $data])
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
            title: 'Are you sure you Want To Change Status of This Inqurie?',
            text: "If Status is Not Enabled",
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
                url: "{{ url('admin/orders/productinqury') }}",
                type: "GET",
                data: formData,
                success: function (data) {
                    $('#table-data').html(data.tableData);
                    let newUrl = "{{ url('admin/orders/productinqury') }}" + '?' + formData;
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
        $('#product_id, #status').select2({
            placeholder: "Select",
            width: '100%',
            allowClear: true
        });
    });
</script>
@endsection