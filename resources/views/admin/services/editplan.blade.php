@extends('admin.layouts.main-layout')
@section('title','Edit Plans')
@section('content') 
 <!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <div class="d-flex align-items-center flex-wrap mr-2">
                <h5 class="text-blue font-weight-bold mt-2 mb-2 mr-5">
                    Update Plan
                </h5>
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <a href="{{ url('admin/dashboard') }}" class="text-blue font-weight-bold mt-2 mb-2 mr-5">
                    Dashboard
                </a>
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <a href="{{ url('admin/services/allplans') }}" class="text-blue font-weight-bold mt-2 mb-2 mr-5">
                    All Plan
                </a>
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <a href="javascript:void(0)" class="text-dark font-weight-bold mt-2 mb-2 mr-5">
                    Update Plan : <b class="text-danger">{{ $data->planname }}</b>
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
            <form enctype="multipart/form-data" method="POST" action="{{ url('admin/services/updateplan') }}">
                @csrf
                <input type="hidden"  name="id" value="{{ $data->id }}">
                <div class="row">
                    <div class="col-md-8">
                        <div class="card card-custom mt-5">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-12 mb-3">
                                                <div class="form-group">
                                                    <label class="lable-control">Plan Name</label>
                                                    <input type="text" name="planname" class="form-control" value="{{ $data->planname }}" placeholder="Enter Plan Name">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="lable-control">Select Provider</label>
                                                    <select id="showprovider" name="provider" class="form-control" onchange="selectproviderservice(this.value)">
                                                        <option value="all">All Providers</option>
                                                        @foreach(DB::table('providers')->get() as $r )
                                                        <option @if($data->provider == $r->id) selected @endif value="{{ $r->id }}">{{ $r->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Plan Service</label>
                                                    <select multiple class="form-control" name="providerservice[]" id="showchildservices" onchange="getattributes()">
                                                        <option>Select Service (Child)</option>
                                                        @foreach(DB::table('services')->where('parent_id', $data->parentservice)->get() as $r)
                                                            <option 
                                                                @foreach(explode(',', $data->providerservice) as $chil) 
                                                                    @if($chil == $r->id) selected @endif  
                                                                @endforeach  
                                                                value="{{ $r->id }}" data-service-name="{{ $r->name }}"> {{ $r->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="row" id="attributesContainer">
                                                    @if($data->plan_type_text == '')
                                                    @foreach(DB::table('plan_attributes')->where('plan_id' , $data->id)->get() as $planAtribute)
                                                    <div class="col-md-12 mb-3">
                                                        @foreach(DB::table('atributes')->where('id', $planAtribute->attribute_id)->get() as $attribute)
                                                        @if($attribute->type == 'Checkbox' || $attribute->type == 'Select')
                                                            <div class="form-group">
                                                                <label>{{ $attribute->name }}</label>
                                                                <select name="attributes[{{ $attribute->id }}][]" multiple class="form-control multipleselecttwo">
                                                                    @foreach(explode(',', $attribute->value) as $att)
                                                                        <option value="{{ $att }}" @if(in_array($att, explode(',', $planAtribute->value))) selected @endif>
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
                                                                        <option value="{{ $att }}" @if(in_array($att, explode(',', $planAtribute->value))) selected @endif>
                                                                            {{ $att }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        @endif
                                                        @if($attribute->type == 'Text')
                                                            <div class="form-group">
                                                                <label>{{ $attribute->name }}</label>
                                                                <input class="form-control" type="text" name="attributes[{{ $attribute->id }}]" value="{{ $planAtribute->value }}">
                                                            </div>
                                                        @endif
                                                        @endforeach
                                                    </div>
                                                    @endforeach
                                                    @else
                                                    <div class="col-md-12" id="lines-section">
                                                        <div class="form-group">
                                                            <label class="lable-control">Plan Type text</label>
                                                            <input type="text" placeholder="" name="plan_type_text" value="{{ $data->plan_type_text }}" class="form-control">
                                                        </div>
                                                    </div>
                                                    @for($i = 1; $i < 6; $i++)
                                                        <div class="col-md-12" id="line-inputs">
                                                            <div class="form-group">
                                                                <label class="lable-control">Line Price {{ $i }}</label>
                                                                <input placeholder="Line Price {{ $i }}" name="line_price_{{ $i }}" value="{{ $data->{'line_price_'.$i} }}" class="form-control">
                                                            </div>
                                                        </div>
                                                    @endfor
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div id="childserviceattributes" class="row"></div>
                                            </div>
                                        </div>
                                    </div>
                                        <div class="col-md-6">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="lable-control">Best Seller Text</label>
                                                        <input id="input-currency" type="text" placeholder="Best Seller Text" name="bestsellertext" class="form-control" value="{{ $data->bestsellertext }}">
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="lable-control">Add Slogan</label>
                                                        <input id="input-currency" type="text" placeholder="Add Slogan" name="slogan" class="form-control" value="{{ $data->slogan }}">
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="lable-control">Special Promotion</label>
                                                        <input id="input-currency" type="text" placeholder="Add Special Promotion " name="specialpromotion" class="form-control" value="{{ $data->specialpromotion }}">
                                                    </div>
                                                </div>
                                                <div class="col-md-12" id="originalPriceContainer">
                                                    <div class="form-group">
                                                        <label class="lable-control">Add Original Price</label>
                                                        <input id="input-currency" placeholder="Plan Original Price" name="originalprice" class="form-control" value="{{ $data->originalprice }}">
                                                    </div>
                                                </div>
                                                <div class="col-md-12" id="planPriceContainer">
                                                    <div class="form-group">
                                                        <label class="lable-control">Plan price</label>
                                                        <input id="input-currency" placeholder="Plan Price" name="price" value="{{ $data->price }}" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="card">
                                                        <div class="pt-5">
                                                            <div class="col-md-12  mb-3">
                                                                <div class="form-group">
                                                                    <label class="lable-control">Display Call Btn</label>
                                                                    <select name="isdisplaycallbtn"  class="form-control">
                                                                       <option @if($data->isdisplaycallbtn == 1) selected @endif value="1">Yes</option>
                                                                       <option @if($data->isdisplaycallbtn == 2) selected @endif value="2">No</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12 mb-3">
                                                                <div class="form-group">
                                                                    <label class="lable-control">Call Button</label>
                                                                    <input id="input-currency" type="text" placeholder="Call Button" name="callbutton" class="form-control" value="{{ $data->callbutton }}">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12 mb-3">
                                                                <div class="form-group">
                                                                    <label class="lable-control">Provider Phone</label>
                                                                    <input id="input-currency" type="text" placeholder="Provider Phone" name="providerphone" value="{{ $data->providerphone }}" class="form-control">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="card">
                                                        <div class="pt-5">
                                                            <div class="col-md-12 mb-3">
                                                                <div class="form-group">
                                                                    <label class="lable-control">Display buy button</label>
                                                                    <select id="services" name="isdisplaybuybtn"  class="form-control">
                                                                       <option @if($data->isdisplaybuybtn == 1) selected @endif value="1">Yes</option>
                                                                       <option @if($data->isdisplaybuybtn == 2) selected @endif value="2">No</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12 mb-3">
                                                                <div class="form-group">
                                                                    <label class="lable-control">Buy Button Text</label>
                                                                    <input id="input-currency" type="text" placeholder="Buy Button Text" name="buybuttontext" class="form-control" value="{{ $data->buybuttontext }}">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12 mb-3">
                                                                <div class="form-group">
                                                                    <label class="lable-control">Buy Button Type</label>
                                                                    <select id="services" name="buttontype"  class="form-control">
                                                                       <option @if($data->buttontype == 'Redirect to Affiliate Url')  selected @endif value="Redirect to Affiliate Url">Redirect to Affiliate Url</option>
                                                                       <option @if($data->buttontype == 'Inquiry Form')  selected @endif value="Inquiry Form">Inquiry Form</option>
                                                                       <option @if($data->buttontype == 'Redirect to Website Url')  selected @endif value="Redirect to Website Url">Redirect to Website Url</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <div class="col-md-12  mt-3">
                                        <div class="form-group">
                                            <label class="lable-control">Plan Details</label>
                                            <textarea placeholder="Plan Detail" rows="1" class="summernote" name="plandetail" >{{ $data->plandetail }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        
                        <div class="card card-custom mt-5">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <div class="form-group">
                                            <label class="lable-control">Plan Status</label>
                                            <select id="select_status" name="status" class="form-control">
                                                <option @if($data->status == 1 ) selected @endif value="1">Enable</option>
                                                <option @if($data->status == 2 ) selected @endif value="2">Disable</option>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-12 mb-3">
                                        <div class="form-group">
                                            <label class="lable-control">Plan Image</label>
                                            <input id="input-currency" type="file" placeholder="Plan Price" value="{{ $data->planimage }}" name="planimage" class="form-control">
                                            @if($data->planimage)
                                            <a href="{{ url('public/images') }}/{{ $data->planimage }}" target="_blank">View Image</a>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <div class="form-group">
                                            <label class="lable-control">Plan Commission <small class="text-danger">(To Sales Rep)</small></label>
                                            <input type="text" @if(DB::table('commissions')->where('plan' , $data->id)->first()) value="{{ DB::table('commissions')->where('plan' , $data->id)->first()->amount }}" @endif name="plancommission" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group-custom">
                                          <!-- Row 2: Link logo to -->
                                            <div class="section-title">Show Plan on home page</div>
                                            <div class="form-check form-check-inline">
                                              <input type="radio" class="form-check-input" name="show_on_home_page" id="show_on_home_page" value="Yes" @if($data->show_on_home_page == 'Yes') checked @endif>
                                              <label class="form-check-label" for="show_on_home_page">Yes</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                              <input type="radio" class="form-check-input" name="show_on_home_page" id="show_on_home_page" value="No" @if($data->show_on_home_page == 'No') checked @endif>
                                              <label class="form-check-label" for="show_on_home_page">No</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group-custom">
                                          <!-- Row 2: Link logo to -->
                                            <div class="section-title">Show Plan on Provider page</div>
                                            <div class="form-check form-check-inline">
                                              <input type="radio" class="form-check-input" name="showthisonprovider" id="showthisonprovider" value="Yes" @if($data->showthisonprovider == 'Yes') checked @endif>
                                              <label class="form-check-label" for="showthisonprovider">Yes</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                              <input type="radio" class="form-check-input" name="showthisonprovider" id="showthisonprovider" value="No" @if($data->showthisonprovider == 'No') checked @endif>
                                              <label class="form-check-label" for="showthisonprovider">No</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card card-custom mt-5">
                            <div class="card-header flex-wrap">
                                <div class="card-title">Default</div>
                            </div>
                            <div class="card-body">
                               <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <div class="form-group">
                                            <label class="lable-control">Parent Service</label>
                                            <select id="parent_service" onchange="getchildservice(this.value)" name="parentservice" class="form-control">
                                                @foreach(DB::table('services')->wherenull('parent_id')->where('status', 1)->where('trashstatus', '!=', 1)->get() as $r)
                                                <option  @if($data->parentservice == $r->id) selected @endif value="{{ $r->id }}">{{ $r->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <div class="form-group">
                                            <label>Child Service </label>
                                            <select multiple class="form-control"  id="showchildservicestwo" name="childservice[]"  onchange="selectchildservice(this.value)">
                                                <option>Select Service (Child)</option>
                                                @foreach(DB::table('services')->where('parent_id', $data->parentservice)->get() as $r)
                                                <option value="{{ $r->id }}"
                                                    @if(in_array($r->id, explode(',', $data->childservice))) selected @endif>
                                                    {{ $r->name }}
                                                </option>
                                            @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <div class="form-group">
                                            <label class="lable-control">Plan Type</label>
                                            <select multiple id="plantype" name="plantype[]" class="form-control">
                                                @php
                                                    $plantypes = explode(',', $data->plantype);
                                                @endphp
                                                <option value="residential" @if(in_array('residential', $plantypes)) selected @endif>Residential</option>
                                                <option value="bussiness" @if(in_array('bussiness', $plantypes)) selected @endif>Business</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <div class="form-group">
                                            <label class="lable-control">Before Plan Price</label>
                                            <input id="input-currency" placeholder="Before Plan Price" name="beforeprice" value="{{ $data->beforeprice }}" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <div class="form-group">
                                            <label class="lable-control">After Plan Price</label>
                                            <input id="input-currency" placeholder="Before Plan Price" name="afterprice" value="{{ $data->afterprice }}" class="form-control">
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
                                    <div class="col-md-12">
                                        <button onclick="submitbutton('exit')" type="submit" class="btn btn-primary">Save & Exit</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <link rel="stylesheet" type="text/css" href="{{ url('public/front/css/internetcss.css') }}">
            <div class="card card-custom mt-5">
                <div class="card-header flex-wrap">
                    <div class="card-title">Provider Plans</div>
                </div>
                <div class="card-body">
                    <div class="plan-cards" id="providerplan">
                        @foreach(DB::table('plans')->where('provider' , $data->provider)->get() as $key=>$r)
                        <div class="planbox mt-4 ">
                            <div class="badge-bestseller">Best Seller</div>
                            <div class="servicecat d-flex flex-wrap  align-items-center">
                                <div class="servicessection mb-3">
                                    <span>
                                        @php
                                            // Retrieve all services at once
                                            $serviceIds = explode(',', $r->providerservice);
                                            $services = DB::table('services')->whereIn('id', $serviceIds)->get()->keyBy('id');
                                        @endphp

                                        @foreach($serviceIds as $id)
                                            @php
                                                $service = $services->get($id);
                                            @endphp
                                            @if($service)
                                                {!! $service->icon !!}
                                                {{ $service->name }}
                                                @if(!$loop->last)
                                                    +
                                                @endif
                                            @endif
                                        @endforeach</span>
                                </div>
                                <div class="borderverticle mb-3"></div>
                                <div class="providername mb-3">
                                    @php
                                        $provider = DB::table('providers')->where('id', $r->provider)->first();
                                    @endphp

                                    <span>{{ $provider ? $provider->name : 'Provider not found' }}</span>
                                </div>
                                <div class="borderverticle mb-3"></div>
                                <div class="connectiontype mb-3">
                                    <span>Satellite Connection</span>
                                </div>
                               <div class="best_cell_connec mobile_starting_price justify-content-between mt-0" style="display: none;">
                                    <h4 class="starting_price">Starting At <span>$59</span><span class="month">/mo</span></h4>   
                               </div>
                            </div>
                            <div class="planoption d-flex flex-wrap justify-content-between align-items-center mt-2">
                                @php
                                    $speed = DB::table('plandesigns')->where('location' , 'speed')->first();

                                    if($speed){
                                     $plan_speed = DB::table('plan_attributes')->where('plan_id' , $r->id)->where('attribute_id' , $speed->attribute_id)->first();
                                    }else {
                                        $plan_speed = null;
                                    }


                                    $datascape = DB::table('plandesigns')->where('location', 'datascape')->first();
                                    if ($datascape) {
                                        $attribute = DB::table('plan_attributes')
                                            ->where('plan_id', $r->id)
                                            ->where('attribute_id', $datascape->attribute_id)
                                            ->first();
                                    } else {
                                        $attribute = null;
                                    }



                                    $contract = DB::table('plandesigns')->where('location' , 'contract')->first();
                                    if ($contract) {
                                    $cont = DB::table('plan_attributes')->where('plan_id' , $r->id)->where('attribute_id' , $contract->attribute_id)->first();
                                    }else{
                                        $cont = null;
                                    }

                                @endphp
                                @if($speed->type == 'attribute')
                                <div class="planspeed mb-3">
                                    <span>Speed</span>
                                    @if($plan_speed && isset($plan_speed->value))
                                    <h2>{{ $plan_speed->value }}</h2>
                                    @else
                                    @endif
                                </div>
                                @endif
                                <div class="planprice mb-3">
                                    <span>Monthly Price</span>
                                    <h2>@if($r->price) ${{ $r->price }} @endif</h2>
                                </div>
                                @if($speed->type == 'attribute')
                                <div class="datascapes mb-3">
                                    <span>DataScapes</span>
                                    @if($attribute && isset($attribute->value))
                                        <h2>{{ $attribute->value }}</h2>
                                    @else
                                        
                                    @endif
                                </div>
                                @endif
                                @if($speed->type == 'attribute')
                                <div class="datascapes mb-3">
                                    <span>Contract Length</span>
                                    @if($cont && isset($cont->value))
                                        <h2>{{ $cont->value }}</h2>
                                    @else 
                                    @endif
                                </div>
                                @endif
                                <div class="phonenumber mb-3">
                                    @if($r->providerphone)
                                    <img src="http://localhost/jiowireless/public/images/phone_in_talk_two.png" alt="phone icon">
                                    <a href="tel:{{ $r->providerphone }}">{{ $r->providerphone }}</a>
                                    @endif
                                </div>
                            </div>
                            <div class="support_head_btn d-flex mt-2 align-items-center justify-content-between">
                                <div>
                                    <p>This Supports using up to 8 Devices at Once.</p>
                                </div>
                                <div>
                                    <button class="planbutton">Select</button>
                                </div>
                            </div>
                            @if($r->specialpromotion )
                            <div class="amazon_gift" style="display: none;">
                                <p>{{ $r->specialpromotion }}</p>
                            </div>
                            @endif
                        </div>
                        <div class="card_tab accordion accordion-toggle-arrow" id="addcarddetail">
                            <div class="accordion-item">
                                <div class="row">
                                    <div class="col-md-6">
                                        @if($r->specialpromotion)
                                        <div class="promotion_high d-flex">
                                            <h5 class="mx-3">Special Promotion:</h5>
                                            <p>{{ $r->specialpromotion }}</p>
                                        </div>
                                        @endif
                                    </div>
                                    <div class="col-md-6">
                                        <h5 class="accordion-header text-right mx-4" id="heading{{ $key }}">
                                            <button class="accordion-button collapsed" type="button" data-toggle="collapse" data-target="#collapse{{ $key }}" style="display: contents; font-size: 13px; color: #033C8C; font-weight: 700;"> Plan HighLight <i style="color: #033C8C;" class="fa fa-angle-down"></i>
                                            </button>
                                        </h5>
                                    </div>
                                </div>
                                <div  id="collapse{{ $key }}" class="collapse" data-parent="#addcarddetail" style="">
                                    <div class="accordion-body" style="padding: 15px;">
                                        <div class="promotion_card">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <p class="speed_support">
                                                        This speed supports using up to 4 devices at once
                                                    </p>
                                                    <h5 class="mt-3">Highlight</h5>
                                                    <ul>
                                                        <li>Download Speed up to 4 devices at once.</li>
                                                        <li>Rate applies for first 12 months.</li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <p class="promotion_card_para mt-3">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
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
    $('#showprovider').select2({
        placeholder: "Select a Provider",
    });
    $('#parent_service').select2({
        placeholder: "Select a Service",
    });
    $('#showchildservices').select2({
        placeholder: "Select  Child Service",
    });
    $('#showchildservicestwo').select2({
        placeholder: "Select  Child Service",
    });
    $('#childseriveselect').select2({
        placeholder: "Please Select Child Service",
    });
    $('#plantype').select2({
        placeholder: "Please Select PlanType",
    });
    @foreach(DB::table('atributes')->get() as $r)
    @if($r->type == 'Select' ||$r->type == 'Checkbox' ||$r->type == 'Radio')
    $('.multipleselecttwo').select2({
        
    });
    @endif
    @endforeach
    function getchildservice(id) {  
    if(id){
        $.ajax({
            type: 'get',
            url: '{{ url("admin/services/getplanchildservices") }}/'+id,
            success: function(res) {
                $('#showchildservicestwo').html(res);  
            }
        });
    
    } else {
    $('#showchildservices').html('');
    }
}
function getattributes() {
    var selectedIds = [];
    var selectElement = document.getElementById('showchildservices');
    
    for (var i = 0; i < selectElement.options.length; i++) {
        if (selectElement.options[i].selected) {
            selectedIds.push(selectElement.options[i].value);
        }
    }
    
    if (selectedIds.length === 0) {
        return;
    }
    
    var plan_id = 'addplan';
    $.ajax({
        type: 'get',
        url: '{{ url("admin/services/getattributes") }}',
        data: {
            service_id: selectedIds, // This now contains all selected IDs
            plan_id: plan_id
        },
        success: function(data) {
            $('#attributesContainer').html(data);
        },
        error: function() {
            alert('Error fetching attributes');
        }
    });
    const selectedOptions = document.getElementById('showchildservices').selectedOptions;
    let isMobileSelected = false;
    for (let option of selectedOptions) {
        if (option.getAttribute('data-service-name') === "Mobile") {
            isMobileSelected = true;
            break;
        }
    }
    const originalPriceContainer = document.getElementById('originalPriceContainer');
    const planPriceContainer = document.getElementById('planPriceContainer');
    if (isMobileSelected) {
        originalPriceContainer.style.display = 'none';
        planPriceContainer.style.display = 'none';
    } else {
        originalPriceContainer.style.display = 'block';
        planPriceContainer.style.display = 'block';
    }
}
function selectchildservice(id) {
    var selectedServices = $('#showchildservicestwo').val(); 
    if (selectedServices.length > 0) {
        $.ajax({
            type: 'GET',
            url: '{{ url("admin/services/getprovider") }}',
            data: { services: selectedServices }, 
            success: function(res) {
                $('#showprovider').html(res);
            },
        });


    } else {
        $('#showprovider').html('<option value="">Select Providers</option>');
    }
}
function selectproviderservice(id) {
    $('#showchildservices').html('<option>Loading services...</option>');
    $.ajax({
        url: '{{ url("admin/services/getchildeservice") }}/' + id,
        type: 'GET',
        success: function(data) {
            $('#showchildservices').html(data);
        },
        error: function() {
            $('#showchildservices').html('<option>Error loading services</option>');
        }
    });
    var getprovider = 'all'
    if(id === getprovider){
    $.ajax({
        type: 'get',
        url: '{{ url("admin/services/getallprovider") }}/'+id,
        success: function(res) {
            $('#showprovider').html(res);   
        }
    });
    }
    $.ajax({
        url: '{{ url("admin/services/getproviderplan") }}/' + id,
        type: 'GET',
        success: function(data) {
            $('#providerplan').html(data);
        },
        error: function() {
            $('#providerplan').html('<option>Error loading services</option>');
        }
    });
}
</script>
@endsection