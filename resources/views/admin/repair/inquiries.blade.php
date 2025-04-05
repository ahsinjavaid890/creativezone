@extends('admin.layouts.main-layout')
@section('title','Repair Inquiries')
@section('content')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
 <!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <div class="d-flex align-items-center flex-wrap mr-2">
                <h5 class="text-blue font-weight-bold mt-2 mb-2 mr-5">
                    All Repair Inquiries
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
                    All Repair Inquiries
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
                    <form id="filterForm" method="GET" action="{{ url('admin/repair/inquiries') }}">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Category</label>
                                    <select name="category_id" id="category_id" class="form-control">
                                        <option value="" >Category</option>
                                        @foreach(DB::table('categories')->where('category_type' , 'sell')->get() as  $r)
                                        <option value="{{ $r->id }}" {{ request('category_id') == $r->id ? 'selected' : '' }}>{{ $r->name }}</option>
                                        @endforeach
                                        
                                    </select> 
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Model</label>
                                    <select name="model_id" id="model" class="form-control">
                                        <option value="">Model</option>
                                        @foreach(DB::table('models')->get() as $r)
                                        <option value="{{ $r->id }}" {{ request('model') == $r->id ? 'selected' : '' }}>{{ $r->name }}</option>
                                        @endforeach
                                    </select> 
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Status</label>
                                    <select name="status" id="status" class="form-control">
                                        <option value="">Status</option>
                                        <option value="1" {{ request('status') == 1 ? 'selected' : '' }}>Completed</option>
                                        <option value="0" {{ request('status') == 0 ? 'selected' : '' }}>Pending</option>
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
                        <span class="card-label font-weight-bolder text-dark">All Repair Inquiries</span>
                    </h3>
                    <!-- <div class="card-toolbar">
                        <a href="javascript:void(0)" data-toggle="modal" data-target="#exampleModalCenter" class="btn btn-primary btn-sm font-weight-bolder">Add Repair Store
                        </a>
                    </div> -->
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center">Device Problems</th>
                                <th class="text-center">Model</th>
                                <th class="text-center">Repair  Option</th>
                                <th class="text-center">Address</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Operations</th>
                            </tr>
                        </thead>
                        <tbody id="table-data">
                         @include('admin.repair.render.inquries_table', ['data' => $data])
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
            title: 'Are you sure you Want To Change Status of This Inqurie?',
            text: "If Status is Not Published then This Inqurie",
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
            url: "{{ url('admin/repair/inquiries') }}",
            type: "GET",
            data: formData,
            success: function (data) {
                $('#table-data').html(data.tableData);
                let newUrl = "{{ url('admin/repair/inquiries') }}" + '?' + formData;
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
    $('#status , #category_id , #model').select2({
        placeholder: "Select",
        width: '100%',
        allowClear: true
    });
});
</script>
@endsection