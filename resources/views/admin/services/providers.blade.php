@extends('admin.layouts.main-layout')
@section('title','All Providers')
@section('content') 
 <!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <div class="d-flex align-items-center flex-wrap mr-2">
                <h5 class="text-blue font-weight-bold mt-2 mb-2 mr-5">
                    All Providers
                </h5>
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <a href="{{ url('admin/dashboard') }}" class="text-blue font-weight-bold mt-2 mb-2 mr-5">
                    Dashboard
                </a>
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <a href="javascript:void(0)" class="text-dark font-weight-bold mt-2 mb-2 mr-5">
                    Service Management
                </a>
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <a href="javascript:void(0)" class="text-dark font-weight-bold mt-2 mb-2 mr-5">
                    All Providers
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
                    <form id="filterForm" method="GET" action="{{ url('admin/services/providers') }}">
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Provider Name</label>
                                    <input type="text" class="form-control" name="name" value="{{ request('name') }}">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Country</label>
                                    <select id="country" name="country" class="form-control">
                                        <option selected="" value="">Country</option>
                                        @foreach(DB::table('countries')->get() as $c)
                                        <option value="{{ $c->code }}" {{ request('country') == $c->code ? 'selected' : '' }}>{{ $c->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Parent Service</label>
                                    <select id="filter_parent" name="service" class="form-control">
                                        <option selected="" value="">Parent Service</option>
                                        @foreach(DB::table('services')->whereNull('parent_id')->get() as $parentService)
                                        <option value="{{ $parentService->id }}" {{ request('service') == $parentService->id ? 'selected' : '' }}>{{ $parentService->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Service</label>
                                    <select id="filter_child" name="filter_child_services" class="form-control">
                                        <option selected="" value="">Service</option>
                                        @foreach(DB::table('services')->whereNotNull('parent_id')->get() as $childService)
                                        <option value="{{ $childService->id }}" {{ request('filter_child_services') == $childService->id ? 'selected' : '' }}>{{ $childService->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Featured</label>
                                    <select id="featured" name="featured" class="form-control">
                                        <option selected="" value="">Featured</option>
                                        <option value="1" {{ request('featured') == 1 ? 'selected' : '' }}>Yes</option>
                                        <option value="2" {{ request('featured') == 2 ? 'selected' : '' }}>No</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
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
                            All Providers
                        </h3>
                    </div>
                    <div class="card-toolbar">
                        <a href="{{ url('admin/services/addprovider') }}" class="btn btn-primary btn-sm font-weight-bolder">
                            Add Provider
                        </a>
                    </div>
                </div>
                <div class="card-body table-responsive" id="table-data">
                    @include('admin.services.render.providers_table', ['data' => $data])
                </div>
            </div>
            <!--end::Card-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->
</div>


<div class="modal fade" id="importprovider" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="row">
                    <div class="col-md-12">
                        <h5 class="modal-title" id="exampleModalLabel">Import Providers</h5>
                    </div>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <form enctype="multipart/form-data" method="POST" action="{{ url('admin/services/importprovider') }}">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Import File</label>
                                <input class="form-control" type="file" name="file" required>
                            </div>
                                <a download="" href="{{ url('public/images/providersimport.xlsx') }}">Download Template</a>
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
<script type="text/javascript">
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
            title: 'Are you sure you Want To Change Status of This Provider?',
            text: "If Status is Not Published then This Provider Will not show Frontend",
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
        function fetchProviders() {
            let formData = $('#filterForm').serialize();
            $.ajax({
                url: "{{ url('admin/services/providers') }}",
                type: "GET",
                data: formData,
                success: function (data) {
                    $('#table-data').html(data.tableData);
                    let newUrl = "{{ url('admin/services/providers') }}" + '?' + formData;
                    history.pushState(null, '', newUrl);
                },
                error: function (xhr, status, error) {
                    console.error(error);
                }
            });
        }
        $('#filterForm input, #filterForm select').on('input change', function () {
            fetchProviders();
        });
        $('#country, #filter_parent, #filter_child, #planstatus, #featured').select2({
            placeholder: "Select",
            width: '100%',
            allowClear: true
        });
    });
</script>
@endsection