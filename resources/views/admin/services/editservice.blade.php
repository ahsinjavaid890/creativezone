@extends('admin.layouts.main-layout')
@section('title','Edit Service')
@section('content')
 <!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <div class="d-flex align-items-center flex-wrap mr-2">
                <h5 class="text-blue font-weight-bold mt-2 mb-2 mr-5">
                    Update Service
                </h5>
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <a href="{{ url('admin/dashboard') }}" class="text-blue font-weight-bold mt-2 mb-2 mr-5">
                    Dashboard
                </a>
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <a href="{{ url('admin/services/allservices') }}" class="text-blue font-weight-bold mt-2 mb-2 mr-5">
                    Services
                </a>
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <a href="javascript::void(0)" class="text-dark font-weight-bold mt-2 mb-2 mr-5">
                    Edit Service : <b class="text-danger">{{ $data->name }}</b>
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
                <form method="POST" action="{{ url('admin/services/updateservice') }}">
                 @csrf
                <div class="row">
                    <div class="col-md-6">
                            <div class="card card-custom mt-5">
                                <div class="card-header flex-wrap"> 
                                    <h3 class="card-title align-items-start flex-column">
                                        <span class="card-label font-weight-bolder text-dark">Service Details</span>
                                    </h3>
                                </div>
                                <div class="card-body">
                                    <input type="hidden" value="{{ $data->id }}" name="id">

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Select Parent</label>
                                                <select class="form-control" name="parent_id">
                                                <option selected="" value="">Choose Parent Service</option>
                                                @foreach(DB::table('services')->whereNull('parent_id')->where('trashstatus', '!=', 1)->get() as $r)
                                                    <option @if($data->parent_id == $r->id) selected @elseif($data->parent_id == 1) selected @endif value="{{ $r->id }}">{{ $r->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Service Name </label>
                                                <input type="text" value="{{ $data->name }}"  placeholder="Service Name" class="form-control"  name="name">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Service Icon</label>
                                                <input type="file" name="icon" class="form-control">
                                                @if($data->icon )
                                                <img src="{{ url('public/images') }}/{{ $data->icon }}" class="img-thumbnail mt-2" width="100">
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Description</label>
                                                <textarea class="form-control" name="description" rows="4">{{ $data->description }}</textarea>
                                            </div>
                                        </div>
                                    </div> 
                                </div>
                                <div class="card-footer">
                                    <div class="form-group">
                                        <input type="submit" class="btn btn-primary" value="Update">
                                    </div>
                                </div>
                            </div>
                    </div>
                    <div class="col-md-6">
                        <div class="accordion" id="addcarddetail">
                            <div class="card card-custom mt-5">
                                <div data-toggle="collapse" data-target="#refferdby" class="card-header bg-white d-flex justify-content-between align-items-center">
                                    <div class="card-title">
                                        <span class="card-label font-weight-bolder text-dark">Tag along with other services in this order</span>
                                    </div>
                                    <div class="accordion-icon">
                                        <i class="fas fa-plus"></i>
                                    </div>
                                </div>
                                <div id="refferdby" class="collapse" data-parent="#addcarddetail">
                                    <div class="card-body">
                                        <div id="container">
                                            @if($relation && $relation->count() > 0)
                                                @foreach($relation as $r)
                                                    <div class="row row-to-clone">
                                                        <div class="col-md-11">
                                                            <div class="form-group">
                                                                <label class="form-label">Add Other Services</label>
                                                                <div class="input-group mb-3">
                                                                    <select class="form-control" name="other_services_id[]">
                                                                        <option selected="" value="">Choose Another Service</option>
                                                                        @foreach(DB::table('services')->wherenull('parent_id')->where('status', 1)->where('trashstatus', '!=', 1)->get() as $parentService)
                                                                            <optgroup label="{{ $parentService->name }} (Parent Service)">
                                                                                @php
                                                                                    $children = DB::table('services')->where('parent_id', $parentService->id)->get();
                                                                                @endphp
                                                                                @if($children->count())
                                                                                    @foreach($children as $childService)
                                                                                        <option @if($r->related_service_id == $childService->id) selected @endif value="{{ $childService->id }}">{{ $childService->name }}</option>
                                                                                    @endforeach
                                                                                @endif
                                                                            </optgroup>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-1 pt-6">
                                                            @if ($loop->last)
                                                                <span class="material-icons add-circle" style="cursor: pointer;">add_circle</span>
                                                            @endif
                                                            <span class="material-icons remove-circle" style="cursor: pointer; @if($loop->first && $relation->count() == 1) display:none; @endif">remove_circle</span>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @else
                                                <div class="row row-to-clone">
                                                    <div class="col-md-11">
                                                        <div class="form-group">
                                                            <label class="form-label">Add Other Services</label>
                                                            <div class="input-group mb-3">
                                                                <select class="form-control" name="other_services_id[]">
                                                                    <option selected="" value="">Choose Another Service</option>
                                                                    @foreach(DB::table('services')->wherenull('parent_id')->where('status', 1)->where('trashstatus', '!=', 1)->get() as $parentService)
                                                                        <optgroup label="{{ $parentService->name }} (Parent Service)">
                                                                            @php
                                                                                $children = DB::table('services')->where('parent_id', $parentService->id)->get(); 
                                                                            @endphp
                                                                            @if($children->count())
                                                                                @foreach($children as $childService)
                                                                                    <option value="{{ $childService->id }}">{{ $childService->name }}</option>
                                                                                @endforeach
                                                                            @endif
                                                                        </optgroup>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-1 pt-1">
                                                        <span class="material-icons add-circle" style="cursor: pointer;">add_circle</span>
                                                        <span class="material-icons remove-circle" style="cursor: pointer; display: none;">remove_circle</span>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if($data->parent_id)
                        <div class="card card-custom mt-5">
                            <div class="card-header flex-wrap">
                                <div class="card-title">
                                    <h3 class="card-label">
                                        Service Attributes
                                    </h3>
                                </div>
                                <div class="card-toolbar">
                                    <a data-toggle="modal" data-target="#exampleModalCenter" href="javascript::void(0)" class="btn btn-primary btn-sm font-weight-bolder mr-2 btn-sm">
                                        Add Attributes
                                    </a>
                                </div>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered" id="sortable-table">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Name</th>
                                            <th class="text-center">Type</th>
                                            <th class="text-center">Operations</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($attributes  as $r)
                                        <tr data-id="{{ $r->id }}">
                                            <td>{{ $r->name }}</td>
                                            <td class="text-center">{{ $r->type }}</td>
                                            <td class="text-center pr-0">
                                               <!-- <a href="javascript::void(0);" onclick='confirmstatusattrbiute("{{ url('admin/services/changeattributestatus') }}/{{ $r->id }}")' class="btn btn-icon btn-light btn-hover-primary btn-sm">
                                                  <span class="material-symbols-outlined">question_exchange</span>
                                               </a> -->
                                               <a href="javascript::void(0)" onclick="editattribute({{ $r->id }})" class="btn btn-icon btn-light btn-hover-primary btn-sm mx-3">
                                                  <span class="material-symbols-outlined">edit</span>
                                               </a>
                                               <a href="javascript::void(0);" onclick='confirmDeleteattrbiute("{{ url('admin/services/deleteattribute') }}/{{ $r->id }}")' class="btn btn-icon btn-light btn-hover-primary btn-sm">
                                                  <span class="material-symbols-outlined">delete</span>
                                               </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                        
                                    </tbody>
                                </table>
                                {!! $attributes->links('admin.pagination') !!}
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </form>
            <!--end::Card-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->
</div>


<div class="modal fade" id="exampleModalCenter" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <form method="POST" action="{{ url('admin/services/saveattibutes') }}" class="modal-content">
            @csrf
            <input type="hidden" value="{{ $data->id }}" name="service_id">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add New Attribute</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Select Type <span class="text-danger">*</span></label>
                            <select class="form-control" name="type" id="attributeType">
                                <option value="Text">Text</option>
                                <option value="Radio">Single Choice</option>
                                <option value="Checkbox">Multiple Choice</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Name <span class="text-danger">*</span></label>
                            <input  type="text" class="form-control" name="name">
                        </div>
                    </div>
                </div>
                <div id="containers">
                    <div class="row row-to-clones">
                        <div class="col-md-11">
                            <div class="form-group">
                                <label class="form-label">Value 1</label>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" name="value[]" >
                                </div>
                            </div>
                        </div>
                        <div class="col-md-1 d-flex align-items-center justify-content-center">
                            <span class="material-icons add-circles" style="cursor: pointer;">add_circle</span>
                            <span class="material-icons remove-circles" style="cursor: pointer; display: none;">remove_circle</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
                <button type="submit" name="submit" class="btn btn-primary font-weight-bold">Save</button>
            </div>
        </form>
    </div>
</div>
<div class="modal fade" id="editattribute" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md" id="editattributecontent" role="document">
        
    </div>
</div>

<style type="text/css">
    .table-responsive{
        display: block !important;
    }
    #sortable-table tbody tr{
        cursor: -webkit-grab;
    }
    .row .row-to-clone{
        align-items: center;
    }
</style>
@endsection
@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.14.0/Sortable.min.js"></script>
<script type="text/javascript">
function editattribute(id) {
    $.ajax({
        type: "POST",
        url: "{{ url('admin/services/editattribute') }}",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            id:id,
        },
        success: function(res) {
            $('#editattributecontent').html(res);
            $('#editattribute').modal('show');
        },
        error: function(error) {
            
        }
    });
}
</script>
<script type="text/javascript">
$(document).ready(function(){
    $(document).on('click', '.add-circle', function(){
        var $clone = $('.row-to-clone:first').clone();
        $clone.find('select').val('');
        $clone.find('.remove-circle').show();
        $clone.find('.add-circle').hide();
        $('#container').append($clone);
        updateRowIcons();
    });
    $(document).on('click', '.remove-circle', function(){
        if ($('.row-to-clone').length > 1) {
            $(this).closest('.row-to-clone').remove();
            updateRowIcons();
        } else {
            alert("You must have at least one row.");
        }
    });
    function updateRowIcons() {
        $('.row-to-clone').each(function(index){
            if (index === $('.row-to-clone').length - 1) {
                $(this).find('.add-circle').show();
                $(this).find('.remove-circle').hide();
            } else {
                $(this).find('.add-circle').hide();
                $(this).find('.remove-circle').show();
            }
        });
    }
    updateRowIcons();
});
$(document).ready(function() {
    function updateLabels() {
        $('.row-to-clones').each(function(index) {
            $(this).find('label').text('Value ' + (index + 1));
        });
        var rows = $('.row-to-clones');
        rows.find('.add-circles').hide();
        rows.find('.remove-circles').show();
        rows.last().find('.add-circles').show();

        if (rows.length === 1) {
            rows.first().find('.remove-circles').hide();
        }
    }
    updateLabels();
    $(document).on('click', '.add-circles', function() {
        var $clone = $('.row-to-clones:first').clone();
        $clone.find('input').val(''); 
        $clone.find('.remove-circles').show();
        $clone.find('.add-circles').hide();
        $('#containers').append($clone);
        updateLabels();
    });
    $(document).on('click', '.remove-circles', function() {
        if ($('.row-to-clones').length > 1) {
            $(this).closest('.row-to-clones').remove();
            updateLabels();
        } else {
            alert("You must have at least one row.");
        }
    });
});
document.addEventListener('DOMContentLoaded', function() {
    const attributeupdateType = document.getElementById('attributeType');
    const containers = document.getElementById('containers');
    const inputElements = containers.querySelectorAll('input');

    function toggleValueContainer() {
        const selectedType = attributeupdateType.value;
        if (selectedType === 'Text') {
            containers.style.display = 'none';
            inputElements.forEach(input => input.removeAttribute('required'));
        } else {
            containers.style.display = 'block';
            inputElements.forEach(input => input.setAttribute('required', 'required'));
        }
    }
    toggleValueContainer();
    attributeupdateType.addEventListener('change', toggleValueContainer);
});
</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var sortable = Sortable.create(document.getElementById('sortable-table').querySelector('tbody'), {
            animation: 150,
            onEnd: function (evt) {
                var sortedIDs = Array.from(evt.from.children).map(function (row) {
                    return row.getAttribute('data-id');
                });
                fetch("{{ url('admin/services/updateorder') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ order: sortedIDs })
                }).then(response => response.json())
                  .then(data => {
                  });
            }
        });
    });
    function confirmDeleteattrbiute(url) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = url;
            }
        })
    }
    function confirmstatusattrbiute(url) {
        Swal.fire({
            title: 'Are you sure you Want To Change Status of This Attribute?',
            text: "If Status is Not Published then This Attribute Will not show Frontend",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Change it!'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = url;
            }
        })
    }
</script>
@endsection