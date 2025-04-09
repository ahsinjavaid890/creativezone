@extends('frontend.layouts.main')
@include('frontend.sections.mettatags')
@section('content')
@php
    use App\Helpers\Cmf;
@endphp
<div class="container" style="margin-top: 140px;">
   <div class="breadcrumb-area" style=" background-color: #5cc99f; padding: 10px; border-radius: 8px; color: white; ">
      <div class="breadcrumb mb-0">
         <ul class="d-flex align-items-center">
            <li><a href="{{ url('') }}" class="text-white mx-1">Home</a></li>
            <li class="active"><i class="fa-solid fa-angle-right"></i> All Events</li>
         </ul>
      </div>
   </div>
</div>
<!--===== EVENT AREA STARTS =======-->
    <div class="blog1-section-area all-event-section sp2">
        <div class="container">
            <div class="row">
                @foreach ($events as $event)
                    <div class="col-lg-4 col-md-6 mt-5">
                        <div class="blog1-auhtor-boxarea">
                            <div class="content-area all-events p-0">
                                <div class="img1 image-anime">
                                    <img src="{{ url('images/' . $event->image) }}" alt="" />
                                </div>
                                <div class="p-3">
                                    <ul>
                                        <li>
                                            <a href="#"><img src="{{ url('newfront/assets/img/icons/calender1.svg') }}" alt="" />{{ Cmf::date_format($event->created_at) }}</a>
                                        </li>
                                    </ul>
                                    <div class="space20"></div>
                                    <a href="{{ url('events/' . $event['id']) }}">{{ $event->name }}</a>
                                    <div class="space16"></div>
                                    <p>{{ \Illuminate\Support\Str::limit($event->description, 50) }}</p>
                                    <div class="space24"></div>
                                    <div class="btn-area1">
                                        <a href="javascript:void(0)" class="vl-btn1 event-btn" data-id="{{ $event->id }}">Become Attendee</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
<!--===== EVENT AREA ENDS =======-->

@endsection