@extends('admin.layouts.main-layout')
@section('title','Ecommerece | Products')
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
                    NEW PRODUCT
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
            <form enctype="multipart/form-data" method="POST" action="{{ url('admin/ecommerce/createproduct') }}">
                @csrf
                <input type="hidden"  name="type" value="buy_products">
                <div class="row">
                    <div class="col-md-9">
                        <div class="accordion accordion-toggle-arrow" id="productdetail">
                            <div class="card card-custom mt-5">
                                <div class="card-header bg-white">
                                    <div class="card-title " data-toggle="collapse" data-target="#collapseOne1">
                                        
                                    <span class="card-label font-weight-bolder text-dark">Product Detail</span>
                                    </div>
                                </div>
                                <div id="collapseOne1" class="collapse show" data-parent="#productdetail">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-12 mb-3">
                                                <div class="form-group">
                                                    <label>Product Name<span class="text-danger">*</span></label>
                                                    <input type="text" placeholder="Enter Product Tittle" class="form-control" name="name" required>
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <div class="form-group">
                                                    <label>Select Brand<span class="text-danger">*</span></label>
                                                    <select class="form-control" required name="brand">
                                                        <option value="">Select Brand</option>
                                                        @foreach(DB::table('brands')->where('status' , 1)->get() as $r)
                                                        <option value="{{ $r->name }}">{{ $r->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <div class="form-group">
                                                    <label>Select Modal<span class="text-danger" >*</span></label>
                                                    <select class="form-control" required name="model" id="model">
                                                        <option value="">Select Modal</option>
                                                        @foreach(DB::table('models')->where('status' , 1)->get() as $r)
                                                        <option value="{{ $r->id }}">{{ $r->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <div class="form-group">
                                                    <label>Select Badge <span class="text-danger">*</span></label>
                                                   <input type="text" id="input-currency" name="badge" required class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <div class="form-group">
                                                    <label>Original Price(in USD) <span class="text-danger">*</span></label>
                                                    <input id="input-currency" name="original_price"  class="form-control"required>
                                                </div>
                                            </div>
                                            <!-- <div class="col-md-4 mb-3">
                                                <div class="form-group">
                                                    <label>Offer Price(in USD) <span class="text-danger">*</span></label>
                                                    <input id="input-currency" name="offer_price"  class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <div class="form-group">
                                                    <label>Sell Price(in USD) <span class="text-danger">*</span></label>
                                                    <input id="input-currency" name="sell_price"  class="form-control" required>
                                                </div>
                                            </div> -->
                                            <div class="col-md-4 mb-3">
                                                <div class="form-group">
                                                    <label>Carrier Compatibility <span class="text-danger">*</span></label>
                                                    <input id="input-currency" name="carrier_compatibility"  class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <div class="form-group">
                                                    <label>Waranty <span class="text-danger">*</span></label>
                                                    <input id="input-currency" name="warranty"  class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="col-md-12 mb-3">
                                                <div class="form-group">
                                                    <label>Notes <span class="text-danger">*</span></label>
                                                    <textarea class="form-control summernote" name="notes" rows="4" required></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>                        
                        <div class="accordion accordion-toggle-arrow" id="networkdetail">
                            <div class="card card-custom mt-5">
                                <div class="card-header bg-white">
                                    <div class="card-title collapsed" data-toggle="collapse" data-target="#collapseOne2">
                                        
                                        <span class="card-label font-weight-bolder text-dark">Network Detail</span>
                                    </div>
                                </div>
                                <div id="collapseOne2" class="collapse" data-parent="#networkdetail">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-4 mb-3">
                                                <div class="form-group">
                                                    <label>Network Technology</label>
                                                    <input type="text" id="input-currency" name="network_technology"  class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <div class="form-group">
                                                    <label>Network 2G Brands</label>
                                                    <input type="text" id="input-currency" name="network_2g_bands"  class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <div class="form-group">
                                                    <label>Network 3G Brands</label>
                                                    <input type="text" id="input-currency" name="network_3g_bands"  class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <div class="form-group">
                                                    <label>Network 4G Brands</label>
                                                    <input type="text" id="input-currency" name="network_4g_bands"  class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <div class="form-group">
                                                    <label>Network 5G Brands</label>
                                                    <input type="text" id="input-currency" name="network_5g_bands"  class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <div class="form-group">
                                                    <label>Network Speed</label>
                                                    <input type="text" id="input-currency" name="network_speed"  class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <div class="form-group">
                                                    <label>Network GPRS</label>
                                                    <input type="text" id="input-currency" name="network_gprs"  class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <div class="form-group">
                                                    <label>Announced</label>
                                                    <input type="date" id="input-currency" name="announced"  class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="accordion accordion-toggle-arrow" id="bodyanddisplydetail">
                            <div class="card card-custom mt-5">
                                <div class="card-header bg-white">
                                    <div class="card-title collapsed" data-toggle="collapse" data-target="#collapsetwo2">
                                        <span class="card-label font-weight-bolder text-dark">Body & Display Detail</span>
                                    </div>
                                </div>
                                <div id="collapsetwo2" class="collapse" data-parent="#bodyanddisplydetail">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-4 mb-3">
                                                <div class="form-group">
                                                    <label>Body Dimensions</label>
                                                    <input type="text" id="input-currency" name="body_dimensions"  class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <div class="form-group">
                                                    <label>Body Weight</label>
                                                    <input type="text" id="input-currency" name="body_weight"  class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <div class="form-group">
                                                    <label>Body Built</label>
                                                    <input type="text" id="input-currency" name="body_built"  class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <div class="form-group">
                                                    <label>Body Keyboard</label>
                                                    <input type="text" id="input-currency" name="body_keyboard"  class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <div class="form-group">
                                                    <label>Body Sim</label>
                                                    <input type="text" id="input-currency" name="body_sim"  class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <div class="form-group">
                                                    <label>Body other</label>
                                                    <input type="text" id="input-currency" name="body_other"  class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <div class="form-group">
                                                    <label>Body other</label>
                                                    <input type="text" id="input-currency" name="body_other"  class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <div class="form-group">
                                                    <label>Display Type</label>
                                                    <input type="text" id="input-currency" name="display_type"  class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <div class="form-group">
                                                    <label>Display Resolution</label>
                                                    <input type="text" id="input-currency" name="display_resolution"  class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <div class="form-group">
                                                    <label>Display Protection</label>
                                                    <input type="text" id="input-currency" name="display_protection"  class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <div class="form-group">
                                                    <label>Display Other</label>
                                                    <input type="text" id="input-currency" name="display_other"  class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="accordion accordion-toggle-arrow" id="platfromandmemory">
                            <div class="card card-custom mt-5">
                                <div class="card-header bg-white">
                                    <div class="card-title collapsed" data-toggle="collapse" data-target="#collapseOne3">
                                        
                                        <span class="card-label font-weight-bolder text-dark">Platform & Memory Detail</span>
                                    </div>
                                </div>
                                <div id="collapseOne3" class="collapse" data-parent="#platfromandmemory">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-4 mb-3">
                                                <div class="form-group">
                                                    <label>Platform OS</label>
                                                    <input type="text" id="input-currency" name="platform_os"  class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <div class="form-group">
                                                    <label>Platform Chipset</label>
                                                    <input type="text" id="input-currency" name="platform_chipset"  class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <div class="form-group">
                                                    <label>Platform CPU</label>
                                                    <input type="text" id="input-currency" name="platform_cpu"  class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <div class="form-group">
                                                    <label>Platform GPU</label>
                                                    <input type="text" id="input-currency" name="platform_gpu"  class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <div class="form-group">
                                                    <label>Memory Phonebook</label>
                                                    <input type="text" id="input-currency" name="memory_phonebook"  class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <div class="form-group">
                                                    <label>Memory Internal</label>
                                                    <input type="text" id="input-currency" name="memory_internal"  class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <div class="form-group">
                                                    <label>Memory Call Records</label>
                                                    <input type="text" id="input-currency" name="memory_call_records"  class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="accordion accordion-toggle-arrow" id="cameradetail">
                            <div class="card card-custom mt-5">
                                <div class="card-header bg-white">
                                    <div class="card-title collapsed" data-toggle="collapse" data-target="#collapseOne4">
                                        
                                        <span class="card-label font-weight-bolder text-dark">Main & Selfi Camera </span>
                                    </div>
                                </div>
                                <div id="collapseOne4" class="collapse" data-parent="#cameradetail">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-4 mb-3">
                                                <div class="form-group">
                                                    <label>Main Camera Single</label>
                                                    <input type="text" id="input-currency" name="main_camera_single"  class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <div class="form-group">
                                                    <label>Main Camera Dual</label>
                                                    <input type="text" id="input-currency" name="main_camera_dual"  class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <div class="form-group">
                                                    <label>Main Camera Triple</label>
                                                    <input type="text" id="input-currency" name="main_camera_triple"  class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <div class="form-group">
                                                    <label>Main Camera Quad</label>
                                                    <input type="text" id="input-currency" name="main_camera_quad"  class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <div class="form-group">
                                                    <label>Main Camera Five</label>
                                                    <input type="text" id="input-currency" name="main_camera_five"  class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <div class="form-group">
                                                    <label>Main Camera Penta</label>
                                                    <input type="text" id="input-currency" name="main_camera_penta"  class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <div class="form-group">
                                                    <label>Main Camera Features</label>
                                                    <input type="text" id="input-currency" name="main_camera_features"  class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <div class="form-group">
                                                    <label>Main Camera Video</label>
                                                    <input type="text" id="input-currency" name="main_camera_video"  class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <div class="form-group">
                                                    <label>Selfie Camera Single</label>
                                                    <input type="text" id="input-currency" name="selfie_camera_single"  class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <div class="form-group">
                                                    <label>Selfie Camera Dual</label>
                                                    <input type="text" id="input-currency" name="selfie_camera_dual"  class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <div class="form-group">
                                                    <label>Selfi Camera Triple</label>
                                                    <input type="text" id="input-currency" name="selfi_camera_triple"  class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <div class="form-group">
                                                    <label>Selfi Camera Quad</label>
                                                    <input type="text" id="input-currency" name="selfi_camera_quad"  class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <div class="form-group">
                                                    <label>Selfi Camera Five</label>
                                                    <input type="text" id="input-currency" name="selfi_camera_five"  class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <div class="form-group">
                                                    <label>Selfi Camera Features</label>
                                                    <input type="text" id="input-currency" name="selfi_camera_features"  class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <div class="form-group">
                                                    <label>Selfi Camera Video</label>
                                                    <input type="text" id="input-currency" name="selfi_camera_video"  class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="accordion accordion-toggle-arrow" id="soundandcomms">
                            <div class="card card-custom mt-5">
                                <div class="card-header bg-white">
                                    <div class="card-title collapsed" data-toggle="collapse" data-target="#collapseOne5">
                                        
                                        <span class="card-label font-weight-bolder text-dark">Sound & Comms Detail </span>
                                    </div>
                                </div>
                                <div id="collapseOne5" class="collapse" data-parent="#soundandcomms">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-4 mb-3">
                                                <div class="form-group">
                                                    <label>Sonud Alert Types</label>
                                                    <input type="text" id="input-currency" name="sound_alert_types"  class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <div class="form-group">
                                                    <label>Sonud Loud Speaker</label>
                                                    <input type="text" id="input-currency" name="sound_loudspeaker"  class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <div class="form-group">
                                                    <label>Sonud 3.5mm Jack</label>
                                                    <input type="text" id="input-currency" name="sound_3.5mm_jack"  class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <div class="form-group">
                                                    <label>Sonud Other</label>
                                                    <input type="text" id="input-currency" name="sound_other"  class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <div class="form-group">
                                                    <label>Comms Wlan</label>
                                                    <input type="text" id="input-currency" name="comms_wlan"  class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <div class="form-group">
                                                    <label>Comms Blutooth</label>
                                                    <input type="text" id="input-currency" name="comms_bluetooth"  class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <div class="form-group">
                                                    <label>Comms GPS</label>
                                                    <input type="text" id="input-currency" name="comms_gps"  class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <div class="form-group">
                                                    <label>Comms Radio</label>
                                                    <input type="text" id="input-currency" name="comms_radio"  class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <div class="form-group">
                                                    <label>Comms USB</label>
                                                    <input type="text" id="input-currency" name="comms_usb"  class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="accordion accordion-toggle-arrow" id="featuresandbattery">
                            <div class="card card-custom mt-5">
                                <div class="card-header bg-white">
                                    <div class="card-title collapsed" data-toggle="collapse" data-target="#collapseOne6">
                                        
                                        <span class="card-label font-weight-bolder text-dark">Features & Battery Detail </span>
                                    </div>
                                </div>
                                <div id="collapseOne6" class="collapse" data-parent="#featuresandbattery">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-4 mb-3">
                                                <div class="form-group">
                                                    <label>Features Sensors</label>
                                                    <input type="text" id="input-currency" name="features_Sensors"  class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <div class="form-group">
                                                    <label>Features Messaging</label>
                                                    <input type="text" id="input-currency" name="features_messaging"  class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <div class="form-group">
                                                    <label>Features Browser</label>
                                                    <input type="text" id="input-currency" name="features_browser"  class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <div class="form-group">
                                                    <label>Features Clock</label>
                                                    <input type="text" id="input-currency" name="features_clock"  class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <div class="form-group">
                                                    <label>Features Alarm</label>
                                                    <input type="text" id="input-currency" name="features_alarm"  class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <div class="form-group">
                                                    <label>Features Games</label>
                                                    <input type="text" id="input-currency" name="features_games"  class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <div class="form-group">
                                                    <label>Features Languages</label>
                                                    <input type="text" id="input-currency" name="features_languages"  class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <div class="form-group">
                                                    <label>Features Java</label>
                                                    <input type="text" id="input-currency" name="features_java"  class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <div class="form-group">
                                                    <label>Features Other</label>
                                                    <input type="text" id="input-currency" name="features_other"  class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <div class="form-group">
                                                    <label>Features Sensors</label>
                                                    <input type="text" id="input-currency" name="features_Sensors"  class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <div class="form-group">
                                                    <label>Battery Other</label>
                                                    <input type="text" id="input-currency" name="battery_other"  class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <div class="form-group">
                                                    <label>Battery Charging</label>
                                                    <input type="text" id="input-currency" name="battery_charging"  class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <div class="form-group">
                                                    <label>Battery Stand By</label>
                                                    <input type="text" id="input-currency" name="battery_stand_by"  class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <div class="form-group">
                                                    <label>Battery Talk Time</label>
                                                    <input type="text" id="input-currency" name="battery_talk_time"  class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <div class="form-group">
                                                    <label>Battery Music Play</label>
                                                    <input type="text" id="input-currency" name="battery_music_play"  class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="accordion accordion-toggle-arrow" id="miscandtest">
                            <div class="card card-custom mt-5">
                                <div class="card-header bg-white">
                                    <div class="card-title collapsed" data-toggle="collapse" data-target="#collapseOne7">
                                        
                                        <span class="card-label font-weight-bolder text-dark">Misc & Tests Detail </span>
                                    </div>
                                </div>
                                <div id="collapseOne7" class="collapse" data-parent="#miscandtest">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-4 mb-3">
                                                <div class="form-group">
                                                    <label>Misc Colors</label>
                                                    <input type="text" id="input-currency" name="misc_colors"  class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <div class="form-group">
                                                    <label>Misc Models</label>
                                                    <input type="text" id="input-currency" name="misc_models"  class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <div class="form-group">
                                                    <label>Misc SAR US</label>
                                                    <input type="text" id="input-currency" name="misc_sar_us"  class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <div class="form-group">
                                                    <label>Misc SAR EU</label>
                                                    <input type="text" id="input-currency" name="misc_sar_eu"  class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <div class="form-group">
                                                    <label>Misc Price Group</label>
                                                    <input type="text" id="input-currency" name="misc_price_group"  class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <div class="form-group">
                                                    <label>Tests Performance</label>
                                                    <input type="text" id="input-currency" name="tests_performance"  class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <div class="form-group">
                                                    <label>Tests Display</label>
                                                    <input type="text" id="input-currency" name="tests_display"  class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <div class="form-group">
                                                    <label>Tests Camera</label>
                                                    <input type="text" id="input-currency" name="tests_camera"  class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <div class="form-group">
                                                    <label>Tests Loudspeaker</label>
                                                    <input type="text" id="input-currency" name="tests_loudspeaker"  class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <div class="form-group">
                                                    <label>Tests Audio Quality</label>
                                                    <input type="text" id="input-currency" name="tests_audio_quality"  class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <div class="form-group">
                                                    <label>Tests Battery Life</label>
                                                    <input type="text" id="input-currency" name="tests_battery_life"  class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card card-custom mt-5 attributecard">
                            <div class="card-header flex-wrap">
                                <div class="card-title">
                                    Attributes
                                </div>
                                <div class="card-toolbar">
                                    <a href="javascript:void(0) collapsed" data-toggle="modal" data-target="#exampleModalCenter" class="btn btn-primary font-weight-bolder mr-2">
                                        Add Variation
                                    </a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="text-center">No Variations</div>
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
                                    <select name="status" id="status" class="form-control">
                                        <option value="1">Enable</option>
                                        <option value="2">Disable</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="card card-custom mt-5">
                            <div class="card-header flex-wrap">
                                <div class="card-title">
                                    Categories
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="tree-checkboxes">
                                   <ul class="list-unstyled">
                                    @foreach(DB::table('categories')->where('category_type' , 'buy')->where('status' , 1)->get() as $r)
                                    <li>
                                      <label class="form-check">
                                      <input required type="radio" value="{{ $r->id }}" name="category_id" class="form-check-input">
                                      <span class="form-check-label">{{ $r->name }}</span>
                                     </label>
                                    </li>
                                    @endforeach
                                   </ul>
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
<div class="modal fade" id="exampleModalCenter" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <form id="addproductvariationform" method="POST" action="{{ url('admin/ecommerce/addproductvariation') }}" class="modal-content">
            @csrf
            <input type="hidden" value="{{ $productid }}" name="product_id">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add variation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <table id="variationTable" class="table table-bordered table-responsive">
                    <thead>
                        <tr>
                            <th>#</th>
                            @foreach(DB::table('attributes')->orderby('id', 'desc')->get() as $a)
                                <th>{{ $a->name }}</th>
                            @endforeach
                            <th>Price</th>
                            <th>QTY</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr id="row1" class="variation-row">
                            <td>1</td>
                            @foreach(DB::table('attributes')->orderby('id', 'desc')->get() as $a)
                                <td>
                                    <select class="form-control" name="{{ strtolower(str_replace(' ', '_', $a->name)) }}[]">
                                        <option value="">Select {{ $a->name }}</option>
                                        @foreach(DB::table('attribute_values')->where('attribute_id', $a->id)->get() as $a_v)
                                            <option value="{{ $a_v->value }}">{{ $a_v->value }}</option>
                                        @endforeach
                                    </select>
                                </td>
                            @endforeach
                            <td>
                                <input type="text" placeholder="Price" class="form-control" name="price[]">
                            </td>
                            <td>
                                <input type="text" placeholder="Qty" class="form-control" name="qty[]">
                            </td>
                            <td>
                                <button type="button" class="btn btn-danger btn-sm" onclick="deleteRow(this)">Delete</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-primary font-weight-bold" onclick="addVariation()">Add</button>
                <button id="addproductvariationbutton" type="submit" class="btn btn-primary font-weight-bold">Save Data</button>
            </div>
        </form>
    </div>
</div>
<style type="text/css">
.accordion .card .card-header .card-title:after {
    right: -4rem;
    font-size: 13px !important;
}
.accordion.accordion-toggle-arrow .card .card-header .card-title{
    width: 685px;
}
</style>
@endsection

@section('script')
<script type="text/javascript">
    function submitbutton(id) {
        $('#submit_type').val(id);
    }
</script>
<script>
    function addVariation() {
        var rowCount = $('#variationTable tbody tr').length + 1;
        var newRow = $('#row1').clone();
        newRow.attr('id', 'row' + rowCount);
        newRow.addClass('variation-row');
        newRow.find('td:first-child').text(rowCount); // Update the first <td> with the new count
        newRow.find('select').each(function () {
            $(this).attr('name', $(this).attr('name') + rowCount);
        });
        newRow.find('input').each(function () {
            $(this).attr('name', $(this).attr('name') + rowCount);
        });
        newRow.find('button').attr('onclick', 'deleteRow(this)'); // Assign delete function to the new delete button
        newRow.find('button').prop('disabled', false); // Ensure the new delete button is enabled
        $('#variationTable tbody').append(newRow);
    }

    function deleteRow(btn) {
        $(btn).closest('tr').remove();
        renumberRows();
    }

    function renumberRows() {
        $('#variationTable tbody tr').each(function(index) {
            $(this).find('td:first-child').text(index + 1);
        });
    }
    $('#addproductvariationform').on('submit',(function(e) {
        $('#addproductvariationbutton').html('<i class="fa fa-spin fa-spinner"></i>');
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            type:'POST',
            url: $(this).attr('action'),
            data:formData,
            cache:false,
            contentType: false,
            processData: false,
            success: function(data){
                $('.attributecard').html(data);
                $('#exampleModalCenter').modal('hide');
                $('#addproductvariationbutton').html('Save Data')
            }
        });
    }));
    $('#model').select2({
        placeholder: "Select",
    });
    $('#status').select2({
        placeholder: "Select",
    });
</script>
@endsection