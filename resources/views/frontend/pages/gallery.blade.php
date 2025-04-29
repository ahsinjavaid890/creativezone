@extends('frontend.layouts.main')
@section('tittle')
<title>Gallery Images | Creative Zone</title>
<link rel="canonical" href="{{Request::url()}}">
@endsection
@section('content')
<style type="text/css">
    .memory1-section-area .memory-slider-areas {
        position: relative;
        z-index: 1;
    }
</style>
<!--===== HERO AREA STARTS =======-->
<div class="container" style="margin-top: 140px;">
   <div class="breadcrumb-area" style=" background-color: #5cc99f; padding: 10px; border-radius: 8px; color: white; ">
      <div class="breadcrumb mb-0">
         <ul class="d-flex align-items-center">
            <li><a href="{{ url('') }}" class="text-white mx-1">Home</a></li>
            <li class="active"><i class="fa-solid fa-angle-right"></i> Gallery Images</li>
         </ul>
      </div>
   </div>
</div>    
<!--===== CONTACT AREA STARTS =======-->
    <div class="memory1-section-area sp1">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 m-auto">
                    <div class="memory-header text-center heading2 space-margin60">
                        <h5 data-aos="fade-left" data-aos-duration="800" class="aos-init aos-animate">Gallery Images</h5>
                        <div class="space16"></div>
                        <h2 class="text-anime-style-3" style="perspective: 400px;"><div class="split-line" style="display: block; text-align: center; position: relative;"><div style="position:relative;display:inline-block;"><div style="position: relative; display: inline-block; translate: none; rotate: none; scale: none; transform: translate(0px, 0px); opacity: 1;">Recent Photos 2024</div></div></div></h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                   <div class="memory-slider-areas">
                        <div class="row">
                            @foreach($data as $p)
                            <div class="col-lg-3 mt-3">
                               <div class="memory-boxarea">
                                  <div class="img1 image-anime">
                                     <img src="{{ url('images/' . $p->photo) }}" alt="">
                                  </div>
                                  <div class="content-area">
                                     <div class="arrow">
                                        <a href="javascript:void(0)"><i class="fa-solid fa-arrow-right"></i></a>
                                     </div>
                                     <div class="space18"></div>
                                     <p>{{ DB::table('photocategories')->where('id' , $p->category_id)->first()->name }}</p>
                                     <div class="space12"></div>
                                     <a href="javascript:void(0)">{{ $p->name }}</a>
                                  </div>
                               </div>
                            </div>
                            @endforeach
                        </div>
                   </div>
                </div>
            </div>
        </div>
    </div>
<!--===== CONTACT AREA ENDS =======-->
@endsection