@extends('admin.layouts.main-layout')
@section('title','Ecommerece | Stock')
@section('content')
 <!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <div class="d-flex align-items-center flex-wrap mr-2">
                <h5 class="text-blue font-weight-bold mt-2 mb-2 mr-5">
                    Stock
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
                    Stock
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
                    <form id="filterForm" method="GET" action="{{ url('admin/ecommerce/stock') }}">
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Product ID</label>
                                    <input type="text" class="form-control" name="product_id" value="{{ request('product_id') }}">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Product Name</label>
                                    <input type="text" class="form-control" name="product_name" value="{{ request('product_name') }}">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Price Greater Then</label>
                                    <input type="text" class="form-control" name="price" value="{{ request('price') }}">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Qty Greater Then</label>
                                    <input type="text" class="form-control" name="qty" value="{{ request('qty') }}">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Our best friend</label>
                                    <select name="best_find" id="best_find" class="form-control">
                                        <option value="">Our best friend</option>
                                        @foreach(DB::table('product_variations')->distinct()->get(['best_find'])->pluck('best_find') as $r)
                                            <option value="{{ $r }}" {{ request('best_find') == $r ? 'selected' : '' }}>{{ $r }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Condition</label>
                                    <select name="condition" id="condition" class="form-control">
                                        <option value="">Condition</option>
                                        @foreach(DB::table('product_variations')->distinct()->get(['condition'])->pluck('condition') as $r)
                                        <option value="{{ $r }}" {{ request('condition') == $r ? 'selected' : '' }}>{{ $r }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Storage</label>
                                    <select name="storage" id="storage" class="form-control">
                                        <option value="" >Storage</option>
                                        @foreach(DB::table('product_variations')->distinct()->get(['storage'])->pluck('storage') as $r)
                                        <option value="{{ $r }}" {{ request('storage') == $r ? 'selected' : '' }}>{{ $r }}</option>
                                        @endforeach
                                        
                                    </select> 
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Color</label>
                                    <select name="color" id="color" class="form-control">
                                        <option value="">Color</option>
                                        @foreach(DB::table('product_variations')->distinct()->get(['color'])->pluck('color') as $r)
                                        <option value="{{ $r }}" {{ request('color') == $r ? 'selected' : '' }}>{{ $r }}</option>
                                        @endforeach
                                    </select> 
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card card-custom mt-5">
                <div class="card-header flex-wrap">
                    <div class="card-title">
                        <span class="subheader-separator">All Stocks</span>
                    </div>
                    <div class="card-toolbar">
                         <form action="{{ url('admin/ecommerce/exportproductvariations') }}" method="POST" id="exportForm">
                            @csrf
                            <input type="hidden" name="product_ids" id="productIds">
                            <button type="submit" class="btn btn-primary font-weight-bolder mr-2">Export </button>
                        </form>
                    </div>
                </div>
                <div class="card-body table-responsive" id="table-data">
                    @include('admin.ecommerce.render.productvariation_table', ['data' => $data])
                </div>
            </div>
            <!--end::Card-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->
</div>

<div class="modal fade" id="editStockModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <div class="modal-content" id="editStockModalBody">
            
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
</script>
<script type="text/javascript">
$(document).ready(function () {
    function fetchorder() {
        let formData = $('#filterForm').serialize();
        $.ajax({
            url: "{{ url('admin/ecommerce/stock') }}",
            type: "GET",
            data: formData,
            success: function (data) {
                $('#table-data').html(data.tableData);
                let newUrl = "{{ url('admin/ecommerce/stock') }}" + '?' + formData;
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
    $('#best_find, #condition, #storage, #color').select2({
        placeholder: "Select",
        width: '100%',
        allowClear: true
    });
});
</script>
<script type="text/javascript">
    document.getElementById('exportForm').addEventListener('submit', function(event) {
        var selectedProductIds = getSelectedProductIds();
        var idsToSend = selectedProductIds.length ? JSON.stringify(selectedProductIds) : 'all';
        document.getElementById('productIds').value = idsToSend;
    });
    function getSelectedProductIds() {
        var selectedIds = [];
        document.querySelectorAll('.product-checkbox:checked').forEach(function(checkbox) {
            selectedIds.push(checkbox.value);
        });
        return selectedIds;
    }
</script>
<script>
$(document).on('click', '.edit-stock-btn', function(e) {
    e.preventDefault();
    var id = $(this).data('id');
    $.ajax({
        url: '{{ url("admin/ecommerce/editstock") }}/' + id,
        type: 'GET',
        success: function(response) {
            $('#editStockModalBody').html(response);
            $('#editStockModal').modal('show');
        },
        error: function(xhr) {
            alert('Error loading data.');
        }
    });
});
</script>
<script type="text/javascript">
$(document).on('submit', '#editStockForm', function(e) {
    e.preventDefault(); 
    var bestFind = $('.best_findvalue').val();
    var condition = $('.conditionvalue').val();
    var color = $('.colorvalue').val();
    var storage = $('.storagevalue').val();
    var product_idvalue = $('.product_idvalue').val();
    var variation_id = $('.variation_id').val();
    var price = $('#price').val();
    var qty = $('#qty').val();

    $.ajax({
        url: '{{ url("admin/ecommerce/updatestock") }}', 
        type: 'POST',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            best_find: bestFind,
            condition: condition,
            color: color,
            storage: storage,
            product_id: product_idvalue,
            variation_id: variation_id,
            price: price,
            qty: qty
        },
        success: function(response) {
            if (response.message) {
                $('#editStockModal').modal('hide');
                var row = $('#stockRow_' + response.data.id);
                row.find('.stock-quantity').text(response.data.qty);
                row.find('.stock-price').text('$'+response.data.price+'.00');
                Swal.fire({
                    title: 'Stock Updated',
                    text: 'The stock has been successfully updated!',
                    icon: 'success',
                    confirmButtonText: 'OK'
                });
            } else {
                Swal.fire({
                    title: 'Error',
                    text: 'There was an error updating the stock.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            }
        },
        error: function(xhr) {
            Swal.fire({
                title: 'Error',
                text: 'An error occurred while updating the stock.',
                icon: 'error',
                confirmButtonText: 'OK'
            });
        }
    });
});
</script>
<script>
function besfind() {
    var bestFind = $('.best_findvalue').val();
    var condition = $('.conditionvalue').val();
    var color = $('.colorvalue').val();
    var storage = $('.storagevalue').val();
    var product_idvalue = $('.product_idvalue').val();
    $.ajax({
        url: '{{ url("admin/ecommerce/filtersotck") }}',
        type: 'GET',
        data: {
            best_find: bestFind,
            condition: condition,
            color: color,
            storage: storage,
            product_id:product_idvalue,
        },
        success: function(response) {
            if (response.price !== undefined && response.qty !== undefined) {
                $('#price').val(response.price);
                $('#qty').val(response.qty);
            } else {
                $('#price').val('');
                $('#qty').val('');
            }
        },
        error: function(xhr) {
            alert('Error loading data.');
        }
    });
}
</script>
@endsection