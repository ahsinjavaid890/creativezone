@extends('admin.layouts.main-layout')
@section('title','Update Order')
@section('content')
 <!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <div class="d-flex align-items-center flex-wrap mr-2">
                <h5 class="text-blue font-weight-bold mt-2 mb-2 mr-5">
                    Update Order
                </h5>
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <a href="{{ url('admin/dashboard') }}" class="text-blue font-weight-bold mt-2 mb-2 mr-5">
                    Dashboard
                </a>
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <a href="{{ url('admin/orders/serviceorder') }}" class="text-blue font-weight-bold mt-2 mb-2 mr-5">
                    Service Orders
                </a>
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <a href="javascript:void(0)" class="text-dark font-weight-bold mt-2 mb-2 mr-5">
                    Update Order
                </a>
            </div>
        </div>
    </div>
    <!--end::Subheader-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class=" container-fluid ">
            @include('alerts.index')
            <form enctype="multipart" action="{{ url('admin/orders/updateorder') }}" method="POST">
                @csrf
                <input type="hidden" name="submit_type" id="submit_type" >
                <input type="hidden" name="id" value="{{ $data->id }}">
                <div class="row">
                    <div class="col-md-8">
                        <div class="accordion accordion-toggle-arrow" id="addcarddetail">
                            <div class="card card-custom mt-5">
                                <div data-toggle="collapse" data-target="#refferdby" class="card-header bg-white d-flex justify-content-between align-items-center">
                                    <div class="card-title">
                                        <span class="card-label font-weight-bolder text-dark">Referred By</span>
                                    </div>
                                    <div class="accordion-icon">
                                        <i class="fas fa-plus"></i>
                                    </div>
                                </div>
                                <div id="refferdby" class="collapse" data-parent="#addcarddetail">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Community</label>
                                                    <select onchange="selectproperty(this.value)" id="allproperties" class="form-control" name="property">
                                                        <option value="">Select Community</option>
                                                        @foreach(DB::table('properties')->where('property_type', $data->property_type)->get() as $r)
                                                        <option @if($data->property == $r->id) selected @endif value="{{ $r->id }}">{{ $r->property_name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="row">
                                                    <div class="col-md-11">
                                                        <div class="form-group">
                                                            <label>Community Rep</label>
                                                            <select class="form-control" name="reps" id="showpropertiesrep">
                                                                <option value="">Select Reps</option>
                                                                @foreach(DB::table('properties_reps')->where('property_id', $data->property)->get() as $r)
                                                                <option @if($data->reps == $r->id) selected @endif value="{{ $r->id }}">{{ $r->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    @if($data->property)
                                                    @php
                                                    $propeties = DB::table('properties')->where('id' , $data->property)->first();
                                                    @endphp
                                                    <div class="col-md-1" style="padding: 0;">
                                                        <div class="dropdown dropdown-inline">
                                                            <a href="#" class="btn btn-icon btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                <span class="material-icons add-circle" style="cursor: pointer;">more_vert</span>
                                                            </a>
                                                            <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                                                                <ul class="navi navi-hover">
                                                                    <li class="navi-item">
                                                                        <a target="_blank" href="{{ url('admin/properties/addproperty') }}" class="navi-link">
                                                                            <span class="navi-text">Add New Community</span>
                                                                        </a>
                                                                    </li>
                                                                    <li class="navi-item">
                                                                        <a target="_blank" href="{{ url('admin/properties/editproperty') }}/{{ $propeties->id }}" class="navi-link">
                                                                            <span class="navi-text">Edit Community</span>
                                                                        </a>
                                                                    </li>
                                                                    <li class="navi-item">
                                                                        <a target="_blank" href="https://www.google.com/maps?q={{ urlencode($propeties->property_address) }}" class="navi-link">
                                                                            <span class="navi-text">Map Location</span>
                                                                        </a>
                                                                    </li>
                                                                    <li class="navi-item">
                                                                        <a target="_blank" href="https://www.google.com/maps/dir/?api=1&destination='{{$propeties->property_address}}'" class="navi-link">
                                                                            <span class="navi-text">Direction</span>
                                                                        </a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                @if($data->property)
                                                 <span id="apartment_note" style="float: left;font-size: 10px;">{{ $propeties->location_notes }}  | {{ $propeties->no_of_units }} | #{{ $propeties->office_phone }}  | {{ $propeties->level }} </span>
                                                 @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card card-custom mt-5">
                            <div class="card-header flex-wrap"> 
                                <h3 class="card-title align-items-start flex-column">
                                    <span class="card-label font-weight-bolder text-dark">Customer Info</span>
                                </h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    @php
                                        $nameParts = explode(' ', $data->name);
                                        $firstName = array_shift($nameParts);
                                        $lastName = implode(' ', $nameParts);
                                    @endphp
                                    <div class="col-md-6 col-sm-6">
                                        <div class="form-group">
                                            <label>First Name </label>
                                            <input type="text" placeholder="Enter First Name" class="form-control"  name="fname" value="{{ $firstName ?? ''}}">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6">
                                        <div class="form-group">
                                            <label>Last Name </label>
                                            <input type="text" placeholder="Enter Last Name" class="form-control"  name="lname" value="{{ $lastName ?? '' }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Phone </label>
                                            <input type="text" placeholder="Enter Customer phone Number" class="form-control"  name="phone" value="{{ $data->phone ?? '' }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Email </label>
                                            <input type="text" placeholder="Enter Customer Email" class="form-control"  name="email" value="{{ $data->email ?? '' }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6  col-sm-6">
                                        <div class="form-group">
                                            <label>Address </label>
                                            <input type="text" placeholder="Enter Address" class="form-control"  name="address" id="address-input" value="{{ $data->address ?? '' }}">
                                            <div id="map"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-md-3">
                                        <div class="form-group">
                                            <label>Unit No</label>
                                            <input type="text" placeholder="Unit No" class="form-control"  name="apartment" value="{{ $data->house_no ?? '' }}">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Zip Code </label>
                                            <input id="zipcode-input" type="number" placeholder="Zipcode" class="form-control"  name="pin_code" onkeyup="selectchildservice()" value="{{ $data->pin_code ?? '' }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card card-custom mt-5">
                            <div class="card-header flex-wrap"> 
                                <h3 class="card-title align-items-start flex-column">
                                    <span class="card-label font-weight-bolder text-dark">Provider / Plan</span>
                                </h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group" id="zipcodeprovider">
                                            <label>Providers </label>
                                            <select  class="form-control"  name="provider" id="getprovider" onchange="selectproviderservice(this.value)" >
                                                <option>Select Providers</option>
                                                @foreach(DB::table('providers')->where('id', $data->provider)->get() as $r)
                                                <option @if($data->provider == $r->id) selected @endif value="{{ $r->id }}">{{ $r->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label>Provider Services Offerd </label>
                                            <select multiple class="form-control"  name="providerservice[]" id="showchildservices" onchange="selectplan(this.value)">
                                                @foreach(DB::table('services')->whereIn('id', explode(',', $data->providerservice))->get() as $r)
                                                    <option value="{{ $r->id }}" 
                                                        @if(in_array($r->id, explode(',', $data->providerservice)))
                                                            selected
                                                        @endif
                                                    >
                                                        {{ $r->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div style="padding:0px;" class="col-md-1">
                                        <div class="dropdown dropdown-inline">
                                            <a href="#" class="btn btn-icon btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                               <span class="material-symbols-outlined">more_vert</span>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                                                <ul class="navi navi-hover" id="providerlinks">
                                                    <li class="navi-item">
                                                        <a href="{{ url('admin/services/addprovider') }}" class="navi-link" target="_blank">
                                                            <span class="navi-text">Add Provider</span>
                                                        </a>
                                                    </li>
                                                    @php
                                                        $links = DB::table('providers')->where('id' , $data->provider)->first();
                                                    @endphp
                                                    <li class="navi-item">
                                                        <a href="javascript:void(0)" onclick="selectchildservice({{ $links->id }})" class="navi-link">
                                                            <span class="navi-text">Available Provider</span>
                                                        </a>
                                                    </li>
                                                    <li class="navi-item">
                                                        <a href="javascript:void(0)" onclick="allprovider({{ $links->id }})" class="navi-link">
                                                            <span class="navi-text">Not Available Provider</span>
                                                        </a>
                                                    </li>
                                                    <li class="navi-item">
                                                        <a href="{{ $links->website }}" class="navi-link" target="_blank">
                                                            <span class="navi-text">Website</span>
                                                        </a>
                                                    </li>
                                                    <li class="navi-item">
                                                        <a href="{{ $links->url }}" class="navi-link"  target="_blank">
                                                            <span class="navi-text">Portal Link</span>
                                                        </a>
                                                    </li>
                                                    <li class="navi-item">
                                                        <a data-toggle="modal" data-target="#exampleModalSizeXl" href="javascript:void(0)" class="navi-link">
                                                            <span class="navi-text">Provider Notes</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-11">
                                        <div class="form-group">
                                            <label>Select Plans</label>
                                            <select class="form-control"  name="plan" onchange="getplandetail(this.value)" id="showplans">
                                                @foreach(DB::table('plans')->where('id' , $data->plan)->get() as $r)
                                                <option @if($data->plan == $r->id) selected @endif value="{{ $r->id }}">@if($r->price) ${{ $r->price }}, @endif @if($r->originalprice) ${{ $r->originalprice }}, @endif @if($r->planname) {{ $r->planname }},@endif @if($r->planname) {{ $r->plantype }} @endif </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div style="padding:0px;" class="col-md-1">
                                        <div class="dropdown dropdown-inline">
                                            <a href="#" class="btn btn-icon btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                               <span class="material-symbols-outlined">more_vert</span>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                                                <ul class="navi navi-hover">
                                                    <li class="navi-item">
                                                        <a data-toggle="modal" data-target="#plandetail" href="javascript::void(0)" class="navi-link"><span class="navi-text">Plans Details  </span></a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Follow Up date</label>
                                            <input type="date" placeholder="Follow Up Date" class="form-control" name="followdate" value="{{ $data->followdate ?? '' }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Follow Up Note</label>
                                            <input type="text" placeholder="Follow Up Note" class="form-control" name="follownote" value="{{ $data->follownote ?? '' }}">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Select Order status</label>
                                            <select required onchange="selectorderstatus()" id="orderstatus" class="form-control"  name="order_status">
                                                <option value="">Select Order status</option>
                                                <option @if($data->order_status == 'Service request') selected @endif  value="Service request">Service request</option>
                                                <option @if($data->order_status == 'Pending') selected @endif value="Pending">Pending</option>
                                                <option @if($data->order_status == 'Completed') selected @endif value="Completed">Completed</option>
                                                <option @if($data->order_status == 'Connected') selected @endif value="Connected">Connected</option>
                                                <option @if($data->order_status == 'Disconnected') selected @endif value="Disconnected">Disconnected</option>
                                                <option @if($data->order_status == 'Inquiry') selected @endif value="Inquiry">Inquiry</option>
                                                <option @if($data->order_status == 'Chargeback') selected @endif value="Chargeback">Chargeback</option>
                                                <option @if($data->order_status == 'Paid') selected @endif value="Paid">Paid</option>
                                                <option @if($data->order_status == 'Dealer Paid') selected @endif value="Dealer Paid">Dealer Paid</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Order status date</label>
                                            <input type="date" placeholder="Order status date" class="form-control" name="order_status_date" value="{{ $order_status->order_status_date ?? '' }}">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Recouncil Status </label>
                                            <select class="form-control"  name="recouncil_status">
                                                <option>Reconcile Status</option>
                                                <option @if($data->reconcil_status == 'Lead') selected @endif value="Lead">Lead</option>
                                                <option @if($data->reconcil_status == 'Pending') selected @endif value="Pending">Pending</option>
                                                <option @if($data->reconcil_status == 'Installed') selected @endif value="Installed">Installed</option>
                                                <option @if($data->reconcil_status == 'Dealer Paid') selected @endif value="Dealer Paid">Dealer Paid</option>
                                                <option @if($data->reconcil_status == 'Dispute Chargeback') selected @endif value="Dispute Chargeback">Dispute Chargeback</option>
                                                <option @if($data->reconcil_status == 'Connected') selected @endif value="Connected">Connected</option>
                                                <option @if($data->reconcil_status == 'Rep paid') selected @endif value="Rep paid">Rep paid</option>
                                                <option @if($data->reconcil_status == 'Rep Chargeback') selected @endif value="Rep Chargeback">Rep Chargeback</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Recouncil status date</label>
                                            <input type="date" class="form-control" name="recouncil_status_date" value="{{ $order_status->recouncil_status_date ?? '' }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Insatall Type </label>
                                            <select class="form-control"  name="install_type">
                                                <option value="">Install type</option>
                                                <option @if($data->install_type == 'Professional') selected @endif value="Professional">Professional</option>
                                                <option @if($data->install_type == 'Self-Install') selected @endif value="Self-Install"> Self-Install</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Install Date </label>
                                            <input type="date" placeholder="Install Date" class="form-control"  name="instal_date" value="{{ $data->instal_date ?? '' }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="accordion accordion-toggle-arrow" id="addcarddetail">
                            <div class="card card-custom mt-5">
                                <div data-toggle="collapse" data-target="#orderinformation" class="card-header bg-white d-flex justify-content-between align-items-center">
                                    <div class="card-title">
                                        <span class="card-label font-weight-bolder text-dark">Order Information</span>
                                    </div>
                                    <div class="accordion-icon">
                                        <i class="fas fa-plus"></i>
                                    </div>
                                </div>
                                <div id="orderinformation" class="collapse" data-parent="#addcarddetail">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Account NO </label>
                                                    <input type="text" placeholder="Account No" class="form-control"  name="accountno"  value="{{ $data->accountno ?? '' }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Word Order Number </label>
                                                    <input type="text" placeholder="Work Order Number" class="form-control"  name="order_number" value="{{ $data->order_number ?? ''  }}">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Order Note </label>
                                                    <textarea class="form-control" rows="5" placeholder="Order Notes"  name="order_note">{{ $data->order_note ?? ''  }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="accordion accordion-toggle-arrow" id="addcarddetail">
                            <div class="card card-custom mt-5">
                                <div data-toggle="collapse" data-target="#creditcheck" class="card-header bg-white d-flex justify-content-between align-items-center">
                                    <div class="card-title">
                                        <span class="card-label font-weight-bolder text-dark">Credit Check</span>
                                    </div>
                                    <div class="accordion-icon">
                                        <i class="fas fa-plus"></i>
                                    </div>
                                </div>
                                <div id="creditcheck" class="collapse" data-parent="#addcarddetail">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>SSN</label>
                                                    <input type="password" placeholder="SSN" class="form-control" name="ssn" id="ssn" value="{{ $data->ssn }}">
                                                    <span class="toggle-visibility" id="toggleSSN">
                                                        <i class="fa fa-eye"></i>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>ID Type</label>
                                                    <select name="id_type" class="form-control">
                                                        <option>Select ID Type</option>
                                                        <option @if($data->id_type == 'DL #')   selected @endif value="DL #">DL #</option>
                                                        <option @if($data->id_type == 'Passport')   selected @endif value="Passport">Passport</option>
                                                        <option @if($data->id_type == 'Student ID')   selected @endif value="Student ID">Student ID</option>
                                                        <option @if($data->id_type == 'Other')   selected @endif value="Other">Other</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>ID Number</label>
                                                    <input  type="text" placeholder="Enter ID Number" class="form-control" name="idnumber" value="{{ $data->idnumber }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>ID Expiry Date</label>
                                                    <input type="date" class="form-control" name="id_expiry_date" value="{{ $data->id_expiry_date }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="accordion accordion-toggle-arrow" id="addcarddetail">
                            <div class="card card-custom mt-5">
                                <div data-toggle="collapse" data-target="#collapseOne1" class="card-header bg-white d-flex justify-content-between align-items-center">
                                    <div class="card-title">
                                        <span class="card-label font-weight-bolder text-dark"> Payment</span>
                                    </div>
                                    <div class="accordion-icon">
                                        <i class="fas fa-plus"></i>
                                    </div>
                                </div>
                                <div id="collapseOne1" class="collapse" data-parent="#addcarddetail">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Payement Method</label>
                                                    <select name="payment_method" class="form-control">
                                                        <option>Select Payement Method</option>
                                                        <option @if($data->payment_method == 'Credit Card') selected @endif value="Credit Card">Crediet Card</option>
                                                        <option @if($data->payment_method == 'Debit Card') selected @endif value="Debit Card">Debit Card</option>
                                                        <option @if($data->payment_method == 'Check In Account No') selected @endif value="Check In Account No">Check In Account No</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Card Holder Name</label>
                                                    <input type="text" placeholder="Card Holder Name" class="form-control" name="cardname" value="{{ $data->cardname }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Card Number</label>
                                                    <input  type="text" placeholder="Enter Card Number" class="form-control" name="carnumber" value="{{ $data->carnumber }}">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Card CVV</label>
                                                    <input  type="text" placeholder="Enter Card CVV" class="form-control" name="cardcvv" value="{{ $data->cardcvv }}">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Expiery Date</label>
                                                    <input  type="date" placeholder="Expiery Date" class="form-control" name="card_expiry_date" value="{{ $data->card_expiry_date }}">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Billing Address</label>
                                                    <input type="text" placeholder="Enter Billing Address" class="form-control" name="billingaddress" value="{{ $data->billingaddress }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="accordion accordion-toggle-arrow" id="addcarddetail">
                            <div class="card card-custom mt-5">
                                <div data-toggle="collapse" data-target="#defaultacc" class="card-header bg-white d-flex justify-content-between align-items-center">
                                    <div class="card-title">
                                        <span class="card-label font-weight-bolder text-dark">Default</span>
                                    </div>
                                    <div class="accordion-icon">
                                        <i class="fas fa-plus"></i>
                                    </div>
                                </div>
                                <div id="defaultacc" class="collapse" data-parent="#addcarddetail">
                                    <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Country </label>
                                                <select class="form-control"  name="country" id="Country">
                                                    <option value="">Select Country</option>
                                                    @foreach(DB::table('countries')->get() as $r)
                                                    <option @if($r->code == $data->country) selected @endif value="{{$r->code}}">{{ $r->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Parent Service </label>
                                                <select class="form-control"  name="parent_service" onchange="selectservice(this.value)" id="parent_service">
                                                    <option value="">Select Service (Parent)</option>
                                                    @foreach(DB::table('services')->wherenull('parent_id')->where('status', 1)->where('trashstatus', '!=', 1)->get() as $r)
                                                    <option @if($data->parent_service == $r->id) selected @endif value="{{ $r->id }}">{{ $r->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Service</label>
                                                <select class="form-control"  name="child_service[]" id="showchildservicestwo" multiple  onchange="selectchildservice(this.value)">
                                                    @php
                                                        $selectedChildServices = explode(',', $data->child_service);
                                                    @endphp
                                                    @foreach(DB::table('services')->where('parent_id' , $data->parent_service)->get() as $service)
                                                        <option value="{{ $service->id }}" {{ in_array($service->id, $selectedChildServices) ? 'selected' : '' }}>
                                                            {{ $service->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12">       
                                            <div class="form-group">
                                                <label>Community Type </label>
                                                <select id="property_type" onchange="selectpropertytype(this.value)" class="form-control"  name="property_type">
                                                    <option value="">Community Type</option>
                                                    @foreach(DB::table('properties')->groupby('property_type')->get() as $r)
                                                    <option @if($data->property_type == $r->property_type)selected @endif value="{{ $r->property_type }}">{{ $r->property_type }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                        <div class="accordion accordion-toggle-arrow" id="addcarddetail">
                            <div class="card card-custom mt-5">
                                <div data-toggle="collapse" data-target="#salesrep" class="card-header bg-white d-flex justify-content-between align-items-center">
                                    <div class="card-title">
                                        <span class="card-label font-weight-bolder text-dark">Sales Rep</span>
                                    </div>
                                    <div class="accordion-icon">
                                        <i class="fas fa-plus"></i>
                                    </div>
                                </div>
                                <div id="salesrep" class="collapse" data-parent="#addcarddetail">
                                    <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Sales Rep</label>
                                                <select class="form-control"  name="salerep" id="selecrep" >
                                                    <option value="">Select Sales Rep</option>
                                                    @foreach(DB::table('users')->get() as $r)
                                                    <option @if($r->id == $data->user_id) selected @endif value="{{ $r->id }}">{{ $r->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Order Type</label>
                                                <select class="form-control" name="order_type" id="order_type">
                                                    <option value="">Select Order Type</option>
                                                    @foreach(DB::table('order_types')->get() as $r)
                                                    <option @if($data->order_type == $r->id) selected @endif value="{{ $r->id }}">{{ $r->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Order Location</label>
                                                <input type="text" placeholder="Order Location" class="form-control"  name="orderlocation" value="{{ $data->orderlocation }}" >
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Order Date</label>
                                                <input type="date" placeholder="Order Date" class="form-control"  name="orderdate" value="{{ $data->orderdate }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card card-custom mt-5">
                        <div class="card-header">
                            <div class="card-title">
                                <span class="card-label font-weight-bolder text-dark">Save</span>
                            </div>
                        </div>
                        <div class="card-footer">
                           <div class="row">
                                <div class="col-md-6">
                                    <button onclick="submitbutton('exit')" type="submit" class="btn btn-primary form-control">Save & Exit</button>
                                </div>
                                <div class="col-md-6">
                                    <button onclick="submitbutton('addmore')" type="submit" class="btn btn-primary form-control">Save & more</button>
                                </div>
                           </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->
</div>
<div class="modal fade" id="exampleModalSizeXl" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Provider Notes</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <div id="providerdetailshows">
                           {!! $links->ordernote !!}                                 
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="plandetail" tabindex="-1" role="dialog" aria-labelledby="plandetail" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Plan Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body" id="plandetails">
                @php
                    $plan = DB::table('plans')->where('id' , $data->plan)->first();
                    $planatt = DB::table('plan_attributes')->where('plan_id', $plan->id)->get();
                    $originalPriceText = !empty($plan->originalprice) ? '$' . $plan->originalprice : '';
                    $services = '';
                    $attrib = '';
                    $serviceArray = explode(',', $plan->providerservice);
                    foreach ($serviceArray as $index => $c) {
                        $serviceName = DB::table('services')->where('id', $c)->first()->name;
                        $services .= $serviceName;

                        // Add a comma after each service except the last one
                        if ($index < count($serviceArray) - 1) {
                            $services .= ', ';
                        }
                    }
                    foreach($planatt as $index => $att){
                        $attribute = DB::table('attributes')->where('id', $att->attribute_id)->first();
                        $attrib .= $att->value;
                        if ($index < count($planatt) - 1) {
                            $attrib .= ', ';
                        }  
                    }
                    $html = '<table class="table table-bordered">
                            <tbody>
                            <tr>
                                <td><strong>Name</strong></td>
                                <td class="text-center">' . $plan->planname . '</td>
                            </tr>
                            <tr>
                                <td><strong>Parent Service</strong></td>
                                <td class="text-center">' . DB::table('services')->where('id' , $plan->parentservice)->first()->name . '</td>
                            </tr>
                            <tr>
                                <td><strong>Services</strong></td>
                                <td class="text-center">' . $services. '</td>
                            </tr>
                            <tr>
                                <td><strong>Attributes</strong></td>
                                <td class="text-center">'.$attrib.'</td>
                            </tr>
                            <tr>
                                <td><strong>Type</strong></td>
                                <td class="text-center">' . $plan->plantype . '</td>
                            </tr>
                            <tr>
                                <td><strong>Original Price</strong></td>
                                <td class="text-center">' . $originalPriceText . '</td>
                            </tr>
                            <tr>
                                <td><strong>Selling Price</strong></td>
                                <td class="text-center">$' . $plan->price . '</td>
                            </tr>';
                        $html .= '</tbody></table>';
                @endphp
                {!! $html !!}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<style type="text/css">
    .accordion .card .card-header .card-title:after{
        display: none;
    }
    .toggle-visibility {
        position: absolute;
        right: 20px;
        top: 64%;
        transform: translateY(-50%);
        cursor: pointer;
    }
    .input-group {
        position: relative;
    }
    .select2-container{
        width: 100% !important;
    }
</style>
<div class="modal fade" id="editTemplate" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" id="editTemplatecontent" role="document">
        
    </div>
</div>
@endsection
@section('script')
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDYUTCpyRfNY8Und6oYaKi5Vkqip7OIWEU&libraries=geometry,places&v=weekly"></script>
<script type="text/javascript">
function submitbutton(id) {
    $('#submit_type').val(id);
}
$('#property_type').select2({
    placeholder: "Select Property Type",
});
$('#property_typeTwo').select2({
     placeholder: "Select Property Type",
});
$('#showplans').select2({
    placeholder: "Please Select Plans",
});
$('#parent_service').select2({
     placeholder: "Select Parent Service",
});
$('#showchildservicestwo').select2({
     placeholder: "Select  Service",
});
$('#allpropselecreperties').select2({
    placeholder: "Please Select Shild Service",
});
$('#showchildservices').select2({
    placeholder: "Please Select Provider Services Offered",
});
$('#getprovider').select2({
    placeholder: "Please Select Providers",
});
$('#showpropertiesrep').select2({
    placeholder: "Please Select Property Rep",
});
$('#allproperties').select2({
    placeholder: "Please Select Property",
});
$('#emaolselect').select2({
    placeholder: "Auto Email To",
});
$('#Country').select2({
    placeholder: "Select Country",
});
function selectpropertytype(id) {
     $.ajax({
        type: 'get',
        url: '{{ url("admin/orders/selectpropertytype") }}/'+id,
        success: function(res) {
            $('#allproperties').html(res);   
        }
    });
}
function selectproperty(id) {
    $.ajax({
        type: 'get',
        url: '{{ url("admin/orders/selectproperty") }}/'+id,
        success: function(res) {
            $('#refferdby').html(res);   
        }
    });
}
function selectservice(id) {
    $.ajax({
        type: 'get',
        url: '{{ url("admin/orders/getorderchild") }}/'+id,
        success: function(res) {
            $('#showchildservicestwo').html(res);
            selectchildservice();
        }
    });
}
function selectchildservice() {
    var zipCode = $('#zipcode-input').val();
    var selectedServices = $('#showchildservicestwo').val(); 
    if (zipCode || (selectedServices && selectedServices.length > 0)) {
        $.ajax({
            type: 'GET',
            url: '{{ url("admin/orders/getprovider") }}',
            data: {
                zipCode: zipCode,
                services: selectedServices
            },
            success: function(res) {
                $('#getprovider').html(res);
            },
        });
    } else {
        $('#getprovider').html('<option value="">No Providers Available</option>');
    }
}
function selectproviderservice(id) {
    if (id) {
    $('#showchildservices').html('<option>Loading services...</option>');
    $('#showplans').html('<option>Loading plans...</option>');
    $.ajax({
        url: '{{ url("admin/orders/getchildeservice") }}/' + id,
        type: 'GET',
        success: function(data) {
            $('#showchildservices').html(data);
            selectplan();
        },
        error: function() {
            $('#showchildservices').html('<option>Error loading services</option>');
        }
    });
    $.ajax({
        type: 'get',
        url: '{{ url("admin/orders/getprovideretails") }}/'+id,
        success: function(res) {
            $('#providerdetailshows').html(res);   
        }
    });
    $.ajax({
        type: 'get',
        url: '{{ url("admin/orders/getproviderlinks") }}/'+id,
        success: function(res) {
            $('#providerlinks').html(res);   
        }
    });
    }else{
        $('#showchildservices').html('<option>No services available</option>');
        $('#providerdetailshows').empty();
        $('#weblink').empty();
        $('#portllink').empty();
    }

    selectorderstatus();
}
function selectplan() {
    let selectedChildServices = $('#showchildservices').val(); 
    let selectedProvider = $('#getprovider').val();
    let selectedData = {
        provider: selectedProvider,
        childservices: selectedChildServices
    };
    loadPlans(selectedData);
}
function loadPlans(selectedData) {
    $('#showplans').html('<option>Loading Plans...</option>'); 
    $.ajax({
        url: '{{ url("admin/orders/getplan") }}',
        type: 'GET',
        data: selectedData, 
        success: function(data) {
            $('#showplans').html(data); 
        },
        error: function(xhr, status, error) {
            console.error("Error loading plans:", xhr, status, error);
            $('#showplans').html('<option>Error loading plans</option>'); 
        }
    });
}
function allprovider(id) {
    $.ajax({
        type: 'get',
        url: '{{ url("admin/orders/getallprovider") }}/'+id,
        success: function(res) {
            $('#getprovider').html(res);   
        }
    });
}
function getplandetail(id) {
    $.ajax({
        type: 'get',
        url: '{{ url("admin/orders/getplandetails") }}/'+id,
        success: function(res) {
            $('#plandetails').html(res.html);   
        }
    });
}
function getaffiliateurl(id) {
    $.ajax({
        type: 'get',
        url: '{{ url("admin/orders/getaffiliateurls") }}/'+id,
        success: function(res) {
            $('#affiliateurl').html(res);   
        }
    });
}
$(document).ready(function() {
    var firstplanid = $('#showplans').find('option:eq(1)').val();
    if(firstplanid) {
        getaffiliateurl(firstplanid);
    }
    $('#toggleSSN').click(function() {
        var ssnInput = $('#ssn');
        var type = ssnInput.attr('type') === 'password' ? 'text' : 'password';
        ssnInput.attr('type', type);
        $(this).find('i').toggleClass('fa-eye fa-eye-slash');
    });
    var firstProviderId = $('#getprovider').find('option:eq(1)').val();
    if(firstProviderId) {
        getproviderDetails(firstProviderId);
        selectplan(firstProviderId);
    }
    var propertytype = $('#property_type').val();
    selectpropertytype(propertytype);
    let selexctprovider = $('#parent_service').val();
    if (selexctprovider) {
        selectservice(selectedService);
    }
    let selectedchild = $('#showchildservicestwo').val(); 
    if (selectedchild.length > 0) { 
        selectchildservice();
    }
    let selectprovider = $('#getprovider').val();
    if (selectprovider) {
        selectproviderservice(selectprovider);
    }
    initMap();
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
    let initialProviderContent = $('#getprovider').html();

    function selectprovider(id) {
        if (id.trim() === "") {
            $('#getprovider').html(initialProviderContent);
            return;
        }
        $.ajax({
            type: 'get',
            url: '{{ url("admin/orders/seachproviderbyzipocde") }}/'+id,
            success: function(res) {
                $('#getprovider').html(res);   
            }
        });
    }
    function selectorderstatus() {
        var orderstatus = $('#orderstatus').val();
        var providerid = $('#getprovider').val();
        $.ajax({
            type: 'get',
            data: {
                orderstatus:orderstatus,
                providerid:providerid,
            },
            url: '{{ url("admin/orders/selectorderstatus") }}',
            success: function(res) {
                $('#autoemailcard').html(res);   
            }
        });
    }
function editTemplate(id) {
    $.ajax({
        type: 'get',
        data: {
            id:id,
        },
        url: '{{ url("admin/orders/editTemplate") }}',
        success: function(res) {
            $('#editTemplate').modal('show');
            $('#editTemplatecontent').html(res);   
        }
    });
}
</script>
@endsection