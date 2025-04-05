@extends('admin.layouts.main-layout')
@section('title','Community Notes')
@section('content')
 <!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <div class="d-flex align-items-center flex-wrap mr-2">
                <h5 class="text-blue font-weight-bold mt-2 mb-2 mr-5">
                    Community Notes
                </h5>
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <a href="{{ url('admin/dashboard') }}" class="text-blue font-weight-bold mt-2 mb-2 mr-5">
                    Dashboard
                </a>
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <a href="{{ url('admin/properties/index') }}" class="text-blue font-weight-bold mt-2 mb-2 mr-5">
                   Communities
                </a>
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <a href="javascript:void(0)" class="text-dark font-weight-bold mt-2 mb-2 mr-5">
                   Community : <b class="text-danger">List of {{ $data->name }} Notes</b>
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
                <div class="card-header flex-wrap"> 
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label font-weight-bolder text-dark">List of {{ $data->name }} Notes</span>
                    </h3>
                    <div class="card-toolbar">
                        <!--begin::Button-->
                        <a href="{{ url('admin/properties/addnote') }}/{{ $data->id }}" class="btn btn-primary font-weight-bolder">
                            <i class="ki ki-plus icon-1x mr-2"></i> Add New Note
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center">Date</th>
                                <th class="text-center">Email To</th>
                                <th class="text-center">Rep/Visi Type</th>
                                <th class="text-center">Notes   </th>
                                <th class="text-center">Rating</th>
                                <th class="text-center">Operations</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($note as $r)
                            <tr>
                                <td class="text-center">{{ $r->created_at->format('d/m/Y g:i a') }}</td>
                                <td class="text-center">{{ $r->emailto }}</td>
                                <td class="text-center">{{ optional(DB::table('properties')->where('id', $r->reps)->first())->property_name }}| {{ $r->visit_type }}</td>
                                <td class="text-center">{{ $r->note }}</td>
                                <td class="text-center">
                                    @if($r->rating == 1)
                                    <span>
                                        <i class="fa fa-star"></i>
                                    </span>
                                    @endif
                                    @if($r->rating == 2)
                                    <span>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    </span>
                                    @endif
                                    @if($r->rating == 3)
                                    <span>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    </span>
                                    @endif
                                    @if($r->rating == 4)
                                    <span>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    </span>
                                    @endif
                                    @if($r->rating == 5)
                                    <span>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    </span>
                                    @endif
                                </td>
                                <td class="text-center pr-0">
                                   <a href="{{ url('admin/properties/editnote') }}/{{ $r->id }}" class="btn btn-icon btn-light btn-hover-primary btn-sm mx-3">
                                      <span class="material-symbols-outlined">edit</span>
                                   </a>
                                   <a href="javascript:void(0);" onclick='confirmDelete("{{ url('admin/properties/deletenote') }}/{{ $r->id }}")' class="btn btn-icon btn-light btn-hover-primary btn-sm">
                                      <span class="material-symbols-outlined">delete</span>
                                   </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div style="margin-top:10px;" class="row">
                    </div>
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
@endsection