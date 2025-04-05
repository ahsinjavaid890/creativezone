@extends('admin.layouts.main-layout')
@section('title','Website Links')
@section('content')
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <div class="d-flex align-items-center flex-wrap mr-2">
                <h5 class="text-blue font-weight-bold mt-2 mb-2 mr-5">
                    Site Links
                </h5>
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <a href="{{ url('admin/dashboard') }}" class="text-blue font-weight-bold mt-2 mb-2 mr-5">
                    Dashboard
                </a>
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <a href="javascript:void(0)" class="text-dark font-weight-bold mt-2 mb-2 mr-5">
                    Website Settings
                </a>
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <a href="javascript:void(0)" class="text-dark font-weight-bold mt-2 mb-2 mr-5">
                    Site Link
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
                    <div class="card card-custom mt-5">
                        <div class="card-header flex-wrap justify-content-end">
                            <div class="card-toolbar">
                                <a data-toggle="modal" data-target="#exampleModalCenter" href="javascript::void(0)" class="btn btn-primary font-weight-bolder">
                                   <span class="material-symbols-outlined">add</span>Add Links
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered" id="sortable-table">
                                <thead>
                                    <tr>
                                        <th class="text-center">Name</th>
                                        <th class="text-center">URL</th>
                                        <th class="text-center">Header Link</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Operations</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data as $r)
                                    <tr data-id="{{ $r->id }}">
                                        <td class="text-center">{{ $r->name }}</td>
                                        <td class="text-center">{{ $r->url }}</td>
                                        <td class="text-center">
                                            @if($r->headerlink == 1)
                                            <span class="label label-lg label-success label-inline">Yes</span>
                                            @endif
                                            @if($r->headerlink == 0)
                                            <span class="label label-lg label-danger label-inline">No</span>
                                            @endif
                                        </td>
                                        <td class="text-center pr-0">
                                            @if($r->status == 1)
                                            <a href="javascript:void(0);" onclick='confirmstatus("{{ url('admin/website/changelinkstatus') }}/{{ $r->id }}")'>
                                                <span class="label label-lg label-success label-inline">Enable</span>
                                            </a>
                                            @endif
                                            @if($r->status == 2)
                                            <a href="javascript:void(0);" onclick='confirmstatus("{{ url('admin/website/changelinkstatus') }}/{{ $r->id }}")'>
                                                <span class="label label-lg label-danger label-inline">Disable</span>
                                            </a>
                                            @endif
                                        </td>
                                        <td class="text-center pr-0">
                                           <a href="javascript::void(0)"data-toggle="modal" data-target="#editlinks{{ $r->id }}"   class="btn btn-icon btn-light btn-hover-primary btn-sm mx-3">
                                              <span class="material-symbols-outlined">edit</span>
                                           </a>
                                           <a href="javascript:void(0);" onclick='confirmDelete("{{ url('admin/website/deletelinks') }}/{{ $r->id }}")' class="btn btn-icon btn-light btn-hover-primary btn-sm">
                                              <span class="material-symbols-outlined">delete</span>
                                           </a>
                                        </td>
                                    </tr>
                                    <div class="modal fade" id="editlinks{{ $r->id }}" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Update Links</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <i aria-hidden="true" class="ki ki-close"></i>
                                                    </button>
                                                </div>

                                                <form method="POST" action="{{ url('admin/website/updateweblinks') }}" class="modal-content">
                                                @csrf
                                                <input type="hidden" value="{{ $r->id }}" name="id">
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label>Link Name </label>
                                                                <input value="{{ $r->name }}" type="text" class="form-control" name="name">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label>Header  link </label>
                                                                <select name="headerlink" class="form-control">
                                                                    <option>Select Header Link</option>
                                                                    <option  @if($r->headerlink == 1) selected @endif  value="1">Yes</option>
                                                                    <option  @if($r->headerlink == 0) selected @endif  value="0">No</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label>Url </label>
                                                                <input  type="text" class="form-control" name="url" value="{{ $r->url }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label>Link Category </label>
                                                                <select name="category" class="form-control">
                                                                    <option>Select Category</option>
                                                                    @foreach(DB::table('sitelink_cats')->get() as $c)
                                                                    <option @if($r->category == $c->name) selected @endif value="{{$c->name}}">{{ $c->name }}</option>
                                                                    @endforeach
                                                                </select>
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
        <form method="POST" action="{{ url('admin/website/createlinks') }}" class="modal-content">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add New Links</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Link Name <span class="text-danger">*</span></label>
                            <input required type="text" class="form-control" name="name">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Header  link </label>
                            <select name="headerlink" class="form-control">
                                <option>Select Header Link</option>
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Url <span class="text-danger">*</span></label>
                            <input required type="text" class="form-control" name="url">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Link Category <span class="text-danger">*</span></label>
                            <select name="category" class="form-control" required>
                                <option value="">Select Category</option>
                                @foreach(DB::table('sitelink_cats')->get() as $c)
                                <option value="{{ $c->name }}">{{ $c->name }}</option>
                                @endforeach
                            </select>
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
<style type="text/css">
    #sortable-table tbody tr{
        cursor: -webkit-grab;
    }
</style>
@endsection
@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.14.0/Sortable.min.js"></script>

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
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var sortable = Sortable.create(document.getElementById('sortable-table').querySelector('tbody'), {
            animation: 150,
            onEnd: function (evt) {
                var sortedIDs = Array.from(evt.from.children).map(function (row) {
                    return row.getAttribute('data-id');
                });

                // Send the new order to the server
                fetch('{{ url('admin/website/updatelinkorder') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ order: sortedIDs })
                }).then(response => response.json())
                  .then(data => {
                  });
            }
        });
    });
</script>
@endsection