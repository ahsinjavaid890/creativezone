@extends('admin.layouts.main-layout')
@section('title','All Messages')
@section('content')
@php
    use App\Helpers\Cmf;
@endphp

<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <div class="d-flex align-items-center flex-wrap mr-2">
                <h5 class="text-blue font-weight-bold mt-2 mb-2 mr-5">
                   All Messages
                </h5>
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <a href="{{ url('admin/dashboard') }}" class="text-blue font-weight-bold mt-2 mb-2 mr-5">
                    Dashboard
                </a>
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <a href="javascript:void(0)" class="text-dark font-weight-bold mt-2 mb-2 mr-5">
                    All Messages
                </a>
            </div>
        </div>
    </div>
    <!--end::Subheader-->
        <!--begin::Container-->
        <div class=" container-fluid ">
            <!--begin::Card-->
            @include('alerts.index')
            <div class="card card-custom mt-5">
                <div class="card-header flex-wrap">
                    <div class="card-title">
                        <h3 class="card-label">
                            All Messages
                            <div class="text-muted pt-2 font-size-sm">Manage All Messages</div>
                        </h3>
                    </div>
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center">Created On</th>
                                <th class="text-center">Name</th>
                                <th class="text-center">Email</th>
                                
                                <th class="text-center">Phone Number</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $r)
                                <tr>
                                    <td class="text-center">{{ Cmf::create_time_ago($r->created_at) }}</td>
                                    <td class="text-center">{{ $r->name}}</td>
                                    
                                    <td class="text-center">
                                        {{ $r->email }}
                                    </td>
                                    <td class="text-center">
                                       {{ $r->phone}}
                                    </td>
                                   <td class="text-center">
                                    <a href="{{ url('admin/contact/viewmessage') }}/{{ $r->id }}" class="btn btn-icon btn-light btn-hover-primary btn-sm" >
                                      <span class="material-symbols-outlined">visibility</span>
                                   </a>
                                   <a href="javascript:void(0);" onclick='confirmDelete("{{ url('admin/contact/deletemessage') }}/{{ $r->id }}")' class="btn btn-icon btn-light btn-hover-primary btn-sm">
                                      <span class="material-symbols-outlined">delete</span>
                                   </a>
                                   </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                        {!! $data->links('admin.pagination') !!}
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
            title: 'Are you sure you Want To Change Status of This Testimonial?',
            text: "If Status is Not Published then This Testimonial Will not show Frontend",
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