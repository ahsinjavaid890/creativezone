@extends('admin.layouts.main-layout')
@section('title','Update Operating System')
@section('content')
 <!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <div class="d-flex align-items-center flex-wrap mr-2">
                <h5 class="Brand-blue font-weight-bold mt-2 mb-2 mr-5">
                    Update Operating System
                </h5>
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <a href="{{ url('admin/dashboard') }}" class="text-blue font-weight-bold mt-2 mb-2 mr-5">
                    Dashboard
                </a>
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <a href="javascript:void(0)" class="text-dark font-weight-bold mt-2 mb-2 mr-5">
                    Ecommerece
                </a>
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <a href="{{ url('admin/ecommerce/operating-system') }}" class="text-blue font-weight-bold mt-2 mb-2 mr-5">
                    Operating Systems
                </a>
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <a href="javascript:void(0)" class="text-dark font-weight-bold mt-2 mb-2 mr-5">
                    Update Operating System : <b class="text-danger">{{ $data->name }}</b>
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
            <form enctype="multipart/form-data" method="POST" action="{{ url('admin/ecommerce/updateoberatingsystems') }}">
            @csrf
            <input type="hidden" name="submit_type" id="submit_type">
            <input type="hidden" value="{{ $data->id }}" name="id">
            <div class="row">
                <div class="col-md-9">
                    <div class="card card-custom mt-5">
                        <div class="card-body">
                            <div class="form-group">
                                <label>Operating System Name <span class="text-danger">*</span></label>
                                <input required value="{{ $data->name }}" type="text" placeholder="Enter Operating System Name" class="form-control" name="name">
                            </div>
                            <div class="form-group">
                                <label>Operating System Status <span class="text-danger">*</span></label>
                                <select name="status" class="form-control">
                                    <option @if($data->status == 1) selected @endif value="1">Enable</option>
                                    <option @if($data->status == 2) selected @endif value="2">Disable</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Description</label>
                                <textarea name="description" class="form-control" rows="4">{{ $data->name }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card card-custom mt-5">
                        <div class="card-header flex-wrap">
                            <div class="card-title">
                                Publish
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <button onclick="submitbutton('addmore')" type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <button onclick="submitbutton('exit')" type="submit" class="btn btn-primary">Update & Exit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('script')
<script type="text/javascript">
    function submitbutton(id) {
        $('#submit_type').val(id);
    }
    function selectcategorytype(id) {
        if(id == 'sell')
        {
            var url = '{{ url("sell/category") }}';
            $('.permalink').html(url)
        }
        if(id == 'buy')
        {
            var url = '{{ url("buy/category") }}';
            $('.permalink').html(url)
        }
    }
    function generateSlug(str) {
        return str
            .toLowerCase()                    
            .replace(/ /g, '-')               
            .replace(/[^\w-]+/g, '');         
    }
    $(document).ready(function() {
        $('#inputField').on('keyup', function() {
            var categoryName = $(this).val();
            var slug = generateSlug(categoryName);
            $('#urlOutput').val(slug);
        });
    });
</script>
@endsection