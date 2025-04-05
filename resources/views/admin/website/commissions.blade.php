@extends('admin.layouts.main-layout')
@section('title','Commissions')
@section('content')
 <!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <div class="d-flex align-items-center flex-wrap mr-2">
                <h5 class="text-blue font-weight-bold mt-2 mb-2 mr-5">
                    Commissions
                </h5>
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <a href="{{ url('admin/dashboard') }}" class="text-blue font-weight-bold mt-2 mb-2 mr-5">
                    Dashboard
                </a>
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <a href="javascript:void(0)" class="text-dark font-weight-bold mt-2 mb-2 mr-5">
                    Settings
                </a>
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <a href="javascript:void(0)" class="text-dark font-weight-bold mt-2 mb-2 mr-5">
                    Commissions
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
                    <form id="filterForm" method="GET" action="{{ url('admin/website/settings/commission') }}">
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Plan Name</label>
                                    <input type="text" class="form-control" name="name" value="{{ request('name') }}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Provider</label>
                                    <select id="provider" name="provider" class="form-control">
                                        <option value="">Select Provider</option>
                                        @foreach(DB::table('providers')->get() as $r)
                                        <option value="{{ $r->id }}" {{ request('provider') == $r->id ? 'selected' : '' }}>{{ $r->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                             <div class="col-md-2">
                                <div class="form-group">
                                    <label>Parent Service</label>
                                    <select id="filter_parent" name="parentservice" class="form-control">
                                        <option selected="" value="">Parent Service</option>
                                        @foreach(DB::table('services')
                                                ->whereNull('parent_id')
                                                ->get() as $parentService)
                                        <option value="{{ $parentService->id }}" {{ request('parentservice') == $parentService->id ? 'selected' : '' }}>{{ $parentService->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Service</label>
                                    <select id="filter_child" name="service" class="form-control">
                                        <option selected="" value="">Service</option>
                                        @foreach(DB::table('services')
                                                ->whereNotNull('parent_id')
                                                ->get() as $childService)
                                        <option value="{{ $childService->id }}" {{ request('providerservice') == $childService->id ? 'selected' : '' }}>{{ $childService->name }}</option>
                                        @endforeach
                                    </select>
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
                            Commissions
                        </h3>
                    </div>
                    <div class="card-toolbar">
                        <a href="javascript:void(0)" onclick="addcommissionmodel()" class="btn btn-primary btn-sm font-weight-bolder">
                            Add Commission
                        </a>
                    </div>
                </div>
                <div class="card-body" id="table-data">
                    @include('admin.website.render.commissione_table', ['data' => $data])
                </div>
            </div>
            <!--end::Card-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->
</div>
<div class="modal fade" id="exampleModalCenter" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md" id="addcommissionmodelrender" role="document">
        
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
                url: "{{ url('admin/website/settings/commission') }}",
                type: "GET",
                data: formData,
                success: function (data) {
                    $('#table-data').html(data.tableData);
                    let newUrl = "{{ url('admin/website/settings/commission') }}" + '?' + formData;
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
        $('#childservice, #selectprovider , #country, #filter_parent, #filter_child, #provider, #showthisonprovider, #planstatus').select2({
            placeholder: "Select",
            width: '100%',
            allowClear: true
        });
    });
    function addcommissionmodel(id) {
        $.ajax({
            url: "{{ url('admin/website/settings/addcommissionmodel') }}/"+id,
            type: "GET",
            success: function (data) {
                $('#addcommissionmodelrender').html(data);
                $('#exampleModalCenter').modal('show');
            },
            error: function (xhr, status, error) {
                console.error(error);
            }
        });
    }
</script>
@endsection