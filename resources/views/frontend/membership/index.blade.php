@extends('frontend.layouts.main')
@section('tittle')
<title>Membership Plans | Creative Zone</title>
<link rel="canonical" href="{{Request::url()}}">
@endsection
@section('content')
<style type="text/css">
    .memory1-section-area .memory-slider-areas {
        position: relative;
        z-index: 1;
    }
    .plan_description p {
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
            <li class="active"><i class="fa-solid fa-angle-right"></i> Membership Plans</li>
         </ul>
      </div>
   </div>
</div>
<div class="pricing-lan-section-area sp1">
    <div class="container">
        <div class="row">
            <div class="col-lg-5 m-auto">
                <div class="heading2 text-center space-margin60">
                    <h5>plan pricing</h5>
                    <div class="space18"></div>
                    <h2>Event Pass &amp; Tickets</h2>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach($data as $r)
            <div class="col-lg-4 col-md-6">
                <div class="pricing-boxarea">
                    <h5>{{ $r['local']->name ?? 'N/A' }}</h5>
                    <div class="space20"></div>
                    <h2> 
                        @if(strtoupper($r['stripe']->currency ?? '') == 'USD')$@endif{{ number_format(($r['stripe']->amount ?? 0) / 100) }}
                    <span>/One Person</span></h2>
                    <div class="space8"></div>
                    <div class="plan_description">
                        {!! $r['local']->description !!}
                    </div>
                    <div class="space28"></div>
                    <div class="btn-area1">
                        @if(Auth::guard('artist')->check())
                        <a href="{{ url('user/buy-plan') }}/{{ $r['local']->slug }}" class="vl-btn1">buy a plan</a>
                        @else
                        <a href="{{ url('login') }}" class="vl-btn1">buy a plan</a>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection