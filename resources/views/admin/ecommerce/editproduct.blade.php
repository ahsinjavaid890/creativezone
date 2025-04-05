@extends('admin.layouts.main-layout')
@section('title','Ecommerece | Products')
@section('content')
 <!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <div class="d-flex align-items-center flex-wrap mr-2">
                <h5 class="text-blue font-weight-bold mt-2 mb-2 mr-5">
                    Update PRODUCT
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
                    Update PRODUCT : <b class="text-danger">{{ $product->name }}</b>
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
            <form enctype="multipart/form-data" method="POST" action="{{ url('admin/ecommerce/updateproduct') }}">
                @csrf
                <input type="hidden" value="{{ $product->id }}" name="id">
                <input type="hidden" value="{{ $product->type }}" name="type">
                <div class="row">
                    <div class="col-md-9">
                        <div class="accordion accordion-toggle-arrow" id="productdetail">
                            <div class="card card-custom mt-5">
                                <div class="card-header bg-white">
                                    <div class="card-title collapsed" data-toggle="collapse" data-target="#collapseOne1">
                                        
                                    <span class="card-label font-weight-bolder text-dark">Product Detail</span>
                                    </div>
                                </div>
                                <div id="collapseOne1" class="collapse show" data-parent="#productdetail">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <label>Product Name</label>
                                                    <input value="{{ $product->name }}" type="text" placeholder="Enter Product Tittle" class="form-control" name="name">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Select Badge</label>
                                                    <input type="text" name="badge" value="{{ $product->badge }}" class="form-control"
                                                    id="input-currency">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Select Brand</label>
                                                    <select class="form-control"  name="brand">
                                                        <option value="">Select Brand</option>
                                                        @foreach(DB::table('brands')->where('status' , 1)->get() as $r)
                                                        <option @if($product->brand == $r->name ) selected @endif  value="{{ $r->name }}">{{ $r->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Select Modal</label>
                                                    <select class="form-control"  name="model" id="model">
                                                        <option value="">Select Modal</option>
                                                        @foreach(DB::table('models')->where('status' , 1)->get() as $r)
                                                        <option  @if($product->model == $r->id ) selected @endif  value="{{ $r->id }}">{{ $r->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Original Price(in USD)</label>
                                                    <input id="input-currency" name="original_price" value="{{ $product->original_price }}" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Offer Price(in USD)</label>
                                                    <input id="input-currency" name="offer_price" value="{{ $product->offer_price }}"  class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Sell Price(in USD)</label>
                                                    <input id="input-currency"  value="{{ $product->sell_price }}"name="sell_price"  class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Carrier Compatibility <span class="text-danger">*</span></label>
                                                    <input id="input-currency" name="carrier_compatibility"  class="form-control" value="{{ $product->carrier_compatibility }}">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Waranty <span class="text-danger">*</span></label>
                                                    <input id="input-currency" name="warranty"  class="form-control" value="{{ $product->warranty }}">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Colors</label>
                                                    <input type="text" id="input-currency" name="misc_colors"  value="{{$product->misc_colors }}" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Storage</label>
                                                    <input type="text" name="storage"  value="{{ $product->storage }}" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Notes</label>
                                                    <textarea class="form-control summernote" name="notes" rows="4">
                                                        {{ $product->notes }}
                                                    </textarea>
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
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Network Technology</label>
                                                    <input type="text" id="input-currency" name="network_technology"  value="{{ $product->network_technology }}" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Network 2G Brands</label>
                                                    <input type="text" id="input-currency" name="network_2g_bands"  value="{{ $product->network_2g_bands }}" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Network 3G Brands</label>
                                                    <input type="text" id="input-currency" name="network_3g_bands"  value="{{ $product->network_3g_bands }}" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Network 4G Brands</label>
                                                    <input type="text" id="input-currency" name="network_4g_bands"  value="{{ $product->network_4g_bands }}" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Network 5G Brands</label>
                                                    <input type="text" id="input-currency" name="network_5g_bands"  value="{{ $product->network_5g_bands }}" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Network Speed</label>
                                                    <input type="text" id="input-currency" name="network_speed"  value="{{ $product->network_speed }}" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Network GPRS</label>
                                                    <input type="text" id="input-currency" name="network_gprs"  value="{{ $product->network_gprs }}" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Announced</label>
                                                    <input type="date" id="input-currency" name="announced"  value="{{ $product->announced }}" class="form-control">
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
                                    <div class="card-title collapsed" data-toggle="collapse" data-target="#bodyanddisplydetailcollapse">
                                        
                                        <span class="card-label font-weight-bolder text-dark">Body & Display Detail</span>
                                    </div>
                                </div>
                                <div id="bodyanddisplydetailcollapse" class="collapse" data-parent="#bodyanddisplydetail">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Body Dimensions</label>
                                                    <input type="text" id="input-currency" name="body_dimensions"  value="{{ $product->body_dimensions }}" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Body Weight</label>
                                                    <input type="text" id="input-currency" name="body_weight"  value="{{ $product->body_weight }}" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Body Built</label>
                                                    <input type="text" id="input-currency" name="body_built"  value="{{ $product->body_built }}" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Body Keyboard</label>
                                                    <input type="text" id="input-currency" name="body_keyboard"  value="{{ $product->body_keyboard }}" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Body Sim</label>
                                                    <input type="text" id="input-currency" name="body_sim"  value="{{ $product->body_sim }}" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Body other</label>
                                                    <input type="text" id="input-currency" name="body_other"  value="{{ $product->body_other }}" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Body other</label>
                                                    <input type="text" id="input-currency" name="body_other"  value="{{ $product->body_other }}" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Display Type</label>
                                                    <input type="text" id="input-currency" name="display_type"  value="{{ $product->display_type }}" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Display Resolution</label>
                                                    <input type="text" id="input-currency" name="display_resolution"  value="{{ $product->display_resolution }}" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Display Protection</label>
                                                    <input type="text" id="input-currency" name="display_protection"  value="{{ $product->display_protection }}" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Display Other</label>
                                                    <input type="text" id="input-currency" name="display_other"  value="{{ $product->display_other }}" class="form-control">
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
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Platform OS</label>
                                                    <input type="text" id="input-currency" name="platform_os"  value="{{ $product->platform_os }}" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Platform Chipset</label>
                                                    <input type="text" id="input-currency" name="platform_chipset"  value="{{ $product->platform_chipset }}" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Platform CPU</label>
                                                    <input type="text" id="input-currency" name="platform_cpu"  value="{{ $product->platform_cpu }}" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Platform GPU</label>
                                                    <input type="text" id="input-currency" name="platform_gpu"  value="{{ $product->platform_gpu }}" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Memory Phonebook</label>
                                                    <input type="text" id="input-currency" name="memory_phonebook"  value="{{ $product->memory_phonebook }}" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Memory Internal</label>
                                                    <input type="text" id="input-currency" name="memory_internal"  value="{{ $product->memory_internal }}" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Memory Call Records</label>
                                                    <input type="text" id="input-currency" name="memory_call_records"  value="{{ $product->memory_call_records }}" class="form-control">
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
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Main Camera Single</label>
                                                    <input type="text" id="input-currency" name="main_camera_single"  value="{{ $product->main_camera_single }}" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Main Camera Dual</label>
                                                    <input type="text" id="input-currency" name="main_camera_dual"  value="{{ $product->main_camera_dual }}" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Main Camera Triple</label>
                                                    <input type="text" id="input-currency" name="main_camera_triple"  value="{{ $product->main_camera_triple }}" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Main Camera Quad</label>
                                                    <input type="text" id="input-currency" name="main_camera_quad"  value="{{ $product->main_camera_quad }}" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Main Camera Five</label>
                                                    <input type="text" id="input-currency" name="main_camera_five"  value="{{ $product->main_camera_five }}" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Main Camera Penta</label>
                                                    <input type="text" id="input-currency" name="main_camera_penta"  value="{{ $product->main_camera_penta }}" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Main Camera Features</label>
                                                    <input type="text" id="input-currency" name="main_camera_features"  value="{{ $product->main_camera_features }}" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Main Camera Video</label>
                                                    <input type="text" id="input-currency" name="main_camera_video"  value="{{ $product->main_camera_video }}" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Selfie Camera Single</label>
                                                    <input type="text" id="input-currency" name="selfie_camera_single"  value="{{ $product->selfie_camera_single }}" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Selfie Camera Dual</label>
                                                    <input type="text" id="input-currency" name="selfie_camera_dual"  value="{{ $product->selfie_camera_dual }}" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Selfi Camera Triple</label>
                                                    <input type="text" id="input-currency" name="selfi_camera_triple"  value="{{ $product->selfi_camera_triple }}" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Selfi Camera Quad</label>
                                                    <input type="text" id="input-currency" name="selfi_camera_quad"  value="{{ $product->selfi_camera_quad }}" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Selfi Camera Five</label>
                                                    <input type="text" id="input-currency" name="selfi_camera_five"  value="{{ $product->selfi_camera_five }}" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Selfi Camera Features</label>
                                                    <input type="text" id="input-currency" name="selfi_camera_features"  value="{{ $product->selfi_camera_features }}" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Selfi Camera Video</label>
                                                    <input type="text" id="input-currency" name="selfi_camera_video"  value="{{ $product->selfi_camera_video }}" class="form-control">
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
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Sonud Alert Types</label>
                                                    <input type="text" id="input-currency" name="sound_alert_types"  value="{{ $product->sound_alert_types }}" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Sonud Loud Speaker</label>
                                                    <input type="text" id="input-currency" name="sound_loudspeaker"  value="{{ $product->sound_loudspeaker }}" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Sonud 3.5mm Jack</label>
                                                    <input type="text" id="input-currency" name="sound_3.5mm_jack"  value="{{ $product->sound_35mm_jack }}" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Sonud Other</label>
                                                    <input type="text" id="input-currency" name="sound_other"  value="{{ $product->sound_other }}" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Comms Wlan</label>
                                                    <input type="text" id="input-currency" name="comms_wlan"  value="{{ $product->comms_wlan }}" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Comms Blutooth</label>
                                                    <input type="text" id="input-currency" name="comms_bluetooth"  value="{{ $product->comms_bluetooth }}" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Comms GPS</label>
                                                    <input type="text" id="input-currency" name="comms_gps"  value="{{ $product->comms_gps }}" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Comms Radio</label>
                                                    <input type="text" id="input-currency" name="comms_radio"  value="{{ $product->comms_radio }}" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Comms USB</label>
                                                    <input type="text" id="input-currency" name="comms_usb"  value="{{ $product->comms_usb }}" class="form-control">
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
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Features Sensors</label>
                                                    <input type="text" id="input-currency" name="features_Sensors"  value="{{ $product->features_Sensors }}" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Features Messaging</label>
                                                    <input type="text" id="input-currency" name="features_messaging"  value="{{ $product->features_messaging }}" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Features Browser</label>
                                                    <input type="text" id="input-currency" name="features_browser"  value="{{ $product->features_browser }}" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Features Clock</label>
                                                    <input type="text" id="input-currency" name="features_clock"  value="{{ $product->features_clock }}" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Features Alarm</label>
                                                    <input type="text" id="input-currency" name="features_alarm"  value="{{ $product->features_alarm }}" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Features Games</label>
                                                    <input type="text" id="input-currency" name="features_games"  value="{{ $product->features_games }}" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Features Languages</label>
                                                    <input type="text" id="input-currency" name="features_languages"  value="{{ $product->features_languages }}" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Features Java</label>
                                                    <input type="text" id="input-currency" name="features_java"  value="{{ $product->features_java }}" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Features Other</label>
                                                    <input type="text" id="input-currency" name="features_other"  value="{{ $product->features_other }}" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Features Sensors</label>
                                                    <input type="text" id="input-currency" name="features_Sensors"  value="{{ $product->features_Sensors }}" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Battery Other</label>
                                                    <input type="text" id="input-currency" name="battery_other"  value="{{ $product->battery_other }}" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Battery Charging</label>
                                                    <input type="text" id="input-currency" name="battery_charging"  value="{{ $product->battery_charging }}" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Battery Stand By</label>
                                                    <input type="text" id="input-currency" name="battery_stand_by"  value="{{ $product->battery_stand_by }}" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Battery Talk Time</label>
                                                    <input type="text" id="input-currency" name="battery_talk_time"  value="{{ $product->battery_talk_time }}" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Battery Music Play</label>
                                                    <input type="text" id="input-currency" name="battery_music_play"  value="{{ $product->battery_music_play }}" class="form-control">
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
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Misc Models</label>
                                                    <input type="text" id="input-currency" name="misc_models"  value="{{ $product->misc_models }}" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Misc SAR US</label>
                                                    <input type="text" id="input-currency" name="misc_sar_us"  value="{{ $product->misc_sar_us }}" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Misc SAR EU</label>
                                                    <input type="text" id="input-currency" name="misc_sar_eu"  value="{{ $product->misc_sar_eu }}" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Misc Price Group</label>
                                                    <input type="text" id="input-currency" name="misc_price_group"  value="{{ $product->misc_price_group }}" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Tests Performance</label>
                                                    <input type="text" id="input-currency" name="tests_performance"  value="{{ $product->tests_performance }}" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Tests Display</label>
                                                    <input type="text" id="input-currency" name="tests_display"  value="{{ $product->tests_display }}" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Tests Camera</label>
                                                    <input type="text" id="input-currency" name="tests_camera"  value="{{ $product->tests_camera }}" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Tests Loudspeaker</label>
                                                    <input type="text" id="input-currency" name="tests_loudspeaker"  value="{{ $product->tests_loudspeaker }}" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Tests Audio Quality</label>
                                                    <input type="text" id="input-currency" name="tests_audio_quality"  value="{{ $product->tests_audio_quality }}" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Tests Battery Life</label>
                                                    <input type="text" id="input-currency" name="tests_battery_life"  value="{{ $product->tests_battery_life }}" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <style type="text/css">
                            .table th, .table td {
                                font-size: 13px;
                                line-height: 1.25;
                                padding: 5px !important;
                                text-align: center;
                                vertical-align:middle !important;
                            }
                        </style>
                        <div class="card card-custom mt-5 attributecard">
                            <div class="card-header flex-wrap">
                                <div class="card-title">
                                    Variations
                                </div>
                                <div class="card-toolbar">
                                    <a href="javascript:void(0) collapsed" data-toggle="modal" data-target="#generateall" class="btn btn-primary font-weight-bolder mr-2 btn-sm">
                                        Generate All
                                    </a>
                                    <a href="javascript:void(0) collapsed" data-toggle="modal" data-target="#importvariations" class="btn btn-primary font-weight-bolder mr-2 btn-sm">
                                        Add Or Update Via Excel
                                    </a>
                                    <a href="{{ url('admin/ecommerce/exportvariations') }}/{{ $product->id }}" class="btn btn-primary font-weight-bolder mr-2 btn-sm">
                                        Export Variations
                                    </a>
                                    <a href="javascript:void(0) collapsed" data-toggle="modal" data-target="#addvariationmodal" class="btn btn-primary font-weight-bolder mr-2 btn-sm">
                                        Add Variation
                                    </a>
                                    @if(DB::table('product_variations')->where('product_id' , $product->id)->exists())
                                    <a href="javascript:void(0);" onclick='confirmvariationDelete("{{ url('admin/ecommerce/deleteproductvariation') }}/{{ $product->id }}")' class="btn btn-danger font-weight-bolder mr-2 btn-sm">
                                        Delete Variations
                                    </a>
                                    @endif
                                </div>
                            </div>
                            <div class="card-body table-responsive" style="height: 350px;overflow: auto;">
                                <table class="table table-bordered table-responsive">
                                    <thead>
                                        <tr>
                                            <th>Carrier<br><input class="form-control" type="text" id="bestFindSearch" placeholder="Search"></th>
                                            <th>Condition<br><input type="text" class="form-control" id="conditionSearch" placeholder="Search"></th>
                                            <th>Storage<br><input type="text" class="form-control" id="storageSearch" placeholder="Search"></th>
                                            <th>Color<br><input type="text" class="form-control" id="colorSearch" placeholder="Search"></th>
                                            <th>Price<br><input type="text" class="form-control" id="priceSearch" placeholder="Search"></th>
                                            <th>QTY<br><input type="text" class="form-control" id="qtySearch" placeholder="Search"></th>
                                            <th>Operations</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($variations as $variation)
                                            <tr  id="stockRow_{{ $variation->id }}">
                                                <td>{{ $variation->best_find }}</td>
                                                <td>{{ $variation->condition }}</td>
                                                <td>{{ $variation->storage }}</td>
                                                <td>{{ $variation->color }}</td>
                                                <td class="stock-price">${{ $variation->price }}</td>
                                                <td class="stock-quantity">{{ $variation->qty }}</td>
                                                <td>
                                                    <a href="javascript:void(0);" data-id="{{ $variation->id }}" class="btn btn-icon btn-light btn-hover-primary btn-sm mx-3 edit-stock-btn">
                                                       <span class="material-symbols-outlined">edit</span>
                                                    </a>
                                                    <a href="javascript::void(0)" onclick='confirmDelete("{{ url('admin/ecommerce/deletestock') }}/{{ $variation->id }}")' class="btn btn-icon btn-light btn-hover-primary btn-sm mx-3">
                                                      <span class="material-symbols-outlined">delete</span>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card card-custom mt-5">
                            <div class="card-header flex-wrap">
                                <div class="card-title">
                                    Product Images
                                </div>
                                <div class="card-toolbar">
                                    <a href="javascript:void(0) collapsed" data-toggle="modal" data-target="#exampleModalCenter" class="btn btn-primary font-weight-bolder">
                                        <i class="ki ki-plus icon-1x mr-2"></i> Add New Image
                                    </a>
                                </div>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="text-center">
                                                #
                                            </th>
                                            <th class="text-center">Image</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach(DB::table('gallary_images')->where('object_id' , $product->id)->where('type' , 'product_buy')->get() as $key => $r)
                                            <tr>
                                                <td class="text-center">
                                                    {{ $key+1 }}
                                                </td>
                                                <td class="text-center">
                                                    <img src="{{ url('public/images') }}/{{ $r->image }}" width="50">
                                                </td>
                                                <td class="text-center pr-0">
                                                   <a href="javascript:void(0);" onclick='confirmDelete("{{ url('admin/ecommerce/deleteproductimage') }}/{{ $r->id }}")' class="btn btn-icon btn-light btn-hover-primary btn-sm">
                                                      <span class="material-symbols-outlined">delete</span>
                                                   </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
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
                                        <button onclick="submitbutton('addmore')" type="submit" class="btn btn-primary">Update</button>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-12">
                                        <button onclick="submitbutton('exit')" type="submit" class="btn btn-primary">Update & Exit</button>
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
                                    <select name="status" id="status" class="form-control">
                                        <option @if($product->status == 1) selected @endif value="1">Enable</option>
                                        <option @if($product->status == 2) selected @endif value="2">Disabled</option>
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
                                          <input @if($product->category_id == $r->id) checked @endif  type="radio" value="{{ $r->id }}" name="category_id" class="form-check-input">
                                          <span class="form-check-label">{{ $r->name }}</span>
                                         </label>
                                        </li>
                                    @endforeach
                                   </ul>
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



<div class="modal fade" id="addvariationmodal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <form id="addproductvariationform" method="POST" action="{{ url('admin/ecommerce/addproductvariation') }}" class="modal-content">
            @csrf
            <input type="hidden" value="{{ $product->id }}" name="product_id">
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



<div class="modal fade" id="importvariations" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <form id="importvariationsform" enctype="multipart/form-data"  method="POST" action="{{ url('admin/ecommerce/importvariations') }}" class="modal-content">
            @csrf
            <input type="hidden" name="object_id" value="{{ $product->id }}">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Or Update Variations Using Excel</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Select File</label>
                    <input  type="file" class="form-control" name="file">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
                <button id="importvariationsformbutton" type="submit" class="btn btn-primary font-weight-bold">Save</button>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="generateall" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <form id="generateallvariations" enctype="multipart/form-data"  method="POST" action="{{ url('admin/ecommerce/generateallvariations') }}" class="modal-content">
            @csrf
            <input type="hidden" name="object_id" value="{{ $product->id }}">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Generate All Variations</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Attribute</th>
                            <th>Value</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach(DB::table('attributes')->get() as $r)
                        <tr>
                            <td>{{ $r->name }}</td>
                            <td>
                                @if($r->name == 'Color')
                                <div class="form-group">
                                    <select name="attributevalues[]" id="variationcolors" multiple class="form-control">
                                        <option>Select Color</option>
                                        @foreach(DB::table('attribute_values')->where('attribute_id', $r->id)->get() as $index => $v)
                                        <option value="{{ $v->id }}" name="attributevalues[]" @if(in_array($v->value, explode(',',$product->misc_colors))) selected @endif>{{ $v->value }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @else
                                <div class="d-flex flex-wrap">
                                    @foreach(DB::table('attribute_values')->where('attribute_id', $r->id)->get() as $index => $v)
                                        <div class="d-flex align-items-center mr-4 mb-2">
                                            <input 
                                                type="checkbox" 
                                                value="{{ $v->id }}" 
                                                name="attributevalues[]" 
                                                id="checkbox-{{ $r->id }}-{{ $index }}" @if($r->id == 2) checked @endif  @if($r->id == 11) checked @endif
                                                @if(in_array($v->value, explode(',', $product->misc_colors))) checked @endif

                                                @if(in_array($v->value, explode(',', $product->storage))) checked @endif
                                            >
                                            <label for="checkbox-{{ $r->id }}-{{ $index }}" class="ml-2 mb-0">{{ $v->value }}</label>
                                        </div>
                                    @endforeach
                                </div>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
                <button id="importvariationsformbutton" type="submit" class="btn btn-primary font-weight-bold">Save</button>
            </div>
        </form>
    </div>
</div>



<div class="modal fade" id="exampleModalCenter" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <form enctype="multipart/form-data"  method="POST" action="{{ url('admin/ecommerce/addproductimage') }}" class="modal-content">
            @csrf
            <input type="hidden" name="object_id" value="{{ $product->id }}">
            <input type="hidden" name="type" value="product_buy">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Product Image</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Select Image</label>
                    <input multiple  type="file" class="form-control" name="images[]">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary font-weight-bold">Add</button>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="editStockModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <div class="modal-content" id="editStockModalBody">
            
        </div>
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript">
$('#variationcolors').select2({
    placeholder: "Select",
});
function submitbutton(id) {
    $('#submit_type').val(id);
}
function confirmDelete(url) {
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = url;
        }
    })
}
    function addVariation() {
        var rowCount = $('#variationTable tbody tr').length + 1;
        var newRow = $('#row1').clone();
        newRow.attr('id', 'row' + rowCount);
        newRow.addClass('variation-row');
        newRow.find('td:first-child').text(rowCount);
        newRow.find('select').each(function () {
            $(this).attr('name', $(this).attr('name') + rowCount);
        });
        newRow.find('input').each(function () {
            $(this).attr('name', $(this).attr('name') + rowCount);
        });
        newRow.find('button').attr('onclick', 'deleteRow(this)'); 
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
                $('#addvariationmodal').modal('hide');
                $('#addproductvariationbutton').html('Save Data')
            }
        });
    }));
    $('#importvariationsform').on('submit',(function(e) {
        $('#importvariationsformbutton').html('<i class="fa fa-spin fa-spinner"></i>');
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
                $('#importvariations').modal('hide');
                $('#importvariationsformbutton').html('Save')
            }
        });
    }));
