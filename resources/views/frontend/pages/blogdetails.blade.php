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
<div class="blog-details-section sp8 mt-1">
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
                            <a href="#"><img src="{{  url('newfront/assets/img/icons/calender1.svg')}}" alt="">26 Jan 2025 <span> | </span></a>
                        </li>
                        <li>
                            <a href="#"><img src="{{  url('newfront/assets/img/icons/user1.svg')}}" alt="">Gisselle <span> | </span></a>
                        </li>
                        <li>
                            <a href="#"><img src="{{  url('newfront/assets/img/icons/comments1.svg')}}" alt="">2 Comments</a>
                        </li>
                    </ul>
                    <div class="space18"></div>
                    <h2>{{ $data->title }}</h2>
                    <div class="space16"></div>
                    <p>{!! $data->content !!}</p>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="space30 d-lg-none d-block"></div>
                <div class="blog-auhtor-details">
                    <div class="blog-categories">
                        <h3>Blogs Category</h3>
                        <div class="space12"></div>
                        <ul>
                            @foreach(DB::table('blogcategories')->where('status' , 1)->get() as $c)
                            <li>
                                <a href="#">{{ $c->name }} <span><i class="fa-solid fa-angle-right"></i></span></a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection