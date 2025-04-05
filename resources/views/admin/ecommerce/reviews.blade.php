@extends('admin.layouts.main-layout')
@section('title','Ecommerece | Products')
@section('content')
 <!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <div class="d-flex align-items-center flex-wrap mr-2">
                <a href="{{ url('admin/dashboard') }}" class="text-blue font-weight-bold mt-2 mb-2 mr-5">
                    Dashboard
                </a>
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <a href="javascript:void(0)" class="text-dark font-weight-bold mt-2 mb-2 mr-5">
                    Ecommerece
                </a>
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <a href="javascript:void(0)" class="text-dark font-weight-bold mt-2 mb-2 mr-5">
                    Products
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
            <div class="card card-custom mt-5">
                <div class="card-header flex-wrap">
                    <div class="card-title">
                        <div class="dropdown dropdown-inline">
                            <a href="#" class="btn btn-primary font-weight-bolder" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Bulk Actions
                            </a>
                            <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                                <ul class="navi navi-hover">
                                    <li class="navi-item">
                                        <a href="javascript:void(0)" class="navi-link">
                                            <span class="navi-text">Bulk changes</span>
                                        </a>
                                    </li>
                                    <li class="navi-item">
                                        <a href="javascript:void(0)" class="navi-link">
                                            <span class="navi-text">Delete</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <a href="javascript::void(0)" class="btn btn-primary font-weight-bolder ml-3">
                            Filters
                        </a>
                    </div>
                    <div class="card-toolbar">
                        <!--begin::Button-->
                        <a href="javascript::void(0)" class="btn btn-primary font-weight-bolder">
                            Export
                        </a>
                        <!--end::Button-->
                    </div>
                </div>
                <div class="card-body">
                    
                </div>
            </div>
            <!--end::Card-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->
</div>
@endsection