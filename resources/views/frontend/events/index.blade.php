@extends('frontend.layouts.main')
@include('frontend.sections.mettatags')
@section('content')
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
                        [
                            'id' => 4,
                            'image' => 'blog-img1.png',
                            'date' => '25 March 2025',
                            'title' => 'Innovate 2025 A Full-Day Journey...',
                            'description' => 'The Innovate 2025 conference is meticulously designed to ...',
                        ],
                        [
                            'id' => 5,
                            'image' => 'blog-img2.png',
                            'date' => '10 April 2025',
                            'title' => 'Tech Future 2025',
                            'description' => 'A conference dedicated to exploring the future of technology, AI ...',
                        ],
                        [
                            'id' => 6,
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
                <div class="col-lg-12 m-auto">
                	<div class="pagination-area">
						<nav aria-label="Page navigation example">
							<ul class="pagination">
								<li class="page-item">
									<a class="page-link" href="#" aria-label="Previous">
										<i class="fa-solid fa-angle-left"></i>
									</a>
								</li>
								<li class="page-item"><a class="page-link active" href="#">1</a></li>
								<li class="page-item"><a class="page-link" href="#">2</a></li>
								<li class="page-item"><a class="page-link" href="#">...</a></li>
								<li class="page-item"><a class="page-link" href="#">12</a></li>
								<li class="page-item">
									<a class="page-link" href="#" aria-label="Next">
										<i class="fa-solid fa-angle-right"></i>
									</a>
								</li>
							</ul>
						</nav>
					</div>
                </div>
            </div>
        </div>
    </div>
<!--===== EVENT AREA ENDS =======-->

@endsection