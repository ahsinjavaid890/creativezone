@php
    $check = DB::table('commissions')->where('id' , $id)->first();
@endphp
@if($check)
<div class="modal-content">
    <div class="modal-header">
        <div class="row">
            <div class="col-md-12">
                <h5 class="modal-title" id="exampleModalLabel">Edit Commission</h5>
            </div>
        </div>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <i aria-hidden="true" class="ki ki-close"></i>
        </button>
    </div>
    <form enctype="multipart/form-data" method="POST" action="{{ url('admin/website/settings/updatecomssion') }}">
        @csrf
        <input type="hidden" name="id" value="{{ $check->id }}">
        <div class="modal-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Country</label>
                        <select disabled name="country"  class="form-control">
                            <option>Select Country</option>
                            @foreach(DB::table('countries')->get() as $r)
                            <option @if($r->code == $check->country) selected @endif value="{{ $r->name }}">{{ $r->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Parent Service</label>
                        <select disabled name="parentservice" class="form-control">
                            <option>Select Parent Service</option>
                            @foreach(DB::table('services')->wherenull('parent_id')->get() as $r)
                            <option @if($r->id == $check->parentservice) selected @endif value="{{ $r->id }}">{{ $r->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Service</label>
                        <select disabled multiple name="service" id="childservice" class="form-control">
                            <option>Service</option>
                            @foreach(DB::table('services')->where('parent_id' , DB::table('services')->where('name' , 'Telecom')->first()->id)->get() as $r)
                            <option 
                            @foreach(explode(',' , $check->service) as $c) 
                            @if($c == $r->id) selected @endif
                            @endforeach 
                            value="{{ $r->id }}">{{ $r->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Providers</label>
                        <select disabled id="selectprovider" class="form-control" name="provider">
                            <option value="">Select Provider</option>
                            @foreach(DB::table('providers')->where('status'  ,  1)->get() as $r)
                            <option @if($check->provider == $r->id) selected @endif value="{{ $r->id }}">{{ $r->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Plans</label>
                        <select disabled id="selectplans" class="form-control" name="planname">
                            <option value="">Select Plans</option>
                            @foreach(DB::table('plans')->where('status'  ,  1)->get() as $r)
                            <option @if($check->plan == $r->id) selected @endif  value="{{ $r->id }}">{{ $r->planname }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    @php
                        $price  = DB::table('plans')->where('id' , $check->plan)->first();
                    @endphp
                    <div class="form-group">
                        <label>Plan Price</label>
                        <input type="text" class="form-control" readonly name="" value="{{ $price->price }}">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Commission Ammount</label>
                        <input type="text" class="form-control" name="amount" value="{{ $check->amount }}">
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary font-weight-bold">Save</button>
        </div>
    </form>
</div>
@else
<div class="modal-content">
    <div class="modal-header">
        <div class="row">
            <div class="col-md-12">
                <h5 class="modal-title" id="exampleModalLabel">Add Commission</h5>
            </div>
        </div>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <i aria-hidden="true" class="ki ki-close"></i>
        </button>
    </div>
    <form id="myForm" enctype="multipart/form-data" method="POST" action="{{ url('admin/website/settings/createcommission') }}">
        @csrf
        <input type="hidden" name="id" id="comssion_id">
        <div class="modal-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Country</label>
                        <select name="country" id="country" class="form-control">
                            <option>Select Country</option>
                            @foreach(DB::table('countries')->get() as $r)
                            <option @if($r->code == 'US') selected @endif value="{{ $r->code }}">{{ $r->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Parent Service</label>
                        <select onchange="selectservice(this.value)" name="parentservice" id="parentservice" class="form-control">
                            <option>Select Parent Service</option>
                            @foreach(DB::table('services')->wherenull('parent_id')->where('status', 1)->where('trashstatus', '!=', 1)->get() as $r)
                            <option @if($r->name == 'Telecom') selected @endif value="{{ $r->id }}">{{ $r->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Service</label>
                        <select multiple name="service" id="childservice" onchange="selectchildservice()" class="form-control">
                            <option value="">Select Service</option>
                            <!-- Populate options here -->
                        </select>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Providers</label>
                        <select id="selectprovider" name="provider" onchange="getplan(this.value)" class="form-control">
                            <option value="">Select Provider</option>
                            <!-- Populate options here -->
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Plans</label>
                        <select id="selectplans" onchange="selectplan(this.value)" class="form-control" name="planname">
                            <option value="">Select Plans</option>
                            <!-- Populate options here -->
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Plan Price</label>
                        <input type="text" class="form-control" readonly id="planprice">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Commission Amount</label>
                        <input type="text" class="form-control" id="amount" name="amount">
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
            <button type="submit" id="saveButton" class="btn btn-primary font-weight-bold">Save</button>
        </div>
    </form>

</div>
@endif
<script type="text/javascript">
function selectservice(id) {
    $.ajax({
        type: 'get',
        url: '{{ url("admin/website/settings/getservice") }}/'+id,
        success: function(res) {
            $('#childservice').html(res);
        }
    });
}

function selectchildservice() {
    var selectedServices = $('#childservice').val(); 
    if ((selectedServices && selectedServices.length > 0)) {
        $.ajax({
            type: 'GET',
            url: '{{ url("admin/website/settings/getprovider") }}',
            data: {
                services: selectedServices
            },
            success: function(res) {
                $('#selectprovider').html(res);
            },
        });
    } else {
        $('#selectprovider').html('<option value="">No Providers Available</option>'); 
    }
}
function getplan(id) {
    $.ajax({
        type: 'get',
        url: '{{ url("admin/website/settings/getplan") }}/'+id,
        success: function(res) {
            $('#selectplans').html(res);
        }
    });
}
function selectplan(id) {
    $.ajax({
        type: 'get',
        url: '{{ url("admin/website/settings/getplanprice") }}/' + id,
        success: function(res) {
                $('#planprice').val(res.price); 
        },
        error: function(xhr) {
            $('#planprice').val('');
            console.log('AJAX error:', xhr.statusText);
        }
    });
}


$(document).ready(function() {
    let selectedService = $('#parentservice').val();
    if (selectedService) {
        selectservice(selectedService);
    }
});
</script>

<script>
    $(document).ready(function () {
        $('#childservice, #selectprovider , #country, #selectplans, #filter_child, #provider, #showthisonprovider, #planstatus').select2({
            placeholder: "Select",
            width: '100%',
            allowClear: true
        });
    });
</script>
<script type="text/javascript">
    function findcommision() {
        var country = $('#country').val();
        var parentservice = $('#parentservice').val();
        var childservice = $('#childservice').val();
        var selectprovider = $('#selectprovider').val();
        var selectplans = $('#selectplans').val();

        $.ajax({
            url: '{{ url("admin/website/settings/filtercommission") }}',
            type: 'GET',
            data: {
                country: country,
                parentservice: parentservice,
                childservice: childservice,
                selectprovider: selectprovider,
                selectplans: selectplans,
            },
            success: function(response) {
                if (response.exists) {
                    $('#amount').val(response.amount);
                    $('#comssion_id').val(response.comission_id);
                    $('#myForm').attr('action', '{{ url("admin/website/settings/updatecomssion") }}');
                    $('#saveButton').text('Update');
                } else {
                    $('#amount').val('');
                    $('#comssion_id').val('');
                    $('#myForm').attr('action', '{{ url("admin/website/settings/createcommission") }}');
                    $('#saveButton').text('Save');
                }
            },
            error: function(xhr) {
                alert('Error loading data.');
            }
        });
    }

    $(document).ready(function() {
        // Add event listeners to call findcommision whenever a relevant field changes
        $('#country, #parentservice, #childservice, #selectprovider, #selectplans').on('change', function() {
            findcommision();
        });
    });
</script>