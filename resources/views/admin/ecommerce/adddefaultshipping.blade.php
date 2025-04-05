@extends('admin.layouts.main-layout')
@section('title','Add Category')
@section('content')
 <!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <div class="d-flex align-items-center flex-wrap mr-2">
                <h5 class="text-blue font-weight-bold mt-2 mb-2 mr-5">
                    Add Default Shipping
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
                <a href="{{ url('admin/ecommerce/defaultshipping') }}" class="text-blue font-weight-bold mt-2 mb-2 mr-5">
                    Default Shipping
                </a>
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <a href="javascript:void(0)" class="text-dark font-weight-bold mt-2 mb-2 mr-5">
                    Add Default Shipping
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
            <form enctype="multipart/form-data" method="POST" action="{{ url('admin/ecommerce/creatdefaultshipping') }}">
                @csrf
                <input type="hidden" name="submit_type" id="submit_type">
                <div class="row">
                    <div class="col-md-6 mx-auto">
                        <div class="card card-custom mt-5">
                            <div class="card-header">
                                <h4>Add Default Shipping</h4>
                            </div>
                            <div class="card-body">
                                <div id="container">
                                    <div class="row row-to-clone align-items-center">
                                        <div class="col-md-11">
                                            <div class="col-md-12">
                                               <div class="form-group">
                                                    <label>Name <span class="text-danger">*</span></label>
                                                    <input type="text" id="inputField" placeholder="Enter Shipping Name" class="form-control" name="name[]" required>
                                                </div> 
                                            </div>
                                            <div class="col-md-12">
                                               <div class="form-group">
                                                    <label>Price <span class="text-danger">*</span></label>
                                                    <input type="text" id="inputField" placeholder="Enter Shipping Price" class="form-control" name="price[]" required>
                                                </div> 
                                            </div>
                                        </div>
                                        <div class="col-md-1 pt-2">
                                            <span class="material-icons add-circle" style="cursor: pointer;">add_circle</span>
                                            <span class="material-icons remove-circle" style="cursor: pointer; display: none;">remove_circle</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="action_btn d-flex justify-content-between">
                                    <div class="save_exit">
                                        <button onclick="submitbutton('exit')" type="submit" class="btn btn-primary">Save & Exit</button>
                                    </div>
                                    <div class="save_btn">
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

$(document).ready(function(){
    function updateLabels() {
        $('.row-to-clone').each(function(index) {
            $(this).find('label').text('Product Shipping ' + (index + 1));
        });
    }
    $(document).on('click', '.add-circle', function(){
        var $clone = $('.row-to-clone:first').clone();
        $clone.find('input').val(''); 
        $clone.find('.remove-circle').show();
        $clone.find('.add-circle').hide();
        $('#container').append($clone);
        updateLabels();
    });
    $(document).on('click', '.remove-circle', function(){
        if ($('.row-to-clone').length > 1) {
            $(this).closest('.row-to-clone').remove();
            updateLabels();
        } else {
            alert("You must have at least one row.");
        }
    });
    updateLabels();
});

</script>
@endsection