@extends('frontend.layouts.simple')

@section('tittle')
    <title>Reset Password | JioWireless</title>
@endsection

@section('content')
<main style="background-color: #fafafa;height: 100vh;">
    <div class="login_werper">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-6 col-lg-6">
                    <div class="mb-2">
                        <h3 class="tp-login-title">Reset Your Password</h3>    
                    </div>
                    <div class="tp-login-wrapper">
                        <div class="tp-login-option mb-10">
                            <form method="POST" action="{{ route('password.update') }}" class="form">
                                @csrf
                                <input type="hidden" name="token" value="{{ $token }}">
                                <input id="email" type="hidden" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
                                
                                <!-- New Password Field -->
                                <div class="tp-login-input-wrapper">
                                    <div class="form-field">
                                        <label for="password" class="">New Password</label>
                                        <div class="form-field__control">
                                            <div class="icon">
                                                <i class="fa-regular fa-lock"></i>
                                            </div>
                                            <input id="password" name="password" type="password" class="form-field__input" required placeholder="Enter your new password" autocomplete="new-password" />
                                            <div class="form-field__bar"></div>
                                        </div>
                                    </div>
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <!-- Confirm Password Field -->
                                <div class="form-field">
                                    <label for="password_confirmation" class="">Confirm New Password</label>
                                    <div class="form-field__control">
                                        <div class="icon">
                                            <i class="fa-regular fa-lock"></i>
                                        </div>
                                        <input id="password_confirmation" name="password_confirmation" type="password" class="form-field__input" required placeholder="Confirm your new password" />
                                        <div class="form-field__bar"></div>
                                        <div class="pass_word_fg">
                                            <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Reset Password Button -->
                                <div class="tp-login-bottom">
                                    <button type="submit" class="tp-login-btn w-100">Update Password</button>
                                </div>
                            </form>
                        </div>
                        
                        <!-- Links -->
                        <div class="links-container">
                            <a href="{{ url('login') }}" style="font-weight: 500; font-size: 15px; color: black; text-decoration: underline;">Remembered Your Password? Log in</a>
                        </div>
                    </div>

                    <!-- Footer Links -->
                    <footer class="mt-3">
                        <div class="links-container">
                            <a style="font-weight: 500; font-size: 15px; color: black; padding: 0 0 0 2rem; text-decoration: underline;" href="#" class="forgot-password">Privacy Policy</a>
                            <a style="font-weight: 500; font-size: 15px; color: black; padding: 0 2rem 0 0; text-decoration: underline;" href="{{ url('terms') }}" class="register-new">Terms and Conditions</a>
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
