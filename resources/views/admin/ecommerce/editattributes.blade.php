@extends('admin.layouts.main-layout')
@section('title','Update Attribute')
@section('content')
 <!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <div class="d-flex align-items-center flex-wrap mr-2">
                <h5 class="text-blue font-weight-bold mt-2 mb-2 mr-5">
                    Update Attribute
                </h5>
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <a href="{{ url('admin/dashboard') }}" class="text-blue font-weight-bold mt-2 mb-2 mr-5">
                    Dashboard
                </a>
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <a href="javascript:void(0)" class="text-dark font-weight-bold mt-2 mb-2 mr-5">
                    Ecommerece
                </a>
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <a href="{{ url('admin/ecommerce/attributes') }}" class="text-blue font-weight-bold mt-2 mb-2 mr-5">
                    Attributes
                </a>
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <a href="javascript:void(0)" class="text-dark font-weight-bold mt-2 mb-2 mr-5">
                    Update Attribute
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
            <div class="card card-custom mt-5">
                <div class="card-header flex-wrap">
                    <div class="card-title">
                        <span class="font-weight-bolder">Update Attribute</span>
                    </div>
                </div>
                <div class="card-body">
                    <form enctype="multipart/form-data" method="POST" action="{{ url('admin/ecommerce/updateattribute') }}">
                        @csrf
                        <input type="hidden" name="id" value="{{ $data->id }}">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Select Attribute Name <span class="text-danger">*</span></label>
                                        <input type="text" name="name" value="{{ $data->name }}" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-12" id="containers">
                                    @if($value->isEmpty())
                                    <div class="row row-to-clone">
                                        <div class="col-md-11">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="form-label">Value</label>
                                                        <input type="text" class="form-control" name="value[]">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-1 pt-1">
                                            <span class="material-icons add-circle" style="cursor: pointer;">add_circle</span>
                                            <span class="material-icons remove-circle" style="cursor: pointer; display: none;">remove_circle</span>
                                        </div>
                                    </div>
                                    @else
                                    @foreach($value as $values)
                                    <div class="row row-to-clone">
                                        <div class="col-md-11">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="form-label">Value</label>
                                                        <input type="text" class="form-control" name="value[]" value="{{ $values->value }}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-1 pt-1">
                                            @if ($loop->last && $loop->count == null)
                                                <!-- Show only the '+' icon if it's the last item and there's only one related service -->
                                                <span class="material-icons add-circle" style="cursor: pointer;">add_circle</span>
                                            @elseif ($loop->last && $loop->count == 1)
                                                <!-- Show only the '+' icon if it's the last item and there's only one related service -->
                                                <span class="material-icons add-circle" style="cursor: pointer;">add_circle</span>
                                                <span class="material-icons remove-circle" style="cursor: pointer; ">remove_circle</span>
                                            @else
                                                <!-- Show '+' and '-' icons based on the number of related services -->
                                                <span class="material-icons add-circle" style="cursor: pointer;">add_circle</span>
                                                <span class="material-icons remove-circle" style="cursor: pointer; display: {{ $loop->count > 1 ? 'inline' : 'none' }};">remove_circle</span>
                                            @endif
                                        </div>
                                    </div>
                                    @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary font-weight-bold">Update Attributes</button>
                        </div>
                    </form>
                </div>
            </div>
            <!--end::Card-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->
</div>
@endsection
@section('script')
<script type="text/javascript">
    
$(document).ready(function(){
    $(document).on('click', '.add-circle', function(){
        var $clone = $('.row-to-clone:first').clone();
        $clone.find('input').val(''); 
        $clone.find('.remove-circle').show();
        $clone.find('.add-circle').hide();
        $('#containers').append($clone);
        updateIcons();
    });
    $(document).on('click', '.remove-circle', function(){
        if ($('.row-to-clone').length > 1) {
            $(this).closest('.row-to-clone').remove();
            updateIcons();
        } else {
            alert("You must have at least one row.");
        }
    });
    function updateIcons() {
        var rows = $('.row-to-clone');
        rows.find('.add-circle').hide();
        rows.find('.remove-circle').show();
        rows.last().find('.add-circle').show();
        if (rows.length === 1) {
            rows.first().find('.remove-circle').hide();
        }
    }
    updateIcons();
});
</script>
@endsection