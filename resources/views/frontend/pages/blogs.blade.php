@extends('frontend.layouts.main')
@section('tittle')
<title>Blogs | Creative Zone</title>
<link rel="canonical" href="{{Request::url()}}">
@endsection
@section('content')
<div class="container" style="margin-top: 140px;">
   <div class="breadcrumb-area" style=" background-color: #5cc99f; padding: 10px; border-radius: 8px; color: white; ">
      <div class="breadcrumb mb-0">
         <ul class="d-flex align-items-center">
            <li><a href="{{ url('') }}" class="text-white mx-1">Home</a></li>
            <li class="active"><i class="fa-solid fa-angle-right"></i> Our Blogs</li>
         </ul>
      </div>
   </div>
</div> 
<div class="blog1-section-area sp2">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 m-auto">
                <div class="blog-header text-center heading2 space-margin60">
                    <h5 >Latest Insights</h5>
                    <div class="space16"></div>
                    <h2 class="text-anime-style-3">Stay Updated with Industry Trends</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-6" >
                <div class="blog1-auhtor-boxarea">
                    <div class="img1 image-anime">
                        <img src="{{ url('public/newfront/assets/img/all-images/blog/blog-img1.png') }}" alt="" />
                    </div>

                    <div class="content-area">
                        <ul>
                            <li>
                                <a href="#"><img src="{{ url('public/newfront/assets/img/icons/calender1.svg') }}" alt="" />15 March 2025</a>
                            </li>
                        </ul>
                        <div class="space20"></div>
                        <a href="{{ url('blog') }}/1">The Future of Green Energy: Innovations to Watch</a>
                        <div class="space24"></div>
                        <div class="btn-area1">
                            <a href="{{ url('blog') }}/1" class="vl-btn2">Read More</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="blog1-auhtor-boxarea">
                    <div class="img1 image-anime">
                        <img src="{{ url('public/newfront/assets/img/all-images/blog/blog-img2.png') }}" alt="" />
                    </div>

                    <div class="content-area">
                        <ul>
                            <li>
                                <a href="#"><img src="{{ url('public/newfront/assets/img/icons/calender1.svg') }}" alt="" />20 March 2025</a>
                            </li>
                        </ul>
                        <div class="space20"></div>
                        <a href="{{ url('blog') }}/1">Tech Giants Investing in AI: What’s Next?</a>
                        <div class="space24"></div>
                        <div class="btn-area1">
                            <a href="{{ url('blog') }}/1" class="vl-btn2">Read More</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="blog1-auhtor-boxarea">
                    <div class="img1 image-anime">
                        <img src="{{ url('public/newfront/assets/img/all-images/blog/blog-img3.png') }}" alt="" />
                    </div>

                    <div class="content-area">
                        <ul>
                            <li>
                                <a href="#"><img src="{{ url('public/newfront/assets/img/icons/calender1.svg') }}" alt="" />25 March 2025</a>
                            </li>
                        </ul>
                        <div class="space20"></div>
                        <a href="{{ url('blog') }}/1">How Remote Work is Reshaping Global...</a>
                        <div class="space24"></div>
                        <div class="btn-area1">
                            <a href="{{ url('blog') }}/1" class="vl-btn2">Read More</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection