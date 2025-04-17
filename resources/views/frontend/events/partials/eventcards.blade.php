
@php
    use App\Helpers\Cmf;
@endphp
@foreach($events as $event)
    <div class="tabs-widget-boxarea" >
        <div class="row align-items-center">
            <div class="col-lg-4">
                <div class="img1">
                    <img src="{{ url('images/' . $event->image) }}" alt="" />
                </div>
            </div>
            <div class="col-lg-8">
                <div class="content-area">
                    <ul>
                        <li>
                            <a href="{{ url('events/' . $event->id )}}"><img src="{{ url('newfront/assets/img/icons/clock1.svg') }}" alt="" /> {{ $event->start_date }} - {{ $event->start_time  }} <span> | </span></a>
                        </li>
                        <li>
                            @if($event->location_type == 'Virtual')
                            <a href="#"><img src="{{ url('newfront/assets/img/icons/location1.svg') }}" alt="" /> {{ $event->address }}</a>
                            @elseif($event->location_type == 'Venue')
                            <a href="#"><img src="{{ url('newfront/assets/img/icons/location1.svg') }}" alt="" /> {{ $event->location_name }} - {{ $event->location_address }}</a>
                            @else
                            <a href="#"><img src="{{ url('newfront/assets/img/icons/location1.svg') }}" alt="" /> {{ $event->location_name }} - {{ $event->location_address }}</a>
                            @endif
                        </li>
                    </ul>
                    <div class="space20"></div>
                    <a href="{{ url('events/' . $event->id )}}" class="head">{{ $event->name }}</a>
                    <div class="space16"></div>
                    <p>{!! $event->description !!}</p>
                    <div class="space32"></div>
                    <div class="btn-area1">
                        <a data-id="{{ $event->id }}" href="{{ url('events/' . $event->id )}}" class="vl-btn1 event-btn" >Become Attendee</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="space30"></div>
@endforeach

@if($events->isEmpty())
    <p>No events found for this date.</p>
@endif
