@extends('admin.layouts.main-layout')
@section('title','New Email Template')
@section('content')
 <!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <div class="d-flex align-items-center flex-wrap mr-2">
                <h5 class="text-blue font-weight-bold mt-2 mb-2 mr-5">
                    New Email Template
                </h5>
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <a href="{{ url('admin/dashboard') }}" class="text-blue font-weight-bold mt-2 mb-2 mr-5">
                    Dashboard
                </a>
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <a href="{{ url('admin/email/emailtamplates') }}" class="text-blue font-weight-bold mt-2 mb-2 mr-5">
                    All Email Templates
                </a>
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <a href="javascript:void(0)" class="text-dark font-weight-bold mt-2 mb-2 mr-5">
                    New Email Template
                </a>
            </div>
        </div>
    </div>
    <!--end::Subheader-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class=" container-fluid ">
            <!--begin::Card-->
            @include('alerts.index')
            <form method="POST" action="{{ url('admin/email/createemailtamplate') }}">
                @csrf
                 <div class="row">
                    <div class="col-md-7">
                        <div class="card card-custom mt-5">
                            <div class="card-header flex-wrap">
                                <div class="card-title">
                                    <h3 class="card-label">
                                        Template Details
                                        <div class="text-muted pt-2 font-size-sm">Please Fill All Details Carefully. All Fields are Required Except CC Email</div>
                                    </h3>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Template for</label>
                                            <select required class="form-control" name="template_for">
                                                <option value="">Select Template For</option>
                                                <option value="Apartments Notes">Apartments Notes</option>
                                                <option value="Apartments Visit Notes">Apartments Visit Notes</option>
                                                <option value="Completed Order">Completed Order</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Email To</label>
                                            <select required class="form-control" name="email_to">
                                                <option value="">Select Email To</option>
                                                <option value="Leasing Rep">Leasing Rep</option>
                                                <option value="Customer">Customer</option>
                                                <option value="Community Rep">Community Rep</option>
                                                <option value="Sales Rep">Sales Rep</option>
                                                <option value="Partner Rep">Partner Rep</option>
                                                <option value="Company">Company</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Service</label>
                                            <select onchange="selectservice(this.value)" required class="form-control" name="service_id">
                                                <option value="">Select Service</option>
                                                @foreach(DB::table('services')->wherenull('parent_id')->where('trashstatus' , 0)->get() as $r)
                                                <option value="{{ $r->id }}">{{ $r->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Providers</label>
                                            <select id="showprovider" required class="form-control" name="provider_id">
                                                <option value="">Select Providers</option>
                                                
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Select Email From</label>
                                            <select required class="form-control" name="email_from">
                                                <option value="">Select Email From</option>
                                                @foreach(DB::table('smtp_lists')->get() as $r)
                                                <option value="{{ $r->id }}">{{ $r->from_name }} ({{ $r->from_email }})</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Send Email CC</label>
                                            <input type="text" class="form-control" name="email_cc">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="lable-control">
                                                Email Template Name
                                            </label>
                                            <input type="text" class="form-control" name="name">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Email Template Subject</label>
                                            <input type="text" class="form-control" name="subject">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Email Template</label>
                                            <textarea rows="4" class="form-control summernote" name="email_detail"></textarea>
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
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="card card-custom mt-5">
                            <div class="card-header flex-wrap">
                                <div class="card-title">
                                    <h3 class="card-label">
                                        Dynamic Values
                                        <div class="text-muted pt-2 font-size-sm">You Can coppy any Value and use in Email Template</div>
                                    </h3>
                                </div>
                            </div>
                            <div class="card-body" id="container">
                                <ul class="list-group scrollable-list">
                                    <li class="list-group-item">
                                        [order_date]
                                        <i class="fas fa-copy copy-icon" onclick="copyToClipboard('[order_date]')"></i>
                                    </li>
                                    <li class="list-group-item">
                                        [account_no]
                                        <i class="fas fa-copy copy-icon" onclick="copyToClipboard('[account_no]')"></i>
                                    </li>
                                    <li class="list-group-item">
                                        [customer_first_name]
                                        <i class="fas fa-copy copy-icon" onclick="copyToClipboard('[customer_first_name]')"></i>
                                    </li>
                                    <li class="list-group-item">
                                        [customer_last_name]
                                        <i class="fas fa-copy copy-icon" onclick="copyToClipboard('[customer_last_name]')"></i>
                                    </li>
                                    <li class="list-group-item">
                                        [customer_address]
                                        <i class="fas fa-copy copy-icon" onclick="copyToClipboard('[customer_address]')"></i>
                                    </li>
                                    <li class="list-group-item">
                                        [customer_apt]
                                        <i class="fas fa-copy copy-icon" onclick="copyToClipboard('[customer_apt]')"></i>
                                    </li>
                                    <li class="list-group-item">
                                        [customer_city]
                                        <i class="fas fa-copy copy-icon" onclick="copyToClipboard('[customer_city]')"></i>
                                    </li>
                                    <li class="list-group-item">
                                        [customer_email]
                                        <i class="fas fa-copy copy-icon" onclick="copyToClipboard('[customer_email]')"></i>
                                    </li>
                                    <li class="list-group-item">
                                        [customer_phone]
                                        <i class="fas fa-copy copy-icon" onclick="copyToClipboard('[customer_phone]')"></i>
                                    </li>
                                    <li class="list-group-item">
                                        [order_no]
                                        <i class="fas fa-copy copy-icon" onclick="copyToClipboard('[order_no]')"></i>
                                    </li>
                                    <li class="list-group-item">
                                        [order_summary]
                                        <i class="fas fa-copy copy-icon" onclick="copyToClipboard('[order_summary]')"></i>
                                    </li>
                                    <li class="list-group-item">
                                        [apartment_name]
                                        <i class="fas fa-copy copy-icon" onclick="copyToClipboard('[apartment_name]')"></i>
                                    </li>
                                    <li class="list-group-item">
                                        [apartment_address]
                                        <i class="fas fa-copy copy-icon" onclick="copyToClipboard('[apartment_address]')"></i>
                                    </li>
                                    <li class="list-group-item">
                                        [apartment_units]
                                        <i class="fas fa-copy copy-icon" onclick="copyToClipboard('[apartment_units]')"></i>
                                    </li>
                                    <li class="list-group-item">
                                        [leasing_rep_name]
                                        <i class="fas fa-copy copy-icon" onclick="copyToClipboard('[leasing_rep_name]')"></i>
                                    </li>
                                    <li class="list-group-item">
                                        [community_rep_name]
                                        <i class="fas fa-copy copy-icon" onclick="copyToClipboard('[community_rep_name]')"></i>
                                    </li>
                                    <li class="list-group-item">
                                        [partner_rep_name]
                                        <i class="fas fa-copy copy-icon" onclick="copyToClipboard('[partner_rep_name]')"></i>
                                    </li>
                                    <li class="list-group-item">
                                        [sales_rep_name]
                                        <i class="fas fa-copy copy-icon" onclick="copyToClipboard('[sales_rep_name]')"></i>
                                    </li>
                                    <li class="list-group-item">
                                        [plan_name]
                                        <i class="fas fa-copy copy-icon" onclick="copyToClipboard('[plan_name]')"></i>
                                    </li>
                                    <li class="list-group-item">
                                        [internet_speed]
                                        <i class="fas fa-copy copy-icon" onclick="copyToClipboard('[internet_speed]')"></i>
                                    </li>
                                    <li class="list-group-item">
                                        [mobile_service]
                                        <i class="fas fa-copy copy-icon" onclick="copyToClipboard('[mobile_service]')"></i>
                                    </li>
                                    <li class="list-group-item">
                                        [tv_plan]
                                        <i class="fas fa-copy copy-icon" onclick="copyToClipboard('[tv_plan]')"></i>
                                    </li>
                                    <li class="list-group-item">
                                        [phone]
                                        <i class="fas fa-copy copy-icon" onclick="copyToClipboard('[phone]')"></i>
                                    </li>
                                    <li class="list-group-item">
                                        [home_security]
                                        <i class="fas fa-copy copy-icon" onclick="copyToClipboard('[home_security]')"></i>
                                    </li>
                                    <li class="list-group-item">
                                        [attachment]
                                        <i class="fas fa-copy copy-icon" onclick="copyToClipboard('[attachment]')"></i>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="card card-custom mt-5">
                            <div class="card-header flex-wrap"> 
                                <h3 class="card-title align-items-start flex-column">
                                    <span class="card-label font-weight-bolder text-dark">Publish</span>
                                </h3>
                            </div>
                            <div class="card-body" id="container">
                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        <button onclick="submitbutton('exit')" type="submit" class="btn btn-primary form-control">Save & Exit</button>
                                    </div>
                                    <div class="col-md-6">
                                        <button onclick="submitbutton('addmore')" type="submit" class="btn btn-primary form-control">Save & Add More</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <!--end::Card-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->
</div>
<style type="text/css">
.scrollable-list {
    max-height: 423px; /* Adjust the height as needed */
    overflow-y: auto;
}
.list-group-item + .list-group-item {
    border: none;
}
.list-group-item:first-child{
    border: none;
}
.copy-icon {
    float: right;
    cursor: pointer;
    margin-left: 10px;
    color: #007bff; /* Blue color for the icon */
}

.copy-icon:hover {
    color: #0056b3; /* Darker blue on hover */
}
</style>
@endsection
@section('script')
<script>
function copyToClipboard(text) {
    // Create a temporary element to hold the text
    var tempInput = document.createElement("input");
    tempInput.style = "position: absolute; left: -1000px; top: -1000px";
    tempInput.value = text;
    document.body.appendChild(tempInput);
    tempInput.select();
    document.execCommand("copy");
    document.body.removeChild(tempInput);

    // Get the icon element that was clicked
    var iconElement = event.target;
    
    // Change the icon color immediately after copying
    iconElement.style.color = '#28a745'; // Green color for success

    // Revert the icon color back after 5 seconds
    setTimeout(function() {
        iconElement.style.color = '#007bff'; // Original blue color
    }, 5000);
}
function selectservice(id) {
    $('#showprovider').html('<option>Loading...</option>');
    $.ajax({
        type: 'GET',
        url: '{{ url("admin/email/getprovider") }}',
        data: { id: id }, 
        success: function(res) {
            $('#showprovider').html(res);
        },
    });
}
</script>
@endsection