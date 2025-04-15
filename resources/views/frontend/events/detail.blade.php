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
            <li class="active"><i class="fa-solid fa-angle-right"></i> Event Detail</li>
         </ul>
      </div>
   </div>
</div>
<div class="blog-details-section sp5">
	<div class="container">
		<div class="row">
			<div class="col-lg-8">
				<div class="blog-deatils-content heading2">
					<div class="img1">
								<img src="{{  url('images') }}/{{ $data->image }}" alt="">
					</div>
					<div class="space32"></div>
					<ul>
						<li>
							<a href="#"><img src="{{  url('newfront/assets/img/icons/calender1.svg')}}" alt="">{{ Cmf::date_format($data->created_at) }} <span> | </span></a>
						</li>
						<li>
							<a href="#"><img src="{{  url('newfront/assets/img/icons/user1.svg')}}" alt="">Gisselle <span> | </span></a>
						</li>
						<li>
							<a href="#"><img src="{{  url('newfront/assets/img/icons/comments1.svg')}}" alt="">2 Comments</a>
						</li>
					</ul>
					<div class="space18"></div>
					<h2>{{ $data->name }}</h2>
					<div class="space16"></div>
					<p>{!! $data->description !!}</p>
					<div class="space32"></div>
					<div class="tags-social-area">
						<div class="tags">
							<h4>Tags:</h4>
							<ul>
								@php
								$tagIds = explode(',', $data->tags);
								$tags = DB::Table('event_tags')->whereIn('id', $tagIds)->get();
								@endphp
								@foreach($tags as $t)
								<li><a href="#">#{{ $t->name }}</a></li>
								@endforeach
							</ul>
						</div>
						<div class="social">
							<h4>Social:</h4>
							<ul>
								<li>
									<a href="{{ $data->facebook_url }}"><i class="fa-brands fa-facebook-f"></i></a>
								</li>
								<li>
									<a href="{{ $data->instagram_url }}"><i class="fa-brands fa-instagram"></i></a>
								</li>
								<li>
									<a href="{{ $data->youtube_url }}" class="m-0"><i class="fa-brands fa-youtube"></i></a>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>

			<div class="col-lg-4">
				<div class="blog-auhtor-details">
				<div class="contact-inner-section">
					<div class="row">
		                <div class="col-md-12">
		                    @include('alerts.index')
		                </div>
		            </div>
			    	<div class="row">
			    		<div class="col-lg-12">
			    			<div class="contact4-boxarea">
			                    <h3 class="text-anime-style-3 text-center">Apply For Event</h3>
			                    <div class="space8"></div>
			                    <form method="POST" action="{{ url('applyevent') }}">
			                    	@csrf
			                    	<input type="hidden" name="event_id" value="{{ $data->id }}">
			                    	<div class="row">
				                        <div class="col-lg-6 col-md-6">
				                            <div class="input-area">
				                                <input type="text" placeholder="Name" name="name" required />
				                            </div>
				                        </div>
				                        <div class="col-lg-6 col-md-6">
				                            <div class="input-area">
				                                <input type="text" placeholder="Phone" name="phone" required/>
				                            </div>
				                        </div>

				                        <div class="col-lg-12 col-md-6">
				                            <div class="input-area">
				                                <input type="email" placeholder="Email" name="email" required/>
				                            </div>
				                        </div>
				                        <div class="col-lg-12">
				                            <div class="input-area">
				                                <textarea placeholder="Message" name="message" required></textarea>
				                            </div>
				                        </div>

				                        <div class="col-lg-12">
				                            <div class="space24"></div>
				                            <div class="input-area text-end">
				                                <button type="submit" class="vl-btn1">Apply Now</button>
				                            </div>
				                        </div>
				                    </div>
			                    </form>
			                </div>
			    		</div>
			    	</div>
				</div>
				<div class="space32"></div>
					<div class="blog-categories">
						<h3>Event Category</h3>
						<div class="space12"></div>
						<ul>
							@foreach(DB::Table('categories')->where('status' , 'Published')->get() as $c)
							<li>
								<a href="#">{{ $c->name }} <span><i class="fa-solid fa-angle-right"></i></span></a>
							</li>
							@endforeach
						</ul>
					</div>
					<div class="space32"></div>
					<div class="tags-area">
						<h3>Popular Hastag</h3>
						<div class="space12"></div>
						<ul>
							@foreach(DB::table('event_tags')->where('status' , 1)->get() as $t)
							<li><a href="#">#{{ $t->name }}</a></li>
							@endforeach
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!--===== EVENT AREA STARTS =======-->
    <div class="blog1-section-area all-event-section sp2">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 m-auto">
                    <div class="event-header heading2 space-margin60 text-center">
                        <div class="space16"></div>
                        <h2 class="text-anime-style-3">Read More Events</h2>
                    </div>
                </div>
            </div>
            @php
            <div class="row">
                @foreach (DB::table('events')->where('status', 'Published')->where('id', '!=', $data->id)->limit(3)->get() as $event)
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
                                    <a href="{{ url('events/' . $event->id )}}">{{ $event->name }}</a>
                                    <div class="space16"></div>
                                    <p>{!! $event->description !!}</p>
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