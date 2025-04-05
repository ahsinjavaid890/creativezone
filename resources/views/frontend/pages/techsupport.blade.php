@extends('frontend.layouts.main')
@include('frontend.sections.mettatags')
@section('content')
<style type="text/css">
    .phoneplanherosection{
        padding: 30px;
        height: 550px;
        left: 43px;
    }
    .custom-form-group textarea{
        height: 100% !important;
    } 
</style>
<section class="buy_section" style="background-image: url('{{ url('') }}/public/front/img/tech-support.png'); height: 729px; background-position:center; background-size: cover; background-repeat:no-repeat;margin-top: 1px;">
  <div class="herosectionpositionrelative">
            @include('alerts.index')
     <div class="phoneplanherosection">
        <form id="firststeptechsupportform" action="{{ url('techsupportsubmit') }}" method="POST" >
            @csrf
            <h3>Tech Support</h3>
            <p>If you have any questions, comments, concerns regarding our products, please reach out to us at:</p>
            <div class="row">
                <div class="col-md-6">
                    <div class="custom-form-group">
                        <div class="custom-input-container">
                            <input type="text" name="firstname" placeholder="First Name" class="custom-input">
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="custom-form-group">
                        <div class="custom-input-container">
                            <input type="text" name="lastname" placeholder="Last Name" class="custom-input">
                        </div>
                    </div>
                </div>
            </div>
            <div class="custom-form-group">
                <div class="custom-input-container">
                    <input type="text" name="email" placeholder="Email Address" class="custom-input">
                </div>
            </div>
            <div class="custom-form-group">
                <div class="custom-input-container">
                    <input type="text" name="phone" placeholder="Phone Number" class="custom-input">
                </div>
            </div>
            <div class="custom-form-group">
                <div class="custom-input-container">
                    <textarea rows="4" name="text" placeholder="text" class="custom-input"></textarea>
                </div>
            </div>
            <div class="custom-form-group justify-content-between">
                <button type="submit" class="btn  form-control" style="width: 126px; border: 1px solid #1370F2; color: #1370F2;"><i class="fa fa-angle-left"></i> Back</button>
                <button id="firststeptechsupportbutton" type="submit" class="btn btn-primary form-control" style="width: 126px;">Next <i class="fa fa-angle-right"></i> </button>
            </div>
        </form>
     </div>
  </div>
</section>
@endsection

@section('script')
<script>
    $('#firststeptechsupportform').on('submit',(function(e) {
        $('#firststeptechsupportbutton').html('<i class="fa fa-spin fa-spinner"></i>');
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            type:'POST',
            url: $(this).attr('action'),
            data:formData,
            cache:false,
            contentType: false,
            processData: false,
            success: function(data){
                $('#firststeptechsupportbutton').html('Next');
                $('.phoneplanherosection').html(data);
            }
        });
    }));
</script>
@endsection