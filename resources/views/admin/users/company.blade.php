@extends('admin.layouts.main-layout')
@section('title','All Companies')
@section('content')

<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Entry-->
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <div class="d-flex align-items-center flex-wrap mr-2">
                <h5 class="text-blue font-weight-bold mt-2 mb-2 mr-5">
                   All Companies
                </h5>
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <a href="{{ url('admin/dashboard') }}" class="text-blue font-weight-bold mt-2 mb-2 mr-5">
                    Dashboard
                </a>
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <a href="javascript:void(0)" class="text-dark font-weight-bold mt-2 mb-2 mr-5">
                    All Companies
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
                            All Companies
                            <div Companies="text-muted pt-2 font-size-sm">Manage All Companies</div>
                        </h3>
                    </div>
                    <div class="card-toolbar">
                        <!--begin::Button-->
                        <a href="javascript::void(0)" class="btn btn-primary font-weight-bolder btn-sm" data-toggle="modal" data-target="#exampleModalScrollable">
                           Add New Company
                        </a>
                    </div>
                </div> 
                <div class="card-body">
                    <table class="table table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th>User Type</th>
                                <th>Operations</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $r)
                                <tr>
                                    <td>{{$r->name}}</td>
                                    <td>{{$r->email}}</td>
                                    <td>
                                        @if($r->status == 'active')
                                        <div class="badge badge-success">Active</div>
                                        @endif
                                    </td>
                                    <td>
                                        @if($r->type == 'admin')
                                        <div class="badge badge-success">{{ $r->type }}</div>
                                        @else
                                        <div class="badge badge-danger">{{ $r->type }}</div>
                                        @endif
                                    </td>
                                   <td>
                                    @if($r->email == 'info@lifeadvice.ca')

                                    @else
                                       <a href="{{ url('admin/users/editcompany') }}/{{ $r->id }}" class="btn btn-icon btn-light btn-hover-primary btn-sm mx-3">
                                          <span class="material-symbols-outlined">edit</span>
                                       </a>
                                       <a href="javascript:void(0);" onclick='confirmDelete("{{ url('admin/users/deletecompany') }}/{{ $r->id }}")' class="btn btn-icon btn-light btn-hover-danger btn-sm">
                                          <span class="material-symbols-outlined">delete</span>
                                       </a>
                                    @endif
                                   </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="exampleModalScrollable" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="row">
                    <div class="col-md-12">
                        <h5 class="modal-title" id="exampleModalLabel">Add New Company</h5>
                    </div>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <form enctype="multipart/form-data" method="POST" action="{{ url('admin/users/addcompany') }}">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Company Name</label>
                                <input required type="text" name="name" class="form-control" placeholder="Name">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Company Email</label>
                                <input required type="email" name="email" class="form-control" placeholder="Email Address" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Company Phone</label>
                                <input required type="number" name="phone" class="form-control" placeholder="Phone Number">
                            </div>
                        </div>
                         <div class="col-md-12">
                            <div class="form-group">
                                <label>Account Password</label>
                                <input type="text" name="dummy" style="display:none;">
                                <input required type="password" name="password" class="form-control" placeholder="Password" autocomplete="new-password">
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
<script type="text/javascript">
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