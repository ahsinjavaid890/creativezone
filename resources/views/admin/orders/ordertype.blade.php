@extends('admin.layouts.main-layout')
@section('title','Order Types')
@section('content')
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <div class="d-flex align-items-center flex-wrap mr-2">
                <h5 class="text-blue font-weight-bold mt-2 mb-2 mr-5">
                    Order Types
                </h5>
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <a href="{{ url('admin/dashboard') }}" class="text-blue font-weight-bold mt-2 mb-2 mr-5">
                    Dashboard
                </a>
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <a href="{{ url('admin/website/settings') }}" class="text-blue font-weight-bold mt-2 mb-2 mr-5">
                    Settings
                </a>
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <a href="javascript:void(0)" class="text-dark font-weight-bold mt-2 mb-2 mr-5">
                    Order Types
                </a>
            </div>
        </div>
    </div>
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container-fluid">
            <!--begin::Card-->
            
            <div class="row d-flex justify-content-center">
                <div class="col-lg-8 mx-auto">
                    @include('alerts.index')
                    <div class="card card-custom mt-5">
                        <div class="card-header flex-wrap">
                            <div class="card-title">
                                <h3>
                                    Order Types
                                </h3>
                            </div>
                            <div class="card-toolbar">
                                <a data-toggle="modal" data-target="#exampleModalCenter" href="javascript::void(0)" class="btn btn-primary font-weight-bolder">
                                   <span class="material-symbols-outlined">add</span>Add order Type
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered" id="sortable-table">
                                <thead>
                                    <tr>
                                        <th class="text-center">Name</th>
                                        <th class="text-center">Operations</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data as $r)
                                    <tr data-id="{{ $r->id }}">
                                        <td class="text-center">{{ $r->name }}</td>
                                        <td class="text-center pr-0">
                                           <a href="javascript::void(0)"data-toggle="modal" data-target="#edittype{{ $r->id }}"   class="btn btn-icon btn-light btn-hover-primary btn-sm mx-3">
                                              <span class="material-symbols-outlined">edit</span>
                                           </a>
                                           <a href="javascript:void(0);" onclick='confirmDelete("{{ url('admin/orders/deleteordertype') }}/{{ $r->id }}")' class="btn btn-icon btn-light btn-hover-primary btn-sm">
                                              <span class="material-symbols-outlined">delete</span>
                                           </a>
                                        </td>
                                    </tr>
                                    <div class="modal fade" id="edittype{{ $r->id }}" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Update Order Type</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <i aria-hidden="true" class="ki ki-close"></i>
                                                    </button>
                                                </div>

                                                <form method="POST" action="{{ url('admin/orders/updateordertype') }}" class="modal-content">
                                                @csrf
                                                <input type="hidden" value="{{ $r->id }}" name="id">
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label>Order Type Name </label>
                                                                <input value="{{ $r->name }}" type="text" class="form-control" name="name">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
                                                    <button type="submit" name="submit" class="btn btn-primary font-weight-bold">Save</button>
                                                </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div> <!-- end col-->
            </div>
            <!--end::Card-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->
</div>
<div class="modal fade" id="exampleModalCenter" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <form method="POST" action="{{ url('admin/orders/addordertype') }}" class="modal-content">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Order Type</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Type Name <span class="text-danger">*</span></label>
                            <input required type="text" class="form-control" name="name">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
                <button type="submit" name="submit" class="btn btn-primary font-weight-bold">Save</button>
            </div>
        </form>
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
    function confirmstatus(url) {
        Swal.fire({
            title: 'Are you sure you Want To Change Status of This Link?',
            text: "If Status is Not Published then This Link Will not show Frontend",
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