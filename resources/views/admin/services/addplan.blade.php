@extends('admin.layouts.main-layout')
@section('title','Add Plans')
@section('content')
 <!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <div class="d-flex align-items-center flex-wrap mr-2">
                <h5 class="text-blue font-weight-bold mt-2 mb-2 mr-5">
                    Add Plan
                </h5>
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <a href="{{ url('admin/dashboard') }}" class="text-blue font-weight-bold mt-2 mb-2 mr-5">
                    Dashboard
                </a>
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <a href="{{ url('admin/services/allplans') }}" class="text-blue font-weight-bold mt-2 mb-2 mr-5">
                    All Plan
                </a>
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <a href="javascript:void(0)" class="text-dark font-weight-bold mt-2 mb-2 mr-5">
                    Add Plan
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
            <form id="planformsubmit" enctype="multipart/form-data" method="POST" action="{{ url('admin/services/createplan') }}">
                @csrf
                <input type="hidden" name="submit_type" id="submit_type" >
                <div class="row">
                    <div class="col-md-8">
                        <div class="card card-custom mt-5">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="lable-control">Plan Name <span class="text-danger">*</span></label>
                                                    <input type="text" name="planname" class="form-control" required placeholder="Enter Plan Name">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="lable-control">Select Provider <span class="text-danger">*</span></label>
                                                    <select id="showprovider" name="provider" class="form-control" onchange="selectprovider(this.value)" required>
                                                       <option>Select provider</option>
                                                    
                                                    </select>
                                                </div> 
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Plan Service <span class="text-danger">*</span></label>
                                                    <select multiple class="form-control" onchange="getattributes()" required name="providerservice[]" id="showchildservices">
                                                        
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div id="attributesContainer" class="row"></div>
                                                <div id="attributesContainer" class="row"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="lable-control">Best Seller Text</label>
                                                    <input type="text" placeholder="Best Seller Text" name="bestsellertext" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="lable-control">Slogan</label>
                                                    <input type="text" placeholder="Slogan" name="slogan" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="lable-control">Special Promotion</label>
                                                    <input type="text" placeholder="Special Promotion " name="specialpromotion" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-12" id="originalPriceContainer">
                                                <div class="form-group">
                                                    <label class="lable-control">Original Price</label>
                                                    <input placeholder="Original Price" name="originalprice" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-12" id="planPriceContainer">
                                                <div class="form-group">
                                                    <label class="lable-control">Plan price</label>
                                                    <input required placeholder="Plan Price" name="price" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="card">
                                                    <div class="pt-5">
                                                        <div class="col-md-12  mb-3">
                                                            <div class="form-group">
                                                                <label class="lable-control">Display Call Btn</label>
                                                                <select id="services" name="isdisplaycallbtn" required="" class="form-control">
                                                                   <option value="1">Yes</option>
                                                                   <option value="2">No</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12  mb-3">
                                                            <div class="form-group">
                                                                <label class="lable-control">Call Button</label>
                                                                <input value="Call to learn more:" id="input-currency" type="text" placeholder="Call Button" name="callbutton" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12  mb-3">
                                                            <div class="form-group">
                                                                <label class="lable-control">Provider Phone</label>
                                                                <input id="providerphone" type="text" placeholder="Provider Phone" name="providerphone" class="form-control">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="card">
                                                    <div class="pt-5">
                                                        <div class="col-md-12  mb-3">
                                                            <div class="form-group">
                                                                <label class="lable-control">Display buy button</label>
                                                                <select id="services" name="isdisplaybuybtn"  class="form-control">
                                                                   <option value="1">Yes</option>
                                                                   <option value="2">No</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12  mb-3">
                                                            <div class="form-group">
                                                                <label class="lable-control">Buy Button Text</label>
                                                                <input value="Select" id="input-currency" type="text" placeholder="Buy Button Text" name="buybuttontext" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12  mb-3">
                                                            <div class="form-group">
                                                                <label class="lable-control">Buy Button Type</label>
                                                                <select id="services" name="buttontype" class="form-control">
                                                                   <option value="Redirect to Affiliate Url">Redirect to Affiliate Url</option>
                                                                   <option value="Inquiry Form">Inquiry Form</option>
                                                                   <option value="Redirect to Website Url">Redirect to Website Url</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mt-3">
                                        <div class="form-group">
                                            <label class="lable-control">Plan Details</label>
                                            <textarea placeholder="Plan Detail" rows="1" class="summernote" name="plandetail" ></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card card-custom mt-5">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Plan Status</label>
                                            <select id="select_status" name="status" class="form-control">
                                                <option value="1">Enabled</option>
                                                <option value="2">Disabled</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="lable-control">Plan Image</label>
                                            <input id="input-currency" type="file" placeholder="Plan Price" name="planimage" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <div class="form-group">
                                            <label class="lable-control">Plan Commission <small class="text-danger">(To Sales Rep)</small></label>
                                            <input type="text" name="plancommission" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group-custom">
                                          <!-- Row 2: Link logo to -->
                                          <div class="col-sm-12 mb-3">
                                            <div class="section-title">Show Plan on home page</div>
                                            <div class="form-check form-check-inline">
                                              <input type="radio" class="form-check-input" name="show_on_home_page" id="show_on_home_page" value="Yes">
                                              <label class="form-check-label" for="show_on_home_page">Yes</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                              <input type="radio" class="form-check-input" name="show_on_home_page" id="show_on_home_page" value="No" checked>
                                              <label class="form-check-label" for="show_on_home_page">No</label>
                                            </div>
                                          </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group-custom">
                                          <!-- Row 2: Link logo to -->
                                          <div class="col-sm-12 mb-3">
                                            <div class="section-title">Show Plan on Provider Page</div>
                                            <div class="form-check form-check-inline">
                                              <input type="radio" class="form-check-input" name="showthisonprovider" id="showthisonprovider" value="Yes">
                                              <label class="form-check-label" for="showthisonprovider">Yes</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                              <input type="radio" class="form-check-input" name="showthisonprovider" id="showthisonprovider" value="No" checked>
                                              <label class="form-check-label" for="showthisonprovider">No</label>
                                            </div>
                                          </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card card-custom mt-5">
                            <div class="card-header flex-wrap">
                                <div class="card-title">Defaults</div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="lable-control">Parent Service</label>
                                            <select id="parent_service" name="parentservice" class="form-control" onchange="getchildservice(this.value)">
                                                <option>Select Servics</option>
                                                @foreach(DB::table('services')->wherenull('parent_id')->where('status', 1)->where('trashstatus', '!=', 1)->get() as $r)
                                                <option @if(isset($latestdata)) @if($latestdata->parentservice == $r->id) selected @endif @endif  value="{{ $r->id }}">{{ $r->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Child Service </label>
                                            <select multiple class="form-control"  name="childservice[]" id="showchildservicestwo" onchange="selectchildservice(this.value)">
                                                <option>Select Service (Child)</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="lable-control">Plan Type</label>
                                            <select multiple id="plantype" name="plantype[]" class="form-control">
                                                <option>Plan Type</option>
                                                <option @if(isset($latestdata)) @if($latestdata->plantype == 'residential') selected @endif @endif  value="residential" selected>Residential</option>
                                                <option @if(isset($latestdata)) @if($latestdata->plantype == 'bussiness') selected @endif @endif  value="bussiness">Bussiness</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="lable-control">Before Plan Price</label>
                                            <input id="input-currency" placeholder="Before Plan Price" name="beforeprice" class="form-control" @if(isset($latestdata)) value="{{ $latestdata->beforeprice }}" @endif>
                                        </div>
                                    </div> 
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="lable-control">After Plan Price</label>
                                            <input id="input-currency" placeholder="Before Plan Price" name="afterprice" class="form-control" @if(isset($latestdata)) value="{{ $latestdata->afterprice }}" @endif>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card card-custom mt-5">
                            <div class="card-header flex-wrap">
                                <div class="card-title">
                                    Publish
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        <button id="exitbutton" onclick="submitbutton('exit')" type="submit" class="btn btn-primary form-control">Save & Exit</button>
                                    </div>
                                    <div class="col-md-6">
                                        <button id="addmorebutton" onclick="submitbutton('addmore')" type="submit" class="btn form-control btn-primary btn-sm">Save & Add More</button>
                                    </div>
                                    <div class="col-md-12 mt-5">
                                        <span id="previewbutton" onclick="showplanpreview()" class="btn btn-warning form-control">Preview</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <link rel="stylesheet" type="text/css" href="{{ url('public/front/css/internetcss.css') }}">
            <div class="card card-custom mt-5">
                <div class="card-header flex-wrap">
                    <div class="card-title">Provider Plans</div>
                </div>
                <div class="card-body">
                    <div class="plan-cards" id="providerplan">
                    </div>
                </div>
            </div>
            <!--end::Card-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->
</div>
<style type="text/css">
    .select2{
        width: 100% !important;
    }
</style>
@endsection
@section('script')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript">
$(document).ready(function() {
    let selectedService = $('#parent_service').val();
    if (selectedService) {
        getchildservice(selectedService);
    }
    let selectedchild = $('#showchildservices').val(); 
    if (selectedchild.length > 0) { 
        selectchildservice();
    }
});
function showplanpreview() {
    $('#submit_type').val('preview');  
    $('#select_status').val(2);  
    $('#planformsubmit').submit(); 
}

$('#planformsubmit').on('submit', function(e) {
    e.preventDefault();  
    var isValid = true;
    var errorMessages = [];
    
    // Required field validation
    $('#planformsubmit [required]').each(function() {
        if ($(this).val() === '') {
            isValid = false;
            var fieldName = $(this).attr('name') || $(this).attr('id');
            errorMessages.push(fieldName + ' is required');
            $(this).addClass('is-invalid'); 
        } else {
            $(this).removeClass('is-invalid'); 
        }
    });

    if (isValid) {
    var formData = new FormData(this);
    $.ajax({
        type: 'POST',
        url: $(this).attr('action'),
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        success: function(data, textStatus, xhr) {
            if (data.status === 'error') {
                // Swal error message when plan name exists
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: data.message, // message from backend
                });
            } else {
                // Continue if no error status
                var submit_type = $('#submit_type').val();

                if(submit_type == 'exit') {
                    Swal.fire({
                        title: "Success",
                        text: "Form submitted successfully.",
                        icon: "success"
                    }).then(() => {
                        window.location.href = '{{ url("admin/services/allplans") }}';
                    });
                }
                if(submit_type == 'addmore') {
                    location.reload();
                }
                if(submit_type == 'preview') {
                    $('#providerplan').html(data);  
                    Swal.fire({
                        title: "Preview",
                        text: "Preview mode activated.",
                        icon: "info"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.scrollTo({
                                bottom: document.body.scrollHeight * 0.1,
                                behavior: 'smooth'
                            });
                        }
                    });
                }
            }
        },
        error: function(xhr) {
            Swal.fire({
                title: "Error",
                text: "An error occurred during submission: " + xhr.statusText,
                icon: "error"
            });
        }
    });
    } else {
        // Display validation error messages
        Swal.fire({
          title: "Please fix the following errors",
          text: errorMessages.join('\n'),
          icon: "error"
        });
    }
});

