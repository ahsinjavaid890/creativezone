<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Email Template : {{ $data->name }}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <i aria-hidden="true" class="ki ki-close"></i>
        </button>
    </div>
    <form method="POST" id="emailtemplateform" action="{{ url('admin/email/updateemailtamplate') }}">
        @csrf
        <input type="hidden" name="id" value="{{ $data->id }}">
        <div class="modal-body">
            <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Template for</label>
                    <select required class="form-control" name="template_for">
                        <option value="">Select Template For</option>
                        <option @if($data->template_for == 'Apartments Notes') selected @endif value="Apartments Notes">Apartments Notes</option>
                        <option @if($data->template_for == 'Apartments Visit Notes') selected @endif value="Apartments Visit Notes">Apartments Visit Notes</option>
                        <option @if($data->template_for == 'Completed Order') selected @endif value="Completed Order">Completed Order</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Email To</label>
                    <select required class="form-control" name="email_to">
                        <option value="">Select Email To</option>
                        <option @if($data->email_to == 'Leasing Rep') selected @endif value="Leasing Rep">Leasing Rep</option>
                        <option @if($data->email_to == 'Customer') selected @endif value="Customer">Customer</option>
                        <option @if($data->email_to == 'Community Rep') selected @endif value="Community Rep">Community Rep</option>
                        <option @if($data->email_to == 'Sales Rep') selected @endif value="Sales Rep">Sales Rep</option>
                        <option @if($data->email_to == 'Partner Rep') selected @endif value="Partner Rep">Partner Rep</option>
                        <option @if($data->email_to == 'Company') selected @endif value="Company">Company</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Service</label>
                    <select onchange="selectservice(this.value)" required class="form-control" name="service_id">
                        <option value="">Select Service</option>
                        @foreach(DB::table('services')->wherenull('parent_id')->where('trashstatus' , 0)->get() as $r)
                        <option @if($data->service_id == $r->id) selected @endif value="{{ $r->id }}">{{ $r->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Providers</label>
                    <select id="showprovider" required class="form-control" name="provider_id">
                        <option value="">Select Providers</option>
                        @foreach(DB::table('providers')->where('service' , $data->service_id)->get() as $r)
                        <option  @if($data->provider_id == $r->id) selected @endif value="{{ $r->id }}">{{ $r->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Select Email From</label>
                    <select required class="form-control" name="email_from">
                        <option value="">Select Email From</option>
                        @foreach(DB::table('smtp_lists')->get() as $r)
                        <option @if($data->email_from == $r->id) selected @endif value="{{ $r->id }}">{{ $r->from_name }} ({{ $r->from_email }})</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Send Email CC</label>
                    <input value="{{ $data->email_cc }}" type="text" class="form-control" name="email_cc">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="lable-control">
                        Email Template Name
                    </label>
                    <input type="text" value="{{ $data->name }}" class="form-control" name="name">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Email Template Subject</label>
                    <input type="text" class="form-control" name="subject" value="{{ $data->subject }}">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label>Email Template</label>
                    <textarea rows="4" class="form-control summernote" name="email_detail">{{ $data->email_detail }}</textarea>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label>Select Attachment</label>
                    <select class="form-control" name="attachment">
                        <option value="">Select Attachment</option>
                        @foreach(DB::table('attachments')->get() as $r)
                        <option value="{{ $r->id }}">{{ $r->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
            <button id="emailtemplateformbutton" type="submit" class="btn btn-primary font-weight-bold">Save</button>
        </div>
    </form>
</div>
<script type="text/javascript">
$('.summernote').summernote({
tabsize: 4,
height: 250
});
$('#emailtemplateform').on('submit',(function(e) {
    $('#emailtemplateformbutton').html('<i class="fa fa-spin fa-spinner"></i>');
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
            $('#emailtemplateformbutton').html('Save');
            selectorderstatus();
        }
    });
}));
</script>
