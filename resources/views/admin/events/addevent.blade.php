@extends('admin.layouts.main-layout')
@section('title','Add Event')
@section('content')
 <!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <div class="d-flex align-items-center flex-wrap mr-2">
                <h5 class="text-blue font-weight-bold mt-2 mb-2 mr-5">
                    Add Event
                </h5>
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <a href="{{ url('admin/dashboard') }}" class="text-blue font-weight-bold mt-2 mb-2 mr-5">
                    Dashboard
                </a>
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <a href="javascript:void(0)" class="text-dark font-weight-bold mt-2 mb-2 mr-5">
                    Event Management
                </a>
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <a href="{{ url('admin/events/allevents') }}" class="text-blue font-weight-bold mt-2 mb-2 mr-5">
                   All Event
                </a>
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <a href="javascript:void(0)" class="text-dark font-weight-bold mt-2 mb-2 mr-5">
                    Add Event
                </a>
            </div>
        </div>
    </div>
    <!--end::Subheader-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class=" container-fluid ">
            <!--begin::Card-->

            <div class="row">
                <div class="col-md-12">
                    @include('alerts.index')
                </div>
            </div>
            <form enctype="multipart/form-data" method="POST" action="{{ url('admin/events/addevent') }}">
                @csrf
                <div class="row">
                    <div class="col-md-8">
                        <div class="card card-custom">
                            <div class="card-header flex-wrap"> 
                                <h3 class="card-title align-items-start flex-column">
                                    <span class="card-label font-weight-bolder text-dark">Events Details</span>
                                </h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                       <div class="form-group">
                                            <label>Select category</label>
                                            <select id="category" class="form-control" name="category_id">
                                                <option  value="">Choose category</option>
                                                @foreach(DB::table('categories')->where('status' , 'Published')->get() as $c)
                                                <option value="{{ $c->id }}">{{ $c->name }}</option>
                                                @endforeach
                                            </select>
                                        </div> 
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Event Name <span class="text-danger">*</span></label>
                                            <input type="text" required placeholder="Event Name" class="form-control" name="name">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Event Image</label>
                                            <input type="file" name="image" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                       <div class="form-group">
                                            <label>Select Location Type</label>
                                            <select id="location_type" class="form-control" name="location_type">
                                                <option value="">Choose Location Type</option>
                                                <option value="Venue" selected>Venue</option>
                                                <option value="Virtual">Virtual</option>
                                                <option value="Both">Both</option>
                                            </select>
                                        </div> 
                                    </div>
                                    <div class="col-md-6" id="venu_location_name">
                                        <div class="form-group">
                                            <label>Location Name <span class="text-danger">*</span></label>
                                            <input type="text"  placeholder="Location Name" class="form-control" name="location_name" id="location_name">
                                        </div>
                                    </div>
                                    <div class="col-md-6" id="venu_location_address">
                                        <div class="form-group">
                                            <label>Location Address <span class="text-danger">*</span></label>
                                            <input type="text"  placeholder="Location Address" class="form-control" name="location_address" id="location_address">
                                            <span class="text-warning">This information is needed for tax purposes.</span>
                                            <div id="location_map" style="height: 300px; width: 100%; margin-top: 10px;display: none;"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-12" id="virtual_address" style="display: none;">
                                        <div class="form-group">
                                            <label>Address <span class="text-danger">*</span></label>
                                            <input type="text"  placeholder="Address" class="form-control" name="address" id="virtual_addres">
                                            <span class="text-warning">This information is needed for tax purposes.</span>
                                            <div id="virtual_map" style="height: 300px; width: 100%; margin-top: 10px;display: none;"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Start Date<span class="text-danger">*</span></label>
                                            <input type="date" name="start_date" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Start Time<span class="text-danger">*</span></label>
                                            <input type="time" name="start_time" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>End Date<span class="text-danger">*</span></label>
                                            <input type="date" name="end_date" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>End Time<span class="text-danger">*</span></label>
                                            <input type="time" name="end_time" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                       <div class="form-group">
                                            <label>Select Time Zone</label>
                                            <select id="timezone" class="form-control" name="time_zone">
                                                <option value="">Choose Time Zone</option>
                                            </select>
                                        </div> 
                                    </div>
                                    <div class="col-md-12">
                                         <div class="form-group">
                                            <label>Description</label>
                                            <textarea class="form-control summernote" name="description" rows="4"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Event video</label>
                                            <input type="file" name="video" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Website URL</label>
                                            <input type="text" name="website_url" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card card-custom">
                            <div class="card-header flex-wrap"> 
                                <h3 class="card-title align-items-start flex-column">
                                    <span class="card-label font-weight-bolder text-dark">Events Socail</span>
                                </h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Facebook url</label>
                                            <input type="text"  placeholder="Facebook URl" class="form-control" name="facebook_url">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Instagram url </label>
                                            <input type="text"  placeholder="Instagram URl" class="form-control" name="instagram_url">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Youtube url </label>
                                            <input type="text"  placeholder="Youtube URl" class="form-control" name="youtube_url">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                       <div class="form-group">
                                            <label>Select Tags</label>
                                            <select id="tags" class="form-control" name="tags[]" multiple>
                                                <option  value="">Choose category</option>
                                                @foreach(DB::table('event_tags')->where('status' , 1)->get() as $t)
                                                <option value="{{ $t->id }}">{{ $t->name }}</option>
                                                @endforeach
                                            </select>
                                        </div> 
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary font-weight-bold">Add New Event</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
@section('script')
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDYUTCpyRfNY8Und6oYaKi5Vkqip7OIWEU&libraries=geometry,places&v=weekly"></script>
<!-- Include Moment.js and Moment-Timezone -->
<script src="{{ url('public/newfront/assets/js/vendor/moment.min.js') }}"></script>
<script src="{{ url('public/newfront/assets/js/vendor/moment-timezone-with-data.min.js') }}"></script>

