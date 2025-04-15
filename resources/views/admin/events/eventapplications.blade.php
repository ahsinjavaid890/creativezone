@extends('admin.layouts.main-layout')
@section('title','All Events')
@section('content')

 <!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <div class="d-flex align-items-center flex-wrap mr-2">
                <h5 class="text-blue font-weight-bold mt-2 mb-2 mr-5">
                    All Events
                </h5>
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <a href="{{ url('admin/dashboard') }}" class="text-blue font-weight-bold mt-2 mb-2 mr-5">
                    Dashboard
                </a>
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <a href="javascript:void(0)" class="text-dark font-weight-bold mt-2 mb-2 mr-5">
                    All Events
                </a>
            </div>
        </div>
    </div>
    <!--end::Subheader-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class=" container-fluid ">
            <!--begin::Card-->
            @include('alerts.index')
            <div class="card card-custom mt-5">
                <div class="card-header flex-wrap">
                    <div class="card-title">
                        <h3 class="card-label">
                            All Events
                            <div class="text-muted pt-2 font-size-sm">Manage New Events</div>
                        </h3>
                    </div>
                    <div class="card-toolbar">
                        <a href="{{ url('admin/events/createnewevent') }}" class="btn btn-primary btn-sm font-weight-bolder mr-2">
                            Add Events
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Event</th>
                                <th>Name</th>
                                <th>phone</th>
                                <th>email</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $r)
                            <tr>
                                <td >
                                    {{ DB::Table('events')->where('id' , 1)->first()->name }}
                                </td>
                                <td>{{ $r->name }}</td>
                                <td>{{ $r->phone }}</td>
                                <td>{{ $r->email }}</td>
                                <td>
                                    @if($r->status == 1)
                                    <a href="javascript::void(0)" onclick='confirmstatus("{{ url('admin/events/changeapplicationstatus') }}/{{ $r->id }}")'>
                                        <span class="label label-lg label-success label-inline">Approved</span>
                                    </a>
                                    @endif
                                    @if($r->status == 2)
                                    <a href="javascript::void(0)" onclick='confirmstatus("{{ url('admin/events/changeapplicationstatus') }}/{{ $r->id }}")'>
                                        <span class="label label-lg label-danger label-inline">Pending</span>
                                    </a>
                                    @endif
                                    @if($r->status == 3)
                                    <a href="javascript::void(0)">
                                        <span class="label label-lg label-danger label-inline">Rejectd</span>
                                    </a>
                                    @endif
                                </td>
                                <td class="text-center pr-0">
                                    <a href="javascript:void(0);" onclick='confirmDelete("{{ url('admin/events/rejecteventapplication') }}/{{ $r->id }}")' class="btn btn-icon btn-light btn-hover-danger btn-sm">
                                       <span class="material-symbols-outlined">block</span>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        
                    </table>
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
    function confirmDelete(url) {
        Swal.fire({
            title: 'Are you sure?',
            text: "Are you sure You want to Reject this Event Application",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Reject it!'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = url;
            }
        })
    }
    function confirmstatus(url) {
        Swal.fire({
            title: 'Are you sure you Want To Change Status of This Event Application?',
            text: "If Status is Not Approved then This Event Will Enter This Events",
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