@extends('admin.layouts.main-layout')
@section('title','Add SMTP Template')
@section('content')
 <!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <div class="d-flex align-items-center flex-wrap mr-2">
                <h5 class="text-blue font-weight-bold mt-2 mb-2 mr-5">
                    Update SMTP Template
                </h5>
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <a href="{{ url('admin/dashboard') }}" class="text-blue font-weight-bold mt-2 mb-2 mr-5">
                    Dashboard
                </a>
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <a href="{{ url('admin/website/emailsettings') }}" class="text-blue font-weight-bold mt-2 mb-2 mr-5">
                    All SMTP Template
                </a>
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <a href="javascript:void(0)" class="text-dark font-weight-bold mt-2 mb-2 mr-5">
                    Update: <span class="text-danger">{{ $data->from_name }}</span>
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
                <div class="row d-flex justify-content-center">
                    <div class="col-md-6 mx-auto">
                        <form enctype="multipart/form-data" method="POST" action="{{ url('admin/website/editsmpttemplate') }}">
                        @csrf
                        <input type="hidden" name="id" value="{{ $data->id }}">
                            <div class="card card-custom mt-5">
                                <div class="card-header flex-wrap"> 
                                    <h3 class="card-title align-items-start flex-column">
                                        <span class="card-label font-weight-bolder text-dark">Update SMTP Template SMTP Template</span>
                                    </h3>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>From Name<span class="text-danger">*</span></label>
                                                <input type="text" value="{{ $data->from_name }}" placeholder="From Name" class="form-control" name="from_name">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>From Email<span class="text-danger">*</span></label>
                                                <input type="text" value="{{ $data->from_email }}" placeholder="From Email" class="form-control" name="from_email">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>SMTP Email<span class="text-danger">*</span></label>
                                                <input type="text" value="{{ $data->smtp_email }}" placeholder="SMTP Email" class="form-control" name="smtp_email">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>SMTP Password<span class="text-danger">*</span></label>
                                                <input type="text" value="{{ $data->smtp_password }}" placeholder="SMTP Password" class="form-control" name="smtp_password">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="form-group">
                                        <input type="submit" class="btn btn-primary"  class="form-control" value="Update SMTP Template">
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