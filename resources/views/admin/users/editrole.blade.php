@extends('admin.layouts.main-layout')
@section('title','Update Role')
@section('content')

<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Entry-->
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <div class="d-flex align-items-center flex-wrap mr-2">
                <h5 class="text-blue font-weight-bold mt-2 mb-2 mr-5">
                   Update Role
                </h5>
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <a href="{{ url('admin/dashboard') }}" class="text-blue font-weight-bold mt-2 mb-2 mr-5">
                    Dashboard
                </a>
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <a href="{{ url('admin/users/alluserroles') }}" class="text-blue font-weight-bold mt-2 mb-2 mr-5">
                    Rolls
                </a>
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <a href="javascript:void(0)" class="text-dark font-weight-bold mt-2 mb-2 mr-5">
                    Update Role
                </a>
            </div>
        </div>
    </div>
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class=" container-fluid ">
            <!--begin::Card-->
            @include('alerts.index')
            <form method="post" action="{{ url('admin/users/updaterule') }}">
                @csrf
                <input type="hidden" name="id" value="{{ $data->id }}">
                <div class="row mb-10">
                    <div class="col-md-9">
                        <div class="card card-custom mt-5">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Name</label>
                                            <input required type="text" class="form-control" name="name" value="{{ $data->name }}">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Description</label>
                                            <textarea class="form-control" rows="3" name="description">{{ $data->description }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label class="col-form-label text-left col-lg-2 col-sm-12">Is Default?</label>
                                            <div class="col-lg-9 col-md-9 col-sm-12">
                                                <input data-switch="true" type="checkbox" name="is_default" id="isDefault" @if($data->is_default == 1) checked @endif >
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                
                                
                            </div>
                        </div>
                        <div class="card card-custom mt-5">
                            <div class="card-header flex-wrap">
                                <div class="card-title">
                                    <h3 class="card-label">
                                        Permission Flags
                                    </h3>
                                </div>
                                <div class="card-toolbar">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="allPermissions">
                                        <label class="form-check-label" for="allPermissions">All Permissions</label>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body" style="height: 500px; overflow: auto;">
                                <div class="accordion">
                                    <div class="card mb-3">
                                        <div class="card-header">
                                            <div class="card-title">
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input permission-header" id="orders">
                                                    <label class="form-check-label" for="orders">Orders</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="collapse show">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input permission-item orders" id="createOrder" name="permissions[orders][createOrder]" @if(isset($permissions['orders']['createOrder']) && $permissions['orders']['createOrder']) checked @endif>
                                                            <label class="form-check-label" for="createOrder">Create Order</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input permission-item orders" id="productOrder" name="permissions[orders][productOrder]" @if(isset($permissions['orders']['productOrder']) && $permissions['orders']['productOrder']) checked @endif>
                                                            <label class="form-check-label" for="productOrder">Product Order</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input permission-item orders" id="productinqury" name="permissions[orders][productinqury]" @if(isset($permissions['orders']['productinqury']) && $permissions['orders']['productinqury']) checked @endif>
                                                            <label class="form-check-label" for="productinqury">Product Inquires</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input permission-item orders" id="serviceOrder" name="permissions[orders][serviceOrder]"  @if(isset($permissions['orders']['serviceOrder']) && $permissions['orders']['serviceOrder']) checked @endif>
                                                            <label class="form-check-label" for="serviceOrder">Service Order</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input permission-item orders" id="incompleteOrder" name="permissions[orders][incompleteOrder]"  @if(isset($permissions['orders']['incompleteOrder']) && $permissions['orders']['incompleteOrder']) checked @endif>
                                                            <label class="form-check-label" for="incompleteOrder">Incomplete Order</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion">
                                    <div class="card mb-3">
                                        <div class="card-header">
                                            <div class="card-title">
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input permission-header" id="reports">
                                                    <label class="form-check-label" for="reports">Reports</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="collapse show">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input permission-item reports" id="allreports" name="permissions[reports][allreports]"  @if(isset($permissions['reports']['allreports']) && $permissions['reports']['allreports']) checked @endif>
                                                            <label class="form-check-label" for="allreports">All Reports</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input permission-item reports" id="exportReports" name="permissions[reports][exportReports]"  @if(isset($permissions['reports']['exportReports']) && $permissions['reports']['exportReports']) checked @endif>
                                                            <label class="form-check-label" for="exportReports">Export Reports</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion">
                                    <div class="card mb-3">
                                        <div class="card-header">
                                            <div class="card-title">
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input permission-header" id="properties">
                                                    <label class="form-check-label" for="properties">Properties</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="collapse show">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input permission-item properties" id="allProperties" name="permissions[properties][allProperties]"  @if(isset($permissions['properties']['allProperties']) && $permissions['properties']['allProperties']) checked @endif>
                                                            <label class="form-check-label" for="allProperties">All Properties</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input permission-item properties" id="addproperty" name="permissions[properties][addproperty]"  @if(isset($permissions['properties']['addproperty']) && $permissions['properties']['addproperty']) checked @endif>
                                                            <label class="form-check-label" for="addproperty">Add Property</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion">
                                    <div class="card mb-3">
                                        <div class="card-header">
                                            <div class="card-title">
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input permission-header" id="routes">
                                                    <label class="form-check-label" for="routes">Routes</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="collapse show">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input permission-item routes" id="allroutes" name="permissions[routes][allroutes]"  @if(isset($permissions['routes']['allroutes']) && $permissions['routes']['allroutes']) checked @endif>
                                                            <label class="form-check-label" for="allroutes">All Routes</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input permission-item routes" id="addroute" name="permissions[routes][addroute]"  @if(isset($permissions['routes']['addroute']) && $permissions['routes']['addroute']) checked @endif>
                                                            <label class="form-check-label" for="addroute">Add Route</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion">
                                    <div class="card mb-3">
                                        <div class="card-header">
                                            <div class="card-title">
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input permission-header" id="productManagement">
                                                    <label class="form-check-label" for="productManagement">Product Management</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="collapse show">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input permission-item productManagement" id="productCategories" name="permissions[productManagement][productCategories]"  @if(isset($permissions['productManagement']['productCategories']) && $permissions['productManagement']['productCategories']) checked @endif>
                                                            <label class="form-check-label" for="productCategories">Product Categories</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input permission-item productManagement" id="models" name="permissions[productManagement][models]"  @if(isset($permissions['productManagement']['models']) && $permissions['productManagement']['models']) checked @endif>
                                                            <label class="form-check-label" for="models">Models</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input permission-item productManagement" id="brands" name="permissions[productManagement][brands]"  @if(isset($permissions['productManagement']['brands']) && $permissions['productManagement']['brands']) checked @endif>
                                                            <label class="form-check-label" for="brands">Brands</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input permission-item productManagement" id="operatingSystem" name="permissions[productManagement][operatingSystem]"  @if(isset($permissions['productManagement']['operatingSystem']) && $permissions['productManagement']['operatingSystem']) checked @endif>
                                                            <label class="form-check-label" for="operatingSystem">Operating System</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input permission-item productManagement" id="products" name="permissions[productManagement][products]"  @if(isset($permissions['productManagement']['products']) && $permissions['productManagement']['products']) checked @endif>
                                                            <label class="form-check-label" for="products">Products</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input permission-item productManagement" id="importProducts" name="permissions[productManagement][importProducts]"  @if(isset($permissions['productManagement']['importProducts']) && $permissions['productManagement']['importProducts']) checked @endif>
                                                            <label class="form-check-label" for="importProducts">Import Products</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input permission-item productManagement" id="collections" name="permissions[productManagement][collections]"  @if(isset($permissions['productManagement']['collections']) && $permissions['productManagement']['collections']) checked @endif>
                                                            <label class="form-check-label" for="collections">Collections</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input permission-item productManagement" id="stock" name="permissions[productManagement][stock]"  @if(isset($permissions['productManagement']['stock']) && $permissions['productManagement']['stock']) checked @endif>
                                                            <label class="form-check-label" for="stock">Stock</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion">
                                    <div class="card mb-3">
                                        <div class="card-header">
                                            <div class="card-title">
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input permission-header" id="repairManagement">
                                                    <label class="form-check-label" for="repairManagement">Repair Management</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="collapse show">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input permission-item repairManagement" id="categories" name="permissions[repairManagement][categories]"  @if(isset($permissions['repairManagement']['categories']) && $permissions['repairManagement']['categories']) checked @endif>
                                                            <label class="form-check-label" for="categories">Categories</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input permission-item repairManagement" id="models" name="permissions[repairManagement][models]"  @if(isset($permissions['repairManagement']['models']) && $permissions['repairManagement']['models']) checked @endif>
                                                            <label class="form-check-label" for="models">Models</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input permission-item repairManagement" id="whatswrong" name="permissions[repairManagement][whatswrong]"  @if(isset($permissions['repairManagement']['whatswrong']) && $permissions['repairManagement']['whatswrong']) checked @endif>
                                                            <label class="form-check-label" for="whatswrong">What's Wrong</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input permission-item repairManagement" id="inquiries" name="permissions[repairManagement][inquiries]"  @if(isset($permissions['repairManagement']['inquiries']) && $permissions['repairManagement']['inquiries']) checked @endif>
                                                            <label class="form-check-label" for="inquiries">Inquiries</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input permission-item repairManagement" id="repairstore" name="permissions[repairManagement][repairstore]"  @if(isset($permissions['repairManagement']['repairstore']) && $permissions['repairManagement']['repairstore']) checked @endif>
                                                            <label class="form-check-label" for="repairstore">Repair Stores</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion">
                                    <div class="card mb-3">
                                        <div class="card-header">
                                            <div class="card-title">
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input permission-header" id="sellManagement">
                                                    <label class="form-check-label" for="sellManagement">Sell Management</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="collapse show">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input permission-item sellManagement" id="categories" name="permissions[sellManagement][categories]"  @if(isset($permissions['sellManagement']['categories']) && $permissions['sellManagement']['categories']) checked @endif>
                                                            <label class="form-check-label" for="categories">Catgeories</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input permission-item sellManagement" id="models" name="permissions[sellManagement][models]"  @if(isset($permissions['sellManagement']['models']) && $permissions['sellManagement']['models']) checked @endif>
                                                            <label class="form-check-label" for="models">Models</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input permission-item sellManagement" id="questions" name="permissions[sellManagement][questions]"  @if(isset($permissions['sellManagement']['questions']) && $permissions['sellManagement']['questions']) checked @endif>
                                                            <label class="form-check-label" for="questions">Questions</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input permission-item sellManagement" id="inquiries" name="permissions[sellManagement][inquiries]"  @if(isset($permissions['sellManagement']['inquiries']) && $permissions['sellManagement']['inquiries']) checked @endif>
                                                            <label class="form-check-label" for="inquiries">Inquiries</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion">
                                    <div class="card mb-3">
                                        <div class="card-header">
                                            <div class="card-title">
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input permission-header" id="serviceManagement">
                                                    <label class="form-check-label" for="serviceManagement">Service Management</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="collapse show">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input permission-item serviceManagement" id="attribute" name="permissions[serviceManagement][attribute]"  @if(isset($permissions['serviceManagement']['attribute']) && $permissions['serviceManagement']['attribute']) checked @endif>
                                                            <label class="form-check-label" for="attribute">Attributes</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input permission-item serviceManagement" id="questions" name="permissions[serviceManagement][questions]"  @if(isset($permissions['serviceManagement']['questions']) && $permissions['serviceManagement']['questions']) checked @endif>
                                                            <label class="form-check-label" for="questions">Questions</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input permission-item serviceManagement" id="parentservices" name="permissions[serviceManagement][parentservices]"  @if(isset($permissions['serviceManagement']['parentservices']) && $permissions['serviceManagement']['parentservices']) checked @endif>
                                                            <label class="form-check-label" for="parentservices">Parent Services</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input permission-item serviceManagement" id="services" name="permissions[serviceManagement][services]"  @if(isset($permissions['serviceManagement']['services']) && $permissions['serviceManagement']['services']) checked @endif>
                                                            <label class="form-check-label" for="services">Services</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input permission-item serviceManagement" id="providers" name="permissions[serviceManagement][providers]"  @if(isset($permissions['serviceManagement']['providers']) && $permissions['serviceManagement']['providers']) checked @endif>
                                                            <label class="form-check-label" for="providers">Providers</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input permission-item serviceManagement" id="plans" name="permissions[serviceManagement][plans]"  @if(isset($permissions['serviceManagement']['plans']) && $permissions['serviceManagement']['plans']) checked @endif>
                                                            <label class="form-check-label" for="plans">Plans</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="accordion">
                                    <div class="card mb-3">
                                        <div class="card-header">
                                            <div class="card-title">
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input permission-header" id="userManagement">
                                                    <label class="form-check-label" for="userManagement">User Management</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="collapse show">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input permission-item userManagement" id="allusers" name="permissions[userManagement][allusers]"  @if(isset($permissions['userManagement']['allusers']) && $permissions['userManagement']['allusers']) checked @endif>
                                                            <label class="form-check-label" for="allusers">All Users</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input permission-item userManagement" id="addusers" name="permissions[userManagement][addusers]"  @if(isset($permissions['userManagement']['addusers']) && $permissions['userManagement']['addusers']) checked @endif>
                                                            <label class="form-check-label" for="addusers">Add Users</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input permission-item userManagement" id="alluserrolls" name="permissions[userManagement][alluserrolls]"  @if(isset($permissions['userManagement']['alluserrolls']) && $permissions['userManagement']['alluserrolls']) checked @endif>
                                                            <label class="form-check-label" for="alluserrolls">All User Rolls</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input permission-item userManagement" id="adduserroll" name="permissions[userManagement][adduserroll]"  @if(isset($permissions['userManagement']['adduserroll']) && $permissions['userManagement']['adduserroll']) checked @endif>
                                                            <label class="form-check-label" for="adduserroll">Add User Rolls</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input permission-item userManagement" id="company" name="permissions[userManagement][company]"  @if(isset($permissions['userManagement']['company']) && $permissions['userManagement']['company']) checked @endif>
                                                            <label class="form-check-label" for="company">Company</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion">
                                    <div class="card mb-3">
                                        <div class="card-header">
                                            <div class="card-title">
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input permission-header" id="faq">
                                                    <label class="form-check-label" for="faq">FAQ</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="collapse show">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input permission-item faq" id="categories" name="permissions[faq][categories]"  @if(isset($permissions['faq']['categories']) && $permissions['faq']['categories']) checked @endif>
                                                            <label class="form-check-label" for="categories">Categories</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input permission-item faq" id="allfaq" name="permissions[faq][allfaq]"  @if(isset($permissions['faq']['allfaq']) && $permissions['faq']['allfaq']) checked @endif>
                                                            <label class="form-check-label" for="allfaq">All Faq</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion">
                                    <div class="card mb-3">
                                        <div class="card-header">
                                            <div class="card-title">
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input permission-header" id="blog">
                                                    <label class="form-check-label" for="blog">Blogs</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="collapse show">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input permission-item blog" id="categories" name="permissions[blog][categories]"  @if(isset($permissions['blog']['categories']) && $permissions['blog']['categories']) checked @endif>
                                                            <label class="form-check-label" for="categories">Categories</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input permission-item blog" id="allblog" name="permissions[blog][allblog]"  @if(isset($permissions['blog']['allblog']) && $permissions['blog']['allblog']) checked @endif>
                                                            <label class="form-check-label" for="allblog">All Blogs</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion">
                                    <div class="card mb-3">
                                        <div class="card-header">
                                            <div class="card-title">
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input permission-header" id="video">
                                                    <label class="form-check-label" for="video">Videos</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="collapse show">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input permission-item video" id="categories" name="permissions[video][categories]"  @if(isset($permissions['video']['categories']) && $permissions['video']['categories']) checked @endif>
                                                            <label class="form-check-label" for="categories">Categories</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input permission-item video" id="allvideo" name="permissions[video][allvideo]"  @if(isset($permissions['video']['allvideo']) && $permissions['video']['allvideo']) checked @endif>
                                                            <label class="form-check-label" for="allvideo">All Videos</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion">
                                    <div class="card mb-3">
                                        <div class="card-header">
                                            <div class="card-title">
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input permission-header" id="testimonials">
                                                    <label class="form-check-label" for="testimonials">Testimonials</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="collapse show">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input permission-item testimonials" id="alltestimonials" name="permissions[testimonials][alltestimonials]"  @if(isset($permissions['testimonials']['alltestimonials']) && $permissions['testimonials']['alltestimonials']) checked @endif>
                                                            <label class="form-check-label" for="alltestimonials">All Testimonials</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input permission-item testimonials" id="addtestimonial" name="permissions[testimonials][addtestimonial]"  @if(isset($permissions['testimonials']['addtestimonial']) && $permissions['testimonials']['addtestimonial']) checked @endif>
                                                            <label class="form-check-label" for="addtestimonial">Add Testimonial</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion">
                                    <div class="card mb-3">
                                        <div class="card-header">
                                            <div class="card-title">
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input permission-header" id="reviews">
                                                    <label class="form-check-label" for="reviews">Reviews</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="collapse show">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input permission-item reviews" id="allreviews" name="permissions[reviews][allreviews]"  @if(isset($permissions['reviews']['allreviews']) && $permissions['reviews']['allreviews']) checked @endif>
                                                            <label class="form-check-label" for="allreviews">All Reviews</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input permission-item reviews" id="addreviews" name="permissions[reviews][addreviews]"  @if(isset($permissions['reviews']['addreviews']) && $permissions['reviews']['addreviews']) checked @endif>
                                                            <label class="form-check-label" for="addreviews">Add Reviews</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion">
                                    <div class="card mb-3">
                                        <div class="card-header">
                                            <div class="card-title">
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input permission-header" id="attachment">
                                                    <label class="form-check-label" for="attachment">Attachments</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="collapse show">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input permission-item attachment" id="allattachments" name="permissions[attachment][allattachments]"  @if(isset($permissions['attachment']['allattachments']) && $permissions['attachment']['allattachments']) checked @endif>
                                                            <label class="form-check-label" for="allattachments">All Attachments</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input permission-item attachment" id="addattachment" name="permissions[attachment][addattachment]"  @if(isset($permissions['attachment']['addattachment']) && $permissions['attachment']['addattachment']) checked @endif>
                                                            <label class="form-check-label" for="addattachment">Add Attachments</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion">
                                    <div class="card mb-3">
                                        <div class="card-header">
                                            <div class="card-title">
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input permission-header" id="emailtemplate">
                                                    <label class="form-check-label" for="emailtemplate">Email Templates</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="collapse show">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input permission-item emailtemplates" id="allemailtemplate" name="permissions[emailtemplate][allemailtemplates]"  @if(isset($permissions['emailtemplate']['allemailtemplates']) && $permissions['emailtemplate']['allemailtemplates']) checked @endif>
                                                            <label class="form-check-label" for="allemailtemplates">All Email Templates</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input permission-item emailtemplate" id="addemailtemplate" name="permissions[emailtemplate][addemailtemplate]"  @if(isset($permissions['emailtemplate']['addemailtemplate']) && $permissions['emailtemplate']['addemailtemplate']) checked @endif>
                                                            <label class="form-check-label" for="addemailtemplate">Add Email Templates</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion">
                                    <div class="card mb-3">
                                        <div class="card-header">
                                            <div class="card-title">
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input permission-header" id="emailsetting">
                                                    <label class="form-check-label" for="emailsetting">Email Setting</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="collapse show">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input permission-item emailsetting" id="allemailsetting" name="permissions[emailsetting][allemailsetting]"  @if(isset($permissions['emailsetting']['allemailsetting']) && $permissions['emailsetting']['allemailsetting']) checked @endif>
                                                            <label class="form-check-label" for="allemailsetting">All Email Setting</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion">
                                    <div class="card mb-3">
                                        <div class="card-header">
                                            <div class="card-title">
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input permission-header" id="pages">
                                                    <label class="form-check-label" for="pages">Pages</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="collapse show">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input permission-item pages" id="allpages" name="permissions[pages][allpages]"  @if(isset($permissions['pages']['allpages']) && $permissions['pages']['allpages']) checked @endif>
                                                            <label class="form-check-label" for="allpages">All pages</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input permission-item pages" id="addpages" name="permissions[pages][addpages]"  @if(isset($permissions['pages']['addpages']) && $permissions['pages']['addpages']) checked @endif>
                                                            <label class="form-check-label" for="addpages">Add Pages</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion">
                                    <div class="card mb-3">
                                        <div class="card-header">
                                            <div class="card-title">
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input permission-header" id="sitesetting">
                                                    <label class="form-check-label" for="sitesetting">Site Setting</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="collapse show">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input permission-item sitesetting" id="allsitesetting" name="permissions[sitesetting][allsitesetting]"  @if(isset($permissions['sitesetting']['allsitesetting']) && $permissions['sitesetting']['allsitesetting']) checked @endif>
                                                            <label class="form-check-label" for="allsitesetting">All Site Setting</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input permission-item sitesetting" id="sitelinks" name="permissions[sitesetting][sitelinks]"  @if(isset($permissions['sitesetting']['sitelinks']) && $permissions['sitesetting']['sitelinks']) checked @endif>
                                                            <label class="form-check-label" for="sitelinks">All Site Links</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input permission-item sitesetting" id="sitelinkscat" name="permissions[sitesetting][sitelinkscat]"  @if(isset($permissions['sitesetting']['sitelinkscat']) && $permissions['sitesetting']['sitelinkscat']) checked @endif>
                                                            <label class="form-check-label" for="sitelinkscat">All Site Links Cat</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion">
                                    <div class="card mb-3">
                                        <div class="card-header">
                                            <div class="card-title">
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input permission-header" id="contactmessages">
                                                    <label class="form-check-label" for="contactmessages">Contact Messages</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="collapse show">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input permission-item contactmessages" id="allcontactmessages" name="permissions[contactmessages][allcontactmessages]"  @if(isset($permissions['contactmessages']['allcontactmessages']) && $permissions['contactmessages']['allcontactmessages']) checked @endif>
                                                            <label class="form-check-label" for="allcontactmessages">All Contact Messages</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion">
                                    <div class="card mb-3">
                                        <div class="card-header">
                                            <div class="card-title">
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input permission-header" id="myprofile">
                                                    <label class="form-check-label" for="myprofile">My Profile</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="collapse show">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input permission-item myprofile" id="allprofiledetail" name="permissions[myprofile][allprofiledetail]"  @if(isset($permissions['myprofile']['allprofiledetail']) && $permissions['myprofile']['allprofiledetail']) checked @endif>
                                                            <label class="form-check-label" for="allprofiledetail">All Profile Detail</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Add other sections here as needed -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-10">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary">Submit</button>
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
    // Class definition

var KTBootstrapSwitch = function() {

// Private functions
var demos = function() {
    // minimum setup
    $('[data-switch=true]').bootstrapSwitch();
};

return {
    // public functions
    init: function() {
    demos();
    },
};
}();

jQuery(document).ready(function() {
KTBootstrapSwitch.init();
});
</script>
<script>
    $(document).ready(function () {
        // Handle header checkbox change event
        $('.permission-header').change(function () {
            var categoryClass = $(this).attr('id');
            $('.' + categoryClass).prop('checked', $(this).prop('checked'));
        });

        // Handle individual checkbox change event
        $('.permission-item').change(function () {
            var categoryClass = $(this).attr('class').split(' ')[1];
            var allChecked = $('.' + categoryClass).length === $('.' + categoryClass + ':checked').length;
            var anyChecked = $('.' + categoryClass + ':checked').length > 0;

            // Update parent checkbox based on the state of child checkboxes
            $('#' + categoryClass).prop('checked', anyChecked);

            // Update the state of the "All Permissions" checkbox
            var allPermissionsChecked = $('.permission-item').length === $('.permission-item:checked').length;
            $('#allPermissions').prop('checked', allPermissionsChecked);
        });

        // Handle 'All Permissions' checkbox change event
        $('#allPermissions').change(function () {
            $('.permission-item, .permission-header').prop('checked', $(this).prop('checked'));
        });

        // Initialize state of header checkboxes based on individual checkboxes
        $('.permission-header').each(function () {
            var categoryClass = $(this).attr('id');
            var allChecked = $('.' + categoryClass).length === $('.' + categoryClass + ':checked').length;
            $(this).prop('checked', allChecked);
        });

        // Initialize state of 'All Permissions' checkbox based on individual checkboxes
        var allPermissionsChecked = $('.permission-item').length === $('.permission-item:checked').length;
        $('#allPermissions').prop('checked', allPermissionsChecked);
    });
</script>
@endsection