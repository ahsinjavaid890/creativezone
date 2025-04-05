@extends('frontend.layouts.main')
@include('frontend.sections.mettatags')
@section('content')
<style type="text/css">
    .phoneplanherosection{
        background-color: transparent !important;
        box-shadow: none;
        top: 170px;
    }
</style>
<section class="buy_section" style="background-image: url('{{ url('') }}/public/front/img/tech-support.png'); height: 600px; background-position:center; background-size: cover; background-repeat:no-repeat;margin-top: -52px;">
  <div class="herosectionpositionrelative">
     <div class="phoneplanherosection">
    <h1>Your All In One <br> Tech Companion</span></h1>
    <p class="want_totalk">Let’s discuss if you need some help with Us</p>
    <div class="custom-form-group">
        <a href="{{ url('techsupport') }}" type="submit" class="btn btn-primary btn-md">Get Help</a>
    </div>
       <!--  <form action="" method="POST">
            @csrf
            <div class="custom-form-group">
                <div class="custom-input-container">
                    <input type="text" name="" placeholder="Enter the Address , City , State" class="custom-input">
                    <img src="{{ url('') }}/public/images/location_on.png" alt="icon" class="custom-icon">
                </div>
            </div>
            <div class="custom-form-group">
                <div class="custom-input-container">
                    <input type="text" name="" placeholder="Apartment Number" class="custom-input">
                    <img src="{{ url('') }}/public/images/tag.png" alt="icon" class="custom-icon">
                </div>
            </div>
        </form>
        <div class="phonenumbersection">
            <img src="{{ url('') }}/public/images/phone_in_talk.png"><a href="tel:425-224-6764">425-224-6764</a>
        </div>
        <p class="want_totalk">Let’s discuss if you need some help with Us</p> -->
     </div>
  </div>
</section>
    @if($pagedata->testimonial_show == 1)
    @include('frontend.sections.testimonial')
    @endif
    @if($pagedata->faq_show == 1)
    @include('frontend.sections.faq')
    @endif
    @if($pagedata->blog_show == 1)
    @include('frontend.sections.blog')
    @endif
    @if($pagedata->video_show == 1)
    @include('frontend.sections.videos')
    @endif
@endsection