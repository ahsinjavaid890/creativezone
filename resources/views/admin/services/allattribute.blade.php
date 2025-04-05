@extends('admin.layouts.main-layout')
@section('title','All Attribute')
@section('content')
 <!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <div class="d-flex align-items-center flex-wrap mr-2">
                <h5 class="text-blue font-weight-bold mt-2 mb-2 mr-5">
                    All Attribute
                </h5>
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <a href="{{ url('admin/dashboard') }}" class="text-blue font-weight-bold mt-2 mb-2 mr-5">
                    Dashboard
                </a>
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <a href="javascript:void(0)" class="text-dark font-weight-bold mt-2 mb-2 mr-5">
                    Attribute
                </a>
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <a href="javascript:void(0)" class="text-dark font-weight-bold mt-2 mb-2 mr-5">
                    All Attribute
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
                <div class="card-body">
                    <form id="filterForm" method="GET" action="{{ url('admin/services/allattribute') }}">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Search Attribute By Name</label>
                                    <input placeholder="Search Attribute By Name" type="text" class="form-control" name="name" value="{{ request('name') }}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Service</label>
                                    <select name="service_id" id="service_id" class="form-control">
                                        <option selected="" value="">Choose Parent Service</option>
                                        @foreach(DB::table('services')->wherenotnull('parent_id')->where('status', 1)->where('trashstatus', '!=', 1)->get() as $r)
                                        <option value="{{ $r->id }}" {{ request('service_id') == $r->id ? 'selected' : '' }}>{{ $r->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Status</label>
                                    <select name="status" class="form-control" id="status">
                                        <option value="">Select Status</option>
                                        <option value="1" {{ request('status') == 1 ? 'selected' : '' }}>Enable</option>
                                        <option value="2" {{ request('status') == 2 ? 'selected' : '' }}>Disable</option>
                                    </select> 
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card card-custom mt-5">
                <div class="card-header justify-content-end">
                    <div class="card-toolbar">
                        <a data-toggle="modal" data-target="#exampleModalCenter" href="javascript:void(0)" class="btn btn-primary font-weight-bolder mr-2">
                            <span class="material-symbols-outlined">add</span> Add Attributes
                        </a>
                    </div>
                </div>
                <div class="card-body table-responsive"> 
                    <table class="table table-bordered" id="sortable-table">
                        <thead>
                            <tr>
                                <th class="text-center">Name</th>
                                <th class="text-center">Service</th>
                                <th class="text-center">Type</th>
                                <th class="text-center">Values</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Operations</th>
                            </tr>
                        </thead>
                        <tbody>
                            @include('admin.services.render.attributes_table', ['data' => $data])
                        </tbody>
                    </table>
                        {!! $data->links('admin.pagination') !!}
                </div>
            </div>
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
                            <label>Select Service <span class="text-danger">*</span></label>
                            <select class="form-control" name="service_id">
                                <option value="">Select</option>
                                @foreach(DB::table('services')->wherenotnull('parent_id')->get() as $r)
                                <option value="{{ $r->id }}">{{ $r->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
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
    #sortable-table tbody tr{
        cursor: -webkit-grab;
    }
    .row .row-to-clone{
        align-items: center;
    }
</style>
@endsection
@section('script')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
<script>
    function confirmDelete(url) {
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
    function confirmstatus(url) {
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
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var sortable = Sortable.create(document.getElementById('sortable-table').querySelector('tbody'), {
            animation: 150,
            onEnd: function (evt) {
                var sortedIDs = Array.from(evt.from.children).map(function (row) {
                    return row.getAttribute('data-id');
                });
                fetch('{{ url('admin/services/updateorder') }}', {
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
</script>
<script type="text/javascript">
    $(document).ready(function () {
        function fetchquestion() {
            let formData = $('#filterForm').serialize();
            $.ajax({
                url: "{{ url('admin/services/allattribute') }}",
                type: "GET",
                data: formData,
                success: function (data) {
                    console.log(data);
                    $('tbody').html(data.tableData);
                    $('.pagination').html(data.paginationLinks);

                    
                    let newUrl = "{{ url('admin/services/allattribute') }}"  + '?' + formData;
                    history.pushState(null, '', newUrl);
                },
                error: function (xhr, status, error) {
                    console.error(error);
                }
            });
        }

        $('#filterForm input, #filterForm select').on('input change', function () {
            fetchquestion();
        });

        $('#service_id , #status').select2({
            placeholder: "Select",
            width: '100%',
            allowClear: true
        });
    });
</script>
<script type="text/javascript">
$(document).ready(function(){
    // Function to add a new row
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
@endsection