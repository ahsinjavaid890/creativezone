@extends('admin.layouts.main-layout')
@section('title','Shipping Companies')
@section('content')
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <div class="d-flex align-items-center flex-wrap mr-2">
                <h5 class="text-blue font-weight-bold mt-2 mb-2 mr-5">
                    Shipping Companies
                </h5>
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <a href="{{ url('admin/dashboard') }}" class="text-blue font-weight-bold mt-2 mb-2 mr-5">
                    Dashboard
                </a>
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <a href="{{ url('admin/website/settings') }}" class="text-blue font-weight-bold mt-2 mb-2 mr-5">
                    Settings
                </a>
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <a href="javascript:void(0)" class="text-dark font-weight-bold mt-2 mb-2 mr-5">
                   Shipping Companies
                </a>
            </div>
        </div>
    </div>
    <div class="d-flex flex-column-fluid">
        <div class="container-fluid">
            @include('alerts.index')
            <div class="card card-custom mt-5">
                <div class="card-body">
                    <form id="filterForm" method="GET" action="{{ url('admin/website/settings/shippingcompanies') }}">
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Company Name</label>
                                    <input type="text" class="form-control" name="name" value="{{ request('name') }}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Status</label>
                                    <select id="planstatus" name="status" class="form-control">
                                        <option value="">Status</option>
                                        <option value="1" {{ request('status') == 1 ? 'selected' : '' }}>Enabled</option>
                                        <option value="2" {{ request('status') == 2 ? 'selected' : '' }}>Disabled</option>
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
                        <h3 class="card-label">
                            Shipping Companies
                        </h3>
                    </div>
                    <div class="card-toolbar">
                        <a href="javascript:void(0)" data-toggle="modal" data-target="#addshipping"  class="btn btn-primary btn-sm font-weight-bolder">
                            Add Shipping Company
                        </a>
                    </div>
                </div>
                <div class="card-body" id="table-data">
                    @include('admin.website.render.shipping_table', ['data' => $data])
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="addshipping" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="row">
                    <div class="col-md-12">
                        <h5 class="modal-title" id="exampleModalLabel">Add Shipping Company</h5>
                    </div>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <form  enctype="multipart/form-data" method="POST" action="{{ url('admin/website/settings/addcompanyname') }}">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="lable-control">Enter Company Name</label>
                                <input type="text" name="name" class="form-control" placeholder="Enter Company Name">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary font-weight-bold">Save</button>
                </div>
            </form>
        </div>
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
            title: 'Are you sure you Want To Change Status of This Company?',
            text: "If Status is Not Published then This Company Will not show Frontend",
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
    $(document).ready(function () {
        function fetchplans() {
            let formData = $('#filterForm').serialize();
            $.ajax({
                url: "{{ url('admin/website/settings/shippingcompanies') }}",
                type: "GET",
                data: formData,
                success: function (data) {
                    $('#table-data').html(data.tableData);
                    let newUrl = "{{ url('admin/website/settings/shippingcompanies') }}" + '?' + formData;
                    history.pushState(null, '', newUrl);
                },
                error: function (xhr, status, error) {
                    console.error(error);
                }
            });
        }
        $('#filterForm input, #filterForm select').on('input change', function () {
            fetchplans();
        });
        $('#status').select2({
            placeholder: "Select",
            width: '100%',
            allowClear: true
        });
    });
</script>
@endsection