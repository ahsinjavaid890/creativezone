@extends('admin.layouts.main-layout')
@section('title','Pending Artist')
@section('content')

 <!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <div class="d-flex align-items-center flex-wrap mr-2">
                <h5 class="text-blue font-weight-bold mt-2 mb-2 mr-5">
                    Pending Artist
                </h5>
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <a href="{{ url('admin/dashboard') }}" class="text-blue font-weight-bold mt-2 mb-2 mr-5">
                    Dashboard
                </a>
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <a href="javascript:void(0)" class="text-dark font-weight-bold mt-2 mb-2 mr-5">
                    Pending Artist
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
                            Pending Artist
                            <div class="text-muted pt-2 font-size-sm">Manage Pending Artist</div>
                        </h3>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Category</th>
                                <th>Nationality</th>
                                <th>Date Of Birth</th>
                                <th>Communication way</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $r)
                            <tr>
                                <td>{{ $r->prefix }} {{ $r->fname }} {{ $r->mname }} {{ $r->lname }}, <br>
                                <b>Mobile: </b>{{ $r->mobile }},<br> <b>Email: </b> {{ $r->email }}</td>
                                <td>@if($r->category_id){{ DB::table('categories')->where('id' , $r->category_id)->first()->name }}@endif</td>
                                <td>{{ $r->nationality }}</td>
                                <td>{{ $r->dob }}</td>
                                <td>{{ $r->prefered_way_communication }}</td>
                                <td>
                                    @if($r->status == 0)
                                    <div class="label label-lg label-warning label-inline">Pending</div>
                                    @endif
                                </td>
                                <td nowrap="">
                                    <a href="javascript:void(0);" onclick='confirmstatus("{{ url('admin/artist/changeartiststatus') }}/{{ $r->id }}")' class="btn btn-icon btn-light btn-hover-primary btn-sm">
                                      <span class="material-symbols-outlined">question_exchange</span>
                                   </a>
                                    <a href="{{ url('admin/artist/editartist') }}/{{ $r->id }}"  class="btn btn-icon btn-light btn-hover-primary btn-sm mx-3">
                                      <span class="material-symbols-outlined">edit</span>
                                    </a>
                                    <a data-toggle="modal" data-target="#deleteModal{{ $r->id }}" href="javascript::void(0)"  class="btn btn-icon btn-light btn-hover-primary btn-sm">
                                      <span class="material-symbols-outlined">delete</span>
                                    </a>
                                </td>
                            </tr>
                            <div class="modal fade" id="deleteModal{{ $r->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Are you Sure?</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <i aria-hidden="true" class="ki ki-close"></i>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p style="color:red;">Are you Sure You want to delete this. </p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
                                            <a href="{{ url('admin/artist/deleteartist') }}/{{ $r->id }}" class="btn btn-danger font-weight-bold">Yes, Delete it</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
            title: 'Are you sure you Want To Change Status of This Artist?',
            text: "If Status is Not Published then This Artist Will not show Frontend",
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