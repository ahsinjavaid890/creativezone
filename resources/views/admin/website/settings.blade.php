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