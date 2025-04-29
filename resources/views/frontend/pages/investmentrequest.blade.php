@extends('frontend.layouts.main')
@include('frontend.sections.mettatags')
@section('content')
<div class="container" style="margin-top: 140px;">
   <div class="breadcrumb-area" style=" background-color: #5cc99f; padding: 10px; border-radius: 8px; color: white; ">
      <div class="breadcrumb mb-0">
         <ul class="d-flex align-items-center">
            <li><a href="{{ url('') }}" class="text-white mx-1">Home</a></li>
            <li class="active"><i class="fa-solid fa-angle-right"></i> Investment Request</li>
         </ul>
      </div>
   </div>
</div>
<div class="contact-inner-section sp1">
    <div class="container">
    	<div class="row">
            <div class="col-md-12">
                @include('alerts.index')
            </div>
    		<div class="col-lg-9">
    			<form method="post" action="{{ url('invest-request') }}">
                    @csrf
                    <div class="contact4-boxarea">
                        <h3 class="text-anime-style-3 text-center">Request For Investment</h3>
                        <div class="space8"></div>
                        <div class="row">
                            <div class="col-lg-6 col-md-6">
                                <div class="input-area">
                                    <input type="text" placeholder="Name" name="name" required />
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="input-area">
                                    <input type="text" placeholder="Phone" name="phone" required />
                                </div>
                            </div>

                            <div class="col-lg-12 col-md-6">
                                <div class="input-area">
                                    <input type="email" placeholder="Email" name="email" required />
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="input-area">
                                    <textarea placeholder="Message" name="message" required></textarea>
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
                </form>
    		</div>
    		<div class="col-lg-3">
    			<div class="contact4-boxarea">
                    <h3 class="text-anime-style-3 text-center">Safety Tips</h3>
                    <div class="space8"></div>
                    <ul class="account-card-text">
	                     <li>
	                         <p>Lorem ipsum dolor sit amet consectetur adipisicing elit debitis odio perferendis placeat at aperiam.</p>
	                     </li>
	                     <li>
	                         <p>Lorem ipsum dolor sit amet consectetur adipisicing elit debitis odio perferendis placeat at aperiam.</p>
	                     </li>
	                     <li>
	                         <p>Lorem ipsum dolor sit amet consectetur adipisicing elit debitis odio perferendis placeat at aperiam.</p>
	                     </li>
	                     <li>
	                         <p>Lorem ipsum dolor sit amet consectetur adipisicing elit debitis odio perferendis placeat at aperiam.</p>
	                     </li>
	                     <li>
	                         <p>Lorem ipsum dolor sit amet consectetur adipisicing elit debitis odio perferendis placeat at aperiam.</p>
	                     </li>
	                </ul>
                </div>
    		</div>
    	</div>
    </div>
</div>
<style type="text/css">
	.account-card-text {
    list-style: none;
    padding: 0;
    margin: 0;
}


.account-card-text li {
	display: flex;
}

.account-card-text li p {
    margin: 0;
    font-size: 14px;
    color: #333;
    line-height: 1.6;
}

.account-card-text li::before {
    content: '●';
    margin-right: 8px;
    color: #28a745;
    font-size: 14px;
}

</style>
@endsection