@extends('admin.layouts.main-layout')
@section('title','Add Category')
@section('content')
 <!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <div class="d-flex align-items-center flex-wrap mr-2">
                <h5 class="text-blue font-weight-bold mt-2 mb-2 mr-5">
                    Update Products Shipping
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
                <a href="{{ url('admin/ecommerce/productshipping') }}/{{ $data->product_id }}" class="text-blue font-weight-bold mt-2 mb-2 mr-5">
                    Products Shipping
                </a>
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <a href="javascript:void(0)" class="text-dark font-weight-bold mt-2 mb-2 mr-5">
                    Update Products Shipping
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
            <form enctype="multipart/form-data" method="POST" action="{{ url('admin/ecommerce/updateshipping') }}">
            @csrf
            <input type="hidden" name="submit_type" id="submit_type">
            <input type="hidden" name="product_id" value="{{ $data->product_id }}">
            <input type="hidden" name="id" value="{{ $data->id }}">
            <div class="row">
                <div class="col-md-6 mx-auto">
                    <div class="card card-custom mt-5">
                        <div class="card-header">
                            <h4>Update Product Shipping</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                   <div class="form-group">
                                        <label>Name </label>
                                        <input type="text" id="inputField" placeholder="Enter Shipping Name" value="{{ $data->name }}" class="form-control" name="name">
                                    </div> 
                                </div>
                                <div class="col-md-12">
                                   <div class="form-group">
                                        <label>Price </label>
                                        <input type="text" id="inputField" placeholder="Enter Shipping Price" class="form-control" value="{{ $data->price }}" name="price">
                                    </div> 
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                             <div class="row mt-3">
                                <div class="col-md-12 mb-3 justify-content-end text-right">
                                    <button onclick="submitbutton('exit')" type="submit" class="btn btn-primary">Save</button>
                                    <button onclick="submitbutton('addmore')" type="submit" class="btn btn-primary">Save & Add More</button>
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
</script>
@endsection