@extends('frontend.layouts.main')
@section('tittle')
<title>Artist Register | Artist</title>
@endsection
@section('content')
<!--===== CONTACT AREA STARTS =======-->
<div class="contact-inner-section sp1 mt-5">
    <div class="container">
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
            <div class="col-lg-6 m-auto">
                <div class="contact4-boxarea">
                    <h3 class="text-anime-style-3 text-center">Complete Artist Profile</h3>
                    <div class="space8"></div>
                    <form method="POST" action="{{ url('completesignup') }}" >
                        @csrf
                        <input type="hidden" name="id" value="{{ Auth::guard('artist')->user()->id }}">
                        <div class="row">
                        <!-- Prefix -->
                            <div class="col-lg-12 col-md-12">
                                <div class="input-area">
                                    <select name="prefix">
                                        <option>Select Prefix</option>
                                        <option @if(Auth::guard('artist')->user()->prefix == 'Mr.') selected @endif value="Mr.">Mr.</option>
                                        <option @if(Auth::guard('artist')->user()->prefix == 'Mrs.') selected @endif value="Mrs.">Mrs.</option>
                                        <option @if(Auth::guard('artist')->user()->prefix == 'Ms.') selected @endif value="Ms.">Ms.</option>
                                    </select>
                                </div>
                            </div>
                            <!-- Title -->
                            <div class="col-lg-12 col-md-12">
                                <div class="input-area">
                                    <input type="text" name="tittle" placeholder="Enter Your Title (e.g., Painter, Sculptor)" />
                                </div>
                            </div>
                            <!-- First Name -->
                            <div class="col-lg-6 col-md-6">
                                <div class="input-area">
                                    <input type="text" name="fname" placeholder="Enter Your First Name" value="{{ Auth::guard('artist')->user()->fname }}" />
                                </div>
                            </div>
                            <!-- Last Name -->
                            <div class="col-lg-6 col-md-6">
                                <div class="input-area">
                                    <input type="text" name="lname" placeholder="Enter Your Last Name" value="{{ Auth::guard('artist')->user()->lname }}" >
                                </div>
                            </div>
                            <!-- Contact -->
                            <div class="col-lg-6 col-md-6">
                                <div class="input-area">
                                    <input type="number" name="mobile" placeholder="Enter Your Mobile Number" />
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="input-area">
                                    <input type="email" name="email" placeholder="Enter Your Email Address" value="{{ Auth::guard('artist')->user()->email }}" />
                                </div>
                            </div>
                            <!-- Nationality -->
                            <div class="col-lg-12 col-md-12">
                                <div class="input-area">
                                    <input type="text" name="nationality" placeholder="Enter Your Nationality" />
                                </div>
                            </div>
                            <!-- Birthdate -->
                            <div class="col-lg-12 col-md-12">
                                <div class="input-area">
                                    <input type="date" name="dob" placeholder="Enter Your Birthdate" />
                                </div>
                            </div>
                            <!-- Location -->
                            <div class="col-lg-12 col-md-12">
                                <div class="input-area">
                                    <input type="text" name="location" placeholder="Enter Your Location" />
                                </div>
                            </div>
                            <!-- Category -->
                            <div class="col-lg-12 col-md-12">
                                <div class="input-area">
                                    <select name="category_id">
                                        <option>Select Category</option>
                                        @foreach(DB::table('categories')->where('status' , 'Published')->get() as $r)
                                        <option value="{{ $r->id }}">{{ $r->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <!-- Portfolio -->
                            <div class="col-lg-12 col-md-12">
                                <div class="input-area">
                                    <input type="url" name="portfolio" placeholder="Enter Your Portfolio Link" />
                                </div>
                            </div>
                            <!-- Emirates ID -->
                            <div class="col-lg-12 col-md-12">
                                <div class="input-area">
                                    <input type="text" name="emirates_id" placeholder="Enter Your Emirates ID Number" />
                                </div>
                            </div>
                            <!-- Sample Works -->
                            <div class="col-lg-12 col-md-12 mt-4">
                                <div class="input-area">
                                    <label>Upload 5-7 Sample Works</label>
                                    <input type="file" name="image[]" multiple accept="image/*" />
                                </div>
                            </div>
                            <!-- Preferred Communication -->
                            <div class="col-lg-12 col-md-12">
                                <div class="input-area">
                                    <select name="prefered_way_communication">
                                        <option>Preferred Communication</option>
                                        <option>Email</option>
                                        <option>Phone</option>
                                        <option>WhatsApp</option>
                                    </select>
                                </div>
                            </div>
                            <!-- Terms and Conditions -->
                            <div class="col-lg-12">
                                <div class="d-flex">
                                    <input name="term_and_condition_acceptance" type="checkbox" />
                                    <label>I accept the terms and conditions and agree to receive requests.</label>
                                </div>
                            </div>
                            <!-- Registration Payment -->
                            <div class="col-lg-12">
                                <div class="input-area">
                                    <input type="number" name="registration_payment" placeholder="Enter Registration Payment Amount" />
                                </div>
                            </div>
                            <!-- Submit Button -->
                            <div class="col-lg-12">
                                <div class="space24"></div>
                                <div class="input-area text-end">
                                    <button type="submit" class="vl-btn1">Complete Profile</button>
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