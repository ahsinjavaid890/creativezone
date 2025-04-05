<style type="text/css">
    .custom-form-pay p{
        font-size: 23px;
        font-weight: 600;
    }
</style>
<form id="thirdsteptechsupportform" action="{{ url('techsupportsubmit') }}" method="POST" >
    @csrf
    <h3>Tech Support</h3>
    <p>Please enter your billing address</p>
    <div class="row">
        <div class="col-md-6">
            <div class="custom-form-group">
                <div class="custom-input-container">
                    <input type="text" name="address" placeholder="Address" class="custom-input">
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="custom-form-group">
                <div class="custom-input-container">
                    <input type="text" name="unitnumber" placeholder="Unit Number" class="custom-input">
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="custom-form-pay">
                <div class="custom-input-container justify-content-between">
                    <p>Initial charges</p>
                    <p>10$</p>
                </div>
                <hr class="m-0">
                <div class="custom-input-container">
                    <p style="font-size: 12px;">After this, a rate of $6 per hour will applicable</p>
                </div>
            </div>
        </div>
    </div>
    <div class="custom-form-group justify-content-between">
        <button id="thirdsteptechsupportbutton" type="submit" class="btn btn-primary form-control" style="width: 126px;">Next <i class="fa fa-angle-right"></i> </button>
    </div>
</form>
<script>
    $('#thirdsteptechsupportform').on('submit',(function(e) {
        $('#thirdsteptechsupportbutton').html('<i class="fa fa-spin fa-spinner"></i>');
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
                $('#thirdsteptechsupportbutton').html('Next');
                $('.phoneplanherosection').html(data);
            }
        });
    }));
</script>