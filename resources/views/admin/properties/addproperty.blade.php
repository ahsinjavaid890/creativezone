@extends('admin.layouts.main-layout')
@section('title','Add New Property')
@section('content')
 <!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <div class="d-flex align-items-center flex-wrap mr-2">
                <h5 class="text-blue font-weight-bold mt-2 mb-2 mr-5">
                    Add New Property
                </h5>
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <a href="{{ url('admin/dashboard') }}" class="text-blue font-weight-bold mt-2 mb-2 mr-5">
                    Dashboard
                </a>
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <a href="{{ url('admin/properties/index') }}" class="text-blue font-weight-bold mt-2 mb-2 mr-5">
                    All Properties
                </a>
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <a href="javascript:void(0)" class="text-dark font-weight-bold mt-2 mb-2 mr-5">
                    Add New Property
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
            <form enctype="multipart/form-data" method="POST" action="{{ url('admin/properties/createproperty') }}">
                @csrf
                <div class="row">
                    <div class="col-md-7">
                        <div class="card card-custom mt-5">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <label class="form-label">Property Name</label>
                                            <input type="text" required class="form-control" name="property_name">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="form-label">No of Units</label>
                                            <input name="no_of_units" type="text" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <label class="form-label">Property Address</label>
                                            <input type="text" required class="form-control" name="address" id="autocomplete">
                                            <div id="map"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="form-label">Zip Code</label>
                                            <input name="zip_code" id="zipcode-input" type="text" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">State</label>
                                            <input type="text"  class="form-control" name="state">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">City</label>
                                            <input type="text"  class="form-control" name="city">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Office Phone</label>
                                            <input type="text" class="form-control" name="office_phone">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Office Email</label>
                                            <input type="text" class="form-control" name="office_email">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-label">Property Image</label>
                                            <input type="file" class="form-control" name="image">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-label">Location Notes</label>
                                            <textarea class="form-control" name="location_notes" placeholder="Location Notes"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div id="container">
                                            <div class="row row-to-clone" style=" border: 1px solid #E4E6EF; padding-top: 10px; margin: 0px; margin-top: 10px; border-radius: 0.42rem; ">
                                                <div class="col-md-11">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="form-label">Rep Name</label>
                                                                <input type="text" class="form-control" name="repname[]">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="form-label">Rep Position</label>
                                                                <input type="text" class="form-control" name="repposition[]">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="form-label">Rep Phone</label>
                                                                <input type="text" class="form-control" name="repphone[]">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="form-label">Rep Email</label>
                                                                <input type="text" class="form-control" name="repemail[]">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-1 pt-10">
                                                    <span class="material-icons add-circle" style="cursor: pointer;">add_circle</span>
                                                    <span class="material-icons remove-circle" style="cursor: pointer; display: none;">remove_circle</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mt-5">
                                        <div class="form-group">
                                            <label class="form-label">Parent Service</label>
                                            <select class="form-control" onchange="selectservice(this.value)" name="parent_service" id="parent_service">
                                                <option>Parent Service</option>
                                                @foreach(DB::table('services')->where('trashstatus' , 0)->wherenull('parent_id')->where('status' ,1)->get() as $r)   
                                                <option value="{{ $r->id }}">{{ $r->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mt-5">
                                        <div class="form-group">
                                            <label class="form-label">Service</label>
                                            <select multiple class="form-control" name="service[]" id="service">
                                                                                                
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Providers Available</label>
                                            <select multiple class="form-control" name="providers_available[]" id="providers">
                                                <option>Select Providers</option>
                                                @foreach(DB::table('providers')
                                                          ->join('services', 'providers.service', '=', 'services.id')
                                                          ->where('services.trashstatus', '!=', 1)
                                                          ->select('providers.id', 'providers.name')
                                                          ->get() as $r )   
                                                <option value="{{ $r->id }}">{{ $r->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Providers Recomended</label>
                                            <select multiple class="form-control" name="providers_recommended[]" id="providers_recommended">
                                                <option>Select Providers</option>
                                                @foreach(DB::table('providers')
                                                          ->join('services', 'providers.service', '=', 'services.id')
                                                          ->where('services.trashstatus', '!=', 1)
                                                          ->select('providers.id', 'providers.name')
                                                          ->get() as $r )   
                                                <option value="{{ $r->id }}">{{ $r->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Grade</label>
                                            <input type="text" placeholder="Grade" class="form-control" name="grade">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Select Route</label>
                                            <select multiple class="form-control" name="routes[]" id="routes">
                                                <option>Select Route</option>
                                                <option value="Call">Call</option>
                                                <option value="Visit">Visit</option>
                                                <option value="Email">Email</option>
                                                <option value="Bags">Bags</option>
                                                <option value="Gift Cards">Gift Card</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-label">Features</label>
                                            <textarea class="form-control" name="features"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-label">Amenities</label>
                                            <textarea class="form-control" name="amenities"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="allowed">Place a Checkmark if Allowed</label>
                                        <div id="allowed" class="row">
                                            <div class="col-md-4">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="mark_call" name="mark_call">
                                                    <label class="form-check-label" for="mark_call">Mark Call</label>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="mark_visit" name="mark_visit">
                                                    <label class="form-check-label" for="mark_visit">Mark Visit</label>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="mark_email" name="mark_email">
                                                    <label class="form-check-label" for="mark_email">Mark Email</label>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="mark_bags" name="mark_bags">
                                                    <label class="form-check-label" for="mark_bags">Mark Bags</label>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="mark_gift_cards" name="mark_gift_cards">
                                                    <label class="form-check-label" for="mark_gift_cards">Mark Gift Cards</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-md-4">
                                        <button type="submit" class="btn btn-primary form-control">Save & Publish</button>
                                    </div>
                                    <div class="col-md-4">
                                        <span class="btn btn-primary form-control">Move to Pending</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="card card-custom mt-5">
                            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                                <div class="card-title">
                                    <span class="card-label font-weight-bolder text-dark">Default</span>
                                </div>
                            </div>
                            <div class="card-body" >
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-label">Select Continent</label>
                                            <select class="form-control" name="continent">
                                                <option>Select Continent</option>

                                                <option selected value="North America">North America</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-label">Select Country</label>
                                            <select class="form-control" name="country">
                                                <option>Select Country</option>
                                                <option selected value="United States">United States</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-label">Property Type</label>
                                            <select class="form-control" name="property_type">
                                                <option>Select Property Type</option>
                                                <option value="commercial">Commercial</option>
                                                <option value="residential">Residential</option>
                                                <option value="Multi-Family" selected>Multi-Family</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-label">Secondry Type</label>
                                            <select class="form-control" name="secondary_type">
                                                <option>Select Secondry Type</option>
                                                <option value="Apartments" selected>Apartments</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="accordion" id="accordionone">
                            <div class="card card-custom mt-5">
                                <div data-toggle="collapse" data-target="#propertydetails" class="card-header bg-white d-flex justify-content-between align-items-center">
                                    <div class="card-title">
                                        <span class="card-label font-weight-bolder text-dark">Property Details</span>
                                    </div>
                                    <div class="accordion-icon">
                                        <i class="fas fa-plus"></i>
                                    </div>
                                </div>
                                <div id="propertydetails" class="collapse" data-parent="#accordionone">
                                    <div class="card-body" style=" height: 300px; overflow: auto; ">
                                        <div class="row">
                                            <div class="col-md-6 mt-5">
                                                <div class="form-group">
                                                    <label for="county_name">County Name</label>
                                                    <input type="text" class="form-control" id="county_name" name="county_name" maxlength="100" placeholder="Enter County Name">
                                                </div>
                                            </div>
                                            <div class="col-md-6 mt-5">
                                                <div class="form-group">
                                                    <label for="year_built">Year Built</label>
                                                    <input type="number" class="form-control" id="year_built" name="year_built" min="1900" max="2100" placeholder="Enter Year Built">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="no_of_elevators">Number of Elevators</label>
                                                    <input type="number" class="form-control" id="no_of_elevators" name="no_of_elevators" min="0" placeholder="Enter Number of Elevators">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="total_available_sf">Total Available SF</label>
                                                    <input type="number" class="form-control" id="total_available_sf" name="total_available_sf" step="0.01" placeholder="Enter Total Available SF">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="land_area">Land Area</label>
                                                    <input type="number" class="form-control" id="land_area" name="land_area" step="0.01" placeholder="Enter Land Area">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="vacancy">Vacancy</label>
                                                    <input type="number" class="form-control" id="vacancy" name="vacancy" step="0.01" placeholder="Enter Vacancy Rate">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="no_of_stories">Number of Stories</label>
                                                    <input type="number" class="form-control" id="no_of_stories" name="no_of_stories" min="0" placeholder="Enter Number of Stories">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="style">Style</label>
                                                    <input type="text" class="form-control" id="style" name="style" maxlength="255" placeholder="Enter Style">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="year_renovated">Year Renovated</label>
                                                    <input type="number" class="form-control" id="year_renovated" name="year_renovated" min="1900" max="2100" placeholder="Enter Year Renovated">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="construct_status">Construct Status</label>
                                                    <input type="text" class="form-control" id="construct_status" name="construct_status" maxlength="255" placeholder="Enter Construct Status">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="construction_material">Construction Material</label>
                                                    <input type="text" class="form-control" id="construction_material" name="construction_material" maxlength="255" placeholder="Enter Construction Material">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="affordable_type">Affordable Type</label>
                                                    <input type="text" class="form-control" id="affordable_type" name="affordable_type" maxlength="255" placeholder="Enter Affordable Type">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="no_of_parking_spaces">Number of Parking Spaces</label>
                                                    <input type="number" class="form-control" id="no_of_parking_spaces" name="no_of_parking_spaces" min="0" placeholder="Enter Number of Parking Spaces">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="construction_begin">Construction Begin Date</label>
                                                    <input type="date" class="form-control" id="construction_begin" name="construction_begin">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="parcel_no_1">Parcel No 1</label>
                                                    <input type="text" class="form-control" id="parcel_no_1" name="parcel_no_1" maxlength="255" placeholder="Enter Parcel No 1">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="parcel_no_2">Parcel No 2</label>
                                                    <input type="text" class="form-control" id="parcel_no_2" name="parcel_no_2" maxlength="255" placeholder="Enter Parcel No 2">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="architect_name">Architect Name</label>
                                                    <input type="text" class="form-control" id="architect_name" name="architect_name" maxlength="255" placeholder="Enter Architect Name">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="developer_name">Developer Name</label>
                                                    <input type="text" class="form-control" id="developer_name" name="developer_name" maxlength="255" placeholder="Enter Developer Name">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="for_sale_price">For Sale Price</label>
                                                    <input type="number" class="form-control" id="for_sale_price" name="for_sale_price" step="0.01" placeholder="Enter For Sale Price">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="last_sale_date">Last Sale Date</label>
                                                    <input type="date" class="form-control" id="last_sale_date" name="last_sale_date">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="last_sale_price">Last Sale Price</label>
                                                    <input type="number" class="form-control" id="last_sale_price" name="last_sale_price" step="0.01" placeholder="Enter Last Sale Price">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="university">University</label>
                                                    <input type="text" class="form-control" id="university" name="university" maxlength="255" placeholder="Enter University">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="submarket">Submarket</label>
                                                    <input type="text" class="form-control" id="submarket" name="submarket" maxlength="255" placeholder="Enter Submarket">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="closest_transit_stop">Closest Transit Stop</label>
                                                    <input type="text" class="form-control" id="closest_transit_stop" name="closest_transit_stop" maxlength="255" placeholder="Enter Closest Transit Stop">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="closest_transit_stop_walk_time">Closest Transit Stop Walk Time</label>
                                                    <input type="time" class="form-control" id="closest_transit_stop_walk_time" name="closest_transit_stop_walk_time">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="longitude">Longitude</label>
                                                    <input type="number" class="form-control" id="longitude" name="longitude" step="0.00000001" placeholder="Enter Longitude">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="latitude">Latitude</label>
                                                    <input type="number" class="form-control" id="latitude" name="latitude" step="0.00000001" placeholder="Enter Latitude">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="accordion" id="accordiontwo">
                            <div class="card card-custom mt-5">
                                <div data-toggle="collapse" data-target="#ownerinformation" class="card-header bg-white d-flex justify-content-between align-items-center">
                                    <div class="card-title">
                                        <span class="card-label font-weight-bolder text-dark">Owner Information</span>
                                    </div>
                                    <div class="accordion-icon">
                                        <i class="fas fa-plus"></i>
                                    </div>
                                </div>
                                <div id="ownerinformation" class="collapse" data-parent="#accordiontwo">
                                    <div class="card-body" style=" height: 300px; overflow: auto; ">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="owner_name">Owner Name</label>
                                                    <input type="text" class="form-control" id="owner_name" name="owner_name" maxlength="255" placeholder="Enter Owner Name">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="true_owner_name">True Owner Name</label>
                                                    <input type="text" class="form-control" id="true_owner_name" name="true_owner_name" maxlength="255" placeholder="Enter True Owner Name">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="recorded_owner_name">Recorded Owner Name</label>
                                                    <input type="text" class="form-control" id="recorded_owner_name" name="recorded_owner_name" maxlength="255" placeholder="Enter Recorded Owner Name">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="owner_phone">Owner Phone</label>
                                                    <input type="tel" class="form-control" id="owner_phone" name="owner_phone" maxlength="20" placeholder="Enter Owner Phone">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="true_owner_phone">True Owner Phone</label>
                                                    <input type="tel" class="form-control" id="true_owner_phone" name="true_owner_phone" maxlength="20" placeholder="Enter True Owner Phone">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="owner_address">Owner Address</label>
                                                    <input type="text" class="form-control" id="owner_address" name="owner_address" maxlength="255" placeholder="Enter Owner Address">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="recorded_owner_address">Recorded Owner Address</label>
                                                    <input type="text" class="form-control" id="recorded_owner_address" name="recorded_owner_address" maxlength="255" placeholder="Enter Recorded Owner Address">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="true_owner_address">True Owner Address</label>
                                                    <input type="text" class="form-control" id="true_owner_address" name="true_owner_address" maxlength="255" placeholder="Enter True Owner Address">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="owner_city_state_zip">Owner City, State, ZIP</label>
                                                    <input type="text" class="form-control" id="owner_city_state_zip" name="owner_city_state_zip" maxlength="255" placeholder="Enter Owner City, State, ZIP">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="recorded_owner_city_state_zip">Recorded Owner City, State, ZIP</label>
                                                    <input type="text" class="form-control" id="recorded_owner_city_state_zip" name="recorded_owner_city_state_zip" maxlength="255" placeholder="Enter Recorded Owner City, State, ZIP">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="true_owner_city_state_zip">True Owner City, State, ZIP</label>
                                                    <input type="text" class="form-control" id="true_owner_city_state_zip" name="true_owner_city_state_zip" maxlength="255" placeholder="Enter True Owner City, State, ZIP">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="owner_contact">Owner Contact</label>
                                                    <input type="text" class="form-control" id="owner_contact" name="owner_contact" maxlength="255" placeholder="Enter Owner Contact">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="true_owner_contact">True Owner Contact</label>
                                                    <input type="text" class="form-control" id="true_owner_contact" name="true_owner_contact" maxlength="255" placeholder="Enter True Owner Contact">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="property_id">Property ID</label>
                                                    <input type="text" class="form-control" id="property_id" name="property_id" placeholder="Enter Property ID">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="accordion" id="accordionthree">
                            <div class="card card-custom mt-5">
                                <div data-toggle="collapse" data-target="#leasingdetails" class="card-header bg-white d-flex justify-content-between align-items-center">
                                    <div class="card-title">
                                        <span class="card-label font-weight-bolder text-dark">Leasing Details</span>
                                    </div>
                                    <div class="accordion-icon">
                                        <i class="fas fa-plus"></i>
                                    </div>
                                </div>
                                <div id="leasingdetails" class="collapse" data-parent="#accordionthree">
                                    <div class="card-body" style=" height: 300px; overflow: auto; ">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="property_manager_name">Property Manager Name</label>
                                                    <input type="text" class="form-control" id="property_manager_name" name="property_manager_name" maxlength="255" placeholder="Enter Property Manager Name">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="leasing_company_name">Leasing Company Name</label>
                                                    <input type="text" class="form-control" id="leasing_company_name" name="leasing_company_name" maxlength="255" placeholder="Enter Leasing Company Name">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="leasing_company_address">Leasing Company Address</label>
                                                    <input type="text" class="form-control" id="leasing_company_address" name="leasing_company_address" maxlength="255" placeholder="Enter Leasing Company Address">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="leasing_company_city_state_zip_code">Leasing Company City, State, ZIP Code</label>
                                                    <input type="text" class="form-control" id="leasing_company_city_state_zip_code" name="leasing_company_city_state_zip_code" maxlength="255" placeholder="Enter Leasing Company City, State, ZIP Code">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="leasing_company_contact">Leasing Company Contact</label>
                                                    <input type="text" class="form-control" id="leasing_company_contact" name="leasing_company_contact" maxlength="255" placeholder="Enter Leasing Company Contact">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="leasing_company_phone">Leasing Company Phone</label>
                                                    <input type="tel" class="form-control" id="leasing_company_phone" name="leasing_company_phone" maxlength="20" placeholder="Enter Leasing Company Phone">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="property_manager_address">Property Manager Address</label>
                                                    <input type="text" class="form-control" id="property_manager_address" name="property_manager_address" maxlength="255" placeholder="Enter Property Manager Address">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="accordion" id="accordionfour">
                            <div class="card card-custom mt-5">
                                <div data-toggle="collapse" data-target="#appartmentrentalinfo" class="card-header bg-white d-flex justify-content-between align-items-center">
                                    <div class="card-title">
                                        <span class="card-label font-weight-bolder text-dark">Appartment Rental Information</span>
                                    </div>
                                    <div class="accordion-icon">
                                        <i class="fas fa-plus"></i>
                                    </div>
                                </div>
                                <div id="appartmentrentalinfo" class="collapse" data-parent="#accordionfour">
                                    <div class="card-body" style=" height: 300px; overflow: auto; ">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="no_of_1_bedroom">No. of 1 Bedroom</label>
                                                    <input type="number" class="form-control" id="no_of_1_bedroom" name="no_of_1_bedroom" placeholder="Enter No. of 1 Bedroom">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="one_bedroom_asking_rent">One Bedroom Asking Rent</label>
                                                    <input type="number" class="form-control" id="one_bedroom_asking_rent" name="one_bedroom_asking_rent" step="0.01" placeholder="Enter One Bedroom Asking Rent">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="one_bedroom_effective_rent">One Bedroom Effective Rent</label>
                                                    <input type="number" class="form-control" id="one_bedroom_effective_rent" name="one_bedroom_effective_rent" step="0.01" placeholder="Enter One Bedroom Effective Rent">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="one_bedroom_avg_sf">One Bedroom Avg. SF</label>
                                                    <input type="number" class="form-control" id="one_bedroom_avg_sf" name="one_bedroom_avg_sf" step="0.01" placeholder="Enter One Bedroom Avg. SF">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="one_vacant_units">One Bedroom Vacant Units</label>
                                                    <input type="number" class="form-control" id="one_vacant_units" name="one_vacant_units" placeholder="Enter One Bedroom Vacant Units">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="no_of_2_bedroom">No. of 2 Bedroom</label>
                                                    <input type="number" class="form-control" id="no_of_2_bedroom" name="no_of_2_bedroom" placeholder="Enter No. of 2 Bedroom">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="two_bedroom_asking_rent">Two Bedroom Asking Rent</label>
                                                    <input type="number" class="form-control" id="two_bedroom_asking_rent" name="two_bedroom_asking_rent" step="0.01" placeholder="Enter Two Bedroom Asking Rent">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="two_bedroom_effective_rent">Two Bedroom Effective Rent</label>
                                                    <input type="number" class="form-control" id="two_bedroom_effective_rent" name="two_bedroom_effective_rent" step="0.01" placeholder="Enter Two Bedroom Effective Rent">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="two_bedroom_avg_sf">Two Bedroom Avg. SF</label>
                                                    <input type="number" class="form-control" id="two_bedroom_avg_sf" name="two_bedroom_avg_sf" step="0.01" placeholder="Enter Two Bedroom Avg. SF">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="two_vacant_units">Two Bedroom Vacant Units</label>
                                                    <input type="number" class="form-control" id="two_vacant_units" name="two_vacant_units" placeholder="Enter Two Bedroom Vacant Units">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="no_of_3_bedroom">No. of 3 Bedroom</label>
                                                    <input type="number" class="form-control" id="no_of_3_bedroom" name="no_of_3_bedroom" placeholder="Enter No. of 3 Bedroom">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="three_bedroom_asking_rent">Three Bedroom Asking Rent</label>
                                                    <input type="number" class="form-control" id="three_bedroom_asking_rent" name="three_bedroom_asking_rent" step="0.01" placeholder="Enter Three Bedroom Asking Rent">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="three_bedroom_effective_rent">Three Bedroom Effective Rent</label>
                                                    <input type="number" class="form-control" id="three_bedroom_effective_rent" name="three_bedroom_effective_rent" step="0.01" placeholder="Enter Three Bedroom Effective Rent">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="three_bedroom_avg_sf">Three Bedroom Avg. SF</label>
                                                    <input type="number" class="form-control" id="three_bedroom_avg_sf" name="three_bedroom_avg_sf" step="0.01" placeholder="Enter Three Bedroom Avg. SF">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="three_vacant_units">Three Bedroom Vacant Units</label>
                                                    <input type="number" class="form-control" id="three_vacant_units" name="three_vacant_units" placeholder="Enter Three Bedroom Vacant Units">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="no_of_4_bedroom">No. of 4 Bedroom</label>
                                                    <input type="number" class="form-control" id="no_of_4_bedroom" name="no_of_4_bedroom" placeholder="Enter No. of 4 Bedroom">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="four_bedroom_asking_rent">Four Bedroom Asking Rent</label>
                                                    <input type="number" class="form-control" id="four_bedroom_asking_rent" name="four_bedroom_asking_rent" step="0.01" placeholder="Enter Four Bedroom Asking Rent">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="four_bedroom_effective_rent">Four Bedroom Effective Rent</label>
                                                    <input type="number" class="form-control" id="four_bedroom_effective_rent" name="four_bedroom_effective_rent" step="0.01" placeholder="Enter Four Bedroom Effective Rent">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="four_bedroom_avg_sf">Four Bedroom Avg. SF</label>
                                                    <input type="number" class="form-control" id="four_bedroom_avg_sf" name="four_bedroom_avg_sf" step="0.01" placeholder="Enter Four Bedroom Avg. SF">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="four_vacant_units">Four Bedroom Vacant Units</label>
                                                    <input type="number" class="form-control" id="four_vacant_units" name="four_vacant_units" placeholder="Enter Four Bedroom Vacant Units">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="no_of_studios">No. of Studios</label>
                                                    <input type="number" class="form-control" id="no_of_studios" name="no_of_studios" placeholder="Enter No. of Studios">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="studio_asking_rent">Studio Asking Rent</label>
                                                    <input type="number" class="form-control" id="studio_asking_rent" name="studio_asking_rent" step="0.01" placeholder="Enter Studio Asking Rent">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="studio_effective_rent">Studio Effective Rent</label>
                                                    <input type="number" class="form-control" id="studio_effective_rent" name="studio_effective_rent" step="0.01" placeholder="Enter Studio Effective Rent">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="studio_avg_sf">Studio Avg. SF</label>
                                                    <input type="number" class="form-control" id="studio_avg_sf" name="studio_avg_sf" step="0.01" placeholder="Enter Studio Avg. SF">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="studio_vacant_units">Studio Vacant Units</label>
                                                    <input type="number" class="form-control" id="studio_vacant_units" name="studio_vacant_units" placeholder="Enter Studio Vacant Units">
                                                </div>
                                            </div>
                                        </div>
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
@endsection
@section('script')
<script>
    $(document).ready(function(){
        // Function to add a new row
        $(document).on('click', '.add-circle', function(){
            var $clone = $('.row-to-clone:first').clone();
            $clone.find('input').val(''); // Clear input values in the cloned row
            
            // Show remove icon and hide add icon in the cloned row
            $clone.find('.remove-circle').show();
            $clone.find('.add-circle').hide();
            
            $('#container').append($clone);
        });

        // Function to remove a row
        $(document).on('click', '.remove-circle', function(){
            // Check if there is more than one row-to-clone, so we don't remove the last one
            if ($('.row-to-clone').length > 1) {
                $(this).closest('.row-to-clone').remove();
            } else {
                alert("You must have at least one row.");
            }
        });
    });
$('#providers').select2({
        placeholder: "Select Providers",
});
$('#providers_recommended').select2({
        placeholder: "Select Providers",
});
$('#routes').select2({
    placeholder: "Please Select Routes",
});
$('#parent_service').select2({
    placeholder: "Please Select Parent service Service",
});
$('#service').select2({
    placeholder: "Please Select Service",
});

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

    // Initialize the autocomplete
    google.maps.event.addDomListener(window, 'load', initAutocomplete);

</script>
<script type="text/javascript">
function selectservice(id) {
    if(id){
        $.ajax({
            type: 'get',
            url: '{{ url("admin/properties/getplanchildservices") }}/'+id,
            success: function(res) {
                $('#service').html(res);   
            }
        });
    }
}
</script>
@endsection