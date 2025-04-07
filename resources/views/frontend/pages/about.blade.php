@extends('frontend.layouts.main')
@section('tittle')
<title>About Us | Creative Zone</title>
<link rel="canonical" href="{{Request::url()}}">
@endsection
@section('content')
<div class="container" style="margin-top: 140px;">
   <div class="breadcrumb-area" style=" background-color: #5cc99f; padding: 10px; border-radius: 8px; color: white; ">
      <div class="breadcrumb mb-0">
         <ul class="d-flex align-items-center">
            <li><a href="{{ url('') }}" class="text-white mx-1">Home</a></li>
            <li class="active"><i class="fa-solid fa-angle-right"></i> About Us</li>
         </ul>
      </div>
   </div>
</div>
<div class="about1-section-area sp1">
   <div class="container">
      <div class="row align-items-center">
         <div class="col-lg-6">
            <div class="about-imges">
               <div class="img1 reveal image-anime" style="opacity: 1; visibility: inherit; translate: none; rotate: none; scale: none; transform: translate(0px, 0px);">
                  <img src="{{ url('public/newfront/assets/img/all-images/about/about-img1.png') }}" alt="" style="translate: none; rotate: none; scale: none; transform: translate(0px, 0px);">
               </div>
               <div class="row">
                  <div class="col-lg-6 col-md-6">
                     <div class="space30"></div>
                     <div class="img1 reveal image-anime" style="opacity: 1; visibility: inherit; translate: none; rotate: none; scale: none; transform: translate(0px, 0px);">
                        <img src="{{ url('public/newfront/assets/img/all-images/about/about-img2.png') }}" alt="" style="translate: none; rotate: none; scale: none; transform: translate(0px, 0px);">
                     </div>
                  </div>
                  <div class="col-lg-6 col-md-6">
                     <div class="space30"></div>
                     <div class="img1 reveal image-anime" style="opacity: 1; visibility: inherit; translate: none; rotate: none; scale: none; transform: translate(0px, 0px);">
                        <img src="{{ url('public/newfront/assets/img/all-images/about/about-img3.png') }}" alt="" style="translate: none; rotate: none; scale: none; transform: translate(0px, 0px);">
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-lg-6">
            <div class="about-header-area heading2">
               <h5 data-aos="fade-left" data-aos-duration="800" class="aos-init">about our Business conferences</h5>
               <div class="space16"></div>
               <h2 class="text-anime-style-3" style="perspective: 400px;">
                  <div class="split-line" style="display: block; text-align: start; position: relative;">
                     <div style="position:relative;display:inline-block;">
                        <div style="position: relative; display: inline-block; translate: none; rotate: none; scale: none; transform: translate(0px, 0px); opacity: 1;">E</div>
                        <div style="position: relative; display: inline-block; translate: none; rotate: none; scale: none; transform: translate(0px, 0px); opacity: 1;">x</div>
                        <div style="position: relative; display: inline-block; translate: none; rotate: none; scale: none; transform: translate(0px, 0px); opacity: 1;">p</div>
                        <div style="position: relative; display: inline-block; translate: none; rotate: none; scale: none; transform: translate(0px, 0px); opacity: 1;">l</div>
                        <div style="position: relative; display: inline-block; translate: none; rotate: none; scale: none; transform: translate(0px, 0px); opacity: 1;">o</div>
                        <div style="position: relative; display: inline-block; translate: none; rotate: none; scale: none; transform: translate(0px, 0px); opacity: 1;">r</div>
                        <div style="position: relative; display: inline-block; translate: none; rotate: none; scale: none; transform: translate(0px, 0px); opacity: 1;">e</div>
                     </div>
                     <div style="position:relative;display:inline-block;">
                        <div style="position: relative; display: inline-block; translate: none; rotate: none; scale: none; transform: translate(0px, 0px); opacity: 1;">F</div>
                        <div style="position: relative; display: inline-block; translate: none; rotate: none; scale: none; transform: translate(0px, 0px); opacity: 1;">u</div>
                        <div style="position: relative; display: inline-block; translate: none; rotate: none; scale: none; transform: translate(0px, 0px); opacity: 1;">t</div>
                        <div style="position: relative; display: inline-block; translate: none; rotate: none; scale: none; transform: translate(0px, 0px); opacity: 1;">u</div>
                        <div style="position: relative; display: inline-block; translate: none; rotate: none; scale: none; transform: translate(0px, 0px); opacity: 1;">r</div>
                        <div style="position: relative; display: inline-block; translate: none; rotate: none; scale: none; transform: translate(0px, 0px); opacity: 1;">e</div>
                     </div>
                     <div style="position:relative;display:inline-block;">
                        <div style="position: relative; display: inline-block; translate: none; rotate: none; scale: none; transform: translate(0px, 0px); opacity: 1;">O</div>
                        <div style="position: relative; display: inline-block; translate: none; rotate: none; scale: none; transform: translate(0px, 0px); opacity: 1;">f</div>
                     </div>
                     <div style="position:relative;display:inline-block;">
                        <div style="position: relative; display: inline-block; translate: none; rotate: none; scale: none; transform: translate(0px, 0px); opacity: 1;">D</div>
                        <div style="position: relative; display: inline-block; translate: none; rotate: none; scale: none; transform: translate(0px, 0px); opacity: 1;">e</div>
                        <div style="position: relative; display: inline-block; translate: none; rotate: none; scale: none; transform: translate(0px, 0px); opacity: 1;">s</div>
                        <div style="position: relative; display: inline-block; translate: none; rotate: none; scale: none; transform: translate(0px, 0px); opacity: 1;">i</div>
                        <div style="position: relative; display: inline-block; translate: none; rotate: none; scale: none; transform: translate(0px, 0px); opacity: 1;">g</div>
                        <div style="position: relative; display: inline-block; translate: none; rotate: none; scale: none; transform: translate(0px, 0px); opacity: 1;">n</div>
                     </div>
                     <div style="position:relative;display:inline-block;">
                        <div style="position: relative; display: inline-block; translate: none; rotate: none; scale: none; transform: translate(0px, 0px); opacity: 1;">A</div>
                        <div style="position: relative; display: inline-block; translate: none; rotate: none; scale: none; transform: translate(0px, 0px); opacity: 1;">t</div>
                     </div>
                  </div>
                  <div class="split-line" style="display: block; text-align: start; position: relative;">
                     <div style="position:relative;display:inline-block;">
                        <div style="position: relative; display: inline-block; translate: none; rotate: none; scale: none; transform: translate(0px, 0px); opacity: 1;">O</div>
                        <div style="position: relative; display: inline-block; translate: none; rotate: none; scale: none; transform: translate(0px, 0px); opacity: 1;">u</div>
                        <div style="position: relative; display: inline-block; translate: none; rotate: none; scale: none; transform: translate(0px, 0px); opacity: 1;">r</div>
                     </div>
                     <div style="position:relative;display:inline-block;">
                        <div style="position: relative; display: inline-block; translate: none; rotate: none; scale: none; transform: translate(0px, 0px); opacity: 1;">Y</div>
                        <div style="position: relative; display: inline-block; translate: none; rotate: none; scale: none; transform: translate(0px, 0px); opacity: 1;">e</div>
                        <div style="position: relative; display: inline-block; translate: none; rotate: none; scale: none; transform: translate(0px, 0px); opacity: 1;">a</div>
                        <div style="position: relative; display: inline-block; translate: none; rotate: none; scale: none; transform: translate(0px, 0px); opacity: 1;">r</div>
                        <div style="position: relative; display: inline-block; translate: none; rotate: none; scale: none; transform: translate(0px, 0px); opacity: 1;">l</div>
                        <div style="position: relative; display: inline-block; translate: none; rotate: none; scale: none; transform: translate(0px, 0px); opacity: 1;">y</div>
                     </div>
                     <div style="position:relative;display:inline-block;">
                        <div style="position: relative; display: inline-block; translate: none; rotate: none; scale: none; transform: translate(0px, 0px); opacity: 1;">C</div>
                        <div style="position: relative; display: inline-block; translate: none; rotate: none; scale: none; transform: translate(0px, 0px); opacity: 1;">o</div>
                        <div style="position: relative; display: inline-block; translate: none; rotate: none; scale: none; transform: translate(0px, 0px); opacity: 1;">n</div>
                        <div style="position: relative; display: inline-block; translate: none; rotate: none; scale: none; transform: translate(0px, 0px); opacity: 1;">f</div>
                        <div style="position: relative; display: inline-block; translate: none; rotate: none; scale: none; transform: translate(0px, 0px); opacity: 1;">e</div>
                        <div style="position: relative; display: inline-block; translate: none; rotate: none; scale: none; transform: translate(0px, 0px); opacity: 1;">r</div>
                        <div style="position: relative; display: inline-block; translate: none; rotate: none; scale: none; transform: translate(0px, 0px); opacity: 1;">e</div>
                        <div style="position: relative; display: inline-block; translate: none; rotate: none; scale: none; transform: translate(0px, 0px); opacity: 1;">n</div>
                        <div style="position: relative; display: inline-block; translate: none; rotate: none; scale: none; transform: translate(0px, 0px); opacity: 1;">c</div>
                        <div style="position: relative; display: inline-block; translate: none; rotate: none; scale: none; transform: translate(0px, 0px); opacity: 1;">e</div>
                     </div>
                  </div>
               </h2>
               <div class="space16"></div>
               <p data-aos="fade-left" data-aos-duration="900" class="aos-init">The Yearly Designer Conferences designed to challenge, Event inspire, and push the boundaries of what is possible in design. From emerging technologies to sustainable design practices.</p>
               <div class="space32"></div>
               <div class="about-counter-area">
                  <div class="counter-box">
                     <h2>
                        <span class="odometer odometer-auto-theme" data-count="250">
                           <div class="odometer-inside"><span class="odometer-digit"><span class="odometer-digit-spacer">8</span><span class="odometer-digit-inner"><span class="odometer-ribbon"><span class="odometer-ribbon-inner"><span class="odometer-value">2</span></span></span></span></span><span class="odometer-digit"><span class="odometer-digit-spacer">8</span><span class="odometer-digit-inner"><span class="odometer-ribbon"><span class="odometer-ribbon-inner"><span class="odometer-value">5</span></span></span></span></span><span class="odometer-digit"><span class="odometer-digit-spacer">8</span><span class="odometer-digit-inner"><span class="odometer-ribbon"><span class="odometer-ribbon-inner"><span class="odometer-value">0</span></span></span></span></span></div>
                        </span>
                        +
                     </h2>
                     <div class="space18"></div>
                     <p>Our Journalist</p>
                  </div>
                  <div class="counter-box box2">
                     <h2>
                        <span class="odometer odometer-auto-theme" data-count="15">
                           <div class="odometer-inside"><span class="odometer-digit"><span class="odometer-digit-spacer">8</span><span class="odometer-digit-inner"><span class="odometer-ribbon"><span class="odometer-ribbon-inner"><span class="odometer-value">1</span></span></span></span></span><span class="odometer-digit"><span class="odometer-digit-spacer">8</span><span class="odometer-digit-inner"><span class="odometer-ribbon"><span class="odometer-ribbon-inner"><span class="odometer-value">5</span></span></span></span></span></div>
                        </span>
                        +
                     </h2>
                     <div class="space18"></div>
                     <p>Our Speaker</p>
                  </div>
                  <div class="counter-box box3" style="border: none">
                     <h2>
                        <span class="odometer odometer-auto-theme" data-count="7">
                           <div class="odometer-inside"><span class="odometer-digit"><span class="odometer-digit-spacer">8</span><span class="odometer-digit-inner"><span class="odometer-ribbon"><span class="odometer-ribbon-inner"><span class="odometer-value">7</span></span></span></span></span></div>
                        </span>
                        K+
                     </h2>
                     <div class="space18"></div>
                     <p>Attendees</p>
                  </div>
               </div>
               <div class="space32"></div>
               <div class="btn-area1 aos-init" data-aos="fade-left" data-aos-duration="1200">
                  <a href="contact.html" class="vl-btn1">Become an Attendee</a>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<div class="brands3-section-area sp2">
   <div class="container">
      <div class="row">
         <div class="col-lg-5 m-auto">
            <div class="brand-header heading4 space-margin60 text-center">
               <h3>Join 4,000+ companies already growing</h3>
            </div>
         </div>
      </div>
      <div class="row">
         <div class="col-lg-12 aos-init" data-aos="zoom-in" data-aos-duration="800">
            <div class="brand-slider-area owl-carousel owl-loaded owl-drag">
               <div class="owl-stage-outer">
                  <div class="owl-stage" style="transform: translate3d(-3315px, 0px, 0px); transition: 2s; width: 5305px;">
                     <div class="owl-item cloned" style="width: 301.502px; margin-right: 30px;">
                        <div class="brand-box">
                           <img src="{{ url('public/newfront/assets/img/elements/brand-img5.png') }}" alt="">
                        </div>
                     </div>
                     <div class="owl-item cloned" style="width: 301.502px; margin-right: 30px;">
                        <div class="brand-box">
                           <img src="{{ url('public/newfront/assets/img/elements/brand-img6.png') }}" alt="">
                        </div>
                     </div>
                     <div class="owl-item cloned" style="width: 301.502px; margin-right: 30px;">
                        <div class="brand-box">
                           <img src="{{ url('public/newfront/assets/img/elements/brand-img7.png') }}" alt="">
                        </div>
                     </div>
                     <div class="owl-item cloned" style="width: 301.502px; margin-right: 30px;">
                        <div class="brand-box">
                           <img src="{{ url('public/newfront/assets/img/elements/brand-img8.png') }}" alt="">
                        </div>
                     </div>
                     <div class="owl-item" style="width: 301.502px; margin-right: 30px;">
                        <div class="brand-box">
                           <img src="{{ url('public/newfront/assets/img/elements/brand-img1.png') }}" alt="">
                        </div>
                     </div>
                     <div class="owl-item" style="width: 301.502px; margin-right: 30px;">
                        <div class="brand-box">
                           <img src="{{ url('public/newfront/assets/img/elements/brand-img2.png') }}" alt="">
                        </div>
                     </div>
                     <div class="owl-item" style="width: 301.502px; margin-right: 30px;">
                        <div class="brand-box">
                           <img src="{{ url('public/newfront/assets/img/elements/brand-img3.png') }}" alt="">
                        </div>
                     </div>
                     <div class="owl-item" style="width: 301.502px; margin-right: 30px;">
                        <div class="brand-box">
                           <img src="{{ url('public/newfront/assets/img/elements/brand-img4.png') }}" alt="">
                        </div>
                     </div>
                     <div class="owl-item" style="width: 301.502px; margin-right: 30px;">
                        <div class="brand-box">
                           <img src="{{ url('public/newfront/assets/img/elements/brand-img5.png') }}" alt="">
                        </div>
                     </div>
                     <div class="owl-item" style="width: 301.502px; margin-right: 30px;">
                        <div class="brand-box">
                           <img src="{{ url('public/newfront/assets/img/elements/brand-img6.png') }}" alt="">
                        </div>
                     </div>
                     <div class="owl-item active" style="width: 301.502px; margin-right: 30px;">
                        <div class="brand-box">
                           <img src="{{ url('public/newfront/assets/img/elements/brand-img7.png') }}" alt="">
                        </div>
                     </div>
                     <div class="owl-item active" style="width: 301.502px; margin-right: 30px;">
                        <div class="brand-box">
                           <img src="{{ url('public/newfront/assets/img/elements/brand-img8.png') }}" alt="">
                        </div>
                     </div>
                     <div class="owl-item cloned active" style="width: 301.502px; margin-right: 30px;">
                        <div class="brand-box">
                           <img src="{{ url('public/newfront/assets/img/elements/brand-img1.png') }}" alt="">
                        </div>
                     </div>
                     <div class="owl-item cloned active" style="width: 301.502px; margin-right: 30px;">
                        <div class="brand-box">
                           <img src="{{ url('public/newfront/assets/img/elements/brand-img2.png') }}" alt="">
                        </div>
                     </div>
                     <div class="owl-item cloned" style="width: 301.502px; margin-right: 30px;">
                        <div class="brand-box">
                           <img src="{{ url('public/newfront/assets/img/elements/brand-img3.png') }}" alt="">
                        </div>
                     </div>
                     <div class="owl-item cloned" style="width: 301.502px; margin-right: 30px;">
                        <div class="brand-box">
                           <img src="{{ url('public/newfront/assets/img/elements/brand-img4.png') }}" alt="">
                        </div>
                     </div>
                  </div>
               </div>
               <div class="owl-nav disabled"><button type="button" role="presentation" class="owl-prev"><span aria-label="Previous">‹</span></button><button type="button" role="presentation" class="owl-next"><span aria-label="Next">›</span></button></div>
               <div class="owl-dots disabled"></div>
            </div>
         </div>
      </div>
   </div>
