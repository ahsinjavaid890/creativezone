@extends('admin.layouts.main-layout')
@section('title','Import Products')
@section('content')
 <!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <div class="d-flex align-items-center flex-wrap mr-2">
                <h5 class="text-blue font-weight-bold mt-2 mb-2 mr-5">
                    NEW PRODUCT
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
                <a href="javascript:void(0)" class="text-dark font-weight-bold mt-2 mb-2 mr-5">
                    Import Products
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
            <form enctype="multipart/form-data" method="POST" action="{{ url('admin/ecommerce/importproduct') }}">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="card card-custom mt-5">
                            <div class="card-body">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Select File <span class="text-danger">*</span></label>
                                            <input type="file" placeholder="Enter Product Tittle" class="form-control" name="file">
                                        </div>
                                    </div>
                                
                                <button class="btn btn-primary" type="submit">Import</button><br><br>
                                <a download="" href="{{ url('public/images/importemplate.xlsx') }}">Download Template</a>
                            </div>
                        </div>
                        <div class="card card-custom mt-5">
                            <div class="card-header flex-wrap"> 
                                <h3 class="card-title align-items-start flex-column">
                                    <span class="card-label font-weight-bolder text-dark">Brands</span>
                                </h3>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Name</th>
                                            <th class="text-center">Brand Id</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach(DB::table('brands')->where('status' , 1)->get() as $r)
                                        <tr>
                                            <td>
                                                <a href="{{ url('admin/ecommerce/editbrand') }}/{{ $r->id }}">{{ $r->name }}</a>
                                            </td>
                                            <td class="text-center pr-0">
                                                {{ $r->id }}
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card card-custom mt-5">
                            <div class="card-header flex-wrap"> 
                                <h3 class="card-title align-items-start flex-column">
                                    <span class="card-label font-weight-bolder text-dark">Categories</span>
                                </h3>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Name</th>
                                            <th class="text-center">Category Id</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach(DB::table('categories')->where('category_type' , 'buy')->where('status' , 1)->get() as $r)
                                        <tr>
                                            <td>
                                                <a href="{{ url('admin/ecommerce/editproductcategories') }}/{{ $r->id }}">{{ $r->name }}</a>
                                            </td>
                                            <td class="text-center pr-0">
                                                {{ $r->id }}
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
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