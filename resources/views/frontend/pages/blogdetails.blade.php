@extends('frontend.layouts.main')
@section('tittle')
<title>Blog Detail | Creative Zone</title>
<link rel="canonical" href="{{Request::url()}}">
@endsection
@section('content')
<div class="container" style="margin-top: 140px;">
   <div class="breadcrumb-area" style=" background-color: #5cc99f; padding: 10px; border-radius: 8px; color: white; ">
      <div class="breadcrumb mb-0">
         <ul class="d-flex align-items-center">
            <li><a href="{{ url('') }}" class="text-white mx-1">Home</a></li>
            <li class="active"><i class="fa-solid fa-angle-right"></i> Blog Detail</li>
         </ul>
      </div>
   </div>
</div>
<div class="blog-details-section sp8 mt-3">
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
                    <div class="space48"></div>
                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <div class="img1 image-anime">
                                        <img src="{{  url('public/newfront/assets/img/all-images/blog/blog-img8.png') }}" alt="">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="space30 d-md-none d-block"></div>
                            <div class="img1 image-anime">
                                        <img src="{{  url('public/newfront/assets/img/all-images/blog/blog-img9.png') }}" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="space32"></div>
                    <h3>Eventify: Your Gateway Strategic Growth</h3>
                    <div class="space16"></div>
                    <p>Fuel an your business growth with actionable insights from world-class experts at Eventify 2024. This premier event brings together forward-thinking professionals to explore the latest trends, technologies, and strategies for success. From keynote speeches to interactive workshops, Eventify provides you with the tools you need.</p>
                    <div class="space16"></div>
                    <p>"Join us at Eventify 2024, where innovation meets opportunity. This conference is the ultimate destination for business leaders seeking to push the boundaries of an what's possible. With sessions on disruptive technologies, leadership trends, and market strategies, you'll walk away with the knowledge and connections to lead.</p>
                    <div class="space48"></div>
                    <div class="video-btn-area">
                        <div class="img1">
                                    <img src="{{  url('public/newfront/assets/img/all-images/blog/blog-img10.png') }}" alt="">
                        </div>
                        <div class="play">
                            <a href="https://www.youtube.com/watch?v=Y8XpQpW5OVY" class="popup-youtube"><i class="fa-solid fa-play"></i></a>
                        </div>
                    </div>
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
                <div class="space30 d-lg-none d-block"></div>
                <div class="blog-auhtor-details">
                    <div class="blog-categories">
                        <h3>Blogs Category</h3>
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
@endsection