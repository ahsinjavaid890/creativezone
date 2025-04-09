@extends('frontend.layouts.main')
@section('tittle')
<title>Contact Us | Creative Zone</title>
<link rel="canonical" href="{{Request::url()}}">
@endsection
@section('content')
<style type="text/css">
    .phoneplanherosection{
        padding: 30px;
        height: 572px;
        width: 615px;
        left: 43px;
        top: 182px;
    }
    .custom-form-group textarea{
        height: 100% !important;
    } 
</style>
<!--===== HERO AREA STARTS =======-->
<div class="container" style="margin-top: 140px;">
   <div class="breadcrumb-area" style=" background-color: #5cc99f; padding: 10px; border-radius: 8px; color: white; ">
      <div class="breadcrumb mb-0">
         <ul class="d-flex align-items-center">
            <li><a href="{{ url('') }}" class="text-white mx-1">Home</a></li>
            <li class="active"><i class="fa-solid fa-angle-right"></i> Contact Us</li>
         </ul>
      </div>
   </div>
</div>    
<!--===== CONTACT AREA STARTS =======-->
<div class="contact-inner-section sp1">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="img1 image-anime">
                    <img src="{{ url('newfront/assets/img/all-images/contact/contact-img4.png') }} " alt="" />
                </div>
            </div>

            <div class="col-lg-6" >
                <div class="contact4-boxarea">
                    <h3 class="text-anime-style-3">Contact Us</h3>
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
                        <div class="col-lg-12 col-md-6">
                            <div class="input-area">
                                <input type="text" placeholder="Subjects" />
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
                                <button type="submit" class="vl-btn1">Submit Now</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--===== CONTACT AREA ENDS =======-->

<!--===== CONTACT AREA STARTS =======-->
<div class="contact2-bg-section">
    <div class="img1">
        <img src="{{ url('newfront/assets/img/all-images/contact/contact-img1.png') }} " alt="" class="contact-img1" />
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="space48"></div>
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="contact-boxarea" >
                            <div class="icons">
                                <img src="{{ url('newfront/assets/img/icons/mail1.svg') }}" alt="" />
                            </div>
                            <div class="text">
                                <h5>Our Email</h5>
                                <div class="space14"></div>
                                <a href="maito:eventify@gmail.com">xyz@gmail.com</a>
                            </div>
                        </div>
                        <div class="space18"></div>
                        <div class="contact-boxarea" >
                            <div class="icons">
                                <img src="{{ url('newfront/assets/img/icons/location1.svg') }}" alt="" />
                            </div>
                            <div class="text">
                                <h5>our location</h5>
                                <div class="space14"></div>
                                <a href="#">Dubai, UAE</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-6">
                        <div class="space20 d-md-none d-block"></div>
                        <div class="contact-boxarea" >
                            <div class="icons">
                                <img src="{{ url('newfront/assets/img/icons/phn1.svg') }}" alt="" />
                            </div>
                            <div class="text">
                                <h5>Call/Message</h5>
                                <div class="space14"></div>
                                <a href="tel:+11234567890">+971 5245 1254</a>
                            </div>
                        </div>
                        <div class="space18"></div>
                        <div class="contact-boxarea">
                            <div class="icons">
                                <img src="{{ url('newfront/assets/img/icons/instagram.svg') }}" alt="" />
                            </div>
                            <div class="text">
                                <h5>Instagram</h5>
                                <div class="space14"></div>
                                <a href="#">xyz.com</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="mapouter">
        <div class="gmap_canvas">
            <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d4506257.120552435!2d88.67021924228865!3d21.954385721237916!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sbd!4v1704088968016!5m2!1sen!2sbd" width="600" height="450" style="border: 0"
                allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </div>
</div>
<div class="space100 d-lg-block d-none"></div>
<div class="space50 d-lg-none d-block"></div>
<!--===== CONTACT AREA ENDS =======-->

@endsection
@section('script')
<script>
    $('#contactfrom').on('submit',(function(e) {
        $('#contactbtn').html('<i class="fa fa-spin fa-spinner"></i>');
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            type:'POST',
            url: $(this).attr('action'),
            data:formData,
            cache:false,
            contentType: false,
            processData: false,
            success: function(data){
                $('#contactbtn').html('Next');
                $('.buy_section').html(data);
            }
        });
    }));
</script>
@endsection