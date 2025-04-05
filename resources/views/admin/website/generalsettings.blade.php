@extends('admin.layouts.main-layout')
@section('title','General Settings')
@section('content')
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <div class="d-flex align-items-center flex-wrap mr-2">
                <h5 class="text-blue font-weight-bold mt-2 mb-2 mr-5">
                   General Settings
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
                   General Settings
                </a>
            </div>
        </div>
    </div>
    <div class="d-flex flex-column-fluid">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    @include('alerts.index')
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card mb-3">
                                <div class="card-header">
                                    <h4 class="fw-600 mb-0">General</h4>
                                </div>
                                <div class="card-body">
                                    <form action="{{ url('admin/website/settingsupdate') }}" enctype='multipart/form-data' method="POST">
                                       @csrf
                                       <div class="row">
                                           <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="col-from-label">Website Name</label>
                                                    <input type="text" name="website_name" class="form-control" placeholder="Website Name" value="{{$settings->site_name}}" />
                                                </div>
                                           </div>
                                           <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="col-from-label">Site Emal</label>
                                                    <input type="text" name="site_email" class="form-control"  value="{{$settings->site_email}}" />
                                                </div>
                                           </div>
                                           <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="col-from-label">Site phone number</label>
                                                    <input type="text" name="site_phonenumber" class="form-control"  value="{{$settings->site_phonenumber}}" />
                                                </div>
                                           </div>
                                           <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="col-from-label">Site Address</label>
                                                    <input type="text" class="form-control" value="{{$settings->site_address}}" name="site_address">
                                                </div>
                                           </div>
                                           <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="col-from-label">Footer Description</label>
                                                    <textarea rows="5" class="form-control" name="footer_description">{{$settings->footer_description}}</textarea>
                                                </div>
                                           </div>
                                       </div>
                                        <div class="text-right">
                                            <button type="submit" class="btn btn-primary">Update</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-8">
                            <div class="card mb-3">
                                <div class="card-header">
                                    <h4 class="fw-600 mb-0">Logos and Fav Icons</h4>
                                </div>
                                <div class="card-body">
                                    <form action="{{ url('admin/website/updatelogos') }}" enctype='multipart/form-data' method="POST">
                                       @csrf
                                       <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="col-from-label">Site Header Logo</label>
                                                    <div class="input-group" data-toggle="aizuploader" data-type="header_logo">
                                                        <input type="file" class="form-control" name="header_logo">
                                                    </div>
                                                </div>
                                                <div style="height: 100px;width: 100px;">
                                                    <img class="img-thumbnail" src="{{ url('public/images') }}/{{ $settings->header_logo }}">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="col-from-label">Site Footer Logo</label>
                                                    <div class="input-group" data-toggle="aizuploader" data-type="footer_logo">
                                                        <input type="file" class="form-control" name="footer_logo">
                                                    </div>
                                                </div>
                                                <div style="height: 100px;width: 100px;">
                                                    <img class="img-thumbnail" src="{{ url('public/images') }}/{{ $settings->footer_logo }}">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="col-from-label">Site Fav Icon</label>
                                                    <div class="input-group" data-toggle="aizuploader" data-type="favicon">
                                                        <input type="file" class="form-control" name="favicon">
                                                    </div>
                                                    <br>
                                                    <small class="text-muted">Website favicon. 32x32 .png</small>
                                                </div>
                                                <div style="height: 100px;width: 100px;">
                                                    <img class="img-thumbnail" src="{{ url('public/images') }}/{{ $settings->favicon }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <button type="submit" class="btn btn-primary">Update</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="card mb-3">
                                <div class="card-header">
                                    <h4 class="fw-600 mb-0">Social Links</h4>
                                </div>
                                <div class="card-body">
                                    <form action="{{ url('admin/website/updatelinks') }}" enctype='multipart/form-data' method="POST">
                                       @csrf
                                       <div class="row">
                                           <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="col-from-label">Facebook Link</label>
                                                    <div class="input-group" data-toggle="aizuploader" data-type="facebook_link">
                                                        <input type="text" class="form-control"  value="{{$settings->facebook_link}}" name="facebook_link">
                                                    </div>
                                                </div> 
                                           </div>
                                           <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="col-from-label">Instagram Link</label>
                                                    <div class="input-group" data-toggle="aizuploader" data-type="insta_link">
                                                        <input type="text" class="form-control"  value="{{$settings->insta_link}}" name="insta_link">
                                                    </div>
                                                </div>
                                           </div>
                                           <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="col-from-label">Twitter Link</label>
                                                    <div class="input-group" data-toggle="aizuploader" data-type="twitter_link">
                                                        <input type="text" class="form-control"  value="{{$settings->twitter_link}}" name="twitter_link">
                                                    </div>
                                                </div>
                                           </div>
                                       </div>
                                        <div class="text-right">
                                            <button type="submit" class="btn btn-primary">Update</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    
                    
                </div> <!-- end col-->
            </div>
        </div>
    </div>
</div>
@endsection