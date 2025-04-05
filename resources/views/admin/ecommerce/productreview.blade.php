@extends('admin.layouts.main-layout')
@section('title','Product Review')
@section('content')
 <!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <div class="d-flex align-items-center flex-wrap mr-2">
                <h5 class="text-blue font-weight-bold mt-2 mb-2 mr-5">
                    Product Review's
                </h5>
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <a href="{{ url('admin/dashboard') }}" class="text-blue font-weight-bold mt-2 mb-2 mr-5">
                    Dashboard
                </a>
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <a href="{{ url('admin/ecommerce/products') }}" class="text-blue font-weight-bold mt-2 mb-2 mr-5">
                    All Product
                </a>
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <a href="{{ url('admin/ecommerce/editproduct') }}/{{ $data->id }}" class="text-dark font-weight-bold mt-2 mb-2 mr-5">
                    Product : <b class="text-danger">{{ $data->name }}</b>
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
            <div class="accordion accordion-toggle-arrow" id="addcarddetail">
                <div class="card card-custom mt-5">
                    <div id="collapseOne1" class="collapse" data-parent="#addcarddetail">
                        <div class="card-body">
                            <form method="GET" action="{{ url('admin/services/providers') }}">
                                <div class="row">
                                    <div class="col-md-11 mb-5">
                                        <div class="form-group">
                                            <h4>Apply Filters</h4>
                                        </div>
                                    </div>
                                    <div class="col-md-1 mb-5 text-right">
                                        <div class="form-group">
                                            <span style="cursor: pointer;" data-toggle="collapse" data-target="#collapseOne1" class="material-symbols-outlined">close</span>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Search Provider By Name</label>
                                            <input placeholder="Search Provider By Name" type="text" class="form-control" name="name" value="{{ request('name') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Service</label>
                                            <select name="filter_operators" class="form-control">
                                                <option selected="" value="">Choose Parent Service</option>
                                                @foreach(DB::table('services')->wherenull('parent_id')->get() as $r)
                                                <option value="{{ $r->id }}" {{ request('filter_operators') == $r->id ? 'selected' : '' }}>{{ $r->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Status</label>
                                            <select name="status" class="form-control">
                                                <option value="">Select Status</option>
                                                <option value="1" {{ request('status') == 1 ? 'selected' : '' }}>Enable</option>
                                                <option value="2" {{ request('status') == 2 ? 'selected' : '' }}>Disable</option>
                                            </select> 
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label></label>
                                            <button class="btn btn-primary form-control mt-2">Apply Filter</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card card-custom mt-5">
                <div class="card-header flex-wrap">
                    <div class="card-title">
                        <a data-toggle="collapse" data-target="#collapseOne1" href="javascript::void(0)" class="btn btn-primary font-weight-bolder">
                           <span class="material-symbols-outlined">filter</span> Apply Filter
                        </a>
                         @if(request()->has('name') || request()->has('filter_operators') || request()->has('status'))
                            <a href="{{ url('admin/ecommerce/products') }}" class="btn ml-3 btn-primary font-weight-bolder">
                                Clear Filter
                            </a>
                        @endif
                    </div>
                    <div class="card-toolbar">
                        <!-- <a href="{{ url('admin/services/exportprovider') }}" class="btn btn-primary font-weight-bolder mr-2">
                          <span class="material-symbols-outlined">system_update_alt</span> Export
                        </a>
                        <a href="javascript::void(0)" class="btn btn-primary font-weight-bolder mr-2" data-toggle="modal" data-target="#importprovider"> <span class="material-symbols-outlined">upload</span> Import
                        </a> -->
                        <!-- <a href="javascript::void(0)" class="btn btn-primary font-weight-bolder"data-toggle="modal" data-target="#addreview">
                           <span class="material-symbols-outlined">add</span> Add
                        </a> -->
                    </div>
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center">Name</th>
                                <th class="text-center">Email</th>
                                <th class="text-center">Product</th>
                                <th class="text-center">Rating</th>
                                <th class="text-center">Operations</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($review as $r)
                                <td class="text-center">{{ $r->name }}</td>
                                <td class="text-center">{{ $r->email }}</td>
                                <td class="text-center">{{ DB::table('buy_products')->where('id' , $r->product_id)->first()->name; }}</td>
                                <td>
                                    @if($r->ratting == 1)
                                    <span class="rating">
                                        <label for="rating-1">★</label>
                                    </span>
                                    @endif
                                    @if($r->ratting == 2)
                                    <span class="rating">
                                        <label for="rating-2">★</label>
                                        <label for="rating-2">★</label>
                                    </span>
                                    @endif
                                    @if($r->ratting == 3)
                                    <span class="rating">
                                        <label for="rating-3">★</label>
                                        <label for="rating-3">★</label>
                                        <label for="rating-3">★</label>
                                    </span>
                                    @endif
                                    @if($r->ratting == 4)
                                    <span class="rating">
                                        <label for="rating-4">★</label>
                                        <label for="rating-4">★</label>
                                        <label for="rating-4">★</label>
                                        <label for="rating-4">★</label>
                                    </span>
                                    @endif
                                    @if($r->ratting == 5)
                                    <span class="rating">
                                        <label for="rating-5">★</label>
                                        <label for="rating-5">★</label>
                                        <label for="rating-5">★</label>
                                        <label for="rating-5">★</label>
                                        <label for="rating-5">★</label>
                                    </span>
                                    @endif
                                </td>
                                <td class="text-center pr-0">
                                   <a href="javascript:void(0);" data-toggle="modal" data-target="#editproduct{{ $r->id }}" class="btn btn-icon btn-light btn-hover-primary btn-sm">
                                      <span class="material-symbols-outlined">Edit</span>
                                   </a>
                                   <a href="javascript:void(0);" onclick='confirmDelete("{{ url('admin/ecommerce/deleteproductreview') }}/{{ $r->id }}")' class="btn btn-icon btn-light btn-hover-primary btn-sm">
                                      <span class="material-symbols-outlined">delete</span>
                                   </a>
                                </td>
                            </tr>
                            <div class="modal fade" id="editproduct{{ $r->id }}" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <h5 class="modal-title" id="exampleModalLabel">Update Product Review</h5>
                                                </div>
                                            </div>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <i aria-hidden="true" class="ki ki-close"></i>
                                            </button>
                                        </div>
                                        <form enctype="multipart/form-data" method="POST" action="{{ url('admin/ecommerce/updateproductreview') }}">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $data->id }}">
                                            <input type="hidden" name="id" value="{{ $r->id }}">
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label>name</label>
                                                            <input class="form-control" type="text" name="name" value="{{ $r->name }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label>Email</label>
                                                            <input class="form-control" type="text" name="email" value="{{ $r->email }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label>Select Ratting</label>
                                                            <select name="ratting" class="form-control">
                                                                <option @if($r->ratting == 1) selected @endif value="1">1</option>
                                                                <option @if($r->ratting == 2) selected @endif value="2">2</option>
                                                                <option @if($r->ratting == 3) selected @endif value="3">3</option>
                                                                <option @if($r->ratting == 4) selected @endif value="4">4</option>
                                                                <option @if($r->ratting == 5) selected @endif value="5">5</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label>Review</label>
                                                            <textarea class="form-control" name="review" rows="4">{{ $r->review }}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary font-weight-bold">Save</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </tbody>
                    </table>
                    {!! $review->links('admin.pagination') !!}
                </div>
            </div>
            <!--end::Card-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->
</div>
<style type="text/css">
.rating {
    display: flex;
    direction: row-reverse;
    justify-content: center;
}

.rating label {
    font-size: 2em;
    color: #ddd;
    cursor: pointer;
}
.rating  label {
    color: gold;
}
.rating label:hover,
.rating label:hover ~ label,
.rating input:checked ~ label:hover,
.rating input:checked ~ label:hover ~ label {
    color: gold;
}
</style>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
            title: 'Are you sure you Want To Change Status of This Provider FAQ?',
            text: "If Status is Not Published then This Provider FAQ Will not show Frontend",
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
    document.addEventListener('DOMContentLoaded', function() {
    // Get URL parameters
    const urlParams = new URLSearchParams(window.location.search);
    
    // Check if any filter parameters are present
    const hasFilters = urlParams.has('name') || 
                       urlParams.has('filter_operators') || 
                       urlParams.has('status');
    
    // If filters are present, open the accordion
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
@endsection