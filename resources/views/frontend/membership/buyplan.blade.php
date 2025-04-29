@extends('frontend.layouts.main')
@section('tittle')
<title>Buy {{ $plan->name }} Plan | Creative Zone</title>
<link rel="canonical" href="{{Request::url()}}">
@endsection
@section('content')
<style type="text/css">
    .memory1-section-area .memory-slider-areas {
        position: relative;
        z-index: 1;
    }
    .plan_description ul li {
      position: relative;
      padding-left: 2rem !important; /* space for the icon */
      margin-bottom: 10px;
    }

    .plan_description ul li::before {
      content: "✓"; /* tick mark */
      position: absolute;
      left: 0;
      top: 50%;
      transform: translateY(-50%);
      width: 1.5rem;
      height: 1.5rem;
      background-color: #5cc99f;
      color: white;
      font-weight: bold;
      text-align: center;
      line-height: 1.5rem;
      border-radius: 50%;
      font-size: 1rem;
    }.plan_description p {
      position: relative;
      padding-left: 2rem !important; /* space for the icon */
      margin-bottom: 10px;
    }

    .plan_description p::before {
      content: "✓"; /* tick mark */
      position: absolute;
      left: 0;
      top: 50%;
      transform: translateY(-50%);
      width: 1.5rem;
      height: 1.5rem;
      background-color: #5cc99f;
      color: white;
      font-weight: bold;
      text-align: center;
      line-height: 1.5rem;
      border-radius: 50%;
      font-size: 1rem;
    }

</style>
<!--===== HERO AREA STARTS =======-->
<div class="container" style="margin-top: 140px;">
   <div class="breadcrumb-area" style=" background-color: #5cc99f; padding: 10px; border-radius: 8px; color: white; ">
      <div class="breadcrumb mb-0">
         <ul class="d-flex align-items-center">
            <li><a href="{{ url('') }}" class="text-white mx-1">Home</a></li>
            <li class="active"><i class="fa-solid fa-angle-right"></i> Buy {{ $plan->name }} Plan</li>
         </ul>
      </div>
   </div>
</div>
<div class="pricing-lan-section-area sp1">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="card" style=" background: #fbfbfb; border: 0; border-radius: 10px; ">
                    <div class="card-body">
                        <div class="plan_heading d-flex justify-content-between">
                            <h2>{{ $plan->name }}</h2>
                            <span style=" font-size: 31px; font-weight: 600;color:#5cc99f ">@if(strtoupper($stripePlan->currency ?? '') == 'USD')$@endif{{ number_format(($stripePlan->amount ?? 0) / 100) }} / <sub>{{ $stripePlan->interval }}</sub> </span>
                        </div>
                        <div class="plan_description mt-3">
                            <ul class="plan_features">
                               @php
                                    $featureIds = explode(',', $plan->features); // e.g., "1 3 5"
                                    $features = DB::table('plan_features')
                                        ->whereIn('id', $featureIds)
                                        ->pluck('name', 'id'); // returns: [1 => "Feature A", 3 => "Feature B", ...]
                                @endphp
                                @foreach($featureIds as $id)
                                    <li>{{ $features[$id] ?? 'Unknown Feature' }}</li>
                                @endforeach
                            </ul>
                            {!! $plan->description !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="contact-inner-section">
                    <div class="contact4-boxarea">
                        <form method="post" action="{{ url('user/buymembership') }}">
                            @csrf
                            <div class="row">
                                <div class="col-lg-6 col-md-6">
                                    <div class="input-area">
                                        <input type="text" placeholder="Name" name="name" required value="{{ Auth::guard('artist')->user()->fname }} {{ Auth::guard('artist')->user()->lname }}">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="input-area">
                                        <input type="text" placeholder="Phone" name="phone" required="" value="{{ Auth::guard('artist')->user()->mobile }}">
                                    </div>
                                </div>

                                <div class="col-lg-12 col-md-12">
                                    <div class="input-area">
                                        <input type="email" placeholder="Email" name="email" readonly value="{{ Auth::guard('artist')->user()->email }}">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="space24"></div>
                                    <div class="input-area text-end">
                                        <button type="submit" id="contactbtn" class="vl-btn1">Next</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div> 
                </div>
            </div>
        </div>
    </div>
</div>
@endsection