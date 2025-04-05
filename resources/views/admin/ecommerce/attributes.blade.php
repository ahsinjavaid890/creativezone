@extends('admin.layouts.main-layout')
@section('title','All Attributes')
@section('content')
 <!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <div class="d-flex align-items-center flex-wrap mr-2">
                <h5 class="text-blue font-weight-bold mt-2 mb-2 mr-5">
                    All Attributes
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
                <a href="javascript:void(0)" class="text-dark font-weight-bold mt-2 mb-2 mr-5">
                    All Attributes
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
                    <form id="filterForm" method="GET" action="{{ url('admin/ecommerce/attributes') }}">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Search Attribute By Name</label>
                                    <input placeholder="Search Attribute By Name" type="text" class="form-control" name="name" value="{{ request('name') }}">
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
                            <span class="material-symbols-outlined">add</span> Add
                        </a>
                    </div>
                </div>
                <div class="card-body table-responsive" id="table-data">
                        @include('admin.ecommerce.render.attrbute_table', ['data' => $data])
                </div>
            </div>
            <!--end::Card-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->
</div>
<div class="modal fade" id="exampleModalCenter" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add New Attribute</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <form method="POST" action="{{ url('admin/ecommerce/addattibutes') }}">
            @csrf
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Select Attribute Name <span class="text-danger">*</span></label>
                            <input type="text" required class="form-control" name="name">
                        </div>
                    </div>
                </div>
                <div id="container">
                    <div class="row row-to-clones">
                        <div class="col-md-11">
                            <div class="form-group">
                                <label class="form-label">Value </label>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" name="value[]">
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
</div>
@endsection

@section('script')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
     document.addEventListener('DOMContentLoaded', function() {
        const urlParams = new URLSearchParams(window.location.search);
        const hasFilters = urlParams.has('name')  
        if (hasFilters) {
            const accordion = document.getElementById('collapseOne1');
            if (accordion) {
                new bootstrap.Collapse(accordion, {
                    toggle: true
                });
            }
        }
    });
</script>

<script>
  
    $(document).ready(function(){
        $(document).on('click', '.add-circles', function(){
            var $clone = $('.row-to-clones:first').clone();
            $clone.find('input').val('');
            $clone.find('.remove-circles').show();
            $clone.find('.add-circles').hide();
            $('#container').append($clone);
        });
        $(document).on('click', '.remove-circles', function(){
            if ($('.row-to-clones').length > 1) {
                $(this).closest('.row-to-clones').remove();
            } else {
                alert("You must have at least one row.");
            }
        });
    });
    $('#values').select2({
        placeholder: "Select a Category",
    });
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
            title: 'Are you sure you Want To Change Status of This Brand?',
            text: "If Status is Not Published then This Brand Will not show Frontend",
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
<script type="text/javascript">
    $(document).ready(function () {
        function fetchorder() {
            let formData = $('#filterForm').serialize();
            $.ajax({
                url: "{{ url('admin/ecommerce/attributes') }}",
                type: "GET",
                data: formData,
                success: function (data) {
                    $('#table-data').html(data.tableData);
                    let newUrl = "{{ url('admin/ecommerce/attributes') }}" + '?' + formData;
                    history.pushState(null, '', newUrl);
                },
                error: function (xhr, status, error) {
                    console.error(error);
                }
            });
        }
        $('#filterForm input, #filterForm select').on('input change', function () {
            fetchorder();
        });
        
    });
</script>
@endsection