@extends('admin.layouts.main-layout')
@section('title','Dashboard')
@section('content')
 <!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <div class="d-flex align-items-center flex-wrap mr-2">
                <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">
                    Dashboard
                </h5>
            </div>
        </div>
    </div>
    <!--end::Subheader-->

    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">
            <!--begin::Dashboard-->
            <div class="row mt-10">
                <div class="col-md-3 mb-4">
                    <div class="cards">
                        <div class="card-svg">
                            <a href="">
                                <span class="material-symbols-outlined pending">inventory</span>
                            </a>
                        </div> 
                        <div class="card-tittle">
                            <h4>Pending Artist</h4>
                        </div>
                        <div class="card-number">
                            <h3>12</h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="cards">
                        <div class="card-svg">
                            <a href="">
                                <span class="material-symbols-outlined design_services">group</span>
                            </a>
                        </div>
                        <div class="card-tittle">
                            <h4>Approved Artist</h4>
                        </div>
                        <div class="card-number">
                            <h3>12</h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="cards">
                        <div class="card-svg">
                            <a href="">
                                <span class="material-symbols-outlined check_box">work_update</span>
                            </a>
                        </div>
                        <div class="card-tittle">
                            <h4>Total Jobs Posted and Completed</h4>
                        </div>
                        <div class="card-number">
                            <h3>12</h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="cards">
                        <div class="card-svg">
                            <a href="{{ url('admin/sales/allsale') }}">
                                <span class="material-symbols-outlined point_of_sale">payments</span>
                            </a>
                        </div>
                        <div class="card-tittle">
                            <h4>Total Payments Recieved</h4>
                        </div>
                        <div class="card-number">
                            <h3>12</h3>
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Dashboard-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->
</div>
<!--end::Content-->
<style type="text/css">
    .mb-4, .my-4 {
        margin-bottom: 4rem !important;
        margin-top: -2rem;
    }

    .cards {
        padding: 20px;
        border-radius: 12px;
        background: var(--white, #FFF);
        box-shadow: 0px 4px 20px 0px rgba(0, 0, 0, 0.05);
        border: transparent !important;
    }
    .img {
        vertical-align: middle;
        border-style: none;
    }
    .card-tittle {
        margin-top: 10px;
    }
    .card-tittle h4 {
        font-size: 14px;
        color: #999999;
    }
    .card-number {
        margin-top: 10px;
    }
    .card-number h3 {
        font-size: 20px;
        font-weight: 700;
    }
</style>
@endsection