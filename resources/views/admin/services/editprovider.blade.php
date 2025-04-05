@extends('admin.layouts.main-layout')
@section('title','Update Provider')
@section('content')
 <!--begin::Content-->
   <style>
    .form-check-label {
      margin-left: 10px;
    }
    .section-title {
      font-weight: bold;
      margin-bottom: 10px;
    }
  </style>
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <div class="d-flex align-items-center flex-wrap mr-2">
                <h5 class="text-blue font-weight-bold mt-2 mb-2 mr-5">
                    Update Provider
                </h5>
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <a href="{{ url('admin/dashboard') }}" class="text-blue font-weight-bold mt-2 mb-2 mr-5">
                    Dashboard
                </a>
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <a href="javascript:void(0)" class="text-dark font-weight-bold mt-2 mb-2 mr-5">
                    Service Management
                </a>
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <a href="{{ url('admin/services/providers') }}" class="text-blue font-weight-bold mt-2 mb-2 mr-5">
                    All Providers
                </a>
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <a href="javascript:void(0)" class="text-dark font-weight-bold mt-2 mb-2 mr-5">
                    Update Provider : <b class="text-danger">{{ $provider->name }}</b>
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
            <form enctype="multipart/form-data" method="POST" action="{{ url('admin/services/updateprovider') }}">
                @csrf
                <input type="hidden" name="submit_type" id="submit_type" >
                <input type="hidden" value="{{ $provider->id }}" name="id">
                <div class="row">
                    <div class="col-md-7">
                        <div class="card card-custom mt-5">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label>Name</label>
                                            <input value="{{ $provider->name }}"  type="text" placeholder="Enter Prover Name" id="name" class="form-control" name="name">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label>Provider Text Color</label>
                                            <input type="color"  class="form-control" name="text_color" value="{{ $provider->text_color }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label>Customer Service</label>
                                            <input  type="text" name="customerservice" id="customerservice" class="form-control" placeholder="Enter Customer Service" value="{{  $provider->customerservice}}" maxlength="14">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label>Sales</label>
                                            <input  type="text" name="sales" id="sales" class="form-control" placeholder="Enter Sales" value="{{ $provider->sales }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label>Tech Support</label>
                                            <input  type="text" name="techsupport" id="techsupport" class="form-control" placeholder="Enter Tech Support" value="{{  $provider->techsupport}}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label>Phone Number</label>
                                            <input  type="text" name="phone" id="phoneNumber" class="form-control" placeholder="Enter Phone Number" value="{{ $provider->phone }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label>Website</label>
                                            <input value="{{ $provider->website }}" type="text" name="website" id="website" class="form-control" placeholder="Website">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label>Affiliate URL</label>
                                            <input value="{{ $provider->url }}" id="affiliate_url" placeholder="Affiliate URL" name="url" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label>Address</label>
                                            <input type="text" name="address" class="form-control" placeholder="Enter Address" id="address-input" value="{{ $provider->address }}">
                                            <div id="map"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group mb-3">
                                            <label>City</label>
                                            <input id="city-input" type="text" name="cityprovider" class="form-control" placeholder="Enter City" value="{{ $provider->city }}">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group mb-3">
                                            <label>Zip code</label>
                                            <input id="zipcode-input" type="text" name="zipcode" class="form-control" placeholder="Enter Zipcode" value="{{ $provider->zipcode }}">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group mb-3">
                                            <label>State</label>
                                            <input type="text" name="state" class="form-control" placeholder="Enter State" value="{{ $provider->state }}">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Country </label>
                                            <select class="form-control"  name="country" id="Country">
                                                <option>Select Country</option>
                                                @foreach(DB::table('countries')->get() as $r)
                                                <option @if($provider->country == $r->code) selected @endif value="{{$r->code}}">{{ $r->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label>Email</label>
                                            <input value="{{ $provider->email }}" type="text" name="email" class="form-control" placeholder="Enter Provider Email">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="provider-url">Provider URL</label>
                                            <div class="input-group">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">{{ url('') }}</span>
                                                </div>
                                                <input type="text" class="form-control" id="providerurl" name="provider_url" value="{{ $provider->provider_url }}" placeholder="Enter the provider URL">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group mb-3">
                                            <label>What We Like</label>
                                            <textarea placeholder="What We likes" class="summernote" name="whatwelike" rows="4">{{ $provider->whatwelike }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group mb-3">
                                            <label>Price Breakdown</label>
                                            <textarea placeholder="Price Breakdown" class="form-control" name="pricebreakdown" rows="4">{{ $provider->pricebreakdown }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group mb-3">
                                            <label>Term And Condition</label>
                                            <textarea placeholder="Term and Condition" class="form-control" name="termandconditon" rows="4">{{ $provider->termandconditon }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group mb-3">
                                            <label>Comments</label>
                                            <textarea placeholder="Comments" class="summernote" name="description" rows="4">{{ $provider->description }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group mb-3">
                                            <label>Order Notes</label>
                                            <textarea placeholder="Order Notes" class="summernote" name="ordernote" rows="4">{{ $provider->ordernote }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="card card-custom mt-5">
                            <div class="card-header flex-wrap">
                                <div class="card-title">
                                    Service Offered
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group mb-3">
                                            <label>Select Service</label>
                                            <select onchange="selectservice(this.value)" id="services" name="service" class="form-control">
                                                <option value="">Select Service</option>
                                                @foreach(DB::table('services')->wherenull('parent_id')->where('status', 1)->get() as $r)
                                                <option @if($provider->service == $r->id) selected @endif   value="{{ $r->id }}">{{ $r->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group mb-3" >
                                            <label>Select Child Service <span class="text-danger">*</span></label>
                                            <select multiple id="showchildservices" name="childservice[]" required="" onchange="getattributes(this.value)" class="form-control">
                                                 @foreach(DB::table('services')->wherenotnull('parent_id')->where('status' , 1)->where('parent_id' , $provider->service)->get() as $c)
                                                <option @foreach(DB::table('provider_child_services')->where('provider_id' , $provider->id)->get() as $child) @if($child->service_id == $c->id) selected @endif @endforeach value="{{ $c->id }}">{{ $c->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div id="attributesContainer" class="row">
                                            @foreach(DB::table('provider_attributes')->where('provider_id', $provider->id)->get() as $providerAttribute)
                                                <div class="col-md-6">
                                                    @foreach(DB::table('atributes')->where('id', $providerAttribute->attribute_id)->get() as $attribute)
                                                        @if($attribute->type == 'Checkbox' || $attribute->type == 'Select')
                                                            <div class="form-group">
                                                                <label>{{ $attribute->name }}</label>
                                                                <select name="attributes[{{ $attribute->id }}][]" multiple class="form-control multipleselecttwo">
                                                                    @foreach(explode(',', $attribute->value) as $att)
                                                                        <option value="{{ $att }}" @if(in_array($att, explode(',', $providerAttribute->value))) selected @endif>
                                                                            {{ $att }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        @endif
                                                        @if($attribute->type == 'Radio')
                                                            <div class="form-group">
                                                                <label>{{ $attribute->name }}</label>
                                                                <select name="attributes[{{ $attribute->id }}][]" class="form-control radioselect">
                                                                    @foreach(explode(',', $attribute->value) as $att)
                                                                        <option value="{{ $att }}" @if(in_array($att, explode(',', $providerAttribute->value))) selected @endif>
                                                                            {{ $att }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        @endif
                                                        @if($attribute->type == 'Text')
                                                            <div class="form-group">
                                                                <label>{{ $attribute->name }}</label>
                                                                <input class="form-control" type="text" name="attributes[{{ $attribute->id }}]" value="{{ $providerAttribute->value }}">
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div id="childserviceattributes" class="row"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card card-custom mt-5">
                            <div class="card-header flex-wrap">
                                <div class="card-title">Service Availability</div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Select Type</label>
                                            <select id="availability_type" onchange="editavailabilitytype(this.value)" name="availability_type" class="form-control">
                                                <option   value="">Select Type</option>
                                                <option @if($provider->availability_type == 'zip_code') selected @endif  value="zip_code">Import Zip codes</option>
                                                <option @if($provider->availability_type == 'state_city') selected @endif  value="state_city">States & City</option>
                                                <option  @if($provider->availability_type == 'by_location') selected @endif value="by_location">By Location</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div id="content-section">
                                    <div class="text-center mt-5 mb-5">
                                        <i style="font-size: 25px;" class="fa fa-spin fa-spinner"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="accordion" id="accordionone">
                            <div class="card card-custom mt-5">
                                <div data-toggle="collapse" data-target="#default" class="card-header bg-white d-flex justify-content-between align-items-center">
                                    <div class="card-title">
                                        <span class="card-label font-weight-bolder text-dark">Default</span>
                                    </div>
                                    <div class="accordion-icon">
                                        <i class="fas fa-plus"></i>
                                    </div>
                                </div>
                                <div id="default" class="collapse" data-parent="#accordionone">
                                    <div class="card-body" style=" height: 300px; overflow: auto; ">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Provider Status</label>
                                                    <select id="select_status" name="status" class="form-control">
                                                        <option @if($provider->status == 1) selected @endif value="1">Enable</option>
                                                        <option @if($provider->status == 2) selected @endif value="2">Disable</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Provider Page</label>
                                                    <select id="provider_page" name="provider_page_status" class="form-control">
                                                        <option @if($provider->provider_page_status == 1) selected @endif value="1">Enable</option>
                                                        <option @if($provider->provider_page_status == 2) selected @endif value="2">Disable</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Show On Order Form</label>
                                                    <select id="show_order_form" name="show_order_form" class="form-control">
                                                        <option @if($provider->show_order_form == 1) selected @endif  value="1">Yes</option>
                                                        <option @if($provider->show_order_form == 2) selected @endif   value="2">No</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card card-custom mt-5">
                            <div class="card-header flex-wrap">
                                <div class="card-title">
                                    Provider Settings
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Logo Image</label>
                                            <input type="file" name="logo" class="form-control">
                                            @if($provider->logo)
                                            <img class="img-thumbnail mt-2" src="{{ url('public/images') }}/{{ $provider->logo }}" width="100">
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Banner Image</label>
                                            <input type="file" name="banner" class="form-control">
                                            @if($provider->banner)
                                            <img class="img-thumbnail  mt-2" src="{{ url('public/images') }}/{{ $provider->banner }}" width="100">
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Use logo on homepage Plans</label>
                                            <select id="home_page_plan" name="logo_home_page_plan" class="form-control">
                                                <option @if($provider->logo_home_page_plan == 1) selected @endif  value="1">Yes</option>
                                                <option @if($provider->logo_home_page_plan == 2) selected @endif   value="2">No</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Use Logo On Provider Page Plan</label>
                                            <select id="provider_page_plan" name="logo_provider_page_plan" class="form-control">
                                                <option @if($provider->logo_provider_page_plan == 1) selected @endif  value="1">Yes</option>
                                                <option @if($provider->logo_provider_page_plan == 2) selected @endif   value="2">No</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group-custom mb-4">
                                            <div class="col-sm-12  mb-3">
                                                <div class="section-title">Show Logo</div>
                                                <div class="form-check">
                                                  <input class="form-check-input" type="checkbox" name="show_logo_on_slider" id="show_logo_on_slider" value="1" @if($provider->show_logo_on_slider == 1) checked @endif>
                                                  <label class="form-check-label" for="show_logo_on_slider">
                                                    Check here if you want to show the logo on the logo slider
                                                  </label>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 mb-3">
                                                <div class="section-title">Link logo to</div>
                                                <div class="form-check form-check-inline">
                                                  <input type="radio" class="form-check-input" name="link_logo_to" id="provider_url" value="provider_url" @if($provider->link_logo_to == 'provider_url') checked @endif>
                                                  <label class="form-check-label" for="provider_url">Provider page</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                  <input type="radio" class="form-check-input" name="link_logo_to" id="website_url" value="website_url" @if($provider->link_logo_to == 'website_url') checked @endif>
                                                  <label class="form-check-label" for="website_url">Website URL</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                  <input type="radio" class="form-check-input" name="link_logo_to" id="affiliate_url" value="affiliate_url" @if($provider->link_logo_to == 'affiliate_url') checked @endif>
                                                  <label class="form-check-label" for="affiliate_url">Affiliate URL</label>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 mb-3">
                                                <div class="section-title">Show logo on home page banner</div>
                                                <div class="form-check form-check-inline">
                                                  <input type="radio" class="form-check-input" @if($provider->show_on_home_banner == 'Yes') checked @endif name="show_on_home_banner" id="show_on_home_banneryes" value="Yes">
                                                  <label class="form-check-label" for="show_on_home_banneryes">Yes</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                  <input type="radio" class="form-check-input" name="show_on_home_banner" id="show_on_home_bannerno" value="No" @if($provider->show_on_home_banner == 'No') checked @endif>
                                                  <label class="form-check-label" for="show_on_home_bannerno">No</label>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 mb-3">
                                                <div class="section-title">Search By Zipcode Box In Provider Page</div>
                                                <div class="form-check form-check-inline">
                                                  <input type="radio" class="form-check-input" name="zipcode_search_box" id="zipcode_search_box_show" value="Yes" @if($provider->zipcode_search_box == 'Yes') checked @endif>
                                                  <label class="form-check-label" for="zipcode_search_box_show">Yes</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                  <input type="radio" class="form-check-input" name="zipcode_search_box" id="zipcode_search_box_hide" value="No" @if($provider->zipcode_search_box == 'No') checked @endif>
                                                  <label class="form-check-label" for="zipcode_search_box_hide">No</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
                                    <div class="col-md-5">
                                        <button onclick="submitbutton('exit')" type="submit" class="btn form-control btn-primary btn-sm p-0">Save & Exit</button>
                                    </div>
                                    <div class="col-md-7">
                                        <button onclick="submitbutton('addmore')" type="submit" class="btn form-control btn-primary btn-sm p-0">Save</button>
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
<style>
.select2-container{
    width: 100% !important;
}
</style>
@endsection

@section('script')
<script type="text/javascript">
    function submitbutton(id) {
        $('#submit_type').val(id);
    }
    $('#services').select2({
        placeholder: "Select a Service",
    });
    $('#showchildservices').select2({
        placeholder: "Select Child  Services",
    });
    $('#select_status').select2({
        placeholder: "Select a state",
    });
    $('#provider_page').select2({
        placeholder: "Select a state",
    });
    $('#show_order_form').select2({
        placeholder: "Select a state",
    });
    $('#home_page_plan').select2({
        placeholder: "Select a state",
    });
    $('#provider_page_plan').select2({
        placeholder: "Select a state",
    });
    $('#Country').select2({
        placeholder: "Select Country",
    });
    $('#city_select').select2({
        placeholder: "Select City",
    });
    @foreach(DB::table('atributes')->get() as $r)
        @if($r->type == 'Checkbox')
            $('.multipleselecttwo').select2({
                
            });
        @endif
        @if($r->type == 'Radio')
            $('.radioselect').select2({
                
            });
        @endif
    @endforeach
    $(document).ready(function() {

        editavailabilitytype($('#availability_type').val());
        $('#select_state').select2({
            placeholder: "Select a state",
            width: '100%'
        });
        $('#select_all').change(function() {
            var selectState = $('#select_state').select2('data');
            if ($(this).is(':checked')) {
                $('#select_state').find('option').prop('selected', true); 
            } else {
                $('#select_state').find('option').prop('selected', false);
            }
            $('#select_state').trigger('change'); 
        });
    });
    function selectcity() {
        var selectedStates = $('#select_state').val();
        if (selectedStates.length > 0) {
            $.ajax({
                type: 'get',
                url: '{{ url("admin/services/getcity") }}',
                data: { states: selectedStates }, 
                success: function(res) {
                    $('#city_select').html(res);   
                }
            });
        } else {
            $('#city_select').html('');
        }
    }
    function selectservice(id) {
        if(id){
            $.ajax({
                type: 'get',
                url: '{{ url("admin/services/getplanchildservices") }}/'+id,
                success: function(res) {
                    $('#showchildservices').html(res);   
                }
            });
        } else {
            $('#showchildservices').html('');
        }
    }
        $('#childseriveselect').select2({
        placeholder: "Please Select Shild Service",
    });
    document.getElementById('availability_type').addEventListener('change', function() {
        var selectedValue = this.value;
        document.getElementById('zip_code').style.display = selectedValue === 'zip_code' ? 'block' : 'none';
        document.getElementById('state_city').style.display = selectedValue === 'state_city' ? 'block' : 'none';
        document.getElementById('by_location').style.display = selectedValue === 'by_location' ? 'block' : 'none';
    });
</script>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDYUTCpyRfNY8Und6oYaKi5Vkqip7OIWEU&libraries=geometry,places&v=weekly"></script>
   
<script>
    function generateShortURL(name) {
        let shortName = name.trim().toLowerCase().replace(/\s+/g, '-');
        shortName = shortName.substring(0, 25);
        return `${shortName}`;
    }
    document.getElementById('name').addEventListener('input', function() {
        const name = this.value;
        const shortUrl = name ? generateShortURL(name) : '';
        document.getElementById('providerurl').value = shortUrl;
    });
</script>
<script type="text/javascript">
function getattributes(selectedIds) {
    if (selectedIds.length === 0) {
        return; 
    }
    var provider_id = '{{ $provider->id }}';
    $.ajax({
        type: 'get',
        url: '{{ url("admin/services/getattributes") }}',
        data: {
            service_id: selectedIds,
            provider_id:provider_id
        },
        success: function(data) {
            $('#attributesContainer').html(data);
        },
        error: function() {
            alert('Error fetching attributes');
        }
    });
}
$(document).ready(function() {
    $('#showchildservices').on('change', function() {
        let selectedchildeservice = $(this).val();
        if (selectedchildeservice.length > 0) {
            getattributes(selectedchildeservice);
        }
    });

    initMap();
});
</script>

<script>
    function editavailabilitytype(selectedType) {
        if (selectedType) {
            $.ajax({
                url: '{{ url("admin/services/editavailability") }}',
                type: 'GET',
                data: {
                    availability_type: selectedType,
                    provider_id: "{{ $provider->id }}" 
                },
                success: function(response) {
                    if (response.html) {
                        $('#content-section').html(response.html);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                    $('#content-section').html('<p class="text-danger">An error occurred while loading the content.</p>');
                }
            });
        } else {
            $('#content-section').html('');
        }
    }    
</script>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDYUTCpyRfNY8Und6oYaKi5Vkqip7OIWEU&libraries=geometry,places&v=weekly"></script>
<script>
    function initMap() {
        const map = new google.maps.Map(document.getElementById("map"), {
            center: { lat: 37.7749, lng: -122.4194 },
            zoom: 8
        });

        const input = document.getElementById("address-input");
        const autocomplete = new google.maps.places.Autocomplete(input, {
            componentRestrictions: { country: 'us' }
        });

        autocomplete.addListener("place_changed", () => {
            const place = autocomplete.getPlace();

            if (!place.geometry) {
                console.log("No details available for input: '" + place.name + "'");
                return;
            }

            map.setCenter(place.geometry.location);
            map.setZoom(15);

            const addressComponents = place.address_components;
            let city = '';
            let state = '';
            let zipcode = '';

            for (const component of addressComponents) {
                if (component.types.includes("locality")) {
                    city = component.long_name;
                } else if (component.types.includes("administrative_area_level_1")) {
                    state = component.short_name;
                } else if (component.types.includes("postal_code")) {
                    zipcode = component.long_name;
                }
            }

            document.getElementById("city-input").value = city;
            document.getElementById("zipcode-input").value = zipcode;
            document.getElementsByName("state")[0].value = state;

        });
    }
</script>
<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('customerservice').addEventListener('input', function() {
            var value = this.value;
            document.getElementById('sales').value = value;
            document.getElementById('techsupport').value = value;
            document.getElementById('phoneNumber').value = value;
        });

        document.getElementById('customerservice').addEventListener('input', function (e) {
            let input = e.target.value.replace(/\D/g, '');
            let formattedInput = input.match(/.{1,4}/g)?.join('-');
            e.target.value = formattedInput ?? '';
        });
        

        
    });
</script>

@endsection
