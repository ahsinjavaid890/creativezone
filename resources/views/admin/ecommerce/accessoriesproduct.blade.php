@extends('admin.layouts.main-layout')
@section('title','Add Accessories Product')
@section('content')
 <!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <div class="d-flex align-items-center flex-wrap mr-2">
                <h5 class="text-blue font-weight-bold mt-2 mb-2 mr-5">
                    Add Accessories Product
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
                <a href="{{ url('admin/ecommerce/products') }}" class="text-blue font-weight-bold mt-2 mb-2 mr-5">
                    Products
                </a>
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <a href="{{ url('admin/ecommerce/accessories') }}" class="text-blue font-weight-bold mt-2 mb-2 mr-5">
                    Accessories Products
                </a>
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <a href="javascript:void(0)" class="text-dark font-weight-bold mt-2 mb-2 mr-5">
                    Add Accessories Product
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
            <form enctype="multipart/form-data" method="POST" action="{{ url('admin/ecommerce/accessorieproduct') }}">
                @csrf
                <input type="hidden" name="submit_type" id="submit_type">
                <input type="hidden" name="type" value="accessories">
                <div class="row">
                    <div class="col-md-9">
                        <div class="card card-custom mt-5">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <div class="form-group">
                                            <label>Select Category<span class="text-danger">*</span></label>
                                            <select onchange="selectcategory(this.value)" class="form-control" required name="category_id" id="category">
                                                <option value="">Select Brand</option>
                                                @foreach(DB::table('categories')->where('category_type' , 'accessories')->get() as $r)
                                                <option value="{{ $r->id }}">{{ $r->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <div class="form-group">
                                            <label>Select Modal<span class="text-danger">*</span></label>
                                            <select class="form-control" id="model_id" required name="model_id">
                                                <option value="">Select Modal</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <div class="form-group">
                                            <label>Product Name <span class="text-danger">*</span></label>
                                            <input type="text" placeholder="Enter Product Tittle" class="form-control" name="name" required>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <div class="form-group">
                                            <label>Select Accesssories Type<span class="text-danger">*</span></label>
                                            <select class="form-control" id="accessories_type" required name="accessories_type">
                                                <option value="">Select Accesssories Type</option>
                                                @foreach(DB::table('accessories_types')->get() as $r)
                                                <option value="{{ $r->id }}">{{ $r->type }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <div class="form-group">
                                            <label>Description</label>
                                            <textarea class="form-control" name="description" rows="4"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <div class="form-group">
                                            <label>Images</label>
                                            <input required type="file" multiple class="form-control" name="images[]">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <div class="form-group">
                                            <label>Stock</label>
                                            <input id="input-currency" name="stock" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <div class="form-group">
                                            <label>Offer Price(in USD)</label>
                                            <input id="input-currency" name="offer_price" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <div class="form-group">
                                            <label>Sell Price(in USD) <span class="text-danger">*</span></label>
                                            <input id="input-currency" name="sell_price" required="" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        
                        <div class="card card-custom mt-5">
                            <div class="card-header flex-wrap">
                                <div class="card-title">
                                    Status
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <select name="status" class="form-control">
                                        <option value="1">Enable</option>
                                        <option value="2">Disable</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="card card-custom mt-5">
                            <div class="card-header flex-wrap">
                                <div class="card-title">
                                    Publish
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row mt-3">
                                    <div class="col-md-12 mb-3">
                                        <button onclick="submitbutton('exit')" type="submit" class="btn btn-primary">Save & Exit</button>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-12 mb-3">
                                        <button onclick="submitbutton('addmore')" type="submit" class="btn btn-primary">Save & Add More</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <!--end::Card-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->
</div>
@endsection

@section('script')
<script type="text/javascript">
    function submitbutton(id) {
        $('#submit_type').val(id);
    }
    $('#category').select2({
        placeholder: "Select a Category",
    });
    $('#model_id').select2({
        placeholder: "Select a Modal",
    });
    $('#accessories_type').select2({
        placeholder: "Select a Accessories type",
    });
    function selectcategory(id) {
        $.ajax({
            type:'GET',
            url: '{{ url("admin/ecommerce/selectcategory") }}/'+id,
            success: function(data){
                $('#model_id').html(data)
            }
        });
    }
</script>
@endsection