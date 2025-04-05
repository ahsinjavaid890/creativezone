@extends('frontend.layouts.main')
@section('tittle')
<title>Log in | Artist</title>
@endsection
@section('content')
<!--===== CONTACT AREA STARTS =======-->
<div class="contact-inner-section sp1 mt-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 m-auto">
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
                <div class="contact4-boxarea">
                    <h3 class="text-anime-style-3 text-center">Login</h3>
                    <div class="space8"></div>
                    <form method="POST" action="{{ url('artistlogin') }}">
                        @csrf
                        <div class="row">
                            <div class="col-lg-12 col-md-12">
                                <div class="input-area">
                                    <input type="email" name="email" placeholder="Email" />
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12">
                                <div class="input-area">
                                    <input type="password" name="password" placeholder="Enter You Password" />
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 mt-2">
                                <div class="input-area">
                                    <label><a href="{{ url('register') }}">Don't Have a account?</a> </label>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 mt-2">
                                <div class="input-area text-end">
                                    <label><a href="{{ url('register') }}">Forget Password?</a> </label>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="space24"></div>
                                <div class="input-area text-end">
                                    <button type="submit" class="vl-btn1">Login</button>
                                </div>
                            </div>
                        </div>
                    </form>
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
</style>
@endsection