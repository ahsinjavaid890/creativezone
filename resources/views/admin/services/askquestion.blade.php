@extends('admin.layouts.main-layout')
@section('title','Add Serivce Question')
@section('content')
 <!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <div class="d-flex align-items-center flex-wrap mr-2">
                <h5 class="text-blue font-weight-bold mt-2 mb-2 mr-5">
                    Add Serivce Question
                </h5>
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <a href="{{ url('admin/dashboard') }}" class="text-blue font-weight-bold mt-2 mb-2 mr-5">
                    Dashboard
                </a>
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <a href="javascript:void(0)" class="text-dark font-weight-bold mt-2 mb-2 mr-5">
                    Service Management
                </a>
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <a href="{{ url('admin/services/allservices') }}" class="text-blue font-weight-bold mt-2 mb-2 mr-5">
                   All Services
                </a>
                @if(isset($_GET['serviceid']))
                @php
                    $service = DB::table('services')->where('id' , $_GET['serviceid'])->first();
                @endphp
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <a href="{{ url('admin/services/editservice') }}/{{ $service->id }}" class="text-blue font-weight-bold mt-2 mb-2 mr-5">
                    Service: <span class="text-danger">{{ $service->name }}</span>
                </a>
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <a href="{{ url('admin/services/allquestion') }}/{{ $service->id }}" class="text-blue font-weight-bold mt-2 mb-2 mr-5">
                   All Questions
                </a>
                @endif
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <a href="javascript:void(0)" class="text-dark font-weight-bold mt-2 mb-2 mr-5">
                    Add Serivce Question
                </a>
            </div>
        </div>
    </div>
    <!--end::Subheader-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class=" container-fluid ">
            <!--begin::Card-->
            
            <form enctype="multipart/form-data" method="POST" action="{{ url('admin/services/addquestionanswer') }}">
            @csrf
            <input type="hidden" name="submit_type" id="submit_type" >
            <div class="row  d-flex justify-content-center">
                <div class="col-md-6 mx-auto">
                    @include('alerts.index')
                    <div class="card card-custom mt-5">
                        <div class="card-header flex-wrap"> 
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label font-weight-bolder text-dark">Ask Question And Answers</span>
                            </h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Service</label>
                                        <select required class="form-control" name="service_id">
                                            <option value="">Select</option>
                                            @foreach(DB::table('services')->wherenotnull('parent_id')->get() as $r)
                                            <option @if(isset($_GET['serviceid'])) @if($_GET['serviceid'] == $r->id) selected @endif @endif value="{{ $r->id }}">{{ $r->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Ask Question</label>
                                        <input required type="text" class="form-control" name="question">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Select Type</label>
                                        <select required class="form-control" id="question_type" name="question_type">
                                            <option  onchange="questiontype(this.value)" value="">Choose Question Type</option>
                                            <option value="checkbox" selected>Single Choice</option>
                                            <option value="radio">Multiple</option>
                                            <option value="text">Text</option>
                                            <option value="date">Calender</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div id="container">
                                <div class="row row-to-clone">
                                    <div class="col-md-11">
                                        <div class="form-group">
                                            <label class="form-label">Answer 1</label>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" name="answer[]">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-1 pt-2">
                                        <span class="material-icons add-circle" style="cursor: pointer;">add_circle</span>
                                        <span class="material-icons remove-circle" style="cursor: pointer; display: none;">remove_circle</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <input type="submit" onclick="submitbutton('exit')" class="btn btn-primary" placeholder="Service Name" class="form-control" value="Save & Exit">
                            <input type="submit"  onclick="submitbutton('addmore')" class="btn btn-primary" placeholder="Service Name" class="form-control" value="Save & More">
                        </div>
                    </div>
                </div>
            </div>
        </form>
        </div>
    </div>
</div>
@endsection
@section('script')
<script type="text/javascript">
function submitbutton(id) {
    $('#submit_type').val(id);
}
$(document).ready(function(){
    function updateLabels() {
        $('.row-to-clone').each(function(index) {
            $(this).find('label').text('Answer ' + (index + 1));
        });
    }
    $(document).on('click', '.add-circle', function(){
        var $clone = $('.row-to-clone:first').clone();
        $clone.find('input').val(''); 
        $clone.find('.remove-circle').show();
        $clone.find('.add-circle').hide();
        $('#container').append($clone);
        updateLabels();
    });
    $(document).on('click', '.remove-circle', function(){
        if ($('.row-to-clone').length > 1) {
            $(this).closest('.row-to-clone').remove();
            updateLabels();
        } else {
            alert("You must have at least one row.");
        }
    });
    updateLabels();
});


document.getElementById('question_type').addEventListener('change', function() {
    var value = this.value;

    document.getElementById('container').style.display = 'none';

    // Show appropriate container based on selected value
    if (value === 'checkbox' || value === 'radio') {
        document.getElementById('container').style.display = 'block';
    }else {
        document.getElementById('container').style.display = 'none';
    } 
});
</script>

@endsection