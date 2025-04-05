@extends('admin.layouts.main-layout')
@section('title','Product Categories')
@section('content')
 <!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <div class="d-flex align-items-center flex-wrap mr-2">
                <h5 class="text-blue font-weight-bold mt-2 mb-2 mr-5">
                    Product Categories
                </h5>
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <a href="{{ url('admin/dashboard') }}" class="text-blue font-weight-bold mt-2 mb-2 mr-5">
                    Dashboard
                </a>
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <a href="javascript:void(0)" class="text-dark font-weight-bold mt-2 mb-2 mr-5">
                    Ecommerece
                </a>
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <a href="javascript:void(0)" class="text-dark font-weight-bold mt-2 mb-2 mr-5">
                    Product Categories
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
                    <form id="filterForm" method="GET" action="{{ url('admin/ecommerce/product-categories') }}">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Search Product Categories By Name</label>
                                    <input placeholder="Search Product Categories By Name" type="text" class="form-control" name="name" value="{{ request('name') }}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Product Category Type</label>
                                    <select name="category_type" id="category_type" class="form-control">
                                        <option value="">Select Product Category Type</option>
                                        <option value="buy" {{ request('status') == 'buy' ? 'selected' : '' }}>Buy</option>
                                        <option value="sell" {{ request('status') == 'sell' ? 'selected' : '' }}>Sell</option>
                                        <option value="accessories" {{ request('status') == 'accessories' ? 'selected' : '' }}>Accessories</option>
                                        <option value="repair" {{ request('status') == 'repair' ? 'selected' : '' }}>Repair</option>
                                    </select> 
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Status</label>
                                    <select name="status" id="status" class="form-control">
                                        <option value="">Select Status</option>
                                        <option value="1" {{ request('status') == 1 ? 'selected' : '' }}>Enable</option>
                                        <option value="2" {{ request('status') == 2 ? 'selected' : '' }}>Disable</option>
                                    </select> 
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card card-custom mt-5">
                <div class="card-header justify-content-end">
                    <div class="card-toolbar">
                        <!--begin::Button-->
                        <a href="{{ url('admin/ecommerce/add-product-category') }}" class="btn btn-primary font-weight-bolder">
                            Add New Category
                        </a>
                        <!--end::Button-->
                    </div>
                </div>
                <div class="card-body table-responsive" id="table-data">
                     @include('admin.ecommerce.render.productcat_table', ['data' => $data])
                </div>
            </div>
            <!--end::Card-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
function confirmDelete(url) {
    Swal.fire({
        title: 'Are you sure you Want To Delete This Category?',
        text: "All Products Will be Deleted Automaticaly against this Category and You won't be able to revert this!",
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
        title: 'Are you sure you Want To Change Status of This Category?',
        text: "If Status is Not Published then This Category Will not show Frontend",
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
            url: "{{ url('admin/ecommerce/product-categories') }}",
            type: "GET",
            data: formData,
            success: function (data) {
                console.log(data);
                $('#table-data').html(data.tableData);
                let newUrl = "{{ url('admin/ecommerce/product-categories') }}" + '?' + formData;
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
    $('#category_type, #status').select2({
        placeholder: "Select",
        width: '100%',
        allowClear: true
    });
});
</script>
@endsection