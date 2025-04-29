@extends('frontend.layouts.main')
@section('tittle')
<title>Buy {{ $plan->name }} Plan | Creative Zone</title>
<link rel="canonical" href="{{Request::url()}}">
@endsection

@section('content')
<style type="text/css">
    .memory1-section-area .memory-slider-areas {
        position: relative;
        z-index: 1;
    }
    .plan_description ul li {
      position: relative;
      padding-left: 2rem !important; /* space for the icon */
      margin-bottom: 10px;
    }

    .plan_description ul li::before {
      content: "✓"; /* tick mark */
      position: absolute;
      left: 0;
      top: 50%;
      transform: translateY(-50%);
      width: 1.5rem;
      height: 1.5rem;
      background-color: #5cc99f;
      color: white;
      font-weight: bold;
      text-align: center;
      line-height: 1.5rem;
      border-radius: 50%;
      font-size: 1rem;
    }

    .plan_description p {
      position: relative;
      padding-left: 2rem !important; /* space for the icon */
      margin-bottom: 10px;
    }

    .plan_description p::before {
      content: "✓"; /* tick mark */
      position: absolute;
      left: 0;
      top: 50%;
      transform: translateY(-50%);
      width: 1.5rem;
      height: 1.5rem;
      background-color: #5cc99f;
      color: white;
      font-weight: bold;
      text-align: center;
      line-height: 1.5rem;
      border-radius: 50%;
      font-size: 1rem;
    }
    .input-area  {
        margin-top: 5px !important;
    }
    .input-area input {
        margin-top: 0 !important;
    }


    .row {
        margin-bottom: 15px;
    }
</style>

<!--===== HERO AREA STARTS =======-->
<div class="container" style="margin-top: 140px;">
   <div class="breadcrumb-area" style=" background-color: #5cc99f; padding: 10px; border-radius: 8px; color: white; ">
      <div class="breadcrumb mb-0">
         <ul class="d-flex align-items-center">
            <li><a href="{{ url('') }}" class="text-white mx-1">Home</a></li>
            <li class="active"><i class="fa-solid fa-angle-right"></i> Buy {{ $plan->name }} Plan</li>
         </ul>
      </div>
   </div>
</div>

