@extends('admin.layouts.main-layout')
@section('title','Edit Collection')
@section('content')
 <!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <div class="d-flex align-items-center flex-wrap mr-2">
                <h5 class="text-blue font-weight-bold mt-2 mb-2 mr-5">
                    Edit Collection
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
                <a href="{{ url('admin/ecommerce/collections') }}" class="text-blue font-weight-bold mt-2 mb-2 mr-5">
                    Collections
                </a>
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <a href="javascript:void(0)" class="text-dark font-weight-bold mt-2 mb-2 mr-5">
                    Edit Collection : <b class="text-danger">{{ $data->name }}</b>
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
            <form enctype="multipart/form-data" method="POST" action="{{ url('admin/ecommerce/updatecollection') }}">
                @csrf
                <input value="{{ $data->id }}" type="hidden" name="id">
                <div class="row"> 
                    <div class="col-md-9">
                        <div class="card card-custom mt-5">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Name <span class="text-danger">*</span></label>
                                            <input value="{{ $data->name }}" required type="text" placeholder="Enter Collection Tittle" class="form-control" name="name">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Collection Type</label>
                                            <select class="form-control" name="collectiontype">
                                                <option value="">Select Collection Type</option>
                                                <option @if($data->collectiontype == 'Collection') selected @endif value="Collection">Collection</option>
                                                <option @if($data->collectiontype == 'Series') selected @endif value="Series">Series</option>
                                            </select>
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
                        </div>
                        <style type="text/css">
                            /* List Group Styles */
                            .list-group-hoverable .list-group-item:hover {
                                background-color: #f1f1f1;
                            }

                            .list-group-item {
                                border: none;
                                border-bottom: 1px solid #ddd;
                                padding: 10px 15px;
                            }

                            .list-group-item:last-child {
                                border-bottom: none;
                            }

                            .avatar {
                                width: 50px;
                                height: 50px;
                                border-radius: 50%;
                                background-size: cover;
                                background-position: center;
                            }

                            .text-body {
                                font-weight: 600;
                                color: #333;
                            }

                            .text-secondary {
                                color: #6c757d;
                            }

                            .list-group-item-actions {
                                cursor: pointer;
                            }

                            .icon {
                                width: 1.5rem;
                                height: 1.5rem;
                                stroke-width: 2px;
                            }
                        </style>
                        <div class="card card-custom mt-5">
                            <div class="card-header flex-wrap">
                                <div class="card-title">
                                    Products
                                </div>
                            </div>
                            <div class="card-body showcollectionproducts" style=" position: relative; ">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="Search Products" id="searchProducts">
                                            <input type="hidden" value="{{ $data->id }}" id="collectionid">
                                        </div>
                                    </div>
                                </div>
                                
                                <div id="searchResults" style=" position: absolute; width: 93%; z-index: 10000000; top: 60px; "></div>
                                @if(DB::table('collection_products')->where('collection_id' , $data->id)->count() > 0)
                                <div class="list-group list-group-flush list-group-hoverable list-selected-products mt-3">
                                    <label class="form-label">
                                        <b>Selected products {{ DB::table('collection_products')->where('collection_id' , $data->id)->count() }}</b>
                                    </label>
                                    @foreach(DB::table('collection_products')->orderby('id' , 'desc')->where('collection_id' , $data->id)->get() as $r)
                                    @php
                                        $product = DB::table('buy_products')->where('id' , $r->product_id)->first();
                                        $image = DB::table('gallary_images')->where('type' , 'product_buy_small')->where('object_id' , $r->product_id)->first();
                                    @endphp
                                    <div class="list-group-item">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                @if($image)
                                                <img width="50" src="{{ url('public/images') }}/{{ $image->image }}">
                                                @else
                                                <img width="50" src="{{ url('public/images/noimage.jpeg') }}">
                                                @endif
                                            </div>
                                            <div class="col text-truncate">
                                                <a href="{{ url('admin/ecommerce/editproduct') }}/{{ $r->product_id }}" class="text-body d-block" target="_blank">{{ $product->name }}</a>
                                                <div class="text-secondary text-truncate"></div>
                                            </div>
                                            <div class="col-auto">
                                                <a href="javascript:void(0)" onclick="removeproductfromcollection({{$r->product_id}} , {{ $data->id }})" class="text-decoration-none list-group-item-actions btn-trigger-remove-selected-product" title="Delete">
                                                    <span class="material-symbols-outlined">close</span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card card-custom mt-5">
                            <div class="card-header flex-wrap">
                                <div class="card-title">
                                    Status & Order
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Order <span class="text-danger">*</span></label>
                                            <input value="{{ $data->orderby }}" required type="text" class="form-control" name="orderby">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Show on Homepage</label>
                                            <select class="form-control" name="homepage">
                                                <option @if($data->homepage == 1) selected @endif  value="1">Yes</option>
                                                <option @if($data->homepage == 0) selected @endif value="0">No</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Show on Buy Page</label>
                                            <select class="form-control" name="buypage">
                                                <option @if($data->buypage == 1) selected @endif value="1">Yes</option>
                                                <option @if($data->buypage == 0) selected @endif value="0">No</option>
                                            </select>
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
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-primary form-control">Save</button>
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
@endsection

@section('script')
<script>
    $(document).ready(function() {
        $('#searchProducts').on('keyup', function() {
            let query = $(this).val();
            if (query.length > 2) {
                $.ajax({
                    url: "{{ url('admin/ecommerce/searchproducts') }}",
                    type: "GET",
                    data: {'query': query,'collectionid': $('#collectionid').val()},
                    success: function(data) {
                        $('#searchResults').html(data);
                    }
                });
            } else {
                $('#searchResults').html('');
            }
        });
    });
    function removeproductfromcollection(productid  , collectionid) {
        $.ajax({
            url: "{{ url('admin/ecommerce/removeproductfromcollection') }}",
            type: "GET",
            data: {'productid': productid,'collectionid': collectionid},
            success: function(data) {
                $('.showcollectionproducts').html(data);
            }
        });
    }
</script>
@endsection