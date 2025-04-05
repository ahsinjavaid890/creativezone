@extends('admin.layouts.main-layout')
@section('title','Top Navbar')
@section('content')
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <div class="d-flex align-items-center flex-wrap mr-2">
                <h5 class="text-blue font-weight-bold mt-2 mb-2 mr-5">
                   General Settings
                </h5>
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <a href="{{ url('admin/dashboard') }}" class="text-blue font-weight-bold mt-2 mb-2 mr-5">
                    Dashboard
                </a>
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <a href="{{ url('admin/website/settings') }}" class="text-blue font-weight-bold mt-2 mb-2 mr-5">
                    Settings
                </a>
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <a href="javascript:void(0)" class="text-dark font-weight-bold mt-2 mb-2 mr-5">
                   Top Navbar
                </a>
            </div>
        </div>
    </div>
    <div class="d-flex flex-column-fluid">
        <div class="container-fluid">
            <div class="row d-flex justify-content-center">
                <div class="col-lg-6">
                    @include('alerts.index')
                    <div class="card mb-3">
                        <div class="card-header">
                            <h4 class="fw-600 mb-0">Top Navbar</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ url('admin/website/settings/topnavbarupdate') }}" enctype='multipart/form-data' method="POST">
                            @csrf
                            <div class="row mb-5">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Want to Show topnavbar?</label>
                                        <select class="form-control" name="top_navbar">
                                            <option value="">Select</option>
                                            <option @if($settings->top_navbar == 1) selected @endif value="1">Yes</option>
                                            <option @if($settings->top_navbar == 2) selected @endif value="2">No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div id="container">
                                        @if($links->isEmpty())
                                            <!-- If no links in database, show one empty row for adding new link -->
                                            <div class="row row-to-clone" style="border: 1px solid #E4E6EF; padding-top: 10px; margin: 0px; margin-top: 10px; border-radius: 0.42rem;">
                                                <div class="col-md-11">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label class="form-label">Title</label>
                                                                <input type="text" class="form-control" name="title[]" value="">
                                                                <input type="hidden" name="link_id[]" value="">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label class="form-label">Link</label>
                                                                <input type="text" class="form-control" name="link[]" value="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-1 pt-10">
                                                    <span class="material-icons add-circle" style="cursor: pointer;">add_circle</span>
                                                    <span class="material-icons remove-circle" style="cursor: pointer; display: none;">remove_circle</span>
                                                </div>
                                            </div>
                                        @else
                                            <!-- If links exist in the database, loop through and display them -->
                                            @foreach($links as $link)
                                            <div class="row row-to-clone" style="border: 1px solid #E4E6EF; padding-top: 10px; margin: 0px; margin-top: 10px; border-radius: 0.42rem;">
                                                <div class="col-md-11">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label class="form-label">Title</label>
                                                                <input type="text" class="form-control" name="title[]" value="{{ $link->tittle }}">
                                                                <input type="hidden" name="link_id[]" value="{{ $link->id }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label class="form-label">Link</label>
                                                                <input type="text" class="form-control" name="link[]" value="{{ $link->link }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-1 pt-10">
                                                    <span class="material-icons add-circle" style="cursor: pointer;">add_circle</span>
                                                    <span class="material-icons remove-circle" style="cursor: pointer;">remove_circle</span>
                                                </div>
                                            </div>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="text-right">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                        </div>
                    </div>
                </div> <!-- end col-->
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
$(document).ready(function(){
    // Function to add a new row
    $(document).on('click', '.add-circle', function(){
        var $clone = $('.row-to-clone:first').clone();
        $clone.find('input').val(''); // Clear input values in the cloned row
        $clone.find('.remove-circle').show(); // Show remove button
        $clone.find('.add-circle').hide(); // Hide add button
        $('#container').append($clone);
    });

    // Function to remove a row
    $(document).on('click', '.remove-circle', function(){
        if ($('.row-to-clone').length > 1) {
            $(this).closest('.row-to-clone').remove();
        } else {
            alert("You must have at least one row.");
        }
    });
});
</script>
@endsection