function submitbutton(id) {
    $('#submit_type').val(id);
}
function getchildservice(id) {  
    if(id){
        $.ajax({
            type: 'get',
            url: '{{ url("admin/services/getplanchildservices") }}/'+id,
            success: function(res) {
                $('#showchildservicestwo').html(res); 
                let selectedchild = $('#showchildservicestwo').val(); 
                if (selectedchild.length > 0) { 
                    selectchildservice();
                } 
            }
        });
    } else {
    $('#showchildservices').html('');
    }
}
function getattributes() {
    var selectedIds = [];
    var selectElement = document.getElementById('showchildservices');
    
    for (var i = 0; i < selectElement.options.length; i++) {
        if (selectElement.options[i].selected) {
            selectedIds.push(selectElement.options[i].value);
        }
    }
    
    if (selectedIds.length === 0) {
        return;
    }
    var plan_id = 'addplan';
    $.ajax({
        type: 'get',
        url: '{{ url("admin/services/getattributes") }}',
        data: {
            service_id: selectedIds, // This now contains all selected IDs
            plan_id: plan_id
        },
        success: function(data) {
            $('#attributesContainer').html(data);
        },
        error: function() {
            alert('Error fetching attributes');
        }
    });
    const selectedOptions = document.getElementById('showchildservices').selectedOptions;
    let isMobileSelected = false;
    for (let option of selectedOptions) {
        if (option.getAttribute('data-service-name') === "Mobile") {
            isMobileSelected = true;
            break;
        }
    }
    const originalPriceContainer = document.getElementById('originalPriceContainer');
    const planPriceContainer = document.getElementById('planPriceContainer');
    if (isMobileSelected) {
        originalPriceContainer.style.display = 'none';
        planPriceContainer.style.display = 'none';
    } else {
        originalPriceContainer.style.display = 'block';
        planPriceContainer.style.display = 'block';
    }
}
function selectchildservice(id) {
    var selectedServices = $('#showchildservicestwo').val(); 
    if (selectedServices.length > 0) {
        $.ajax({
            type: 'GET',
            url: '{{ url("admin/services/getprovider") }}',
            data: { services: selectedServices }, 
            success: function(res) {
                $('#showprovider').html(res);
            },
        });
    } else {
        $('#showprovider').html('<option value="">Select Providers</option>');
    }
}
function selectprovider(id) {
    $('#showchildservices').html('<option>Loading services...</option>');
    $.ajax({
        url: '{{ url("admin/services/getproviderplan") }}/' + id,
        type: 'GET',
        success: function(response) {
            $('#providerplan').html(response.html);
            if (response.provider) {
                $('#providerphone').val(response.provider.phone);
            } else {
                $('#providerphone').val('');
            }
            if (response.services && response.services.length > 0) {
                var serviceOptions = '<option value="">Provider Services Offered</option>';
                response.services.forEach(function(service) {
                    serviceOptions += '<option value="' + service.id + '" data-service-name="'+ service.name +'">' + service.name + '</option>';
                });
                $('#showchildservices').html(serviceOptions);
            } else {
                $('#showchildservices').html('<option>No services available</option>');
            }
        },
        error: function() {
            $('#providerplan').html('<option>Error loading services</option>');
            $('#showchildservices').html('<option>Error loading provider services</option>');
        }
    });
}
$('#showprovider').select2({
    placeholder: "Select",
});
$('#parent_service').select2({
    placeholder: "Select",
});
$('#showchildservices').select2({
    placeholder: "Select",
});
$('#showchildservicestwo').select2({
    placeholder: "Select",
});
$('#childseriveselect').select2({
    placeholder: "Select",
});
$('#plantype').select2({
    placeholder: "Select",
});
@foreach(DB::table('atributes')->get() as $r)
@if($r->type == 'Select')
$('.multipleselecttwo').select2({
    
});
@endif
@endforeach
</script>
@endsection