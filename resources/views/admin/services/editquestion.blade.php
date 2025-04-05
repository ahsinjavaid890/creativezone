@extends('admin.layouts.main-layout')
@section('title','Update Question')
@section('content')
 <!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <div class="d-flex align-items-center flex-wrap mr-2">
                <h5 class="text-blue font-weight-bold mt-2 mb-2 mr-5">
                   Update Question
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
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <a href="{{ url('admin/services/allservices') }}" class="text-blue font-weight-bold mt-2 mb-2 mr-5">
                   Services : <span class="text-danger">{{ DB::table('services')->where('id' , $data->service_id)->first()->name }}</span>
                </a>
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <a href="{{ url('admin/services/allquestion') }}/{{ $service->id }}" class="text-blue font-weight-bold mt-2 mb-2 mr-5">
                   All Questions
                </a>
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <a href="javascript:void(0)" class="text-dark font-weight-bold mt-2 mb-2 mr-5">
                  Update Question
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
            <form enctype="multipart/form-data" method="POST" action="{{ url('admin/services/updatequestionanswer') }}">
            @csrf
            <input type="hidden" name="submit_type" id="submit_type" >
            <input type="hidden" name="id" value="{{ $data->id }}">
            <input type="hidden" name="service_id" value="{{ $data->service_id }}">
            <div class="row d-flex justify-content-center">
                <div class="col-md-6 mx-auto">
                    <div class="card card-custom mt-5">
                        <div class="card-header flex-wrap"> 
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label font-weight-bolder text-dark">Update Question</span>
                            </h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Ask Question</label>
                                        <input type="text" class="form-control" name="question" value="{{ $data->question }}">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Select Type</label>
                                        <select class="form-control" id="question_type" name="question_type">
                                            <option selected="" value="">Choose Question Type</option>
                                            <option @if($data->question_type == 'checkbox') selected @endif value="checkbox">Single Choice</option>
                                            <option @if($data->question_type == 'radio') selected @endif value="radio">Multiple Choice</option>
                                            <option @if($data->question_type == 'text') selected @endif value="text">Text</option>
                                            <option @if($data->question_type == 'date') selected @endif value="date">Date</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="answer-container col-md-12" id="container">
                                    @if($answer->isEmpty())
                                        <div class="row row-to-clone">
                                            <div class="col-md-11">
                                                <div class="form-group">
                                                    <label class="form-label">Answer 1</label>
                                                    <div class="input-group mb-3">
                                                        <input type="text" class="form-control" name="answer[]" placeholder="Enter answer">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-1 pt-2">
                                                <span class="material-icons remove-circle" style="cursor: pointer;">remove_circle</span>
                                                <span class="material-icons add-circle" style="cursor: pointer;">add_circle</span>
                                            </div>
                                        </div>
                                    @else
                                    @foreach($answer as $r)
                                        <div class="row row-to-clone">
                                            <div class="col-md-11">
                                                <div class="form-group">
                                                    <label class="form-label">Answer {{ $loop->iteration }}</label>
                                                    <div class="input-group mb-3">
                                                        <input type="text" class="form-control" value="{{ $r->answer }}" name="answer[]">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-1 pt-2">
                                                <span class="material-icons remove-circle" style="cursor: pointer;">remove_circle</span>
                                                @if ($loop->last)
                                                    <span class="material-icons add-circle" style="cursor: pointer;">add_circle</span>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-right"><input type="submit" onclick="submitbutton('exit')" class="btn btn-primary" placeholder="Service Name" class="form-control" value="Update & Exit">
                            <input type="submit"  onclick="submitbutton('addmore')" class="btn btn-primary" placeholder="Service Name" class="form-control" value="Update & More">
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
$(document).ready(function() {
    function updateIcons() {
        $('.row-to-clone .add-circle').hide();
        $('.row-to-clone:last .add-circle').show();
        $('.row-to-clone .remove-circle').show();
        $('.row-to-clone:last .remove-circle').hide();
    }

    updateIcons();
    $('.answer-container').on('click', '.add-circle', function() {
        var $lastRow = $('.row-to-clone:last');
        var $newRow = $lastRow.clone();
        var newIndex = $('.row-to-clone').length + 1;
        $newRow.find('.form-label').text('Answer ' + newIndex);
        $newRow.find('input').val('');
        $lastRow.after($newRow);
        updateIcons();
    });
    $('.answer-container').on('click', '.remove-circle', function() {
        if ($('.row-to-clone').length > 1) {
            $(this).closest('.row-to-clone').remove();
            updateIcons();
        }
    });
});

document.getElementById('question_type').addEventListener('change', function() {
    var value = this.value;

    // Hide all containers initially
    var containers = ['container'];
    containers.forEach(function(id) {
        var element = document.getElementById(id);
        if (element) {
            element.style.display = 'none';
        }
    });

    // Show the appropriate container based on the selected value
    if (value === 'checkbox' || value === 'radio') {
        document.getElementById('container').style.display = 'block';
    } else{
        document.getElementById('container').style.display = 'none';
    }
});
</script>

@endsection