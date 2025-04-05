@extends('admin.layouts.main-layout')
@section('title','Website Settings')
@section('content')
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <div class="d-flex align-items-center flex-wrap mr-2">
                <h5 class="text-blue font-weight-bold mt-2 mb-2 mr-5">
                    Settings
                </h5>
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <a href="{{ url('admin/dashboard') }}" class="text-blue font-weight-bold mt-2 mb-2 mr-5">
                    Dashboard
                </a>
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <a href="javascript:void(0)" class="text-dark font-weight-bold mt-2 mb-2 mr-5">
                    Settings
                </a>
            </div>
        </div>
    </div>
    <div class="d-flex flex-column-fluid">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <a href="{{ url('admin/website/settings/general') }}" class="card-link">
                        <div class="card text-center shadow-lg">
                            <div class="card-body">
                                <span class="material-icons icon">settings</span>
                                <h5 class="card-title">General Settings</h5>
                                <p class="card-text">Manage your website's general settings such as site title, logo, and more.</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-3">
                    <a href="{{ url('admin/orders/ordertype') }}" class="card-link">
                        <div class="card text-center shadow-lg">
                            <div class="card-body">
                                <span class="material-icons icon">view_list</span>
                                <h5 class="card-title">Order Types</h5>
                                <p class="card-text">Define and manage different order types for your ecommerce platform.</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-3">
                    <a href="{{ url('admin/website/settings/plancarddesign') }}" class="card-link">
                        <div class="card text-center shadow-lg">
                            <div class="card-body">
                                <span class="material-icons icon">style</span>
                                <h5 class="card-title">Plan Card Design</h5>
                                <p class="card-text">Customize the design of your plan cards for better user experience.</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-3">
                    <a href="{{ url('admin/ecommerce/defaultshipping') }}" class="card-link">
                        <div class="card text-center shadow-lg">
                            <div class="card-body">
                                <span class="material-icons icon">local_shipping</span>
                                <h5 class="card-title">Default Shipping</h5>
                                <p class="card-text">Set the default shipping options for your ecommerce platform.</p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="row mt-8">
                <div class="col-md-3">
                    <a href="{{ url('admin/website/settings/shippingcompanies') }}" class="card-link">
                        <div class="card text-center shadow-lg">
                            <div class="card-body">
                                <span class="material-icons icon">local_mall</span>
                                <h5 class="card-title">Shipping Companies</h5>
                                <p class="card-text">Manage shipping Companies and choose the best for your platform.</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-3">
                    <a href="{{ url('admin/website/settings/topnavbar') }}" class="card-link">
                        <div class="card text-center shadow-lg">
                            <div class="card-body">
                                <span class="material-icons icon">menu</span>
                                <h5 class="card-title">Top Navbar</h5>
                                <p class="card-text">Edit and customize your top navigation bar for better user navigation.</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-3">
                    <a href="{{ url('admin/ecommerce/accessoriestype') }}" class="card-link">
                        <div class="card text-center shadow-lg">
                            <div class="card-body">
                                <span class="material-icons icon">inventory</span>
                                <h5 class="card-title">Accesories Type</h5>
                                <p class="card-text">Manage Accesories Type and choose the best for your platform.</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-3">
                    <a href="{{ url('admin/ecommerce/simcard') }}" class="card-link">
                        <div class="card text-center shadow-lg">
                            <div class="card-body">
                                <span class="material-icons icon">sim_card</span>
                                <h5 class="card-title">Sim Card</h5>
                                <p class="card-text">Manage Sim Card and choose the best for your platform.</p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<style type="text/css">
    .card {
        background-color: white;
        border: none;
        border-radius: 10px;
        transition: transform 0.3s ease-in-out;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        padding: 5px;
    }

    .card:hover {
        transform: translateY(-10px);
    }

    .card-body {
        padding: 20px;
    }

    .card-title {
        font-size: 16px;
        font-weight: 700;
        color: #2c3e50;
    }

    .card-text {
        color: #7f8c8d;
        margin-top: 10px;
        font-size: 14px;
    }

    .icon {
        font-size: 40px;
        color: #3498db;
    }

    /* Ensure entire card is clickable */
    .card-link {
        display: block;
        text-decoration: none;
        color: inherit;
    }

    .card-link:hover .card {
        transform: translateY(-10px);
    }
</style>
@endsection