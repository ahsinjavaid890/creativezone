@extends('admin.layouts.main-layout')
@section('title','Add Provider')
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
                    Add Provider
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
                    Add Provider
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
            <form enctype="multipart/form-data" method="POST" action="{{ url('admin/services/createprovider') }}">
                @csrf
                <input type="hidden" name="submit_type" id="submit_type" >
                <!-- <input type="hidden"  name="type" value="buy"> -->
                <div class="row">
                    <div class="col-md-7">
                        <div class="card card-custom mt-5">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label>Name <span class="text-danger">*</span></label>
                                            <input required type="text" placeholder="Enter Prover Name" class="form-control" name="name" id="name">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label>Provider Text Color</label>
                                            <input type="color"  class="form-control" name="text_color" value="#000000">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label>Customer Service</label>
                                            <input type="text" id="customerService" name="customerservice" class="form-control" placeholder="Enter Customer Service" maxlength="14">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label>Sales</label>
                                            <input type="text" id="sales" name="sales" class="form-control" placeholder="Enter Sales">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label>Tech Support</label>
                                            <input type="text" id="techSupport" name="techsupport" class="form-control" placeholder="Enter Tech Support">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label>Phone Number</label>
                                            <input type="text" id="phoneNumber" name="phone" class="form-control" placeholder="Enter Phone Number">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label>Website</label>
                                            <input id="website" type="text" name="website" class="form-control" placeholder="Website">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label>Affiliate URL</label>
                                            <input placeholder="Affiliate URL" id="affiliate_url" name="url" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label>Address</label>
                                            <input type="text" name="address" class="form-control" placeholder="Enter Address" id="address-input">
                                            <div id="map"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group mb-3">
                                            <label>City</label>
                                            <input id="city-input" type="text" name="city" class="form-control" placeholder="Enter City">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group mb-3">
                                            <label>Zip code</label>
                                            <input id="zipcode-input" type="text" name="zipcode" class="form-control" placeholder="Enter Zipcode">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group mb-3">
                                            <label>State</label>
                                            <input type="text" name="state" class="form-control" placeholder="Enter State">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Country </label>
                                            <select class="form-control"  name="country" id="Country">
                                                <option>Select Country</option>
                                                @foreach(DB::table('countries')->get() as $r)
                                                <option @if($r->name == 'United States') selected @endif value="{{$r->code}}">{{ $r->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label>Email</label>
                                            <input type="text" name="email" class="form-control" placeholder="Enter Provider Email">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="provider-url">Provider URL</label>
                                            <div class="input-group">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">{{ url('') }}</span>
                                                </div>
                                                <input type="text" class="form-control" id="providerurl" name="provider_url" placeholder="Enter the provider URL">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group mb-3">
                                            <label>What We Like</label>
                                            <textarea placeholder="What We likes" class="form-control" name="whatwelike" rows="4"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group mb-3">
                                            <label>Price Breakdown</label>
                                            <textarea placeholder="Price Breakdown" class="form-control" name="pricebreakdown" rows="4"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group mb-3">
                                            <label>Term And Condition</label>
                                            <textarea placeholder="Term and Condition" class="form-control" name="termandconditon" rows="4"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group mb-3">
                                            <label>Comments</label>
                                            <textarea placeholder="Comments" class="summernote" name="description" rows="4"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group mb-3">
                                            <label>Order Notes</label>
                                            <textarea placeholder="Order Notes" class="summernote" name="ordernote" rows="4"></textarea>
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
                                                <option @if($r->name == 'Telecom') selected @endif value="{{ $r->id }}">{{ $r->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group mb-3" >
                                            <label>Select Child Service <span class="text-danger">*</span></label>
                                            <select multiple id="showchildservices" name="childservice[]" required="" onchange="getattributes()" class="form-control">
                                                
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div id="attributesContainer" class="row"></div>
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
                                            <select id="availability_type" onchange="availabilitytype(this.value)" name="availability_type" class="form-control">
                                                <option value="">Select Type</option>
                                            select_state    <option value="zip_code">Import Zip codes</option>
                                                <option value="state_city">Select States & City</option>
                                                <option value="by_location">Select By Location</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div id="content-section">
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
                                                        <option value="1">Enable</option>
                                                        <option value="2">Disable</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Provider Page</label>
                                                    <select id="provider_page" name="provider_page_status" class="form-control">
                                                        <option value="1">Published</option>
                                                        <option value="2">Pending</option>
                                                        <option value="3">Draft</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Show On Order Form</label>
                                                    <select id="show_order_form" name="show_order_form" class="form-control">
                                                        <option value="1">Yes</option>
                                                        <option value="2">No</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>User ratting</label>
                                                    <input type="number" name="userrating" class="form-control" value="5">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>User ratting Qty</label>
                                                    <input type="number" name="userratingqty" class="form-control" value="100">
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
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Banner Image</label>
                                            <input type="file" name="banner" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Use logo on homepage Plans</label>
                                            <select id="home_page_plan" name="logo_home_page_plan" class="form-control">
                                                <option value="1">Yes</option>
                                                <option value="2">No</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Use Logo On Provider Page Plan</label>
                                            <select id="provider_page_plan" name="logo_provider_page_plan" class="form-control">
                                                <option value="1">Yes</option>
                                                <option value="2">No</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group-custom mb-4">
                                          <!-- Row 1: Show Logo -->
                                          <div class="col-sm-12 mb-3">
                                            <div class="section-title">Show Logo</div>
                                            <div class="form-check">
                                              <input class="form-check-input" type="checkbox" name="show_logo_on_slider" id="show_logo_on_slider" value="1">
                                              <label class="form-check-label" for="show_logo_on_slider">
                                                Check here if you want to show the logo on the logo slider
                                              </label>
                                            </div>
                                          </div>

                                          <!-- Row 2: Link logo to -->
                                          <div class="col-sm-12 mb-3">
                                            <div class="section-title">Link logo to</div>
                                            <div class="form-check form-check-inline">
                                              <input type="radio" class="form-check-input" name="link_logo_to" id="provider_url" value="provider_url">
                                              <label class="form-check-label" for="provider_url">Provider page</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                              <input type="radio" class="form-check-input" name="link_logo_to" id="website_url" value="website_url" checked>
                                              <label class="form-check-label" for="website_url">Website URL</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                              <input type="radio" class="form-check-input" name="link_logo_to" id="affiliate_url" value="affiliate_url">
                                              <label class="form-check-label" for="affiliate_url">Affiliate URL</label>
                                            </div>
                                          </div>

                                          <!-- Row 2: Link logo to -->
                                          <div class="col-sm-12 mb-3">
                                            <div class="section-title">Show logo on home page banner</div>
                                            <div class="form-check form-check-inline">
                                              <input type="radio" class="form-check-input" name="show_on_home_banner" id="show_on_home_banneryes" value="Yes">
                                              <label class="form-check-label" for="show_on_home_banneryes">Yes</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                              <input type="radio" class="form-check-input" name="show_on_home_banner" id="show_on_home_bannerno" value="No" checked>
                                              <label class="form-check-label" for="show_on_home_bannerno">No</label>
                                            </div>
                                          </div>
                                          <!-- Row 2: Link logo to -->
                                          <div class="col-sm-12  mb-3">
                                            <div class="section-title">Search By Zipcode Box In Provider Page</div>
                                            <div class="form-check form-check-inline">
                                              <input type="radio" class="form-check-input" name="zipcode_search_box" id="zipcode_search_box_show" value="Yes">
                                              <label class="form-check-label" for="zipcode_search_box_show">Yes</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                              <input type="radio" class="form-check-input" name="zipcode_search_box" id="zipcode_search_box_hide" value="No" checked>
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
                                        <button onclick="submitbutton('exit')" type="submit" class="btn form-control btn-primary">Save & Exit</button>
                                    </div>
                                    <div class="col-md-7">
                                        <button onclick="submitbutton('addmore')" type="submit" class="btn form-control btn-primary">Save & Add More</button>
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
    $('#Country').select2({
        placeholder: "Select Country",
    });
    $('#city_select').select2({
        placeholder: "Select City",
    });
    @foreach(DB::table('atributes')->get() as $r)
    @if($r->type == 'Select')
    $('.multipleselecttwo').select2({
        
    });
    @endif
    @endforeach
    $(document).ready(function() {
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
        
    initMap();
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
                    getattributes();
                }
            });
        } else {
            $('#showchildservices').html('');
        }
    }
    $(document).ready(function() {
        $('#services').select2();
        $('#showchildservices select').select2();
    });
    $('#showchildservices').select2({
        placeholder: "Please Select Shild Service",
    });
    document.getElementById('select_all').addEventListener('change', function() {
        var selectState = document.getElementById('select_state');
        for (var i = 0; i < selectState.options.length; i++) {
            selectState.options[i].selected = this.checked;
        }
    });
</script>
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
            let zipcode = '';
            for (const component of addressComponents) {
                if (component.types.includes("postal_code")) {
                    zipcode = component.long_name;
                    break;
                }
            }
            document.getElementById("zipcode-input").value = zipcode;
            showprovidersagainstzipcode(zipcode);
        });
    }
