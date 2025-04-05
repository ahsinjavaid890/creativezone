@extends('admin.layouts.main-layout')
@section('title','All Plans')
@section('content')
 <!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <div class="d-flex align-items-center flex-wrap mr-2">
                <h5 class="text-blue font-weight-bold mt-2 mb-2 mr-5">
                    All Plans
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
                    All Plans
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
                    <form id="filterForm" method="GET" action="{{ url('admin/services/allplans') }}">
                        <div class="row">
                           <!--  <div class="col-md-2">
                                <div class="form-group">
                                    <label>Plan Name</label>
                                    <input type="text" class="form-control" name="name" value="{{ request('name') }}">
                                </div>
                            </div> -->
                             <div class="col-md-2">
                                <div class="form-group">
                                    <label>Parent Service</label>
                                    <select id="filter_parent" name="parentservice" class="form-control">
                                        <option selected="" value="">Parent Service</option>
                                        @foreach(DB::table('services')
                                                ->whereNull('parent_id')
                                                ->whereIn('id', DB::table('plans')->pluck('parentservice'))
                                                ->get() as $parentService)
                                        <option value="{{ $parentService->id }}" {{ request('parentservice') == $parentService->id ? 'selected' : '' }}>{{ $parentService->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Service</label>
                                    <select id="filter_child" name="providerservice" class="form-control">
                                        <option selected="" value="">Service</option>
                                        @foreach(DB::table('services')
                                                ->whereNotNull('parent_id')
                                                ->whereIn('id', DB::table('plans')->pluck('providerservice'))
                                                ->get() as $childService)
                                        <option value="{{ $childService->id }}" {{ request('providerservice') == $childService->id ? 'selected' : '' }}>{{ $childService->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Select Provider</label>
                                    <select id="filter_provider" name="provider" class="form-control">
                                        <option selected="" value="">Select Provider</option>
                                        @foreach(DB::table('providers')
                                                ->whereIn('id', DB::table('plans')->pluck('provider'))
                                                ->get() as $provider)
                                        <option value="{{ $provider->id }}" {{ request('provider') == $provider->id ? 'selected' : '' }}>{{ $provider->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Show on Home Page plan</label>
                                    <select id="show_on_home_page" name="show_on_home_page" class="form-control">
                                        <option value="">Show on Home Page</option>
                                        <option value="Yes" {{ request('show_on_home_page') == 'Yes' ? 'selected' : '' }}>Yes</option>
                                        <option value="No" {{ request('show_on_home_page') == 'No' ? 'selected' : '' }}>No</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Show on Provider Page Plan</label>
                                    <select id="showthisonprovider" name="showthisonprovider" class="form-control">
                                        <option value="">Show on Provider Page Plan</option>
                                        <option value="Yes" {{ request('showthisonprovider') == 'Yes' ? 'selected' : '' }}>Yes</option>
                                        <option value="No" {{ request('showthisonprovider') == 'No' ? 'selected' : '' }}>No</option>
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
                            All Plans
                        </h3>
                    </div>
                    <div class="card-toolbar">
                        <!-- <a href="{{ url('admin/services/planexport') }}" class="btn btn-primary font-weight-bolder mr-2">
                          <span class="material-symbols-outlined">system_update_alt</span> Export
                        </a>
                        <a href="javascript::void(0)" class="btn btn-primary font-weight-bolder mr-2" data-toggle="modal" data-target="#importplans"> <span class="material-symbols-outlined">upload</span> Import
                        </a> -->
                        <a href="{{ url('admin/services/addplan') }}" class="btn btn-primary btn-sm font-weight-bolder">
                            Add Plan
                        </a>
                    </div>
                </div>
                <div class="card-body table-responsive" id="table-data">
                    @include('admin.services.render.plans_table', ['data' => $data])
                </div>
            </div>
            <!--end::Card-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->
</div>
<div class="modal fade" id="importplans" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="row">
                    <div class="col-md-12">
                        <h5 class="modal-title" id="exampleModalLabel">Import Plans</h5>
                    </div>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <form enctype="multipart/form-data" method="POST" action="{{ url('admin/services/importplans') }}">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Import File</label>
                                <input class="form-control" type="file" name="file" required>
                            </div>
                                <a download="" href="{{ url('public/images/plansimport.xlsx') }}">Download Template</a>
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
            title: 'Are you sure you Want To Change Status of This Plan?',
            text: "If Status is Not Published then This Plan Will not show Frontend",
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
    function confirmhomepage(url) {
        Swal.fire({
            title: 'Are you sure you Want To Change Status of This Hompage plan?',
            text: "If Status is Not Published then This Plan Will not show on homepage",
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
    function confirmprovider(url) {
        Swal.fire({
            title: 'Are you sure you Want To Change Status of This Provider plan?',
            text: "If Status is Not Published then This Plan Will not show on Provider Page",
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
    document.getElementById('perPageSelect').addEventListener('change', function() {
        var perPage = this.value;
        var url = new URL(window.location.href);
        url.searchParams.set('per_page', perPage);
        window.location.href = url.toString();
    });
</script>
<script type="text/javascript">
    $(document).ready(function () {
        function fetchplans() {
            let formData = $('#filterForm').serialize();
            $.ajax({
                url: "{{ url('admin/services/allplans') }}",
                type: "GET",
                data: formData,
                success: function (data) {
                    $('#table-data').html(data.tableData);
                    let newUrl = "{{ url('admin/services/allplans') }}" + '?' + formData;
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
        $('#country, #filter_parent, #filter_child, #filter_provider, #show_on_home_page, #showthisonprovider, #planstatus').select2({
            placeholder: "Select",
            width: '100%',
            allowClear: true
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.show-more').on('click', function() {
            $(this).siblings('.attributes').find('.attribute-item').show();
            $(this).hide(); 
            $(this).siblings('.show-less').show();
        });
        $('.show-less').on('click', function() {
            $(this).siblings('.attributes').find('.attribute-item').hide();
            $(this).siblings('.attributes').find('.attribute-item').slice(0, 3).show();
            $(this).hide(); 
            $(this).siblings('.show-more').show();
        });
    });
</script>
@endsection