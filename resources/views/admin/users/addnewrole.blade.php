@extends('admin.layouts.main-layout')
@section('title','Create New Role')
@section('content')

<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Entry-->
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <div class="d-flex align-items-center flex-wrap mr-2">
                <h5 class="text-blue font-weight-bold mt-2 mb-2 mr-5">
                   Create New Role
                </h5>
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <a href="{{ url('admin/dashboard') }}" class="text-blue font-weight-bold mt-2 mb-2 mr-5">
                    Dashboard
                </a>
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <a href="javascript:void(0)" class="text-dark font-weight-bold mt-2 mb-2 mr-5">
                    Create New Role
                </a>
            </div>
        </div>
    </div>
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class=" container-fluid ">
            <!--begin::Card-->
            @include('alerts.index')
            <form method="post" action="{{ url('admin/users/createrule') }}">
                @csrf
                <div class="row mb-10">
                    <div class="col-md-9">
                        <div class="card card-custom mt-5">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                       <div class="form-group">
                                            <label>Name</label>
                                            <input required type="text" class="form-control" name="name">
                                        </div> 
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Description</label>
                                            <textarea class="form-control" rows="3" name="description"></textarea>
                                        </div> 
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label class="col-form-label text-left col-lg-2 col-sm-12">Is Default?</label>
                                            <div class="col-lg-9 col-md-9 col-sm-12">
                                                <input data-switch="true" type="checkbox" name="is_default" id="isDefault"/>
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
                                                            <input type="checkbox" class="form-check-input permission-item orders" id="createOrder" name="permissions[orders][createOrder]">
                                                            <label class="form-check-label" for="createOrder">Create Order</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input permission-item orders" id="productOrder" name="permissions[orders][productOrder]">
                                                            <label class="form-check-label" for="productOrder">Product Order</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input permission-item orders" id="productinqury" name="permissions[orders][productinqury]">
                                                            <label class="form-check-label" for="productinqury">Product Inquries</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input permission-item orders" id="serviceOrder" name="permissions[orders][serviceOrder]">
                                                            <label class="form-check-label" for="serviceOrder">Service Order</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input permission-item orders" id="incompleteOrder" name="permissions[orders][incompleteOrder]">
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
                                                            <input type="checkbox" class="form-check-input permission-item reports" id="allreports" name="permissions[reports][allreports]">
                                                            <label class="form-check-label" for="allreports">All Reports</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input permission-item reports" id="exportReports" name="permissions[reports][exportReports]">
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
                                                            <input type="checkbox" class="form-check-input permission-item properties" id="allProperties" name="permissions[properties][allProperties]">
                                                            <label class="form-check-label" for="allProperties">All Properties</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input permission-item properties" id="addproperty" name="permissions[properties][addproperty]">
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
                                                            <input type="checkbox" class="form-check-input permission-item productManagement" id="productCategories" name="permissions[productManagement][productCategories]">
                                                            <label class="form-check-label" for="productCategories">Product Categories</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input permission-item productManagement" id="models" name="permissions[productManagement][models]">
                                                            <label class="form-check-label" for="models">Models</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input permission-item productManagement" id="brands" name="permissions[productManagement][brands]">
                                                            <label class="form-check-label" for="brands">Brands</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input permission-item productManagement" id="operatingSystem" name="permissions[productManagement][operatingSystem]">
                                                            <label class="form-check-label" for="operatingSystem">Operating System</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input permission-item productManagement" id="products" name="permissions[productManagement][products]">
                                                            <label class="form-check-label" for="products">Products</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input permission-item productManagement" id="importProducts" name="permissions[productManagement][importProducts]">
                                                            <label class="form-check-label" for="importProducts">Import Products</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input permission-item productManagement" id="collections" name="permissions[productManagement][collections]">
                                                            <label class="form-check-label" for="collections">Collections</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input permission-item productManagement" id="stock" name="permissions[productManagement][stock]">
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
                                                            <input type="checkbox" class="form-check-input permission-item repairManagement" id="categories" name="permissions[repairManagement][categories]">
                                                            <label class="form-check-label" for="categories">Categories</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input permission-item repairManagement" id="models" name="permissions[repairManagement][models]">
                                                            <label class="form-check-label" for="models">Models</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input permission-item repairManagement" id="whatswrong" name="permissions[repairManagement][whatswrong]">
                                                            <label class="form-check-label" for="whatswrong">What's Wrong</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input permission-item repairManagement" id="inquiries" name="permissions[repairManagement][inquiries]">
                                                            <label class="form-check-label" for="inquiries">Inquiries</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input permission-item repairManagement" id="repairstore" name="permissions[repairManagement][repairstore]">
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
                                                            <input type="checkbox" class="form-check-input permission-item sellManagement" id="categories" name="permissions[sellManagement][categories]">
                                                            <label class="form-check-label" for="categories">Catgeories</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input permission-item sellManagement" id="models" name="permissions[sellManagement][models]">
                                                            <label class="form-check-label" for="models">Models</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input permission-item sellManagement" id="questions" name="permissions[sellManagement][questions]">
                                                            <label class="form-check-label" for="questions">Questions</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input permission-item sellManagement" id="inquiries" name="permissions[sellManagement][inquiries]">
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
                                                            <input type="checkbox" class="form-check-input permission-item serviceManagement" id="attribute" name="permissions[serviceManagement][attribute]">
                                                            <label class="form-check-label" for="attribute">Attribute</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input permission-item serviceManagement" id="questions" name="permissions[serviceManagement][questions]">
                                                            <label class="form-check-label" for="questions">Questions</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input permission-item serviceManagement" id="parentservices" name="permissions[serviceManagement][parentservices]">
                                                            <label class="form-check-label" for="parentservices">Parent Services</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input permission-item serviceManagement" id="services" name="permissions[serviceManagement][services]">
                                                            <label class="form-check-label" for="services">Services</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input permission-item serviceManagement" id="providers" name="permissions[serviceManagement][providers]">
                                                            <label class="form-check-label" for="providers">Providers</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input permission-item serviceManagement" id="importproviders" name="permissions[serviceManagement][importproviders]">
                                                            <label class="form-check-label" for="importproviders">Import Providers</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input permission-item serviceManagement" id="plans" name="permissions[serviceManagement][plans]">
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
                                                            <input type="checkbox" class="form-check-input permission-item userManagement" id="allusers" name="permissions[userManagement][allusers]">
                                                            <label class="form-check-label" for="allusers">All Users</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input permission-item userManagement" id="addusers" name="permissions[userManagement][addusers]">
                                                            <label class="form-check-label" for="addusers">Add Users</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input permission-item userManagement" id="alluserrolls" name="permissions[userManagement][alluserrolls]">
                                                            <label class="form-check-label" for="alluserrolls">All User Rolls</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input permission-item userManagement" id="adduserroll" name="permissions[userManagement][adduserroll]">
                                                            <label class="form-check-label" for="adduserroll">Add User Rolls</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input permission-item userManagement" id="company" name="permissions[userManagement][company]">
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
                                                            <input type="checkbox" class="form-check-input permission-item faq" id="categories" name="permissions[faq][categories]">
                                                            <label class="form-check-label" for="categories">Categories</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input permission-item faq" id="allfaq" name="permissions[faq][allfaq]">
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
                                                            <input type="checkbox" class="form-check-input permission-item blog" id="categories" name="permissions[blog][categories]">
                                                            <label class="form-check-label" for="categories">Categories</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input permission-item blog" id="allblog" name="permissions[blog][allblog]">
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
                                                            <input type="checkbox" class="form-check-input permission-item video" id="categories" name="permissions[video][categories]">
                                                            <label class="form-check-label" for="categories">Categories</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input permission-item video" id="allvideo" name="permissions[video][allvideo]">
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
                                                            <input type="checkbox" class="form-check-input permission-item testimonials" id="alltestimonials" name="permissions[testimonials][alltestimonials]">
                                                            <label class="form-check-label" for="alltestimonials">All Testimonials</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input permission-item testimonials" id="addtestimonial" name="permissions[testimonials][addtestimonial]">
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
                                                            <input type="checkbox" class="form-check-input permission-item reviews" id="allreviews" name="permissions[reviews][allreviews]">
                                                            <label class="form-check-label" for="allreviews">All Reviews</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input permission-item testimonials" id="addreviews" name="permissions[testimonials][addreviews]">
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
                                                            <input type="checkbox" class="form-check-input permission-item attachment" id="allattachments" name="permissions[attachment][allattachments]">
                                                            <label class="form-check-label" for="allattachments">All Attachments</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input permission-item attachment" id="addattachment" name="permissions[attachment][addattachment]">
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
                                                            <input type="checkbox" class="form-check-input permission-item emailtemplates" id="allemailtemplate" name="permissions[emailtemplate][allemailtemplates]">
                                                            <label class="form-check-label" for="allemailtemplates">All Email Templates</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input permission-item emailtemplate" id="addemailtemplate" name="permissions[emailtemplate][addemailtemplate]">
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
                                                            <input type="checkbox" class="form-check-input permission-item emailsetting" id="allemailsetting" name="permissions[emailsetting][allemailsetting]">
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
                                                            <input type="checkbox" class="form-check-input permission-item pages" id="allpages" name="permissions[pages][allpages]">
                                                            <label class="form-check-label" for="allpages">All pages</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input permission-item pages" id="addpages" name="permissions[pages][addpages]">
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
                                                            <input type="checkbox" class="form-check-input permission-item sitesetting" id="allsitesetting" name="permissions[sitesetting][allsitesetting]">
                                                            <label class="form-check-label" for="allsitesetting">All Site Setting</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input permission-item sitesetting" id="sitelinks" name="permissions[sitesetting][sitelinks]">
                                                            <label class="form-check-label" for="sitelinks">All Site Links</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input permission-item sitesetting" id="sitelinkscat" name="permissions[sitesetting][sitelinkscat]">
                                                            <label class="form-check-label" for="sitelinkscat">All Site Links Car</label>
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
                                                            <input type="checkbox" class="form-check-input permission-item contactmessages" id="allcontactmessages" name="permissions[contactmessages][allcontactmessages]">
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
                                                            <input type="checkbox" class="form-check-input permission-item myprofile" id="allprofiledetail" name="permissions[myprofile][allprofiledetail]">
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