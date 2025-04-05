@extends('admin.layouts.main-layout')
@section('title', 'Email Settings')
@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
            <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
                <div class="d-flex align-items-center flex-wrap mr-2">
                    <h5 class="text-blue font-weight-bold mt-2 mb-2 mr-5">
                        SMTP Templates
                    </h5>
                    <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                    <a href="{{ url('admin/dashboard') }}" class="text-blue font-weight-bold mt-2 mb-2 mr-5">
                        Dashboard
                    </a>
                    <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                    <a href="javascript:void(0)" class="text-dark font-weight-bold mt-2 mb-2 mr-5">
                        SMTP Templates
                    </a>
                </div>
            </div>
        </div>
        <!--begin::Entry-->
        <div class="d-flex flex-column-fluid">
            <!--begin::Container-->
            <div class="container-fluid">
                <!--begin::Card-->
       

                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        @include('alerts.index')
                        <div class="card card-custom mb-3">
                            <div class="card-header flex-wrap">
                                <div class="card-title">
                                    <h4 class="fw-600 mb-0">List of SMTP Templates</h4>
                                </div>
                                <div class="card-toolbar">
                                    <a href="{{ url('admin/website/createsmtptemplate') }}" class="btn btn-primary font-weight-bolder mr-2">
                                        <span class="material-symbols-outlined">add</span> Add
                                    </a>
                                </div>
                            </div>
                            <div class="card-body table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="text-center">From name</th>
                                            <th class="text-center">From Email</th>
                                            <th class="text-center">SMTP Email</th>
                                            <th class="text-center">SMTP Password</th>
                                            <th class="text-center">Operations</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($smtplist as $r)
                                        <tr>
                                            <td>{{ $r->from_name }}</td>
                                            <td>{{ $r->from_email }}</td>
                                            <td>{{ $r->smtp_email }}</td>
                                            <td>{{ $r->smtp_password }}</td>
                                            <td>
                                                <a href="{{ url('admin/website/updatesmtptemplate') }}/{{ $r->id }}" class="btn btn-icon btn-light btn-hover-primary btn-sm mx-3">
                                                    <span class="material-symbols-outlined">edit</span>
                                                </a>
                                                <a href="javascript:void(0);" onclick='confirmDelete("{{ url('admin/website/deletesmtptemplate') }}/{{ $r->id }}")' class="btn btn-icon btn-light btn-hover-primary btn-sm">
                                                    <span class="material-symbols-outlined">delete</span>
                                                </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                            </div>
                        </div>

                    </div> <!-- end col-->
                </div>


                
            </div>
        </div>
    </div>
</div>
<style type="text/css">
.swal2-popup .swal2-icon {
    margin: 1.25em auto 1.875em;
}
</style>
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
</script>
@endsection
