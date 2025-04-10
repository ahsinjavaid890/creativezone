@extends('frontend.layouts.main')
@section('tittle')
<title>Contact Us | Creative Zone</title>
<link rel="canonical" href="{{Request::url()}}">
@endsection
@section('content')
<style type="text/css">
	.hang_tight {
		background-color: #f9f9f9;
		border-radius: 20px;
		box-shadow: 0 0 20px rgba(0, 0, 0, 0.05);
		padding: 40px 20px;
		margin-top: 60px;
	}

	.caler_des {
		align-items: center;
		font-weight: 500;
		color: #333;
	}

	.caler_des hr {
		width: 100px;
		border-top: 1px solid #ccc;
	}

	.hang_number {
		border: 2px solid #079F16;
		border-radius: 20px;
		color: #079F16;
		align-items: center;
		background-color: #e6f9ea;
		transition: all 0.3s ease;
	}

	.hang_number:hover {
		background-color: #d4f5db;
	}

	.hang_number i {
		font-size: 22px;
		margin-top: 5px;
		color: #079F16;
	}

	.hang_number h3 {
		font-size: 20px;
		text-align: left;
		color: #079F16;
		margin: 0;
		line-height: 1.4;
	}

	.hang_number h3 span {
		font-size: 14px;
		font-weight: 400;
		color: #555;
	}

	.hang_des p {
		text-align: left;
		font-size: 15px;
		color: #444;
		margin-top: 10px;
	}

	.buy_section {
		background-image: none !important;
		margin-top: 0px !important;
		height: auto !important;
	}

	.caller_btn .btn {
		padding: 10px 25px;
		font-size: 16px;
		border-radius: 30px;
	}

	@media (max-width: 576px) {
		.caler_des {
			flex-direction: column;
		}

		.caler_des hr {
			width: 60px;
			margin: 5px 0;
		}

		.caller_number {
			flex-direction: column;
			align-items: center;
			text-align: center;
		}

		.hang_number {
			flex-direction: column;
			padding: 15px;
		}

		.hang_number i {
			margin-bottom: 10px;
		}

		.hang_number h3 {
			text-align: center;
		}

		.hang_des {
			margin-top: 15px;
		}
	}
</style>

<div class="container py-5 mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8 text-center bg-light rounded shadow p-5">
            <div class="mb-4">
                <img src="{{ url('public/front/img/caller.png') }}" width="80" alt="Caller Icon">
            </div>
            <h2 class="mb-3" style="color: rgb(92 201 159) !important;">Hang Tight!</h2>
            <h5 class="text-dark">A specialist will contact you shortly.</h5>

            <div class="my-4 d-flex align-items-center justify-content-center text-muted">
                <hr class="flex-grow-1 mx-2" style="width: 100px;">
                <span>or you can Call us on</span>
                <hr class="flex-grow-1 mx-2" style="width: 100px;">
            </div>

            <div class="d-flex justify-content-center align-items-center flex-wrap gap-3">
                <div class="d-flex align-items-center border border-success rounded-pill px-4 py-2 bg-white shadow-sm">
                    <i class="fa fa-phone text-success me-2" style="width:25px;"></i>
                    <a href="tel:425-224-6764" class="text-success fw-bold text-decoration-none">
                        425-224-6764<br>
                        <small class="fw-light">for any other query</small>
                    </a>
                </div>
                <div class="text-muted">
                    <p class="mb-0">We will find the <br><strong>Best Deal</strong> for you.</p>
                </div>
            </div>

            <div class="mt-4">
                <a href="{{ url('contact') }}" class="vl-btn1 event-btn px-4">Start Over</a>
            </div>
        </div>
    </div>
</div>

@endsection