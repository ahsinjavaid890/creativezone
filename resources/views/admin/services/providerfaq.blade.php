@extends('admin.layouts.main-layout')
@section('title','All Provider FAQ')
@section('content')
 <!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <div class="d-flex align-items-center flex-wrap mr-2">
                <h5 class="text-blue font-weight-bold mt-2 mb-2 mr-5">
                    Provider FAQ's
                </h5>
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <a href="{{ url('admin/dashboard') }}" class="text-blue font-weight-bold mt-2 mb-2 mr-5">
                    Dashboard
                </a>
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <a href="{{ url('admin/services/providers') }}" class="text-blue font-weight-bold mt-2 mb-2 mr-5">
                    All Providers
                </a>
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <a href="{{ url('admin/services/editprovider') }}/{{ $data->id }}" class="text-dark font-weight-bold mt-2 mb-2 mr-5">
                    Provider : <b class="text-danger">{{ $data->name }}</b>
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
                        All Provdider Faq's
                    </div>
                    <div class="card-toolbar">
                        <a href="javascript::void(0)" class="btn btn-primary font-weight-bolder"data-toggle="modal" data-target="#addfaq">
                           <span class="material-symbols-outlined">add</span> Add
                        </a>
                    </div>
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center">Questions</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Operations</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($faq as $r)
                                <td class="text-center">{{ $r->question }}</td>
                                <td class="text-center">{{ DB::table('providers')->where('id' , $r->provider_id)->first()->name; }}</td>
                                <td class="text-center pr-0">
                                    @if($r->status == 1)
                                    <span class="label label-lg label-success label-inline">Enable</span>
                                    @endif
                                    @if($r->status == 2)
                                    <span class="label label-lg label-danger label-inline">Disable</span>
                                    @endif
                                </td>
                                <td class="text-center pr-0">
                                   <a href="javascript:void(0);" onclick='confirmstatus("{{ url('admin/services/changeproviderfaqstatus') }}/{{ $r->id }}")' class="btn btn-icon btn-light btn-hover-primary btn-sm">
                                      <span class="material-symbols-outlined">question_exchange</span>
                                   </a>
                                   <a href="javascript:void(0);" data-toggle="modal" data-target="#editfaq{{ $r->id }}" class="btn btn-icon btn-light btn-hover-primary btn-sm">
                                      <span class="material-symbols-outlined">Edit</span>
                                   </a>
                                   <a href="javascript:void(0);" onclick='confirmDelete("{{ url('admin/services/deleteproviderfaq') }}/{{ $r->id }}")' class="btn btn-icon btn-light btn-hover-primary btn-sm">
                                      <span class="material-symbols-outlined">delete</span>
                                   </a>
                                </td>
                            </tr>
                            <div class="modal fade" id="editfaq{{ $r->id }}" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <h5 class="modal-title" id="exampleModalLabel">Update Provider  FAQ</h5>
                                                </div>
                                            </div>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <i aria-hidden="true" class="ki ki-close"></i>
                                            </button>
                                        </div>
                                        <form enctype="multipart/form-data" method="POST" action="{{ url('admin/services/updateproviderfaq') }}">
                                            @csrf
                                            <input type="hidden" name="provider_id" value="{{ $data->id }}">
                                            <input type="hidden" name="id" value="{{ $r->id }}">
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label>Quesiton</label>
                                                            <input class="form-control" type="text" name="question" value="{{ $r->question }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label>Answer</label>
                                                            <textarea class="form-control" name="answer" rows="4">{{ $r->answer }}</textarea>
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
                            @endforeach
                        </tbody>
                    </table>
                    {!! $faq->links('admin.pagination') !!}
                </div>
            </div>
            <!--end::Card-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->
</div>


<div class="modal fade" id="addfaq" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="row">
                    <div class="col-md-12">
                        <h5 class="modal-title" id="exampleModalLabel">Add Provider FAQ</h5>
                    </div>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <form enctype="multipart/form-data" method="POST" action="{{ url('admin/services/createproviderfaq') }}">
                @csrf
                <input type="hidden" name="provider_id" value="{{ $data->id }}">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Quesiton</label>
                                <input class="form-control" type="text" name="question" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Answer</label>
                                <textarea class="form-control" name="answer" rows="4"></textarea>
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
            title: 'Are you sure you Want To Change Status of This Provider FAQ?',
            text: "If Status is Not Published then This Provider FAQ Will not show Frontend",
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
    document.addEventListener('DOMContentLoaded', function() {
    // Get URL parameters
    const urlParams = new URLSearchParams(window.location.search);
    
    // Check if any filter parameters are present
    const hasFilters = urlParams.has('name') || 
                       urlParams.has('filter_operators') || 
                       urlParams.has('status');
    
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
</script>
@endsection