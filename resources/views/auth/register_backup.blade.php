@extends('frontend.layouts.simple')
@section('tittle')
<title>Register | JioWireless</title>
@endsection
@section('content')
<main style="background-color: #fafafa;height: 100vh;">
    <div class="login_werper">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-6 col-lg-6">
                    <div class="mb-2">
                        <h3 class="tp-login-title">Register</h3>    
                    </div>
                    <div class="tp-login-wrapper">
                        <div class="tp-login-option mb-10">
                            <form action="{{ route('register') }}" method="post">
                                @csrf                                 
                                <div class="tp-login-option">
                                    <div class="tp-login-input-wrapper">
                                        <div class="form-field">
                                            <label class="">Name</label>
                                            <div class="form-field__control">
                                                <div class="icon">
                                                    <i class="fa-regular fa-user"></i>
                                                </div>
                                                <input id="name" type="text" class="form-field__input @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                                <div class="form-field__bar">
                                                </div>
                                            </div>
                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-field">
                                            <label for="email" class="">Email</label>
                                            <div class="form-field__control">
                                                <div class="icon">
                                                    <i class="fa-regular fa-envelope"></i>
                                                </div>
                                                <input id="email" type="email" class="form-field__input @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                                                <div class="form-field__bar">
                                                </div>
                                            </div>
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-field">
                                            <label for="password" class="">Password</label>
                                            <div class="form-field__control">
                                                <div class="icon">
                                                    <i class="fa-regular fa-lock"></i>
                                                </div>
                                                <input id="password" type="password" class="form-field__input @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                                
                                                <div class="form-field__bar">
                                                </div>
                                                <div class="pass_word_fg">
                                                <span class="toggle-visibility" id="togglepassword">
                                                    <i class="fa fa-eye"></i>
                                                </span>
                                                </div>
                                            </div>
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-field">
                                            <label for="password" class="">Confirm Password</label>
                                            <div class="form-field__control">
                                                <div class="icon">
                                                    <i class="fa-regular fa-lock"></i>
                                                </div>
                                                <input id="password-confirm" type="password" class="form-field__input" name="password_confirmation" required autocomplete="new-password">
                                                <div class="form-field__bar">
                                                </div>
                                                <div class="pass_word_fg">
                                                <span class="toggle-visibility" id="toggleconfirm">
                                                    <i class="fa fa-eye"></i>
                                                </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="clickj_heading">
                                        <p>By clicking Sign Up, you agree to our <a href="https://tech.igiapp.com/jiowireless/terms-of-use"  target="_blank">Terms of Use, </a> <a
                                                href="https://tech.igiapp.com/jiowireless/privacy-policies" target="_blank">Privacy Policy</a> and <a href="cookie-policies" target="_blank">Cookie Policy.</a></p>
                                    </div>

                                    <div class="tp-login-bottom">
                                        <button type="submit" class="tp-login-btn w-100">Register</button>
                                    </div>
                                </div>
                                </form>
                        </div>
                    </div>
                    <footer class="mt-1 mb-20">
                        <div class="links-container">
                            <a style=" font-weight: 500; font-size: 15px; color: black;text-decoration:underline;padding: 0 0 0 10px; " href="{{ url('login') }}" class="forgot-password">Already have and Account ? Login</a>
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