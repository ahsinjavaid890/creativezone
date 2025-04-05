@extends('admin.layouts.main-layout')
@section('title','Update Route')
@section('content')
 <!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <div class="d-flex align-items-center flex-wrap mr-2">
                <h5 class="text-blue font-weight-bold mt-2 mb-2 mr-5">
                    Update Route
                </h5>
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <a href="{{ url('admin/dashboard') }}" class="text-blue font-weight-bold mt-2 mb-2 mr-5">
                    Dashboard
                </a>
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <a href="{{ url('admin/routes/allroutes') }}" class="text-blue font-weight-bold mt-2 mb-2 mr-5">
                    All Routes
                </a>
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <a href="javascript:void(0)" class="text-dark font-weight-bold mt-2 mb-2 mr-5">
                    Update Route
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
            <form enctype="multipart/form-data" method="POST" action="{{ url('admin/routes/updateroute') }}">
                @csrf
                <input type="hidden" name="id" value="{{ $data->id }}">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-custom mt-5">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label class="lable-control">Route Name</label>
                                        <div class="mb-3">
                                            <input type="text" name="name" class="form-control" placeholder="Enter Route Name" value="{{ $data->name }}">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="autocomplete">Starting Point</label>
                                        <div class="mb-3">
                                            <input type="text" id="autocomplete" class="form-control" placeholder="Enter your address" name="starting_point" value="{{ $data->starting_point }}" />
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <label class="lable-control">Visiting Date</label>
                                        <div class="mb-3">
                                            <input type="date" name="visitng_date" class="form-control" placeholder="Enter Visiting Date" value="{{ $data->visitng_date }}">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="lable-control">Comments</label>
                                            <textarea placeholder="Comments" rows="4" class="summernote" name="comments" >{{ $data->comments }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <select id="select_status" name="status" class="form-control">
                                                <option @if($data->status == 1 ) selected @endif value="1">Enable</option>
                                                <option @if($data->status == 2 ) selected @endif value="2">Disable</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-12">
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
<style type="text/css">
    input[type="color"] {
    background-color: #fff;
    padding: 10px;
    width: 100%;
    height: 100%;
    cursor: pointer;
    border: 2px solid #000;
    border-radius: 3px;
}
</style>
@endsection

@section('script')
<script type="text/javascript">
    function submitbutton(id) {
        $('#submit_type').val(id);
    }
</script>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDYUTCpyRfNY8Und6oYaKi5Vkqip7OIWEU&libraries=geometry,places&v=weekly"></script>
<script>
    function initAutocomplete() {
        // Create the autocomplete object, restricting the search predictions to
        // addresses in the US.
        var options = {
            componentRestrictions: { country: "us" }
        };

        var autocomplete = new google.maps.places.Autocomplete(
            document.getElementById('autocomplete'), options
        );

        // When the user selects an address from the dropdown, populate the address
        // fields in the form.
        autocomplete.addListener('place_changed', function() {
            var place = autocomplete.getPlace();
            console.log(place);
        });
    }

    // Initialize the autocomplete
    google.maps.event.addDomListener(window, 'load', initAutocomplete);
</script>
@endsection