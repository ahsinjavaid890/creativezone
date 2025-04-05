@extends('frontend.layouts.simple')
@section('tittle')
<title>Log in | JioWireless</title>
@endsection
@section('content')
<main style="background-color: #fafafa;height: 100vh;">
    <div class="login_werper">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-6 col-lg-6">
                    <div class="mb-2">
                        <h3 class="tp-login-title">Log in to your Account</h3>    
                    </div>
                    
                    <div class="tp-login-wrapper">
                        <div class="tp-login-top text-center">
                            @if ($errors->any())
                                @foreach ($errors->all() as $error)
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $error }}</strong>
                                    </span>
                                @endforeach
                            @endif
                        </div>
                        <div class="tp-login-option mb-10">
                            <form action="{{ url('userlogin') }}" method="post">
                                @csrf
                                <input type="hidden" name="redirectback" @if(isset($_GET['redirectback'])) value="{{ $_GET['redirectback'] }}" @endif name="">
                                <div class="tp-login-input-wrapper">
                                    <div class="form-field">
                                        <label for="email" class="">Email</label>
                                        <div class="form-field__control">
                                            <div class="icon">
                                                <i class="fa-regular fa-envelope"></i>
                                            </div>
                                            <input id="email" name="email" type="email" class="form-field__input" placeholder="Email" required />
                                            <div class="form-field__bar"></div>
                                        </div>
                                    </div>

                                    <div class="form-field">
                                        <label for="password-field" class="">Password</label>
                                        <div class="form-field__control">
                                            <div class="icon">
                                                <i class="fa-regular fa-lock"></i>
                                            </div>
                                            <input id="password-field" name="password" type="password" class="form-field__input" placeholder="Password" required />
                                            <div class="form-field__bar"></div>
                                            <div class="pass_word_fg">
                                                <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tp-login-bottom">
                                    <button type="submit" class="tp-login-btn w-100">Login</button>
                                </div>
                            </form>
                        </div>
                        <div class="links-container">
                            <a href="{{ url('password/reset') }}" style=" font-weight: 500; font-size: 15px; color: black; text-decoration:underline; ">Forgot Password</a>
                            <a href="{{ url('register') }}" style=" font-weight: 500; font-size: 15px; color: black; text-decoration:underline; ">Register Now</a>
                        </div>
                        <div class="tp-login-mail text-center mb-20">
                            <p>or</p>
                        </div>
                        <div class="tp-login-social mb-10">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="tp-login-option-item has-google">
                                        <a href="#">
                                            <div class="d-flex">
                                                <div class="contgit">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="1.5em" height="1.5em" viewBox="0 0 256 262"><path fill="#4285f4" d="M255.878 133.451c0-10.734-.871-18.567-2.756-26.69H130.55v48.448h71.947c-1.45 12.04-9.283 30.172-26.69 42.356l-.244 1.622l38.755 30.023l2.685.268c24.659-22.774 38.875-56.282 38.875-96.027"/><path fill="#34a853" d="M130.55 261.1c35.248 0 64.839-11.605 86.453-31.622l-41.196-31.913c-11.024 7.688-25.82 13.055-45.257 13.055c-34.523 0-63.824-22.773-74.269-54.25l-1.531.13l-40.298 31.187l-.527 1.465C35.393 231.798 79.49 261.1 130.55 261.1"/><path fill="#fbbc05" d="M56.281 156.37c-2.756-8.123-4.351-16.827-4.351-25.82c0-8.994 1.595-17.697 4.206-25.82l-.073-1.73L15.26 71.312l-1.335.635C5.077 89.644 0 109.517 0 130.55s5.077 40.905 13.925 58.602z"/><path fill="#eb4335" d="M130.55 50.479c24.514 0 41.05 10.589 50.479 19.438l36.844-35.974C195.245 12.91 165.798 0 130.55 0C79.49 0 35.393 29.301 13.925 71.947l42.211 32.783c10.59-31.477 39.891-54.251 74.414-54.251"/></svg>
                                                </div>
                                                <div class="contgitxc">
                                                    <span class="cont_yeq">Continue with Google</span>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="tp-login-option-item has-google">
                                        <a href="#">
                                            <div class="d-flex">
                                                <div class="contgit">  
                                                    <img src="{{ url('public/images/facebook.svg') }}">
                                                </div>
                                                <div class="contgitxc">
                                                    <span class="cont_yeq">Continue with Facebook</span>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    <footer class="mt-3">
                        <div class="links-container">
                            <a style=" font-weight: 500; font-size: 15px; color: black; padding: 0 0 0 2rem;text-decoration:underline; " href="" class="forgot-password">Privacy Policy</a>
                            <a style=" font-weight: 500; font-size: 15px; color: black; padding: 0 2rem 0 0;text-decoration:underline; " href="{{ url('register') }}" class="register-new">Terms and Conditions</a>
                        </div>
                    </footer>
                </div>
            </div>
        </div>
    </div>
</main>
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