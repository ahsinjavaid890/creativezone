@extends('frontend.layouts.main')
@include('frontend.sections.mettatags')
@section('content')
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
								<img src="{{  url('public/newfront/assets/img/all-images/blog/blog-img7.png') }}" alt="">
					</div>
					<div class="space32"></div>
					<ul>
						<li>
							<a href="#"><img src="{{  url('public/newfront/assets/img/icons/calender1.svg')}}" alt="">26 Jan 2025 <span> | </span></a>
						</li>
						<li>
							<a href="#"><img src="{{  url('public/newfront/assets/img/icons/user1.svg')}}" alt="">Gisselle <span> | </span></a>
						</li>
						<li>
							<a href="#"><img src="{{  url('public/newfront/assets/img/icons/comments1.svg')}}" alt="">2 Comments</a>
						</li>
					</ul>
					<div class="space18"></div>
					<h2>Step Into the Future of Business with Eventify</h2>
					<div class="space16"></div>
					<p>At Eventify 2024, you'll join an exclusive gathering of business leaders and innovators shaping the future their industries. This one-day conference offers dynamic sessions on leadership, technology, and strategy to help you stay ahead in today's competitive market. Whether you're looking to unlock new opportunities or build lasting eventify partnerships, Eventify is where you need to be.</p>
					<div class="space32"></div>
					<h3>Eventify: Your Gateway Strategic Growth</h3>
					<div class="space16"></div>
					<p>Fuel an your business growth with actionable insights from world-class experts at Eventify 2024. This premier event brings together forward-thinking professionals to explore the latest trends, technologies, and strategies for success. From keynote speeches to interactive workshops, Eventify provides you with the tools you need.</p>
					<div class="space16"></div>
					<p>"Join us at Eventify 2024, where innovation meets opportunity. This conference is the ultimate destination for business leaders seeking to push the boundaries of an what's possible. With sessions on disruptive technologies, leadership trends, and market strategies, you'll walk away with the knowledge and connections to lead.</p>
					<div class="space32"></div>
					<h3>Reimagine Business Possibilities Eventify</h3>
					<div class="space16"></div>
					<p>"Eventify 2024 is the ultimate destination for professionals eager to stay ahead in the evolving business landscape. This event brings together to innovators, meetup industry leaders, and experts to explore the future of business strategy technology.</p>
					<div class="space32"></div>
					<div class="tags-social-area">
						<div class="tags">
							<h4>Tags:</h4>
							<ul>
								<li><a href="#">#Conferences</a></li>
								<li><a href="#" class="m-0">#Meetup</a></li>
							</ul>
						</div>
						<div class="social">
							<h4>Social:</h4>
							<ul>
								<li>
									<a href="#"><i class="fa-brands fa-facebook-f"></i></a>
								</li>
								<li>
									<a href="#"><i class="fa-brands fa-instagram"></i></a>
								</li>
								<li>
									<a href="#" class="m-0"><i class="fa-brands fa-youtube"></i></a>
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
			    		<div class="col-lg-12">
			    			<div class="contact4-boxarea">
			                    <h3 class="text-anime-style-3 text-center">Apply For Event</h3>
			                    <div class="space8"></div>
			                    <div class="row">
			                        <div class="col-lg-6 col-md-6">
			                            <div class="input-area">
			                                <input type="text" placeholder="Name" />
			                            </div>
			                        </div>
			                        <div class="col-lg-6 col-md-6">
			                            <div class="input-area">
			                                <input type="text" placeholder="Phone" />
			                            </div>
			                        </div>

			                        <div class="col-lg-12 col-md-6">
			                            <div class="input-area">
			                                <input type="email" placeholder="Email" />
			                            </div>
			                        </div>
			                        <div class="col-lg-12">
			                            <div class="input-area">
			                                <textarea placeholder="Message"></textarea>
			                            </div>
			                        </div>

			                        <div class="col-lg-12">
			                            <div class="space24"></div>
			                            <div class="input-area text-end">
			                                <button type="submit" class="vl-btn1">Apply Now</button>
			                            </div>
			                        </div>
			                    </div>
			                </div>
			    		</div>
			    	</div>
				</div>
				<div class="space32"></div>
					<div class="blog-categories">
						<h3>Event Category</h3>
						<div class="space12"></div>
						<ul>
							<li>
								<a href="#">Business Innovation <span><i class="fa-solid fa-angle-right"></i></span></a>
							</li>
							<li>
								<a href="#">Leadership &amp; Strategy <span><i class="fa-solid fa-angle-right"></i></span></a>
							</li>
							<li>
								<a href="#">Networking &amp; Collaboration <span><i class="fa-solid fa-angle-right"></i></span></a>
							</li>
							<li>
								<a href="#">Entrepreneurship Startups <span><i class="fa-solid fa-angle-right"></i></span></a>
							</li>
							<li>
								<a href="#">Marketing &amp; Branding <span><i class="fa-solid fa-angle-right"></i></span></a>
							</li>
							<li>
								<a href="#">Event Highlights &amp; Recaps <span><i class="fa-solid fa-angle-right"></i></span></a>
							</li>
						</ul>
					</div>
					<div class="space32"></div>
					<div class="tags-area">
						<h3>Popular Hastag</h3>
						<div class="space12"></div>
						<ul>
							<li><a href="#">#Conferences</a></li>
							<li><a href="#">#Meetup</a></li>
							<li><a href="#">#Event</a></li>
						</ul>

						<ul>
							<li><a href="#">#Eventify2024</a></li>
							<li><a href="#">#DigitalTransformation</a></li>
						</ul>

						<ul>
							<li><a href="#">#BusinessLeadership</a></li>
							<li><a href="#">#IndustryTrends</a></li>
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
            $events = [
                        [
                            'id' => 1,
                            'image' => 'blog-img1.png',
                            'date' => '25 March 2025',
                            'title' => 'Innovate 2025 A Full-Day Journey...',
                            'description' => 'The Innovate 2025 conference is meticulously designed to ...',
                        ],
                        [
                            'id' => 2,
                            'image' => 'blog-img2.png',
                            'date' => '10 April 2025',
                            'title' => 'Tech Future 2025',
                            'description' => 'A conference dedicated to exploring the future of technology, AI ...',
                        ],
                        [
                            'id' => 3,
                            'image' => 'blog-img3.png',
                            'date' => '15 May 2025',
                            'title' => 'Business Summit 2025',
                            'description' => 'Bringing together top business leaders to discuss trends and strategies ...',
                        ],
                    ];

            @endphp
            <div class="row">
                @foreach ($events as $event)
                    <div class="col-lg-4 col-md-6 mt-5">
                        <div class="blog1-auhtor-boxarea">
                            <div class="content-area all-events p-0">
                                <div class="img1 image-anime">
                                    <img src="{{ url('public/newfront/assets/img/all-images/blog/' . $event['image']) }}" alt="" />
                                </div>
                                <div class="p-3">
                                    <ul>
                                        <li>
                                            <a href="#"><img src="{{ url('public/newfront/assets/img/icons/calender1.svg') }}" alt="" />{{ $event['date'] }}</a>
                                        </li>
                                    </ul>
                                    <div class="space20"></div>
                                    <a href="{{ url('events/' . $event['id']) }}">{{ $event['title'] }}</a>
                                    <div class="space16"></div>
                                    <p>{{ $event['description'] }}</p>
                                    <div class="space24"></div>
                                    <div class="btn-area1">
                                        <a href="javascript:void(0)" class="vl-btn1 event-btn" data-id="{{ $event['id'] }}">Become Attendee</a>
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