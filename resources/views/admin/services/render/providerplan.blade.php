@if(isset($preview))
<div class="planbox mt-4 ">
    <div style="position: absolute; top: 0; left: 0; background-color: #cfe1fb; padding: 5px; color: #1370f2; border-top-left-radius: 20px; border-bottom-right-radius: 20px; font-weight: 600;">This is the Preview Mode of Plan</div>
    @if($preview->bestsellertext)
    <div class="badge-bestseller">{{ $preview->bestsellertext }}</div>
    @endif
    <div class="servicecat d-flex flex-wrap  align-items-center mt-3">
        <div class="servicessection mb-3">
            <span>
                @foreach($preview->providerservice as $s)
                    @php
                        $service = DB::Table('services')->where('id' , $s)->first();
                    @endphp
                    @if($service)
                        {!! $service->icon !!}
                        {{ $service->name }}
                        @if(!$loop->last)
                            +
                        @endif
                    @endif
                @endforeach
            </span>
        </div>
        <div class="borderverticle mb-3"></div>
        <div class="providername mb-3">
            @php
                $provider = DB::table('providers')->where('id', $preview->provider)->first();
            @endphp
            <span>{{ $provider ? $provider->name : 'Provider not found' }}</span>
        </div>
        <div class="borderverticle mb-3"></div>
        
        <div class="connectiontype mb-3">
            @php
                $plandesignconnection = DB::table('plandesigns')->where('location' , 'connection')->first();
            @endphp
            <span>{{ $preview['attributes'][$plandesignconnection->attribute_id][0] }}</span>
        </div>
       <div class="best_cell_connec mobile_starting_price justify-content-between mt-0" style="display: none;">
            <h4 class="starting_price">Starting At <span>${{ $preview->price }}</span><span class="month">/{{ $preview->afterprice }}</span></h4>   
       </div>
    </div>
    <div class="planoption d-flex flex-wrap justify-content-between align-items-center mt-2">
        @php
            $plandesignspeed = DB::table('plandesigns')->where('location' , 'speed')->first();
        @endphp
        <div class="planspeed mb-3">
            <span>Speed</span>
            <h2>{{ $preview['attributes'][$plandesignspeed->attribute_id][0] }}</h2>
        </div>
        <div class="planprice mb-3">
            <span>Monthly Price</span>
            <h2>{{ $preview->price }}</h2>
        </div>
        @php
            $plandesigndatascape = DB::table('plandesigns')->where('location' , 'datascape')->first();
        @endphp
        <div class="datascapes mb-3">
            <span>DataScapes</span>
            <h2>{{ $preview['attributes'][$plandesigndatascape->attribute_id][0] }}</h2>
        </div>
        @php
            $plandesigncontract = DB::table('plandesigns')->where('location' , 'contract')->first();
        @endphp
        <div class="datascapes mb-3">
            <span>Contract Length</span>
            <h2>{{ $preview['attributes'][$plandesigncontract->attribute_id][0] }}</h2>
        </div>
        <div class="phonenumber mb-3">
            <img src="{{ url('public/images/phone_in_talk_two.png') }}" alt="phone icon">
            <a href="tel:{{ $preview->providerphone }}">{{ $preview->providerphone }}</a>
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
    @if($preview->specialpromotion )
    <div class="amazon_gift" style="display: none;">
        <p>{{ $preview->specialpromotion }}</p>
    </div>
    @endif
</div>
<div class="card_tab accordion accordion-toggle-arrow" id="addcarddetail">
    <div class="accordion-item">
        <div class="row">
            <div class="col-md-6">
                @if($preview->specialpromotion)
                <div class="promotion_high d-flex">
                    <h5 class="mx-3">Special Promotion:</h5>
                    <p>{{ $preview->specialpromotion }}</p>
                </div>
                @endif
            </div>
            <div class="col-md-6">
                <h5 class="accordion-header text-right mx-4" id="heading{{ $preview->_token }}">
                    <button class="accordion-button collapsed" type="button" data-toggle="collapse" data-target="#collapse{{ $preview->_token }}" style="display: contents; font-size: 13px; color: #033C8C; font-weight: 700;"> Plan HighLight <i style="color: #033C8C;" class="fa fa-angle-down"></i>
                    </button>
                </h5>
            </div>
        </div>
        <div  id="collapse{{ $preview->_token }}" class="collapse" data-parent="#addcarddetail" style="">
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
@endif
@foreach($data as $key=>$r)
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
            <h4 class="starting_price">Starting At <span>${{ $r->price }}</span><span class="month">{{ $r->afterprice }}</span></h4>   
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
