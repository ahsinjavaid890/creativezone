@extends('admin.layouts.main-layout')
@section('title','Add Services')
@section('content')
 <!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <div class="d-flex align-items-center flex-wrap mr-2">
                <h5 class="text-blue font-weight-bold mt-2 mb-2 mr-5">
                    Add Service
                </h5>
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <a href="{{ url('admin/dashboard') }}" class="text-blue font-weight-bold mt-2 mb-2 mr-5">
                    Dashboard
                </a>
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <a href="javascript:void(0)" class="text-dark font-weight-bold mt-2 mb-2 mr-5">
                    Service Management
                </a>
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <a href="{{ url('admin/services/allservices') }}" class="text-blue font-weight-bold mt-2 mb-2 mr-5">
                   All Services
                </a>
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <a href="javascript:void(0)" class="text-dark font-weight-bold mt-2 mb-2 mr-5">
                    Add Service
                </a>
            </div>
        </div>
    </div>
    <!--end::Subheader-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class=" container-fluid ">
            <!--begin::Card-->
            
                <div class="row d-flex justify-content-center">
                    <div class="col-md-6 mx-auto">
                        @include('alerts.index')
                        <form enctype="multipart/form-data" method="POST" action="{{ url('admin/services/addservice') }}">
                        @csrf
                            <div class="card card-custom mt-5">
                                <div class="card-header flex-wrap"> 
                                    <h3 class="card-title align-items-start flex-column">
                                        <span class="card-label font-weight-bolder text-dark">Service Details</span>
                                    </h3>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                           <div class="form-group">
                                                <label>Select Parent Service</label>
                                                <select id="parentservice" class="form-control" name="parent_id">
                                                    <option selected="" value="">Choose Parent Service</option>
                                                    @foreach(DB::table('services')->wherenull('parent_id')->get() as $r)
                                                    <option @if($r->name == 'Telecom') selected @endif value="{{ $r->id }}">{{ $r->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div> 
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Service Name <span class="text-danger">*</span></label>
                                                <input type="text" required placeholder="Service Name" class="form-control" name="name">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Service Icon</label>
                                                <input type="file" name="icon" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                             <div class="form-group">
                                                <label>Description</label>
                                                <textarea class="form-control" name="description" rows="4"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="form-group">
                                        <input type="submit" class="btn btn-primary" placeholder="Service Name" class="form-control" value="Add New Service">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('script')
<script type="text/javascript">
    $(document).ready(function () {
        // Initialize Select2
        $('#parentservice').select2({
            placeholder: "Select",
            width: '100%',
            allowClear: true
        });
    });
</script>
@endsection