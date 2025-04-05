@extends('admin.layouts.main-layout')
@section('title','Add Category')
@section('content')
 <!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <div class="d-flex align-items-center flex-wrap mr-2">
                <h5 class="text-blue font-weight-bold mt-2 mb-2 mr-5">
                    Add Category
                </h5>
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <a href="{{ url('admin/dashboard') }}" class="text-blue font-weight-bold mt-2 mb-2 mr-5">
                    Dashboard
                </a>
                @if(isset($_GET['category_type']))
                    @if($_GET['category_type'] == 'repair')
                    <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                    <a href="{{ url('admin/repair/categories') }}" class="text-blue font-weight-bold mt-2 mb-2 mr-5">
                        Categories
                    </a>
                    @endif

                @else
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <a href="javascript:void(0)" class="text-dark font-weight-bold mt-2 mb-2 mr-5">
                    Ecommerece
                </a>
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <a href="{{ url('admin/ecommerce/product-categories') }}" class="text-blue font-weight-bold mt-2 mb-2 mr-5">
                    Categories
                </a>
                @endif
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <a href="javascript:void(0)" class="text-dark font-weight-bold mt-2 mb-2 mr-5">
                    Add Category
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
            <form enctype="multipart/form-data" method="POST" action="{{ url('admin/ecommerce/createcategory') }}">
            @csrf
            <div class="row">
                <div class="col-md-9">
                    <div class="card card-custom mt-5">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Category Type <span class="text-danger">*</span></label>
                                        <select onchange="selectcategorytype(this.value)" required class="form-control" name="category_type">
                                            <option @if(isset($_GET['category_type'])) @if($_GET['category_type'] == 'buy') selected @endif @endif value="buy">Buy</option>
                                            <option @if(isset($_GET['category_type'])) @if($_GET['category_type'] == 'sell') selected @endif @endif value="sell">Sell</option>
                                            <option @if(isset($_GET['category_type'])) @if($_GET['category_type'] == 'accessories') selected @endif @endif value="accessories">Accessories</option>
                                            <option @if(isset($_GET['category_type'])) @if($_GET['category_type'] == 'repair') selected @endif @endif value="repair">Repair</option>
                                        </select>
                                        @if ($errors->has('category_type'))
                                            <span class="error-message">{{ $errors->first('category_type') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-12">
                                   <div class="form-group">
                                        <label>Category Name <span class="text-danger">*</span></label>
                                        <input value="{{ old('name') }}" type="text" id="inputField" placeholder="Enter Category Name" class="form-control" name="name">
                                        @if ($errors->has('name'))
                                            <span class="error-message">{{ $errors->first('name') }}</span>
                                        @endif
                                    </div> 
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea name="description" class="form-control" rows="4">{{ old('description') }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Image</label>
                                        <input type="file" name="image" class="form-control">
                                    </div>
                                </div>
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
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </div>
                        </div>
                    </div>
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
                </div>
            </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('script')
<script type="text/javascript">
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
</script>
@endsection