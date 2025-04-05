@extends('admin.layouts.main-layout')
@section('title','View Product orders | Orders')
@section('content')
 <!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <div class="d-flex align-items-center flex-wrap mr-2">
                <h5 class="text-blue font-weight-bold mt-2 mb-2 mr-5">
                   View Product Inquriy
                </h5>
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <a href="{{ url('admin/dashboard') }}" class="text-blue font-weight-bold mt-2 mb-2 mr-5">
                    Dashboard
                </a>
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <a href="{{ url('admin/orders/productinqury') }}" class="text-blue font-weight-bold mt-2 mb-2 mr-5">
                    Product Inquriy
                </a>
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <a href="javascript:void(0)" class="text-dark font-weight-bold mt-2 mb-2 mr-5">
                  View Product Inquriy
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
            <div class="row">
                <div class="col-md-8">
                    <div class="card card-custom mt-5">
                        <div class="card-header flex-wrap">
                            <div class="card-title">
                               Inquiry Information # {{ $data->id }}
                            </div>
                           <!--  <div class="card-toolbar">
                                @if($data->status == 1)
                                <a href="javascript:void(0)" class="badge badge-success">Completed</a>
                                @else
                                <a href="javascript:void(0)" class="badge badge-success">order_confirm</a>
                                @endif
                            </div> -->
                        </div>
                        @php
                            $product = DB::table('buy_products')->where('id' , $data->product_id)->first();
                        @endphp
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text-center">Image</th>
                                        <th class="text-center">Name</th>
                                        <th class="text-center">Best Find</th>
                                        <th class="text-center">Storage</th>
                                        <th class="text-center">Color</th>
                                        <th class="text-center">Condition</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $image = DB::table('gallary_images')->where('object_id', $product->id)->first();
                                        $imagesArray = json_decode($product->images, true);
                                        $firstImage = $imagesArray[0] ?? null;
                                        @endphp
                                            
                                    <tr class="data_table">
                                        <td class="text-center">
                                            @if($image)
                                            <img src="{{ url('public/images') }}/{{ $image->image }}" class="image-thumbnail" width="50">
                                            @elseif($product->type == 'accessories') <!-- Use == for comparison -->
                                            <img src="{{ url('public/images') }}/{{ $firstImage }}" width="50" alt="Image">
                                            @endif
                                        </td>
                                        <td>
                                            @if($data->storage)
                                            <a href="{{ url('admin/ecommerce/editproduct') }}/{{ $product->id }}">{{ $product->name }}</a>
                                            @elseif($product->type == 'accessories') <!-- Use == for comparison -->
                                            <a href="{{ url('admin/ecommerce/editproduct') }}/{{ $product->id }}">{{ $product->name }}</a>
                                            @endif
                                        </td>
                                        <td>
                                            {{ $data->best_find }}
                                        </td>
                                        <td>
                                            {{ $data->storage }}
                                        </td>
                                        <td>
                                            {{ $data->color }}
                                        </td>
                                        <td>
                                            {{ $data->condition }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mt-5 shadow-lg rounded">
                        <!-- Card Header -->
                        <div class="card-header-custom bg-gradient-primary p-3">
                            <h5 class="mb-0">Customer Information</h5>
                        </div>
                        
                        <!-- Card Body 1: Customer Details -->
                        <div class="card-body-custom border-bottom p-4">
                            <div class="customer_detail">
                                <div class="customer_name mb-3">
                                    <h6 class="mb-1"><i class="fas fa-user-circle text-gradient-primary me-2 mr-2"></i><b>{{ $data->name }}</b></h6>
                                </div>
                                <div class="customer_email mb-2">
                                    <i class="fas fa-envelope text-gradient-primary me-2"></i>
                                    <a href="mailto:{{ $data->email }}" class="text-decoration-none">{{ $data->email }}</a>
                                </div>
                                <div class="customer_phone mb-3">
                                    <i class="fas fa-phone-alt text-gradient-primary me-2"></i>
                                    <a href="tel:{{ $data->phonenumber }}" class="text-decoration-none">{{ $data->phone }}</a>
                                </div>
                                <div class="customer_address mb-2">
                                    <i class="fas fa-map-marker-alt text-gradient-primary me-2"></i>
                                    <p class="d-inline">{{ $data->address }}</p>
                                </div>
                                <div class="seeonmap mt-3">
                                    <a href="https://www.google.com/maps/search/?api=1&query={{ urlencode($data->address) }}" class="btn-custom btn-map" target="_blank">
                                        <i class="fas fa-map-pin me-1"></i> See on Google Maps
                                    </a>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<style type="text/css">
    .extra_data td{
        border: 0;
    }
    .data_table td{
        border-top: 0;
        border-bottom: 1px solid #EBEDF3;
    }
    .steps-vertical {
        --bb-steps-dot-offset: 6px;
        flex-direction: column;
    }
    .steps {
        --bb-steps-color: #206bc4;
        --bb-steps-inactive-color: #dce1e7;
        --bb-steps-dot-size: .5rem;
        --bb-steps-border-width: 2px;
        display: flex;
        flex-wrap: nowrap;
        list-style: none;
        margin: 0;
        padding: 0;
        width: 100%;
    }
    .steps-vertical .step-item {
        min-height: auto;
        padding-left: calc(var(--bb-steps-dot-size) + 1rem);
        padding-top: 0;
        text-align: left;
    }
    .step-item {
        color: inherit;
        cursor: default;
        flex: 1 1 0;
        margin-top: 0;
        min-height: 1rem;
        padding-top: calc(var(--bb-steps-dot-size));
        position: relative;
        text-align: center;
    }
    .steps-vertical .step-item:before {
        left: 0;
        top: var(--bb-steps-dot-offset);
        transform: translate(0);
    }
    .step-item:before {
        align-items: center;
        border-radius: 100rem;
        box-sizing: content-box;
        color: #fff;
        content: "";
        display: flex;
        height: var(--bb-steps-dot-size);
        justify-content: center;
        left: 50%;
        position: absolute;
        top: 0;
        transform: translateX(-50%);
        width: var(--bb-steps-dot-size);
        z-index: 1;
    }
    .step-item:after, .step-item:before {
        background: #206bc4;
    }
    .steps-vertical .step-item:not(:last-child):after {
        content: "";
        height: calc(100% + 1rem);
        left: calc(var(--bb-steps-dot-size)* .5);
        position: absolute;
        top: var(--bb-steps-dot-offset);
        transform: translateX(-50%);
        width: var(--bb-steps-border-width);
    }
    .step-item:not(:last-child):after {
        content: "";
        left: 50%;
        position: absolute;
        transform: translateY(-50%);
        width: 100%;
    }
    .step-item:after {
        height: var(--bb-steps-border-width);
        top: calc(var(--bb-steps-dot-size)* .5);
    }
    .select2-container{
        width: 100% !important;
    }
</style>
@endsection
@section('script')

@endsection