@extends('admin.layouts.main-layout')
@section('title','All Routes Properties')
@section('content')
 <!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <div class="d-flex align-items-center flex-wrap mr-2">
                <h5 class="text-blue font-weight-bold mt-2 mb-2 mr-5">
                    All Routes Properties
                </h5>
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <a href="{{ url('admin/dashboard') }}" class="text-blue font-weight-bold mt-2 mb-2 mr-5">
                    Dashboard
                </a>
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <a href="javascript:void(0)" class="text-dark font-weight-bold mt-2 mb-2 mr-5">
                    All Routes Properties
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
            <div class="accordion accordion-toggle-arrow" id="addcarddetail">
                <div class="card card-custom mt-5">
                    <div id="collapseOne1" class="collapse" data-parent="#addcarddetail">
                        <div class="card-body">
                            <form method="GET" action="{{ url('admin/services/allplans') }}">
                                <div class="row">
                                    <div class="col-md-11 mb-5">
                                        <div class="form-group">
                                            <h4>Apply Filters</h4>
                                        </div>
                                    </div>
                                    <div class="col-md-1 mb-5 text-right">
                                        <div class="form-group">
                                            <span style="cursor: pointer;" data-toggle="collapse" data-target="#collapseOne1" class="material-symbols-outlined">close</span>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Search Provider By Name</label>
                                            <input placeholder="Search Provider By Name" type="text" class="form-control" name="name" value="{{ request('name') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Service</label>
                                            <select name="filter_operators" class="form-control">
                                                <option selected="" value="">Choose Parent Service</option>
                                                @foreach(DB::table('services')->wherenull('parent_id')->get() as $r)
                                                <option value="{{ $r->id }}" {{ request('filter_operators') == $r->id ? 'selected' : '' }}>{{ $r->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Status</label>
                                            <select name="status" class="form-control">
                                                <option value="">Select Status</option>
                                                <option value="1" {{ request('status') == 1 ? 'selected' : '' }}>Enable</option>
                                                <option value="2" {{ request('status') == 2 ? 'selected' : '' }}>Disable</option>
                                            </select> 
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label></label>
                                            <button class="btn btn-primary form-control mt-2">Apply Filter</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card card-custom mt-5">
                <div class="card-header flex-wrap">
                    <div class="card-title">
                        <a data-toggle="collapse" data-target="#collapseOne1" href="javascript::void(0)" class="btn btn-primary font-weight-bolder">
                           <span class="material-symbols-outlined">filter</span> Apply Filter
                        </a>
                         @if(request()->has('name') || request()->has('filter_operators') || request()->has('status'))
                            <a href="{{ url('admin/services/providers') }}" class="btn ml-3 btn-primary font-weight-bolder">
                                Clear Filter
                            </a>
                        @endif
                    </div>
                    <div class="card-toolbar">
                        <a href="javascript::void()" class="btn btn-primary font-weight-bolder"data-toggle="modal" data-target="#exampleModalScrollable">
                           <span class="material-symbols-outlined">add</span> Add
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center">Route</th>
                                <th class="text-center">Properties</th>
                                <th class="text-center">Operations</th>
                            </tr>
                        </thead>
                        <tbody>
                             @foreach($data as $r)
                            <tr>
                                <td class="text-center">
                                    <a href="">{{ DB::table('routes')->where('id', $r->route_id)->first()->name }}</a>
                                </td>
                                <td class="text-center">{{ DB::table('properties')->where('id', $r->propert_id)->first()->property_name }}</td>
                                <td class="text-center pr-0">
                                   <div class="dropdown dropdown-inline">
                                        <a href="#" class="btn btn-icon btn-light btn-hover-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                           <span class="material-symbols-outlined">more_horiz</span>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                                            <ul class="navi navi-hover">
                                                <li class="navi-item">
                                                    <a href="{{ url('admin/routes/properties') }}/{{ $r->id }}" class="navi-link">
                                                        <span class="navi-text">Properties</span>
                                                    </a>
                                                </li>
                                                <li class="navi-item">
                                                    <a href="javascript:void(0);" onclick='confirmstatus("{{ url('admin/routes/routestatus') }}/{{ $r->id }}")' class="navi-link">
                                                        <span class="navi-text">Change Status</span>
                                                    </a>
                                                </li>
                                                <li class="navi-item">
                                                    <a href="{{ url('admin/routes/editroute') }}/{{ $r->id }}" class="navi-link">
                                                        <span class="navi-text">Edit</span>
                                                    </a>
                                                </li>
                                                <li class="navi-item">
                                                    <a href="javascript:void(0);" onclick='confirmDelete("{{ url('admin/routes/deleteroutes') }}/{{ $r->id }}")' class="navi-link">
                                                        <span class="navi-text">Delete</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                           
                        </tbody>
                    </table>
                    {!! $data->links('admin.pagination') !!}

<div id="results"></div>
                </div>
            </div>
            <!--end::Card-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->
</div>

<div class="modal fade" id="exampleModalScrollable" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="row">
                    <div class="col-md-12">
                        <h5 class="modal-title" id="exampleModalLabel">Search Appartments</h5>
                    </div>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <form enctype="multipart/form-data" method="POST" action="{{ url('admin/routes/addrouteproperties') }}">
                @csrf
                <input type="hidden" name="route_id" value="{{ $route->id }}" >
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="lable-control">Search Appartment </label>
                                <input name="searchproperties" type="text" id="search-field" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Properties</label>
                                <select name="propert_id" class="form-control" id="results-table">
                                    <option></option>
                                </select>
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
            title: 'Are you sure you Want To Change Status of This Property?',
            text: "If Status is Not Published then This Property Will not show Frontend",
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
   $(document).ready(function() {
            $('#search-field').on('keyup', function() {
                let searchValue = $(this).val();
                if (searchValue.length >= 3) {
                    $.ajax({
                        url: "{{ url('/admin/routes/searchproperties') }}",
                        type: "POST",
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content'),
                            seacrchappartment: searchValue
                        },
                        success: function(response) {
                            $('#results-table').empty();
                            response.forEach(property => {
                                $('#results-table').append(`
                                    <option value="${property.id}">
                                        ${property.name}
                                    </option>
                                `);
                            });
                        }
                    });
                }
            });
        });
</script>
@endsection