</script>
<script type="text/javascript">
$(document).ready(function() {
    let selectedService = $('#services').val();
    if (selectedService) {
        selectservice(selectedService);
    }
});
</script>
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
function getattributes() {
    let selectedchildeservice = $('#showchildservices').val();
    if (selectedchildeservice.length > 0) {
        $.ajax({
            type: 'get',
            url: '{{ url("admin/services/getattributes") }}',
            data: {service_id: selectedchildeservice},
            success: function(data) {
                $('#attributesContainer').html(data);
            },
            error: function() {
                alert('Error fetching attributes');
            }
        });
    }
    
}
</script>

<script>
    function availabilitytype(selectedType) {
        if (selectedType) {
            $.ajax({
                url: '{{ url("admin/services/getavailability") }}', 
                type: 'GET',
                data: { availability_type: selectedType },
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

            showprovidersagainstzipcode(zipcode);
        });
    }

    window.onload = initMap;
    // JavaScript to copy the input from Customer Service to other fields
    document.getElementById('customerService').addEventListener('input', function() {
        var value = this.value;
        document.getElementById('sales').value = value;
        document.getElementById('techSupport').value = value;
        document.getElementById('phoneNumber').value = value;
    });
    document.getElementById('website').addEventListener('input', function() {
        var value = this.value;
        document.getElementById('affiliate_url').value = value;
    });



    document.getElementById('customerService').addEventListener('input', function (e) {
        let input = e.target.value.replace(/\D/g, '');
        let formattedInput = input.match(/.{1,4}/g)?.join('-');
        e.target.value = formattedInput ?? '';
    });
</script>
@endsection