</script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<script>
    $(document).ready(function() {
        // Function to collect unique values from a column
        function getUniqueColumnValues(columnIndex) {
            var values = [];
            $('tbody tr').each(function() {
                var value = $(this).find('td:nth-child(' + columnIndex + ')').text().trim().toLowerCase();
                if (value && values.indexOf(value) === -1) {
                    values.push(value);
                }
            });
            return values;
        }

        // Initialize autocomplete for Best Find input
        $('#bestFindSearch').autocomplete({
            source: getUniqueColumnValues(1) // Best Find is in the 1st column
        });

        // Initialize autocomplete for Condition input
        $('#conditionSearch').autocomplete({
            source: getUniqueColumnValues(2) // Condition is in the 2nd column
        });

        // Initialize autocomplete for Storage input
        $('#storageSearch').autocomplete({
            source: getUniqueColumnValues(3) // Storage is in the 3rd column
        });

        // Initialize autocomplete for Color input
        $('#colorSearch').autocomplete({
            source: getUniqueColumnValues(4) // Color is in the 4th column
        });

        // Initialize autocomplete for Price input
        $('#priceSearch').autocomplete({
            source: getUniqueColumnValues(5) // Price is in the 5th column
        });

        // Initialize autocomplete for QTY input
        $('#qtySearch').autocomplete({
            source: getUniqueColumnValues(6) // QTY is in the 6th column
        });

        // Function to filter the table based on input values (same as before)
        function filterTable() {
            $('tbody tr').each(function() {
                var row = $(this);
                var bestFind = row.find('td:nth-child(1)').text().toLowerCase();
                var condition = row.find('td:nth-child(2)').text().toLowerCase();
                var storage = row.find('td:nth-child(3)').text().toLowerCase();
                var color = row.find('td:nth-child(4)').text().toLowerCase();
                var price = row.find('td:nth-child(5)').text().toLowerCase();
                var qty = row.find('td:nth-child(6)').text().toLowerCase();

                var bestFindVal = $('#bestFindSearch').val().toLowerCase();
                var conditionVal = $('#conditionSearch').val().toLowerCase();
                var storageVal = $('#storageSearch').val().toLowerCase();
                var colorVal = $('#colorSearch').val().toLowerCase();
                var priceVal = $('#priceSearch').val().toLowerCase();
                var qtyVal = $('#qtySearch').val().toLowerCase();

                if (bestFind.indexOf(bestFindVal) > -1 &&
                    condition.indexOf(conditionVal) > -1 &&
                    storage.indexOf(storageVal) > -1 &&
                    color.indexOf(colorVal) > -1 &&
                    price.indexOf(priceVal) > -1 &&
                    qty.indexOf(qtyVal) > -1) {
                    row.show();
                } else {
                    row.hide();
                }
            });
        }

        // Attach keyup event listeners to all search input fields for filtering
        $('#bestFindSearch, #conditionSearch, #storageSearch, #colorSearch, #priceSearch, #qtySearch').on('keyup', function() {
            filterTable();
        });
    });
