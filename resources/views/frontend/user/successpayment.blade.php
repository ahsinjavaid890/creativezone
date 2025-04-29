@extends('frontend.layouts.main')
@section('tittle')
<title>Buy {{ $plan->name }} Plan | Creative Zone</title>
<link rel="canonical" href="{{Request::url()}}">
@endsection
@section('content')
<style type="text/css">
    
.success-box {
    background-color: white;
    padding: 40px 60px;
    border-radius: 10px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    text-align: center;
    max-width: 400px;
    width: 100%;
}

.icon-container {
    background-color: #4CAF50;
    padding: 20px;
    border-radius: 50%;
    display: inline-block;
    margin-bottom: 20px;
}

.success-icon {
    width: 50px;
    height: 50px;
}

h1 {
    color: #333;
    margin-bottom: 15px;
    font-size: 28px;
}

.description {
    font-size: 16px;
    color: #555;
    margin-bottom: 20px;
}

.details {
    font-size: 14px;
    color: #888;
    margin-bottom: 30px;
}

</style>
<div class="pricing-lan-section-area sp1">
    <div class="container">
        <div class="success-box">
            <div class="icon-container">
                <img src="{{ url('newfront/assets/img/logo/logo1.jpg') }}" alt="Success Icon" class="success-icon">
            </div>
            <h1>Payment Successful!</h1>
            <p class="description">Your payment has been processed successfully. Thank you for your purchase!</p>
            <p class="details">You will receive a confirmation email shortly. Please check your inbox.</p>
            <a href="{{ url('') }}" class="vl-btn1">Return to Home</a>
        </div>
    </div>
</div>
@endsection