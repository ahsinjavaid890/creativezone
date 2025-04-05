@extends('admin.layouts.main-layout')
@section('title','Ecommerece | Products Accessories')
@section('content')
 <!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <div class="d-flex align-items-center flex-wrap mr-2">
                <h5 class="text-blue font-weight-bold mt-2 mb-2 mr-5">
                    Products Accessories
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
                    Products Accessories
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
                    <form id="filterForm" method="GET" action="{{ url('admin/ecommerce/accessories') }}">
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input placeholder="Search Accessories By Name" type="text" class="form-control" name="name" value="{{ request('name') }}">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Type</label>
                                    <select name="type" id="type" class="form-control">
                                        <option value="">Type</option>
                                        <option value="buy_products">Buy</option>
                                        <option value="accessories">Accessories</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Category</label>
                                    <select name="category_id" id="category_id" class="form-control">
                                        <option value="" >Category</option>
                                        @foreach(DB::table('categories')->get() as  $r)
                                        <option value="{{ $r->id }}" {{ request('category_id') == $r->id ? 'selected' : '' }}>{{ $r->name }}</option>
                                        @endforeach
                                        
                                    </select> 
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Model</label>
                                    <select name="model" id="model" class="form-control">
                                        <option value="">Model</option>
                                        @foreach(DB::table('models')->get() as $r)
                                        <option value="{{ $r->id }}" {{ request('model') == $r->id ? 'selected' : '' }}>{{ $r->name }}</option>
                                        @endforeach
                                    </select> 
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Status</label>
                                    <select name="status" id="status" class="form-control">
                                        <option value="">Status</option>
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
                <div class="card-header flex-wrap">
                    <div class="card-title">
                        Products Accessories
                    </div>
                    <div class="card-toolbar">
                        <form action="{{ url('admin/ecommerce/export-products') }}" method="POST" id="exportForm">
                            @csrf
                            <input type="hidden" name="product_ids" id="productIds">
                            <button type="submit" class="btn btn-primary font-weight-bolder mr-2">Export </button>
                        </form>
                        <div class="dropdown dropdown-inline">
                            <a href="{{ url('admin/ecommerce/accessories-product') }}" class="btn btn-primary font-weight-bolder" >
                                Create Accessories Product
                            </a>
                        </div>
                        <!--end::Button-->
                    </div>
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <!-- <th><input type="checkbox" onclick="toggleCheckboxes(this)"></th> -->
                                <th class="text-center">Images</th>
                                <th class="text-center">Tittle</th>
                                <th class="text-center">Category</th>
                                <th class="text-center">Modal</th>
                                <th class="text-center">Offer Price</th>
                                <th class="text-center">Sell Price</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Operations</th>
                            </tr>
                        </thead>
                        <tbody>
                            @include('admin.ecommerce.render.accessories_table', ['data' => $data])
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
            title: 'Are you sure you Want To Change Status of This Product Accessories?',
            text: "If Status is Not Published then This Product Accessories Will not show Frontend",
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
            url: "{{ url('admin/ecommerce/accessories') }}",
            type: "GET",
            data: formData,
            success: function (data) {
                console.log(data);
                $('tbody').html(data.tableData);
                let newUrl = "{{ url('admin/ecommerce/accessories') }}" + '?' + formData;
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
    $('#category_id, #type, #model, #status').select2({
        placeholder: "Select",
        width: '100%',
        allowClear: true
    });
});
</script>
@endsection