</script>
<script>
$(document).on('click', '.edit-stock-btn', function(e) {
    e.preventDefault();
    var id = $(this).data('id');
    $.ajax({
        url: '{{ url("admin/ecommerce/editstock") }}/' + id,
        type: 'GET',
        success: function(response) {
            $('#editStockModalBody').html(response);
            $('#editStockModal').modal('show');
        },
        error: function(xhr) {
            alert('Error loading data.');
        }
    });
});
</script>
<script type="text/javascript">
$(document).on('submit', '#editStockForm', function(e) {
    e.preventDefault(); 
    var bestFind = $('.best_findvalue').val();
    var condition = $('.conditionvalue').val();
    var color = $('.colorvalue').val();
    var storage = $('.storagevalue').val();
    var product_idvalue = $('.product_idvalue').val();
    var variation_id = $('.variation_id').val();
    var price = $('#price').val();
    var qty = $('#qty').val();

    $.ajax({
        url: '{{ url("admin/ecommerce/updatestock") }}', 
        type: 'POST',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            best_find: bestFind,
            condition: condition,
            color: color,
            storage: storage,
            product_id: product_idvalue,
            variation_id: variation_id,
            price: price,
            qty: qty
        },
        success: function(response) {
            if (response.message) {
                $('#editStockModal').modal('hide');
                var row = $('#stockRow_' + response.data.id);
                row.find('.stock-quantity').text(response.data.qty);
                row.find('.stock-price').text('$'+response.data.price+'.00');
                Swal.fire({
                    title: 'Stock Updated',
                    text: 'The stock has been successfully updated!',
                    icon: 'success',
                    confirmButtonText: 'OK'
                });
            } else {
                Swal.fire({
                    title: 'Error',
                    text: 'There was an error updating the stock.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            }
        },
        error: function(xhr) {
            Swal.fire({
                title: 'Error',
                text: 'An error occurred while updating the stock.',
                icon: 'error',
                confirmButtonText: 'OK'
            });
        }
    });
});
</script>
<script>
function besfind() {
    var bestFind = $('.best_findvalue').val();
    var condition = $('.conditionvalue').val();
    var color = $('.colorvalue').val();
    var storage = $('.storagevalue').val();
    var product_idvalue = $('.product_idvalue').val();
    $.ajax({
        url: '{{ url("admin/ecommerce/filtersotck") }}',
        type: 'GET',
        data: {
            best_find: bestFind,
            condition: condition,
            color: color,
            storage: storage,
            product_id:product_idvalue
        },
        success: function(response) {
            if (response.price !== undefined && response.qty !== undefined) {
                $('#price').val(response.price);
                $('#qty').val(response.qty);
            } else {
                $('#price').val('');
                $('#qty').val('');
            }
        },
        error: function(xhr) {
            alert('Error loading data.');
        }
    });
}
$('#model').select2({
    placeholder: "Select",
});
$('#status').select2({
    placeholder: "Select",
});
</script>
<script>
    function confirmvariationDelete(url) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = url;
            }
        })
    }
</script>
@endsection