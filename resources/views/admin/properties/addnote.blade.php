@extends('admin.layouts.main-layout')
@section('title','Add Note')
@section('content')
 <!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <div class="d-flex align-items-center flex-wrap mr-2">
                <h5 class="text-blue font-weight-bold mt-2 mb-2 mr-5">
                    Community Notes
                </h5>
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <a href="{{ url('admin/dashboard') }}" class="text-blue font-weight-bold mt-2 mb-2 mr-5">
                    Dashboard
                </a>
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <a href="{{ url('admin/properties/index') }}" class="text-blue font-weight-bold mt-2 mb-2 mr-5">
                   Communities
                </a>
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <a href="{{ url('admin/properties/propertienotes') }}/{{ $data->id }}" class="text-blue font-weight-bold mt-2 mb-2 mr-5">
                   List of {{ $data->name }} Notes
                </a>
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <a href="javascript:void(0)" class="text-dark font-weight-bold mt-2 mb-2 mr-5">
                   Add Note
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
            <form method="POST" action="{{ url('admin/properties/createnote') }}">
                @csrf
                <input type="hidden" name="submit_type" id="submit_type" >
                <input type="hidden" value="{{ $data->id }}" name="property_id">
                <div class="row">
                    <div class="col-md-7">
                        <div class="card card-custom mt-5">
                            <div class="card-header flex-wrap">
                                <div class="card-title">
                                    <h3>Add Community note</h3>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="me-3 mb-0 mr-2">Visit Type:</label>
                                                    <select class="form-control" name="visit_type" id="visit_type" required>
                                                        <option value="">Select Email Templates</option>
                                                        <option value="email">Email</option>
                                                        <option value="call">Call</option>
                                                        <option value="visit">Visit</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Note</label>
                                                    <textarea class="form-control" rows="5" name="note" required></textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="rating">
                                                    <div class="rating-component">
                                                        <div class="status-msg">
                                                            <label>
                                                                <input class="rating_msg" type="hidden" name="rating_msg" value="" required>
                                                            </label>
                                                        </div>
                                                        <label >Rate Visit</label>
                                                        <div class="stars-box">
                                                            <i class="star fa fa-star" title="1 star" data-message="Poor" data-value="1"></i>
                                                            <i class="star fa fa-star" title="2 stars" data-message="Bad" data-value="2"></i>
                                                            <i class="star fa fa-star" title="3 stars" data-message="Average Quality" data-value="3"></i>
                                                            <i class="star fa fa-star" title="4 stars" data-message="Nice" data-value="4"></i>
                                                            <i class="star fa fa-star" title="5 stars" data-message="Very Good Quality" data-value="5"></i>
                                                        </div>
                                                        <div class="starrate">
                                                            <label>
                                                                <input class="ratevalue" type="hidden" name="rating" value="" required>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="lable-control">Parent Service</label>
                                                    <select id="parent_service" name="parentservice" class="form-control" onchange="getprovider(this.value)">
                                                        <option>Select Servics</option>
                                                        @foreach(DB::table('services')->wherenull('parent_id')->where('status', 1)->where('trashstatus', '!=', 1)->get() as $r)
                                                        <option @if(isset($latestdata)) @if($latestdata->parentservice == $r->id) selected @endif @endif  value="{{ $r->id }}">{{ $r->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="lable-control">Select Provider <span class="text-danger">*</span></label>
                                                    <select id="showprovider" name="provider" class="form-control" onchange="selecttempalte(this.value)" required>
                                                       <option value="all">Select All provider</option>
                                                    </select>
                                                </div> 
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Email Tempaltes</label>
                                                    <select class="form-control" name="emailtemplate" id="emailtemplate" onchange="selecttemplatedata(this.value)" required>
                                                        <option value="">Select Email Templates</option>
                                                        
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Email To</label>
                                                    @php
                                                        $property = DB::table('properties')->where('id' , $data->id)->get();

                                                    @endphp
                                                    @if(!$property || empty($property->office_email))
                                                        <input type="email" name="emailto" value="{{ $note->emailto }}" class="form-control">
                                                    @else
                                                    <select class="form-control" name="emailto" id="emailto" onchange="getnewemail(this.value)" required>
                                                        <option value="">Select Email Templates</option>
                                                        @foreach($property as $r)
                                                        <option value="{{ $r->id }}">{{ $r->office_email }}</option>
                                                        <option value="add">Add new</option>
                                                        @endforeach
                                                    </select>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group" id="newemail">
                                                    
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Reps</label>
                                                    <select class="form-control" name="reps" id="reps">
                                                        <option>Select Rep</option>
                                                        @foreach(DB::table('properties_reps')->where('property_id' , $data->id)->get() as $r)
                                                        <option value="{{ $r->id }}">{{ $r->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                 <div class="form-group">
                                                    <label>Subject</label>
                                                    <input type="text" name="subject" value="" id="emailsubject" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Email Template Description</label>
                                                    <textarea class="summernote" name="emaildescription" required>
                                                        
                                                    </textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Attachments</label>
                                                    <select class="form-control" name="attachments" id="attachments" required>
                                                        <option>Select Attachments</option>
                                                        @foreach(DB::table('attachments')->get() as $r)
                                                        <option value="{{ $r->id }}">{{ $r->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-12 text-right">
                                                <button onclick="submitbutton('addmore')" type="submit" class="btn btn-primary">Save</button>
                                                <button onclick="submitbutton('email')" type="submit" class="btn btn-primary">Save & Email</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="card card-custom mt-5">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-5">
                                        <ul class="list-group scrollable-list">
                                            <li class="list-group-item mt-4">
                                                [apartment_name]
                                            </li>
                                            <li class="list-group-item">
                                                [apartment_address]
                                            </li>
                                            <li class="list-group-item">
                                                [apartment_units]
                                            </li>
                                            <li class="list-group-item">
                                                [leasing_rep_name]
                                            </li>
                                            <li class="list-group-item mt-4">
                                                [community_rep_name]
                                            </li>
                                            <li class="list-group-item">
                                                [partner_rep_name]
                                            </li>
                                            <li class="list-group-item">
                                                [attachment]
                                            </li>
                                        </ul>
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

<style>
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
.rating {
    display: inline-block;
}
.rating .star {
    cursor: pointer;
    font-size: 20px;
    color: #ccc;
}
.rating .star.selected {
    color: #f39c12;
}
.rating .star:hover {
    color: #f39c12;
}

.selected{
    border: none;
}

</style>

@endsection
@section('script')
<script type="text/javascript">
function submitbutton(id) {
    $('#submit_type').val(id);
}
$('#visit_type').select2({
        placeholder: "Select Visit Type",
});
$('#emailtemplate').select2({
        placeholder: "Select Email Template",
});
$('#reps').select2({
        placeholder: "Select Rep",
});
$('#emailto').select2({
        placeholder: "Select Sales Rep",
});
$('#parent_service').select2({
        placeholder: "Select Sales Rep",
});
$('#showprovider').select2({
        placeholder: "Select Provider",
});
$('#attachments').select2({
        placeholder: "Select Attachments",
})
</script>
<script>
$(document).ready(function() {
    $('.star').on('mouseover', function() {
        var value = $(this).data('value');
        $('.star').each(function() {
            $(this).toggleClass('selected', $(this).data('value') <= value);
        });
    });

    $('.star').on('mouseleave', function() {
        var value = $('.ratevalue').val();
        $('.star').each(function() {
            $(this).toggleClass('selected', $(this).data('value') <= value);
        });
    });

    $('.star').on('click', function() {
        var value = $(this).data('value');
        $('.ratevalue').val(value);
        $('.rating_msg').val($(this).data('message'));
        $('.star').each(function() {
            $(this).toggleClass('selected', $(this).data('value') <= value);
        });
    });
});
</script>
<script>
    function selecttemplatedata(id) {
    if (id === '') {
        $('#emailsubject').val(''); 
        $('.summernote').summernote('code', '');
        return;
    }  
    $.ajax({
        url: '{{ url("admin/properties/gettempdetail") }}/' + id,
        type: 'GET',
        success: function(data) {
            $('#emailsubject').val(data.subject);
            $('.summernote').summernote('code', data.email_detail); 
        },
        error: function() {
            $('#emailsubject').val('Error loading Detail');
            $('.summernote').summernote('code', 'Error loading Detail');
        }
    });
}
</script>
<script type="text/javascript">
function getprovider(id) {  
    if(id){
        $.ajax({
            type: 'get',
            url: '{{ url("admin/properties/getprovider") }}/'+id,
            success: function(res) {
                $('#showprovider').html(res);  
            }
        });
    } else {
    $('#showprovider').html('');
    }
}
function selecttempalte(id) {  
    if(id){
        $.ajax({
            type: 'get',
            url: '{{ url("admin/properties/gettemplate") }}/'+id,
            success: function(res) {
                $('#emailtemplate').html(res);  
            }
        });
   
    } else {
    $('#emailtemplate').html('');
    }
}
function getnewemail(id) {
   if (id === 'add') {
        $.ajax({
            type: 'get',
            url: '{{ url("admin/properties/getemail") }}/'+id,
            success: function(res) {
                 $('#newemail').html('<lable>Add New Email</lable><input type="email" name="new_email" placeholder="Enter new email" class="form-control">');
            }
        });   
    } else {
    $('#newemail').html('');
    }
}
</script>
@endsection