<script type="text/javascript">
    $(document).ready(function () {
        // Initialize Select2
        $('#category').select2({
            placeholder: "Select Category",
            width: '100%',
            allowClear: true
        });
        $('#location_type').select2({
            placeholder: "Select Location Type",
            width: '100%',
            allowClear: true
        });
        $('#timezone').select2({
            placeholder: "Select Time Zone",
            width: '100%',
            allowClear: true
        });
        $('#tags').select2({
            placeholder: "Select Tags",
            width: '100%',
            allowClear: true
        });
    });
</script>
<script>
    $(document).ready(function() {
        function toggleLocationFields() {
            var selectedType = $("#location_type").val();

            if (selectedType === "Venue") {
                $("#venu_location_name, #venu_location_address").show();
                $("#virtual_address").hide();
            } else if (selectedType === "Virtual") {
                $("#venu_location_name, #venu_location_address").hide();
                $("#virtual_address").show();
            } else if (selectedType === "Both") {
                $("#venu_location_name, #venu_location_address").show();
                $("#virtual_address").hide();
            } else {
                $("#venu_location_name, #venu_location_address, #virtual_address").hide();
            }
        }

        // Pehli dafa load hone par bhi function chale
        toggleLocationFields();

        // Jab dropdown ka value change ho to function chale
        $("#location_type").on("change", toggleLocationFields);
    });
</script>

<script>
    function initAutocomplete(inputId, mapId) {
        var input = document.getElementById(inputId);
        var mapDiv = document.getElementById(mapId);

        if (!input || !mapDiv) return;

        var map = new google.maps.Map(mapDiv, {
            center: { lat: 31.5204, lng: 74.3587 }, // Default: Lahore
            zoom: 13
        });

        var marker = new google.maps.Marker({
            map: map,
            anchorPoint: new google.maps.Point(0, -29)
        });

        var autocomplete = new google.maps.places.Autocomplete(input);
        autocomplete.bindTo("bounds", map);

        autocomplete.addListener("place_changed", function () {
            marker.setVisible(false);
            var place = autocomplete.getPlace();

            if (!place.geometry) return;

            if (place.geometry.viewport) {
                map.fitBounds(place.geometry.viewport);
            } else {
                map.setCenter(place.geometry.location);
                map.setZoom(17);
            }

            marker.setPosition(place.geometry.location);
            marker.setVisible(true);
        });
    }

    document.addEventListener("DOMContentLoaded", function () {
        initAutocomplete("location_address", "location_map");
        initAutocomplete("virtual_addres", "virtual_map");
    });
</script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        var select = document.getElementById("timezone");
        var timezones = moment.tz.names(); // Get all timezones

        timezones.forEach(function (tz) {
            var option = document.createElement("option");
            var offset = moment.tz(tz).utcOffset(); // Get offset in minutes
            var offsetHours = (offset / 60).toFixed(2); // Convert to hours

            option.value = tz;
            option.textContent = `(GMT${offsetHours >= 0 ? '+' : ''}${offsetHours}) ${tz}`;
            select.appendChild(option);
        });

        // Auto-select user's timezone
        select.value = moment.tz.guess();
    });
</script>
@endsection