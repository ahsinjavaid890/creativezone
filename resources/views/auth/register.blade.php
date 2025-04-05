@extends('frontend.layouts.main')
@section('tittle')
<title>Artist Register | Artist</title>
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
                    <h3 class="text-anime-style-3 text-center">Artist Register</h3>
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
                            <div class="col-lg-6">
                                <div class="space24"></div>
                                <div class="input-area">
                                    <a href="{{ url('login') }}">Already have an Account?</a>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="space24"></div>
                                <div class="input-area text-end">
                                    <button type="submit" class="vl-btn1">Register Now</button>
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
@section('script')



@endsection