<div class="pricing-lan-section-area sp1">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="card" style=" background: #fbfbfb; border: 0; border-radius: 10px; ">
                    <div class="card-body">
                        <div class="plan_heading d-flex justify-content-between">
                            <h2>{{ $plan->name }}</h2>
                            <span style=" font-size: 31px; font-weight: 600;color:#5cc99f ">@if(strtoupper($stripePlan->currency ?? '') == 'USD')$@endif{{ number_format(($stripePlan->amount ?? 0) / 100) }} / <sub>{{ $stripePlan->interval }}</sub> </span>
                        </div>
                        <div class="plan_description mt-3">
                            <ul class="plan_features">
                               @php
                                    $featureIds = explode(',', $plan->features); // e.g., "1 3 5"
                                    $features = DB::table('plan_features')
                                        ->whereIn('id', $featureIds)
                                        ->pluck('name', 'id'); // returns: [1 => "Feature A", 3 => "Feature B", ...]
                                @endphp
                                @foreach($featureIds as $id)
                                    <li>{{ $features[$id] ?? 'Unknown Feature' }}</li>
                                @endforeach
                            </ul>
                            {!! $plan->description !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="contact-inner-section">
                    <div class="contact4-boxarea">
                        <p>Selected Plan ID: {{ $plan->id }}</p>  <!-- Displaying the plan_id -->
                        <form id="payment-form">
                            <div class="input-area">
                                <label for="card-name">Cardholder Name</label>
                                <input type="text" id="card-name" class="form-control" placeholder="Cardholder Name" required>
                            </div>
                            
                            <div class="input-area">
                                <label for="card-number">Card Number</label>
                                <div class="input-group">
                                    <input type="text" id="card-number" class="form-control" placeholder="Card Number" maxlength="19" required style="border-radius: 8px;">
                                    <span id="card-icon" class="input-group-text" style=" position: absolute; right: 9px; top: 32px; padding: 0; "></span> <!-- Card icon placeholder -->
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4 input-area">
                                    <label for="expiry-month">Expiration Month</label>
                                    <input type="text" id="expiry-month" class="form-control" placeholder="MM" maxlength="2" required>
                                </div>
                                <div class="col-md-3 input-area">
                                    <label for="expiry-year">Expiration Year</label>
                                    <input type="text" id="expiry-year" class="form-control" placeholder="YYYY" maxlength="4" required>
                                </div>
                                <div class="col-md-3 input-area">
                                    <label for="cvc">CVC</label>
                                    <input type="text" id="cvc" class="form-control" placeholder="CVC" maxlength="3" required>
                                </div>
                            </div>

                            <button id="submit" class="vl-btn1">Pay</button>
                        </form>

                    </div> 
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="https://js.stripe.com/v3/"></script>

<script>
    // Set up Stripe.js
    var stripe = Stripe("{{ env('STRIPE_KEY') }}");  // Use your publishable key from .env

    // Handle form submission
    var form = document.getElementById('payment-form');
    form.addEventListener('submit', function(event) {
        event.preventDefault();

        // Collect the input values
        var cardName = document.getElementById('card-name').value;
        var cardNumber = document.getElementById('card-number').value;
        var expiryMonth = document.getElementById('expiry-month').value;
        var expiryYear = document.getElementById('expiry-year').value;
        var cvc = document.getElementById('cvc').value;

        // Create a payment method with the collected card details
        stripe.createPaymentMethod('card', {
            card: {
                number: cardNumber,
                exp_month: expiryMonth,
                exp_year: expiryYear,
                cvc: cvc
            },
            billing_details: {
                name: cardName
            }
        }).then(function(result) {
            if (result.error) {
                // Display error message to the user
                var errorElement = document.getElementById('card-errors');
                errorElement.textContent = result.error.message;
            } else {
                // Send the payment method ID to the server
                stripe.confirmCardPayment("{{ $clientSecret }}", {
                    payment_method: result.paymentMethod.id
                }).then(function(paymentResult) {
                    if (paymentResult.error) {
                        // Handle error here
                        var errorElement = document.getElementById('card-errors');
                        errorElement.textContent = paymentResult.error.message;
                    } else {
                        // The payment was successful, handle the success
                        window.location.href = "{{ url('user/successpayment') }}"; // Redirect to success page
                    }
                });
            }
        });
    });

    document.addEventListener("DOMContentLoaded", function () {
        const cardNumberInput = document.getElementById("card-number");
        const cardIcon = document.getElementById("card-icon");
        const expiryMonthInput = document.getElementById("expiry-month");
        const expiryYearInput = document.getElementById("expiry-year");
        const cvcInput = document.getElementById("cvc");

        // Card type detection regexes
        const visaRegex = /^4/;
        const masterCardRegex = /^5[1-5]/;
        const amexRegex = /^3[47]/;

        const validCardNumberRegex = /^[0-9]{16}$/;  // Validate only 12 numeric digits (without spaces)

        // Handle card number input formatting and icon change
        cardNumberInput.addEventListener("input", function () {
            // Allow only numbers
            let value = cardNumberInput.value.replace(/\D/g, '');

            // Format the card number with spaces (4 digits per group)
            if (value.length > 16) {
                value = value.slice(0, 16);  // Limit to 12 digits
            }

            cardNumberInput.value = value.replace(/(\d{4})(?=\d)/g, '$1 '); // Add spaces after every 4 digits

            const cardNumber = value;

            if (validCardNumberRegex.test(cardNumber)) {
                if (visaRegex.test(cardNumber)) {
                    cardIcon.innerHTML = '<img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQRjQnYjrgFKBmkvABU7oP1eO4C2sXkFP8TkA&s" alt="Visa" width="30" />';
                } else if (masterCardRegex.test(cardNumber)) {
                    cardIcon.innerHTML = '<img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQf05uJ1hgVMgZ8Cyj5hy8eRXje4mBS7ZR25w&s" alt="MasterCard" width="30" />';
                } else if (amexRegex.test(cardNumber)) {
                    cardIcon.innerHTML = '<img src="https://1000logos.net/wp-content/uploads/2016/10/American-Express-Color.png" alt="American Express" width="30" />';
                } else {
                    cardIcon.innerHTML = '';  // Remove icon if not recognized
                }
            } else {
                cardIcon.innerHTML = '';  // Remove icon if card number is invalid
            }
        });

        // Automatically move to the Expiry Year field after entering 2 digits in Expiry Month
        expiryMonthInput.addEventListener("input", function () {
            if (expiryMonthInput.value.length === 2) {
                expiryYearInput.focus();
            }
        });

        // Automatically move to the CVC field after entering 4 digits in Expiry Year
        expiryYearInput.addEventListener("input", function () {
            if (expiryYearInput.value.length === 4) {
                cvcInput.focus();
            }
        });

        // Validate Expiry Year against current year
        expiryYearInput.addEventListener("blur", function () {
            const currentYear = new Date().getFullYear();
            const enteredYear = parseInt(expiryYearInput.value, 10);

            if (enteredYear < currentYear) {
                alert('The expiration year cannot be in the past.');
                expiryYearInput.value = ''; // Clear the invalid input
            }
        });

        // Handle form submission (validate card number length and expiry date)
        const form = document.getElementById('payment-form');
        form.addEventListener('submit', function (event) {
            event.preventDefault();

            // Validate card number length (only 12 digits)
            if (cardNumberInput.value.replace(/\D/g, '').length !== 12) {
                alert('Please enter a valid 12-digit card number.');
                return;
            }

            // Validate expiration month
            if (expiryMonthInput.value.length !== 2 || parseInt(expiryMonthInput.value) > 12 || parseInt(expiryMonthInput.value) < 1) {
                alert('Please enter a valid expiration month.');
                return;
            }

            // Validate expiration year
            const expiryYear = parseInt(expiryYearInput.value);
            if (expiryYear < new Date().getFullYear()) {
                alert('The expiration year cannot be in the past.');
                return;
            }

            // Validate CVC length
            if (cvcInput.value.length !== 3) {
                alert('Please enter a valid CVC.');
                return;
            }

            // Submit the form (or handle the payment)
            console.log('Form submitted');
        });
    });


</script>
@endsection
