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
                    All Plans
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
                            All Plans
                            <div class="text-muted pt-2 font-size-sm">Manage New Plans</div>
                        </h3>
                    </div>
                    <div class="card-toolbar">
                        <a href="{{ url('admin/plans/createnewplan') }}" class="btn btn-primary btn-sm font-weight-bolder mr-2">
                            Add Plans
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Slug</th>
                                <th>Billing Cycle</th>
                                <th>Price</th>
                                <th>Priority Support</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $r)
                                <tr>
                                    <td>{{ $r['local']->name ?? 'N/A' }}</td>
                                    <td>{{ $r['local']->slug ?? 'N/A' }}</td>
                                    <td>{{ $r['local']->billing_cycle ?? 'N/A' }}</td>
                                    <td>
                                        @if(strtoupper($r['stripe']->currency ?? '') == 'USD')
                                            $
                                        @endif
                                        {{ number_format(($r['stripe']->amount ?? 0) / 100, 2) }}
                                    </td>
                                    <td>{{ $r['local']->priority_support ? 'Yes' : 'No' }}</td>
                                    <td>
                                        <a href="javascript::void(0)" onclick='confirmstatus("{{ url('admin/events/changestatus') }}/{{ $r['local']->id }}")'>
                                            @if($r['local']->is_active == 1)
                                                <span class="label label-lg label-success label-inline">Published</span>
                                            @elseif($r['local']->is_active == 2)
                                                <span class="label label-lg label-danger label-inline">Pending</span>
                                            @else
                                                <span class="label label-lg label-warning label-inline">Unknown</span>
                                            @endif
                                        </a>
                                    </td>
                                    <td class="text-center pr-0">
                                        <a href="{{ url('admin/plans/editplan') }}/{{ $r['local']->id }}" class="btn btn-icon btn-light btn-hover-primary btn-sm mx-3">
                                            <span class="material-symbols-outlined">edit</span>
                                        </a>
                                        <a href="javascript:void(0);" onclick='confirmDelete("{{ url('admin/plans/deleteplan') }}/{{ $r['local']->id }}")' class="btn btn-icon btn-light btn-hover-primary btn-sm">
                                            <span class="material-symbols-outlined">delete</span>
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
            text: "Are you sure You want to delete this Plan",
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
            title: 'Are you sure you Want To Change Status of This Event?',
            text: "If Status is Not Published then This Event Will not show Frontend",
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