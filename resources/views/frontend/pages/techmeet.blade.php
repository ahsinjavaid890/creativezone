
<style type="text/css">
    .phoneplanherosection{
        background-color: transparent !important;
        box-shadow: none;
        top: 127px;
        left: 43px;
    }
    .custom-form-image{
        border: 1px solid #666A80;
        border-radius: 15px;
    }
    .custom-form-image img{
        padding: 13px;
    }
</style>
<form id="secondsteptechsupportform" action="{{ url('techsupportsubmittwo') }}" method="POST">
    @php
    $data = DB::table('techsupports')->first();
    @endphp
    @csrf
    <input type="hidden" value="{{ $data->id }}" name="id">
    <h3>Tech Support</h3>
    <p>Download any of this software so that our representative can connect you via that Software</p>
    <div class="row">
        <div class="col-md-6">
            <div class="custom-form-image">
                <div class="custom-input-container">
                    <img src="{{ url('public/front/img/teamviewer.png') }}">
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="custom-form-image">
                <div class="custom-input-container">
                    <img src="{{ url('public/front/img/showmypc.png') }}" class=" p-0">
                </div>
            </div>
        </div>
    </div>
    <hr class="mt-4">
    <div class="custom-form-group mt-3">
        <p>Please enter your Username and Password of your Remote Software</p>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="custom-form-group">
                <div class="custom-input-container">
                    <input type="text" name="username"  placeholder="Username"  class="custom-input">
                </div>
            </div> 
        </div>
        <div class="col-md-6">
            <div class="custom-form-group">
                <div class="custom-input-container">
                    <input type="text" name="password"  placeholder="Password"  class="custom-input">
                </div>
            </div> 
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <input type="checkbox" name=""> <span style="font-size: 11px;">Please agree to our terms of use and privacy policy. By checking this box, you are also confirming that your device is free and clear of any activation locks</span>
        </div>
    </div>
    
    <div class="custom-form-group justify-content-between">
        <button id="secondsteptechsupportbutton" type="submit" class="btn btn-primary form-control" style="width: 126px;">Next <i class=" fa fa-angle-right"></i> </button>
    </div>
</form>

<script>
    $('#secondsteptechsupportform').on('submit',(function(e) {
        $('#secondsteptechsupportbutton').html('<i class="fa fa-spin fa-spinner"></i>');
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
                $('#secondsteptechsupportbutton').html('Next');
                $('.phoneplanherosection').html(data);
            }
        });
    }));
</script>