</div>
<div class="choose-section-area sp2">
   <div class="container">
      <div class="row">
         <div class="col-lg-4 m-auto">
            <div class="heading2 text-center space-margin60">
               <h5>why choose us</h5>
               <div class="space18"></div>
               <h2>Why Attend Event?</h2>
            </div>
         </div>
      </div>
      <div class="row">
         <div class="col-lg-4 col-md-6">
            <div class="choose-widget-boxarea">
               <div class="icons">
                  <img src="{{ url('public/newfront/assets/img/icons/choose-icons1.svg') }}" alt="">
               </div>
               <div class="space24"></div>
               <div class="content-area">
                  <a href="event-single.html">Make Ideas Happen</a>
                  <div class="space16"></div>
                  <p>Eventify 2024 brings together the brightest minds and industry leaders for best of transformative business.</p>
                  <div class="space24"></div>
                  <a href="event-single.html" class="readmore">Read More <i class="fa-solid fa-arrow-right"></i></a>
               </div>
            </div>
         </div>
         <div class="col-lg-4 col-md-6">
            <div class="choose-widget-boxarea">
               <div class="icons">
                  <img src="{{ url('public/newfront/assets/img/icons/choose-icons1.svg') }}" alt="">
               </div>
               <div class="space24"></div>
               <div class="content-area">
                  <a href="event-single.html">Great Speakers</a>
                  <div class="space16"></div>
                  <p>Whether you're looking to elevate your business strategy, discover the latest industry trends, or connect.</p>
                  <div class="space24"></div>
                  <a href="event-single.html" class="readmore">Read More <i class="fa-solid fa-arrow-right"></i></a>
               </div>
            </div>
         </div>
         <div class="col-lg-4 col-md-6">
            <div class="choose-widget-boxarea">
               <div class="icons">
                  <img src="{{ url('public/newfront/assets/img/icons/choose-icons1.svg') }}" alt="">
               </div>
               <div class="space24"></div>
               <div class="content-area">
                  <a href="event-single.html">One Day Ticket</a>
                  <div class="space16"></div>
                  <p>We empower businesses to thrive in an ever-evolving marketplace. This conference more than just an event.</p>
                  <div class="space24"></div>
                  <a href="event-single.html" class="readmore">Read More <i class="fa-solid fa-arrow-right"></i></a>
               </div>
            </div>
         </div>
         <div class="col-lg-4 col-md-6">
            <div class="choose-widget-boxarea">
               <div class="icons">
                  <img src="{{ url('public/newfront/assets/img/icons/choose-icons1.svg') }}" alt="">
               </div>
               <div class="space24"></div>
               <div class="content-area">
                  <a href="event-single.html">Develop Your Skills</a>
                  <div class="space16"></div>
                  <p>Eventify is your gateway to future of business. By bringing together best experts from various sectors.</p>
                  <div class="space24"></div>
                  <a href="event-single.html" class="readmore">Read More <i class="fa-solid fa-arrow-right"></i></a>
               </div>
            </div>
         </div>
         <div class="col-lg-4 col-md-6">
            <div class="choose-widget-boxarea">
               <div class="icons">
                  <img src="{{ url('public/newfront/assets/img/icons/choose-icons1.svg') }}" alt="">
               </div>
               <div class="space24"></div>
               <div class="content-area">
                  <a href="event-single.html">Entry Verification</a>
                  <div class="space16"></div>
                  <p>You'll walk away with a deeper best understanding of emerging trends and actionable strategies that can.</p>
                  <div class="space24"></div>
                  <a href="event-single.html" class="readmore">Read More <i class="fa-solid fa-arrow-right"></i></a>
               </div>
            </div>
         </div>
         <div class="col-lg-4 col-md-6">
            <div class="choose-widget-boxarea">
               <div class="icons">
                  <img src="{{ url('public/newfront/assets/img/icons/choose-icons1.svg') }}" alt="">
               </div>
               <div class="space24"></div>
               <div class="content-area">
                  <a href="event-single.html">Workshops Offer</a>
                  <div class="space16"></div>
                  <p>Designed for forward-thinking and professionals, this event delivers the tools, connections, and insights you.</p>
                  <div class="space24"></div>
                  <a href="event-single.html" class="readmore">Read More <i class="fa-solid fa-arrow-right"></i></a>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection