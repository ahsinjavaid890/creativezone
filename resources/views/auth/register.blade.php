@extends('frontend.layouts.mainlogin')
@section('tittle')
<title>Register | Artist</title>
@endsection
@section('content')
@php
    $settings = DB::table('site_settings')->where('smallname' , env('APP_NAME'))->first();
@endphp
<!--===== CONTACT AREA STARTS =======-->
<div class="contact-inner-section">
    <div class="">
        <div class="row">
            <div class="col-lg-12">
                @if (session('success'))
                    <div class="alert alert-success">
                      {{ session('success') }}
                    </div>
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                          @foreach ($errors->all() as $error)
                              <li>{{ $error }}</li> 
                          @endforeach
                        </ul>
                    </div>
                @endif
            </div>
            <div class="col-lg-7 p-0">
                <div class="user-form-banner">
                    <div class="user-form-header mb-5">
                        <a href="{{ url('') }}"><i class="fas fa-arrow-left"></i></a>
                    </div>
                    <div class="user-form-content mt-4">
                        <a href="{{ url('') }}"><img src="{{ url('images') }}/{{ $settings->footer_logo }}" alt="logo"></a>
                        <h1>Welcome Back, Artist! <span>Your Creative Journey Starts Here.</span></h1>
                        <p>Register to access your dashboard — manage your artwork listings, track your sales, engage with art lovers, and grow your presence in the region's leading artist marketplace.</p>


                    </div>
                </div>
            </div>
            <div class="col-lg-5 p-0">
                <div class="contact4-boxarea">
                    <div class="user-form-category-btn">
                        <ul class="nav nav-tabs">
                            <li><a href="{{ url('login') }}" class="nav-link " data-toggle="tab">sign in</a></li>
                            <li><a href="javascript:void(0)" class="nav-link active">sign up</a></li>
                        </ul>
                    </div>
                    <div class="" style="padding: 0px 50px;">
                        <h3 class="text-anime-style-3 text-center">Register</h3>
                        <p class="text-anime-style-3 text-center">Register to post an Event</p>
                        <div class="space8"></div>
                        <form method="POST" action="{{ url('artistsignup') }}">
                            @csrf
                            <div class="row">
                                <!-- Prefix -->
                                <div class="col-lg-12 col-md-12">
                                    <div class="input-area">
                                        <select id="prefix" name="prefix">
                                            <option value="">Select Prefix</option>
                                            <option value="Mr.">Mr.</option>
                                            <option value="Mrs.">Mrs.</option>
                                            <option value="Ms.">Ms.</option>
                                        </select>
                                        @error('prefix') <p style="color: red;">{{ $message }}</p> @enderror
                                    </div>
                                </div>

                                <!-- First Name -->
                                <div class="col-lg-6 col-md-6">
                                    <div class="input-area">
                                        <input type="text" id="fname" name="fname" placeholder="Enter Your First Name" value="{{ old('fname') }}" />
                                        @error('fname') <p style="color: red;">{{ $message }}</p> @enderror
                                    </div>
                                </div>

                                <!-- Last Name -->
                                <div class="col-lg-6 col-md-6">
                                    <div class="input-area">
                                        <input type="text" id="lname" name="lname" placeholder="Enter Your Last Name" value="{{ old('lname') }}" />
                                        @error('lname') <p style="color: red;">{{ $message }}</p> @enderror
                                    </div>
                                </div>

                                <!-- Email -->
                                <div class="col-lg-12 col-md-6">
                                    <div class="input-area">
                                        <input type="email" id="email" name="email" placeholder="Enter Your Email Address" value="{{ old('email') }}" />
                                        @error('email') <p style="color: red;">{{ $message }}</p> @enderror
                                    </div>
                                </div>

                                <!-- Password -->
                                <div class="col-lg-6 col-md-6">
                                    <div class="input-area">
                                        <input type="password" id="password" name="password" placeholder="Enter Your Password" />
                                        @error('password') <p style="color: red;">{{ $message }}</p> @enderror
                                    </div>
                                </div>

                                <!-- Confirm Password -->
                                <div class="col-lg-6 col-md-6">
                                    <div class="input-area">
                                        <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Confirm Your Password" />
                                    </div>
                                </div>
                            </div>
                            <div class="row align-item-baseline">
                                <div class="col-lg-12">
                                    <div class="space24"></div>
                                    <div class="input-area text-end">
                                        <button type="submit" style="width: 100%;" class="vl-btn1">Register Now</button>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 mt-4">
                                    <div class="user-form-direction">
                                        <p>Already have an account? click on the <a href="{{ url('login') }}"><span>( sign In )</span></a> button.</p>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--===== CONTACT AREA ENDS =======-->

<style type="text/css">
    
.form-field {
    position: relative;
}
.form-field label{
    font-size: 10px;
    font-weight: 400;
    color: #b5b5c3;
    position: absolute;
    left: 9px;
    top: -12px;
    background-color: white;
    padding: 0 5px;
    z-index: 1;
    opacity: 1;
}
.invalid-feedback{
    display: block !important;
}
.contact-inner-section .img1 img{
    border-radius: 0px !important;
}
.contact-inner-section .contact4-boxarea{
    height: 685px;
    padding: 0 !important;
}
.user-form-banner::before {
    position: absolute;
    content: "";
    top: 0px;
    left: 0px;
    width: 100%;
    height: 100%;
    background: linear-gradient(to right, rgb(0 0 0 / 46%), rgb(0 109 153 / 65%));
    z-index: -1;
}
.user-form-content {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    text-align: center;
    width: 600px;
}
.user-form-content a {
    margin-bottom: 35px;
}
.user-form-content a img {
    width: 250px;
    height: auto;
}
.user-form-content h1 {
    color: white;
    font-size: 30px;
    line-height: 37px;
    margin-bottom: 8px;
}
.user-form-content h1 span {
    display: block;
}
.user-form-content p {
    color: white;
    font-size: 17px;
    line-height: 29px;
}
.user-form-category-btn {
    margin-bottom: 50px;
}
.nav {
    flex-wrap: nowrap;
    align-items: center;
    justify-content: center;
}
.nav-tabs li .active {
    color: #ffffff !important;
    background: #56b792 !important;
    border-color: #000000 !important;
    font-weight: 600;
    border-radius: 0px;
}
.nav-tabs li {
    width: 100%;
}
.nav-tabs li .nav-link {
    width: 100%;
    border: none;
    padding: 16px 0px;
    text-align: center;
    font-size: 11px;
    font-weight: 500;
    color: var(--heading);
    letter-spacing: 0.5px;
    text-transform: uppercase;
    border-radius: var(--tab-radius);
    border-bottom: 3px solid transparent;
    text-shadow: 2px 3px 8px rgba(0, 0, 0, 0.1);
}
.user-form-header {
    position: fixed;
    top: 50px;
    left: 50px;
    z-index: 1;
}
.user-form-header a i {
    width: 50px;
    height: 50px;
    line-height: 50px;
    text-align: center;
    border-radius: 50%;
    font-size: 16px;
    color: #56b792;
    background: white;
    text-shadow: 2px 3px 8px rgba(0, 0, 0, 0.1);
    box-shadow: 0px 15px 35px 0px rgba(0, 0, 0, 0.1);
}
.user-form-direction {
    text-align: center;
    margin: 30px 0px 50px;
}
.user-form-direction p {
    color: #666666;
    font-size: 18px;
    width: 290px;
    margin: 0 auto;
}
</style>
@endsection