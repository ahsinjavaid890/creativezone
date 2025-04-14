@extends('admin.layouts.main-layout')
@section('title','All Upcoming Events')
@section('content')

 <!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <div class="d-flex align-items-center flex-wrap mr-2">
                <h5 class="text-blue font-weight-bold mt-2 mb-2 mr-5">
                    All Upcoming Events
                </h5>
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <a href="{{ url('admin/dashboard') }}" class="text-blue font-weight-bold mt-2 mb-2 mr-5">
                    Dashboard
                </a>
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <a href="javascript:void(0)" class="text-dark font-weight-bold mt-2 mb-2 mr-5">
                    All Upcoming Events
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
                                All Upcoming Events
                                <div class="text-muted pt-2 font-size-sm">Manage Upcoming Events</div>
                            </h3>
                        </div>
                        <div class="card-toolbar">
                            <a href="javascript::void(0)" class="btn btn-primary font-weight-bolder" data-toggle="modal" data-target="#exampleModalScrollable">
                                Add Upcoming Events
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Category</th>
                                    <th>Location Type</th>
                                    <th>Time Zone</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data as $r)
                                <tr>
                                    <td class="text-center">
                                        @if($r->image)
                                        <img src="{{ url('images') }}/{{ $r->image }}" width="50" alt="Image">
                                        @else
                                        <img src="{{ url('images/noimage.jpeg') }}" width="50" alt="Image">
                                        @endif
                                    </td>
                                    <td>{{ $r->name }}</td>
                                    <td>{{ DB::table('categories')->where('id' , $r->category_id)->first()->name }}</td>
                                    <td>{{ $r->location_type }}</td>
                                    <td>{{ $r->time_zone }}</td>
                                    <td>
                                        <a href="javascript::void(0)" onclick='confirmstatus("{{ url('admin/events/changestatus') }}/{{ $r->id }}")'>
                                             @if($r->status == 'Published')
                                             <span class="label label-lg label-success label-inline">Published</span>
                                             @endif
                                             @if($r->status == 'Pending')
                                             <span class="label label-lg label-danger label-inline">Pending</span>
                                             @endif
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
    <div class="modal fade" id="exampleModalScrollable" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="row">
                        <div class="col-md-12">
                            <h5 class="modal-title" id="exampleModalLabel">Add Upcoming Event</h5>
                        </div>
                    </div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <form enctype="multipart/form-data" method="POST" action="{{ url('admin/events/addupcomingevents') }}">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="lable-control">Select Events</label>
                                    <select id="events_id" class="form-control" multiple name="events_id[]">
                                        <option value="">Select Events</option>
                                        @foreach(DB::Table('events')->where('status' , 'Published')->get() as $e)
                                        <option @if(in_array($e->id, $upcoming)) selected @endif value="{{ $e->id }}">{{ $e->name }}</option>
                                        @endforeach
                                    </select>
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
</div>
@endsection
@section('script')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script type="text/javascript">
    $(document).ready(function () {
        // Initialize Select2
        $('#events_id').select2({
            placeholder: "Select Upcoming Event",
            width: '100%',
            allowClear: true
        });
    });
</script>
<script>
    function confirmDelete(url) {
        Swal.fire({
            title: 'Are you sure?',
            text: "Are you sure You want to delete this Event",
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