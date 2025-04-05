@extends('admin.layouts.main-layout')
@section('title','Roles and Permissions')
@section('content')

<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Entry-->
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <div class="d-flex align-items-center flex-wrap mr-2">
                <h5 class="text-blue font-weight-bold mt-2 mb-2 mr-5">
                   Roles and Permissions
                </h5>
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <a href="{{ url('admin/dashboard') }}" class="text-blue font-weight-bold mt-2 mb-2 mr-5">
                    Dashboard
                </a>
               <!--  <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <a href="javascript:void(0)" class="text-dark font-weight-bold mt-2 mb-2 mr-5">
                    Management
                </a> -->
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <a href="javascript:void(0)" class="text-dark font-weight-bold mt-2 mb-2 mr-5">
                    Roles and Permissions
                </a>
            </div>
        </div>
    </div>
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class=" container-fluid ">
            <!--begin::Card-->
            @include('alerts.index')
            <div class="card card-custom mt-5">
                <div class="card-header flex-wrap">
                    <div class="card-title">
                        <h3 class="card-label">
                            Roles and Permissions
                            <div class="text-muted pt-2 font-size-sm">Manage All Roles and Permissions</div>
                        </h3>
                    </div>
                    <div class="card-toolbar">
                        <!--begin::Button-->
                        <a href="{{ url('admin/users/addnewrole') }}" class="btn btn-primary font-weight-bolder mr-2">
                            Add User roles
                        </a>
                        <!--end::Button-->
                    </div>
                </div> 
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th class="text-center pr-0">Created At</th>
                                <th class="text-center pr-0">Created By</th>
                                <th class="text-center pr-0">No of Users</th>
                                <th class="text-center pr-0">Operations</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $r)
                                <tr>
                                    <td>{{$r->name}}</td>
                                    <td class="text-center pr-0">{{ Cmf::date_format($r->created_at) }}</td>
                                    <td class="text-center pr-0">{{ DB::table('users')->where('id' , $r->user_id)->first()->name }}</td>
                                    <td class="text-center pr-0">{{ DB::table('users')->where('role_id' , $r->id)->count() }}</td>
                                    <td class="text-center pr-0">
                                       <a href="{{ url('admin/users/editrole') }}/{{ $r->id }}" class="btn btn-icon btn-light btn-hover-primary btn-sm mx-3">
                                          <span class="material-symbols-outlined">edit</span>
                                       </a>
                                       <a href="javascript:void(0);" onclick='confirmDelete("{{ url('admin/users/deleteuserrol') }}/{{ $r->id }}")' class="btn btn-icon btn-light btn-hover-primary btn-sm">
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
<script type="text/javascript">
$('#rolls').select2({
    placeholder: "Select Roll",
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
</script>
@endsection