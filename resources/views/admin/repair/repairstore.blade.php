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
                    All Repair Stores
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
                <a href="javascript:void(0)" class="text-dark font-weight-bold mt-2 mb-2 mr-5">
                    All Repair Stores
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
            <div class="card card-custom mt-5">
                <div class="card-body">
                    <form id="filterForm" method="GET" action="{{ url('admin/repair/repairstore') }}">
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input  type="text" class="form-control" name="name" value="{{ request('name') }}">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Status</label>
                                    <select name="status" id="status" class="form-control">
                                        <option value="">Status</option>
                                        <option value="1" {{ request('status') == 1 ? 'selected' : '' }}>Enable</option>
                                        <option value="2" {{ request('status') == 2 ? 'selected' : '' }}>Disable</option>
                                    </select> 
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card card-custom mt-5">
                <div class="card-header flex-wrap"> 
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label font-weight-bolder text-dark">All Repair Stores</span>
                    </h3>
                    <div class="card-toolbar">
                        <a href="javascript:void(0)" data-toggle="modal" data-target="#exampleModalCenter" class="btn btn-primary btn-sm font-weight-bolder">Add Repair Store
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center">Name & Phone</th>
                                <th class="text-center">Address</th>
                                <th class="text-center">Lattitude & Longitude</th>
                                <th class="text-center">Timing</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Operations</th>
                            </tr>
                        </thead>
                        <tbody id="table-data">
                         @include('admin.repair.render.store_table', ['data' => $data])
                        </tbody>
                    </table>
                </div>
            </div>
            <!--end::Card-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->
</div>
<div class="modal fade" id="exampleModalCenter" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <form enctype="multipart/form-data" method="POST" action="{{ url('admin/repair/creatrepairstore') }}" class="modal-content">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Repair Store</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Name <span class="text-danger">*</span></label>
                            <input required type="text" placeholder="Enter Name" class="form-control" name="name">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Email (Optional)</label>
                            <input type="text" placeholder="Enter Email" class="form-control" name="email">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Phone Number <span class="text-danger">*</span></label>
                            <input required type="text" placeholder="Enter Phone Number" class="form-control" name="phonenumber">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Address <span class="text-danger">*</span></label>
                            <input required type="text" placeholder="Address" class="form-control" id="address-input" name="address">
                            <div id="map"></div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Latitude</label>
                            <input type="text" class="form-control" id="latitude-input" name="latitude" readonly>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Longitude</label>
                            <input type="text" class="form-control" id="longitude-input" name="longitude" readonly>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Time From</label>
                            <input type="text" class="form-control" name="timefrom" id="time-from" placeholder="HH:MM - HH:MM" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Time To</label>
                            <input type="text" class="form-control" name="timeto" id="time-to" placeholder="HH:MM - HH:MM" required>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary font-weight-bold">Create New Store</button>
            </div>
        </form>
    </div>
</div>
@endsection
@section('script')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDYUTCpyRfNY8Und6oYaKi5Vkqip7OIWEU&libraries=geometry,places&v=weekly"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>


<script>
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
    function confirmstatus(url) {
        Swal.fire({
            title: 'Are you sure you Want To Change Status of This Repair Store?',
            text: "If Status is Not Published then This Repair Store Will not show Frontend",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Change it!'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = url;
            }
        })
    }
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
<script type="text/javascript">
$(document).ready(function () {
    function fecthshiiping() {
        let formData = $('#filterForm').serialize();
        $.ajax({
            url: "{{ url('admin/repair/repairstore') }}",
            type: "GET",
            data: formData,
            success: function (data) {
                $('#table-data').html(data.tableData);
                let newUrl = "{{ url('admin/repair/repairstore') }}" + '?' + formData;
                history.pushState(null, '', newUrl);
            },
            error: function (xhr, status, error) {
                console.error(error);
            }
        });
    }
    $('#filterForm input, #filterForm select').on('input change', function () {
        fecthshiiping();
    });
    $('#status').select2({
        placeholder: "Select",
        width: '100%',
        allowClear: true
    });
});
</script>
@endsection