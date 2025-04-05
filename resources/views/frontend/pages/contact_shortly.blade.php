<style type="text/css">
	.caler_des hr{
		width: 130px;
	}
	.hang_number{
		border: 1px solid;
		border-radius: 15px;
		color: #079F16;
		align-items: center;
	}
	.hang_number i{
		font-size: 20px;
	}
	.hang_number h3{
		font-size: 20px;
		text-align: justify;
		color: #079F16;
	}
	.hang_number h3 span{
		font-size: 15px;
		font-weight: 300;
	}
	.hang_des p{
		text-align: justify;
	}
	.buy_section{
		background-image: none !important;
		margin-top: 0px !important;
		height: 572px !important;
	}
</style>
<div class="container">
	<div class="hang_tight text-center p-4 mt-40">
		<div class="caller_img">
			<img src="{{ url('public/front/img/caller.png') }}" width="100">
		</div>
		<div class="caller_head mt-4">
			<h2><span style="color: #1370F2;">Hang Tight!</span></h2>
			<h5 class="mt-40">A specialist will contact you shortly.</h5>
		</div>
		<div class="caller_btn mt-50">
			<a href="{{ url('contact') }}" class="btn btn-primary">Start Over</a>
		</div>
		<div class="caler_des mt-4 d-flex justify-content-center">
			<p><hr class="mx-3">or you can Call us on <hr class="mx-3"></p>
		</div>
		<div class="caller_number d-flex justify-content-center">
			<div class="hang_number d-flex p-2">
				<i class="fa fa-phone mx-3"></i>
				<a href="tel:425-224-6764"><h3>425-224-6764 <br> <span>for any other query</span> </h3></a>
			</div>
			<div class="hang_des mx-3 p-2">
				<p>We will find the <br> Best Deal for you.</p>
			</div>
		</div>
	</div>
</div>