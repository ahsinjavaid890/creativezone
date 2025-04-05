@extends('admin.layouts.main-layout')
@section('title','All Properties')
@section('content')
 <!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <div class="d-flex align-items-center flex-wrap mr-2">
                <h5 class="text-blue font-weight-bold mt-2 mb-2 mr-5">
                    Properties
                </h5>
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <a href="{{ url('admin/dashboard') }}" class="text-blue font-weight-bold mt-2 mb-2 mr-5">
                    Dashboard
                </a>
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <a href="javascript:void(0)" class="text-dark font-weight-bold mt-2 mb-2 mr-5">
                   All Properties
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
                    <form id="filterForm" method="GET" action="{{ url('admin/properties/index') }}">
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Property Type</label>
                                    <select name="property_type" class="form-control" id="property_type">
                                        <option value="">Choose Property Type</option>
                                         @foreach(DB::table('properties')->groupby('property_type')->get() as $r)
                                        <option value="{{ $r->property_type }}" {{ request('property_type') ==$r->property_type ? 'selected' : '' }}>{{ $r->property_type }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Property Name</label>
                                    <input placeholder="Search Property By Name" type="text" class="form-control" name="name" value="{{ request('name') }}">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Parent Service</label>
                                    <select id="filter_parent" name="filter_parent_services" class="form-control">
                                        <option selected="" value="">Choose Parent Service</option>
                                        @foreach(DB::table('services')
                                                ->whereNull('parent_id')
                                                ->whereIn('id', DB::table('orders')->pluck('parent_service'))
                                                ->get() as $parentService)
                                        <option value="{{ $parentService->id }}" {{ request('filter_parent_services') == $parentService->id ? 'selected' : '' }}>{{ $parentService->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Service</label>
                                    <select id="filter_child" name="filter_child_services" class="form-control">
                                        <option selected="" value="">Choose Service</option>
                                        @foreach(DB::table('services')
                                                ->whereNotNull('parent_id')
                                                ->whereIn('id', DB::table('orders')->pluck('providerservice'))
                                                ->get() as $childService)
                                        <option value="{{ $childService->id }}" {{ request('filter_child_services') == $childService->id ? 'selected' : '' }}>{{ $childService->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Provider</label>
                                    <select name="provider" class="form-control" id="provider">
                                        <option value="">Choose Provider</option>
                                        @foreach(DB::table('providers')
                                                  ->join('services', 'providers.service', '=', 'services.id')
                                                  ->where('services.trashstatus', '!=', 1)
                                                  ->select('providers.id', 'providers.name')
                                                  ->get() as $r )   
                                        <option value="{{ $r->id }}" {{ request('provider') == $r->id ? 'selected' : '' }}>{{ $r->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
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
                <div class="card-header justify-content-end">
                    <div class="card-toolbar">
                        <a href="javascript:void(0)" data-toggle="modal" data-target="#exampleModalCenter" class="btn btn-primary font-weight-bolder mr-5">
                            Import Properties
                        </a>
                        <!--begin::Button-->
                        <a href="{{ url('admin/properties/addproperty') }}" class="btn btn-primary font-weight-bolder mr-2">
                            Add Property
                        </a>
                        <!--end::Button-->
                    </div>
                </div>
                <div class="card-body" id="table-data">
                    @include('admin.properties.render.properties_table', ['data' => $data])
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
        <form enctype="multipart/form-data" method="POST" action="{{ url('admin/properties/importproperties') }}" class="modal-content">
            @csrf
            <input type="hidden" value="accessories" name="type">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Import Properties</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Select File <span class="text-danger">*</span></label>
                            <input type="file" name="file" class="form-control" required>
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
@endsection
@section('script')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Get URL parameters
        const urlParams = new URLSearchParams(window.location.search);
        
        // Check if any filter parameters are present
        const hasFilters = urlParams.has('property_type') || 
                           urlParams.has('name') || 
                           urlParams.has('status') || 
                           urlParams.has('provider') 
        
        // If filters are present, open the accordion
        if (hasFilters) {
            const accordion = document.getElementById('collapseOne1');
            if (accordion) {
                new bootstrap.Collapse(accordion, {
                    toggle: true
                });
            }
        }
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
            title: 'Are you sure you Want To Change Status of This Properties?',
            text: "If Status is Not Published then This Properties Will not show Frontend",
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
        function fetchproperties() {
            let formData = $('#filterForm').serialize();
            $.ajax({
                url: "{{ url('admin/properties/index') }}",
                type: "GET",
                data: formData,
                success: function (data) {
                    $('#table-data').html(data.tableData);
                    let newUrl = "{{ url('admin/properties/index') }}" + '?' + formData;
                    history.pushState(null, '', newUrl);
                },
                error: function (xhr, status, error) {
                    console.error(error);
                }
            });
        }
        $('#filterForm input, #filterForm select').on('input change', function () {
            fetchproperties();
        });
        $('#property_type, #filter_parent, #filter_child, #provider, #status').select2({
            placeholder: "Select",
            width: '100%',
            allowClear: true
        });
    });
</script>
@endsection