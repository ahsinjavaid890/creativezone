@extends('admin.layouts.main-layout')
@section('title','Repair Store')
@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
 <!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <div class="d-flex align-items-center flex-wrap mr-2">
                <h5 class="text-blue font-weight-bold mt-2 mb-2 mr-5">
                    Update Repair Store
                </h5>
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <a href="{{ url('admin/dashboard') }}" class="text-blue font-weight-bold mt-2 mb-2 mr-5">
                    Dashboard
                </a>
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <a href="javascript:void(0)" class="text-dark font-weight-bold mt-2 mb-2 mr-5">
                    Repair Management
                </a>
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <a href="{{ url('admin/repair/repairstore') }}" class="text-blue font-weight-bold mt-2 mb-2 mr-5">
                    Repair Store
                </a>
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <a href="javascript:void(0)" class="text-dark font-weight-bold mt-2 mb-2 mr-5">
                    Update Repair Stores
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
                <div class="col-md-6 mx-auto">
                    <div class="card card-custom mt-5">
                        <div class="card-header flex-wrap"> 
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label font-weight-bolder text-dark">update Repair Stores</span>
                            </h3>
                        </div>
                        <form enctype="multipart/form-data" method="POST" action="{{ url('admin/repair/updaterepairstore') }}" class="modal-content">
                        @csrf
                        <input type="hidden" name="id" value="{{ $data->id }}">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Name </label>
                                            <input  type="text" placeholder="Enter Name" class="form-control" name="name" value="{{ $data->name }}">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Phone Number </label>
                                            <input  type="text" placeholder="Enter Phone Number" class="form-control" name="phonenumber" value="{{ $data->phonenumber }}">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Email </label>
                                            <input  type="text" placeholder="Enter Email" class="form-control" name="email" value="{{ $data->email }}">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Address </label>
                                            <input  type="text" placeholder="Address" class="form-control" id="address-input" name="address" value="{{ $data->address }}">
                                            <div id="map"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Latitude</label>
                                            <input type="text" class="form-control" id="latitude-input" name="latitude" value="{{ $data->lattitude }}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Longitude</label>
                                            <input type="text" class="form-control" id="longitude-input" name="longitude" value="{{ $data->longitude }}" readonly>
                                        </div>
                                    </div>
                                    @php
                                    $times = explode(' - ', $data->timming);
                                    $timeFrom = $times[0]; 
                                    $timeTo = $times[1];  
                                    @endphp
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Time From</label>
                                            <input type="text" class="form-control" name="timefrom" id="time-from" value="{{ $timeFrom }}" placeholder="HH:MM - HH:MM" >
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Time To</label>
                                            <input type="text" class="form-control" name="timeto" id="time-to" value="{{ $timeTo }}" placeholder="HH:MM - HH:MM" >
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <button type="submit" class="btn btn-primary font-weight-bold">Update Store</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!--end::Card-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->
</div>
@endsection
@section('script')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDYUTCpyRfNY8Und6oYaKi5Vkqip7OIWEU&libraries=geometry,places&v=weekly"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        flatpickr("#time-from", {
            enableTime: true,
            noCalendar: true,
            dateFormat: "H:i",
            time_24hr: true,
            onClose: function(selectedDates, dateStr) {
                const times = dateStr.split(" to ");
                if (times.length === 2) {
                    this.input.value = times[0] + " - " + times[1];
                }
            }
        });
    });
    document.addEventListener('DOMContentLoaded', function() {
        flatpickr("#time-to", {
            enableTime: true,
            noCalendar: true,
            dateFormat: "H:i",
            time_24hr: true,
            onClose: function(selectedDates, dateStr) {
                const times = dateStr.split(" to ");
                if (times.length === 2) {
                    this.input.value = times[0] + " - " + times[1];
                }
            }
        });
    });
</script>
<script type="text/javascript">
   function initMap() {
    const map = new google.maps.Map(document.getElementById("map"), {
        center: { lat: 37.7749, lng: -122.4194 },
        zoom: 8
    });

    const input = document.getElementById("address-input");

    // Add a listener for the input to handle manual address entry
    input.addEventListener("blur", () => {
        const geocoder = new google.maps.Geocoder();
        const address = input.value;

        if (address) {
            geocoder.geocode({ address: address }, (results, status) => {
                if (status === "OK") {
                    const place = results[0];
                    if (place.geometry) {
                        map.setCenter(place.geometry.location);
                        map.setZoom(15);

                        // Get latitude and longitude
                        const latitude = place.geometry.location.lat();
                        const longitude = place.geometry.location.lng();

                        // Set latitude and longitude in respective input fields
                        document.getElementById("latitude-input").value = latitude;
                        document.getElementById("longitude-input").value = longitude;
                    }
                } else {
                    console.log("Geocode was not successful for the following reason: " + status);
                }
            });
        }
    });
}

// Call initMap on window load
window.onload = initMap;
</script>
@endsection