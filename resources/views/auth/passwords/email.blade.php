@extends('frontend.layouts.simple')
@section('tittle')
<title>Forgot Password | JioWireless</title>
@endsection
@section('content')
<main style="background-color: #fafafa; height: 100vh;">
    <div class="login_werper">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-6 col-lg-6">
                    <div class="mb-2">
                        <h3 class="tp-login-title">Forgot Your Password?</h3>    
                    </div>
                    <div class="tp-login-wrapper">
                        <div class="tp-login-top text-center">
                            @if(session()->has('warning'))
                                <div style="text-align: center; color: red;" id="result">{{ session()->get('warning') }}</div>
                            @endif
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif
                        </div>
                        <div class="tp-login-option mb-10">
                            <form method="POST" action="{{ route('password.email') }}" class="form">
                                @csrf
                                <div class="tp-login-input-wrapper">
                                    <div class="form-field">
                                        <label for="email" class="">Email Address</label>
                                        <div class="form-field__control">
                                            <div class="icon">
                                                <i class="fa-regular fa-envelope"></i>
                                            </div>
                                            <input id="email" name="email" value="{{ old('email') }}" required autocomplete="off" autofocus type="email" class="form-field__input" placeholder="Enter your email address" />
                                            <div class="form-field__bar"></div>
                                        </div>
                                    </div>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="tp-login-bottom">
                                    <button type="submit" class="tp-login-btn w-100">Send Reset Password Link</button>
                                </div>
                            </form>
                        </div>
                        <div class="links-container">
                            <a href="{{ url('login') }}" style="font-weight: 500; font-size: 15px; color: black; text-decoration: underline;">Remembered your password? Log in</a>
                        </div>
                    </div>
                    <footer class="mt-3">
                        <div class="links-container">
                            <a style="font-weight: 500; font-size: 15px; color: black; padding: 0 0 0 2rem; text-decoration: underline;" href="#" class="forgot-password">Privacy Policy</a>
                            <a style="font-weight: 500; font-size: 15px; color: black; padding: 0 2rem 0 0; text-decoration: underline;" href="{{ url('register') }}" class="register-new">Terms and Conditions</a>
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
.form-field label {
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
.invalid-feedback {
    display: block !important;
}
</style>
@endsection
