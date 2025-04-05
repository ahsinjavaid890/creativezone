@extends('admin.layouts.main-layout')
@section('title','Email Templates')
@section('content')
 <!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <div class="d-flex align-items-center flex-wrap mr-2">
                <h5 class="text-blue font-weight-bold mt-2 mb-2 mr-5">
                    Email Templates
                </h5>
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <a href="{{ url('admin/dashboard') }}" class="text-blue font-weight-bold mt-2 mb-2 mr-5">
                    Dashboard
                </a>
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <a href="javascript:void(0)" class="text-dark font-weight-bold mt-2 mb-2 mr-5">
                   Email Templates
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
                    <div class="card-title">
                        <h3 class="card-label">
                            Email Templates
                            <div class="text-muted pt-2 font-size-sm">Manage All Email Templates</div>
                        </h3>
                    </div>
                    <div class="card-toolbar">
                        <!--begin::Button-->
                        <a href="{{ url('admin/email/addemailtamplate') }}" class="btn btn-primary font-weight-bolder mr-2">
                            Add Email Tamplate
                        </a>
                        <!--end::Button-->
                    </div>
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center">Provider</th>
                                <th class="text-center">Template Name</th>
                                <th class="text-center">Template For</th>
                                <th class="text-center">Email To</th>
                                <th class="text-center">Subject</th>
                                <th class="text-center">Attachment</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Preview</th>
                                <th class="text-center">Default</th>
                                <th class="text-center">Operations</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $r)

                            <tr>
                                <td>{{ DB::table('providers')->where('id' , $r->provider_id)->first()->name }}</td>
                                <td style="width: 200px;"> <a href="{{ url('admin/email/editemailtamplate') }}/{{ $r->id }}">{{ $r->name }}</a> </td>
                                <td>{{ $r->template_for }}</td>
                                <td>{{ $r->email_to }}</td>
                                <td>{{ $r->subject }}</td>
                                <td> 
                                    @if($r->attachment)
                                    <a href="{{ url('public/images') }}/{{ DB::table('attachments')->where('id' , $r->attachment)->first()->attachment }}">{{ DB::table('attachments')->where('id' , $r->attachment)->first()->name }}</a>
                                    @endif
                                </td>
                                <td class="text-center pr-0">
                                    @if($r->status == 1)
                                    <span class="label label-lg label-success label-inline">Enable</span>
                                    @endif
                                    @if($r->status == 2)
                                    <span class="label label-lg label-danger label-inline">Disable</span>
                                    @endif
                                </td>
                                <td><a href="javascript:void(0)">View</a> </td>
                                <td class="text-center">
                                    @if($r->default == 1)
                                    <a href="{{ url('admin/email/changeddefault') }}/{{ $r->id }}" class="badge badge-primary badge-sm">Yes</a>
                                    @else
                                    <a href="{{ url('admin/email/changeddefault') }}/{{ $r->id }}" class="badge badge-warning badge-sm">No</a>
                                    @endif
                                </td>
                                <td class="text-center pr-0">
                                   <div class="dropdown dropdown-inline">
                                        <a href="#" class="btn btn-icon btn-light btn-hover-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                           <span class="material-symbols-outlined">more_horiz</span>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                                            <ul class="navi navi-hover">
                                                <li class="navi-item">
                                                    <a href="javascript:void(0);" onclick='confirmstatus("{{ url('admin/email/changeemailtampstatus') }}/{{ $r->id }}")'class="navi-link">
                                                        <span class="navi-text">Change Status</span>
                                                    </a>
                                                </li>
                                                <li class="navi-item">
                                                    <a href="{{ url('admin/email/editemailtamplate') }}/{{ $r->id }}"class="navi-link">
                                                        <span class="navi-text">Edit</span>
                                                    </a>
                                                </li>
                                                <li class="navi-item">
                                                    <a href="javascript:void(0);" onclick='confirmDelete("{{ url('admin/email/deleteemailtamplate') }}/{{ $r->id }}")' class="navi-link">
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
            title: 'Are you sure you Want To Change Status of This Email Tamplate?',
            text: "If Status is Not Published then This Email Tamplate Will not show Frontend",
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