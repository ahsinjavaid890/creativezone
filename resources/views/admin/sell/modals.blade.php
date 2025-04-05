@extends('admin.layouts.main-layout')
@section('title','Modals')
@section('content') 
 <!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <div class="d-flex align-items-center flex-wrap mr-2">
                <h5 class="text-blue font-weight-bold mt-2 mb-2 mr-5">
                    Modals
                </h5>
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <a href="{{ url('admin/dashboard') }}" class="text-blue font-weight-bold mt-2 mb-2 mr-5">
                    Dashboard
                </a>
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <a href="javascript:void(0)" class="text-dark font-weight-bold mt-2 mb-2 mr-5">
                    Sell
                </a>
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <a href="javascript:void(0)" class="text-dark font-weight-bold mt-2 mb-2 mr-5">
                    All Modals
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
                    <form id="filterForm" method="GET" action="{{ url('admin/ecommerce/models') }}">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Search Model By Name</label>
                                    <input placeholder="Search Provider By Name" type="text" class="form-control" name="name" value="{{ request('name') }}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Brands</label>
                                    <select name="category_id" id="category_id" class="form-control">
                                        <option selected="" value="">Choose Category</option>
                                        @foreach(DB::table('categories')->where('category_type' , 'sell')->where('status' , 1)->get() as $r)
                                        <option value="{{ $r->id }}" {{ request('category_id') == $r->id ? 'selected' : '' }}>{{ $r->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Status</label>
                                    <select name="status" class="form-control" id="status">
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
                <div class="card-header flex-wrap"> 
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label font-weight-bolder text-dark">All Modals</span>
                    </h3>
                    <div class="card-toolbar">
                        <a href="javascript:void(0)" data-toggle="modal" data-target="#exampleModalCenter" class="btn btn-primary btn-sm font-weight-bolder">Add New Modal
                        </a>
                    </div>
                </div>
                <div class="card-body" id="table-data">
                    @include('admin.sell.render.modal_table', ['data' => $data])
                </div>
            </div>
            <!--end::Card-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->
</div>
<div class="modal fade" id="exampleModalCenter" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <form enctype="multipart/form-data" method="POST" action="{{ url('admin/ecommerce/createmodal') }}" class="modal-content">
            @csrf
            <input type="hidden" value="accessories" name="type">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add New Modal</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Select Category <span class="text-danger">*</span></label>
                            <select class="form-control" name="category_id">
                                @foreach(DB::table('categories')->where('category_type' , 'sell')->where('status' , 1)->get() as $r)
                                <option value="{{ $r->id }}">{{ $r->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Modal Name <span class="text-danger">*</span></label>
                            <input required type="text" placeholder="Enter Modal Name" class="form-control" name="name">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Modal Image <span class="text-danger">*</span></label>
                            <input required type="file" placeholder=""  class="form-control" name="image">
                        </div>
                    </div>
                    <div class="col-md-12">
                       <div class="form-group">
                            <label>Description</label>
                            <textarea name="description" class="form-control" rows="4"></textarea>
                        </div> 
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary font-weight-bold">Create New Operating System</button>
            </div>
        </form>
    </div>
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
            title: 'Are you sure you Want To Change Status of This Model?',
            text: "If Status is Not Published then This Model Will not show Frontend",
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
            url: "{{ url('admin/sell/models') }}",
            type: "GET",
            data: formData,
            success: function (data) {
                $('#table-data').html(data.tableData);
                let newUrl = "{{ url('admin/sell/models') }}" + '?' + formData;
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
    $('#category_id, #status').select2({
        placeholder: "Select",
        width: '100%',
        allowClear: true
    });
});
</script>
@endsection