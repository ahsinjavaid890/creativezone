@extends('admin.layouts.main-layout')
@section('title','Ecommerece | Products')
@section('content')
 <!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <div class="d-flex align-items-center flex-wrap mr-2">
                <h5 class="text-blue font-weight-bold mt-2 mb-2 mr-5">
                    Products
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
                    Products
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
                    <form id="filterForm" method="GET" action="{{ url('admin/ecommerce/products') }}">
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input placeholder="Search Product By Name" type="text" class="form-control" name="name" value="{{ request('name') }}">
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
                                        <option value="1" selected>Enable</option>
                                       
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
                        <a href="{{ url('admin/ecommerce/accessories') }}" class="btn btn-primary font-weight-bolder  mx-2">
                            Accessories Product
                        </a>
                    </div>
                    <div class="card-toolbar">
                        <form action="{{ url('admin/ecommerce/export-products') }}" method="POST" id="exportForm">
                            @csrf
                            <input type="hidden" name="product_ids" id="productIds">
                            <button type="submit" class="btn btn-primary font-weight-bolder mr-2">Export </button>
                        </form>
                        <div class="dropdown dropdown-inline">
                            <a href="javascript:void(0)" class="btn btn-primary font-weight-bolder" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Create Product
                            </a>
                            <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                                <ul class="navi navi-hover">
                                    <li class="navi-item">
                                        <a href="{{ url('admin/ecommerce/add-product') }}" class="navi-link">
                                            <span class="navi-text">Buy Product</span>
                                        </a>
                                    </li>
                                    <li class="navi-item">
                                        <a href="{{ url('admin/ecommerce/accessories-product') }}" class="navi-link">
                                            <span class="navi-text">Accessories Product</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!--end::Button-->
                    </div>
                </div>
                <div class="card-body table-responsive" id="table-data">
                    @include('admin.ecommerce.render.product_table', ['data' => $data])
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
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip(); 
    });
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
<script>
    // Function to toggle all checkboxes
    function toggleCheckboxes(source) {
        checkboxes = document.getElementsByName('product_checkbox');
        for (var i = 0; i < checkboxes.length; i++) {
            checkboxes[i].checked = source.checked;
        }
    }

     document.getElementById('exportForm').addEventListener('submit', function(e) {
        e.preventDefault();
        let selected = [];
        document.querySelectorAll('input[name="product_checkbox"]:checked').forEach((checkbox) => {
            selected.push(checkbox.value);
        });
        document.getElementById('productIds').value = selected.join(',');
        this.submit();
    });
</script>
<script type="text/javascript">
$(document).ready(function () {
    function fetchorder() {
        let formData = $('#filterForm').serialize();
        $.ajax({
            url: "{{ url('admin/ecommerce/products') }}",
            type: "GET",
            data: formData,
            success: function (data) {
                $('#table-data').html(data.tableData);
                let newUrl = "{{ url('admin/ecommerce/products') }}" + '?' + formData;
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