@extends('admin.layouts.main-layout')
@section('title','View Product orders | Orders')
@section('content')
 <!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <div class="d-flex align-items-center flex-wrap mr-2">
                <h5 class="text-blue font-weight-bold mt-2 mb-2 mr-5">
                   View Product Orders
                </h5>
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <a href="{{ url('admin/dashboard') }}" class="text-blue font-weight-bold mt-2 mb-2 mr-5">
                    Dashboard
                </a>
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <a href="{{ url('admin/orders/all') }}" class="text-blue font-weight-bold mt-2 mb-2 mr-5">
                    Product Orders
                </a>
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <a href="javascript:void(0)" class="text-dark font-weight-bold mt-2 mb-2 mr-5">
                  View Product  Orders
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
            <div class="row">
                <div class="col-md-8">
                    <div class="card card-custom mt-5">
                        <div class="card-header flex-wrap">
                            <div class="card-title">
                               Order Information # {{ $data->id }}
                            </div>
                            <div class="card-toolbar">
                                @if($data->order_confirm == 1)
                                <a href="javascript:void(0)" class="badge badge-success">Completed</a>
                                @else
                                <a href="javascript:void(0)" class="badge badge-success">order_confirm</a>
                                @endif
                            </div>
                        </div>
                        @php
                            $item = DB::table('order_items')->where('order_id' , $data->id)->get();
                        @endphp
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text-center">Image</th>
                                        <th class="text-center">Name</th>
                                        <th class="text-center">price</th>
                                        <th class="text-center">quantity</th>
                                        <th class="text-center">Total Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $totalQuantity = 0;
                                        $subamount = 0;
                                        $totalshipping = 0;
                                    @endphp
                                    @foreach($item as $it)
                                    @php
                                        $product = DB::table('buy_products')->where('id', $it->product_id)->first();
                                        $image = DB::table('gallary_images')->where('object_id', $product->id)->first();
                                        $imagesArray = json_decode($product->images, true);
                                        $firstImage = $imagesArray[0] ?? null;
                                        $totalQuantity += $it->quantity;
                                        $totalamount = $it->price * $it->quantity;
                                        $subamount += $totalamount;
                                        $defaultshipping = DB::table('default_shippings')->where('id', $it->shipping_id)->first();
                                        @endphp
                                        @if($defaultshipping)
                                            @php $totalshipping = $defaultshipping->price; @endphp
                                        @endif
                                            
                                    <tr class="data_table">
                                        <td class="text-center">
                                            @if($image)
                                            <img src="{{ url('public/images') }}/{{ $image->image }}" class="image-thumbnail" width="50">
                                            @elseif($product->type == 'accessories') <!-- Use == for comparison -->
                                            <img src="{{ url('public/images') }}/{{ $firstImage }}" width="50" alt="Image">
                                            @endif
                                        </td>
                                        <td>
                                            @if($it->storage)
                                            <a href="{{ url('admin/ecommerce/editproduct') }}/{{ $product->id }}">{{ $product->name }} - {{ $it->storage }} - {{ $it->color }} - {{ $it->best_find }} - {{ $it->condition }}</a>
                                            @elseif($product->type == 'accessories') <!-- Use == for comparison -->
                                            <a href="{{ url('admin/ecommerce/editproduct') }}/{{ $product->id }}">{{ $product->name }}</a>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <div class="d-flex">
                                                <div class="price">
                                                    <p>${{ $it->price }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            {{ $it->quantity }}
                                        </td>
                                        <td class="text-center">
                                            ${{ $totalamount }}
                                        </td>
                                    </tr>
                                    @endforeach
                                    <tr class="extra_data">
                                        <td></td>
                                        <td class="text-center">Quantity</td>
                                        <td></td>
                                        <td></td>
                                        <td class="text-center">{{ $totalQuantity  }}</td>

                                    </tr>
                                    <tr class="extra_data">
                                        <td></td>
                                        <td class="text-center">Sub Amount</td>
                                        <td></td>
                                        <td></td>
                                        <td class="text-center">${{ $subamount  }}</td>
                                    </tr>
                                    <tr class="extra_data">
                                        <td></td>
                                        <td class="text-center">Shipping Fee</td>
                                        <td></td>
                                        <td></td>
                                        <td class="text-center">${{ $totalshipping }}</td>
                                    </tr>
                                    <tr class="extra_data">
                                        <td></td>
                                        <td class="text-center">Total Amount</td>
                                        <td></td>
                                        <td></td>
                                        <td class="text-center"><b class="text-warning">${{ $subamount + $totalshipping }}</b> </td>
                                    </tr>
                                    <tr class="extra_data">
                                        <td></td>
                                        <td class="text-center">Payment Status</td>
                                        <td></td>
                                        <td></td>
                                        <td class="text-center">
                                            @if($data->payment_status == 'paid')
                                            <a href="javascript:void(0)" class="badge badge-primary">Paid</a>
                                            @elseif($data->payment_status == 'pending')
                                            <a href="javascript:void(0)" class="badge badge-primary">Pending</a>
                                            @else
                                            <a href="javascript:void(0)" class="badge badge-danger">Cancelled</a>
                                            @endif
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="other_detail mt-5">
                                <div class="print_btn d-flex justify-content-end">
                                    <div class="print_invoice">
                                         <a href="{{ url('admin/orders/showinvoice') }}/{{ $data->id }}" target="_blank" class="btn btn-sm bg-gray-200" ><i class="fa fa-print"></i> Print Invoice</a>
                                    </div>
                                    <div class="download_invoice ml-5">
                                        <a href="{{ url('admin/orders/downloadinvoice') }}/{{ $data->id }}" class="btn btn-sm bg-gray-200"><i class="fa fa-download"></i>Download Invoice</a>
                                    </div>
                                </div>
                            </div>
                            <div class="order_confirm d-flex justify-content-between"style="border-top: 1px solid #ebedf3; padding: 12px 0px; ">
                            <input type="hidden" id="emailpayment" name="email" value="{{ $data->email }}">
                            <input type="hidden" id="order_id" name="order_id" value="{{ $data->id }}">
                            @if($data->order_confirm == 1)
                                <div class="order_confirm_text">
                                    <p id="order_confirm"><i class="fa fa-check text-primary"></i> Order was confirmed</p>
                                </div>
                            @else
                                <div class="order_confirm_text">
                                     <p id="order_confirm_text" style="display: none;"><i class="fa fa-check text-primary"></i> Order was confirmed</p>
                                    <p id="confirmorder">Confirm the order</p>
                                </div>
                                <div class="confirm_btn" id="confirm_btn">
                                    <a href="javascript:void(0)" onclick="confirmorder({{ $data->id }})" class="btn btn-sm btn-primary">Order Confirm
                                        <span id="confirm_spinner" class="spinner-border spinner-border-sm" style="display:none;" role="status" aria-hidden="true"></span>
                                    </a>
                                </div>
                            @endif

                            </div>
                            <div class="order_confirm d-flex justify-content-between"style="border-top: 1px solid #ebedf3; padding: 12px 0px; ">
                                @if($data->payment_status == 'paid')
                                <div class="order_confirm_text">
                                    <p><i class="fa fa-check text-primary"></i>Payment Confirmed</p>
                                </div>
                                @else
                                <div class="order_confirm_text">
                                    <p><i class="fa fa-check text-primary" style="display: none;" id="confirmpayment"></i>Payment Confirmed</p>
                                    <p><i class="fa fa-wallet" id="pendingpayment"></i> Pending payment</p>
                                </div>
                                <div class="confirm_btn">
                                    <a href="javascript:void(0)" onclick="confirmpayment({{ $data->id }})" id="payment_btn" class="btn btn-sm btn-primary">Payment Confirm
                                        <span id="payment_spinner" class="spinner-border spinner-border-sm" style="display:none;" role="status" aria-hidden="true"></span>
                                    </a>
                                </div>
                                @endif
                            </div>
                            <div class="order_confirm"style="border-top: 1px solid #ebedf3; padding: 12px 0px; ">
                                @php
                                 $delivery = DB::table('deliveries')->where('product_id' , $data->id)->first();
                                @endphp
                                @if(is_null($delivery))
                                <div class="d-flex justify-content-between">
                                    <div class="order_confirm_text">
                                    <p><i class="fa fa-shipping-fast"></i> Delivery</p>
                                </div>
                                <div class="confirm_btn">
                                    <a href="javascript:void(0)" data-toggle="modal" data-target="#delivery" class="btn btn-sm btn-primary">Delivery</a>
                                </div>
                                </div>
                                @else
                                 <div class="justify-content-between">
                                    <div class="order_confirm_text">
                                        <p><i class="fa fa-check text-primary"></i> Delivery</p>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="tracking_number">
                                                Tracking Number
                                                @if($delivery->tracking)
                                                <p>#{{ $delivery->tracking }}</p>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="dilvery_status">
                                                <p class="d-flex align-items-center">
                                                    @if($delivery->order_status)
                                                    <span class="badge badge-success">
                                                        {{ $delivery->order_status }}
                                                    </span>
                                                    @endif
                                                    <a href="javascript:void(0)" data-toggle="modal" data-target="#changeorderstatus" class="mx-3"><i class="fa fa-edit"></i></a>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="tracking_number">
                                                Shipping Company
                                                @if($delivery->shipping_company)
                                                <p>{{ $delivery->shipping_company }}</p>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="tracking_number">
                                                Last Update

                                                @if($delivery->updated_at)
                                                <p>{{ Cmf::date_format($delivery->updated_at) }}</p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                <div id="deliveryData" style="display: none;">
                                    @if($delivery)
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="tracking_number">
                                                Tracking Number
                                                @if($delivery->tracking)
                                                <p>#{{ $delivery->tracking }}</p>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="dilvery_status">
                                                <p class="d-flex align-items-center">
                                                @if($delivery->order_status)
                                                    <span class="badge badge-success">
                                                        {{ $delivery->order_status }}
                                                    </span>
                                                    @endif
                                                    <a href="javascript:void(0)" data-toggle="modal" data-target="#changeorderstatus" class="mx-3"><i class="fa fa-edit"></i></a>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="tracking_number">
                                                Shipping Company
                                                @if($delivery->shipping_company)
                                                <p>{{ $delivery->shipping_company }}</p>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="tracking_number">
                                                Last Update

                                                @if($delivery->updated_at)
                                                <p>{{ Cmf::date_format($delivery->updated_at) }}</p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mt-5 shadow-lg rounded">
                        <!-- Card Header -->
                        <div class="card-header-custom bg-gradient-primary p-3">
                            <h5 class="mb-0">Customer Information</h5>
                        </div>
                        
                        <!-- Card Body 1: Customer Details -->
                        <div class="card-body-custom border-bottom p-4">
                            <div class="customer_detail">
                                <div class="customer_name mb-3">
                                    <h6 class="mb-1"><i class="fas fa-user-circle text-gradient-primary me-2"></i><b> {{ $data->first_name }} {{ $data->last_name }}</b></h6>
                                </div>
                                <div class="customer_email mb-2">
                                    <i class="fas fa-envelope text-gradient-primary me-2"></i>
                                    <a href="mailto:{{ $data->email }}" class="text-decoration-none">{{ $data->email }}</a>
                                </div>
                                <div class="customer_phone mb-3">
                                    <i class="fas fa-phone-alt text-gradient-primary me-2"></i>
                                    <a href="tel:{{ $data->phonenumber }}" class="text-decoration-none">{{ $data->phonenumber }}</a>
                                </div>
                                <div class="badge bg-gradient-success py-2 px-3">Has an Account</div>
                            </div>
                        </div>
                        
                        <!-- Card Body 2: Shipping Information -->
                        <div class="card-body-custom p-4">
                            <div class="shippinginfo mb-3">
                                <h6 class="text-muted">Shipping Information</h6>
                            </div>
                            <div class="customer_detail">
                                <div class="customer_name mb-2">
                                    <h6 class="mb-0"><i class="fas fa-user-circle text-gradient-primary me-2"></i><b> {{ $data->first_name }} {{ $data->last_name }}</b></h6>
                                </div>
                                <div class="customer_phone mb-2">
                                    <i class="fas fa-phone-alt text-gradient-primary me-2"></i>
                                    <a href="tel:{{ $data->phonenumber }}" class="text-decoration-none">{{ $data->phonenumber }}</a>
                                </div>
                                <div class="customer_email mb-2">
                                    <i class="fas fa-envelope text-gradient-primary me-2"></i>
                                    <a href="mailto:{{ $data->email }}" class="text-decoration-none">{{ $data->email }}</a>
                                </div>
                                <div class="customer_address mb-2">
                                    <i class="fas fa-map-marker-alt text-gradient-primary me-2"></i>
                                    <p class="d-inline">{{ $data->address }}</p>
                                </div>
                                <div class="customer_city mb-2">
                                    <p><i class="fas fa-city text-gradient-primary me-2"></i> {{ $data->city }}</p>
                                </div>
                                <div class="customer_state mb-2">
                                    <p><i class="fas fa-flag text-gradient-primary me-2"></i> {{ $data->state }}</p>
                                </div>
                                <div class="customer_country mb-2">
                                    <p><i class="fas fa-globe text-gradient-primary me-2"></i> {{ $data->country }}</p>
                                </div>
                                <div class="seeonmap mt-3">
                                    <a href="https://www.google.com/maps/search/?api=1&query={{ urlencode($data->address) }}" class="btn-custom btn-map" target="_blank">
                                        <i class="fas fa-map-pin me-1"></i> See on Google Maps
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="changeorderstatus" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="row">
                    <div class="col-md-12">
                        <h5 class="modal-title" id="exampleModalLabel">Update Delivery Status</h5>
                    </div>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <form id="updatedeliveryForm"  enctype="multipart/form-data" method="POST" action="{{ url('admin/orders/updatedeliverystatus') }}">
                @csrf
                @if($delivery)
                @if($delivery->id)
                <input type="hidden" name="id" value="{{ $delivery->id }}">
                <input type="hidden" name="email" value="{{ $delivery->email }}">
                <input type="hidden" name="order_id" value="{{ $delivery->order_id }}">
                @endif
                @endif
                <input type="hidden" name="product_id" value="{{ $data->id }}">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="lable-control">Order Status</label>
                                <select required class="form-control" name="order_status">
                                    @if($delivery)
                                    <option @if($delivery->order_status == 'not_approved') selected @endif value="not_approved">Not approved</option>
                                    <option @if($delivery->order_status == 'approved') selected @endif value="approved">Approved</option>
                                    <option @if($delivery->order_status == 'pending') selected @endif value="pending">Pending</option>
                                    <option @if($delivery->order_status == 'arrange_shipment') selected @endif value="arrange_shipment">Arrange shipment</option>
                                    <option @if($delivery->order_status == 'ready_to_be_shipped_out') selected @endif value="ready_to_be_shipped_out">Ready to be shipped out</option>
                                    <option @if($delivery->order_status == 'picking') selected @endif value="picking">Picking</option>
                                    <option @if($delivery->order_status == 'delay_picking') selected @endif value="delay_picking">Delay picking</option>
                                    <option @if($delivery->order_status == 'picked') selected @endif value="picked">Picked</option>
                                    <option @if($delivery->order_status == 'not_picked') selected @endif value="not_picked">Not picked</option>
                                    <option @if($delivery->order_status == 'delivering') selected @endif value="delivering">Delivering</option>
                                    <option @if($delivery->order_status == 'delivered') selected @endif value="delivered">Delivered</option>
                                    <option @if($delivery->order_status == 'not_delivered') selected @endif value="not_delivered">Not delivered</option>
                                    <option @if($delivery->order_status == 'audited') selected @endif value="audited">Audited</option>
                                    <option @if($delivery->order_status == 'canceled') selected @endif value="canceled">Canceled</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
                    <button type="submit" id="update_delivery" class="btn btn-primary font-weight-bold">Update Delivery Status
                        <span id="update_spinner" class="spinner-border spinner-border-sm" style="display:none;" role="status" aria-hidden="true">
                     </button>
                </div>
            </form>

        </div>
    </div>
</div>
<div class="modal fade" id="delivery" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="row">
                    <div class="col-md-12">
                        <h5 class="modal-title" id="exampleModalLabel">Delivery</h5>
                    </div>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <form class="deliveryform" enctype="multipart/form-data" method="POST" action="{{ url('admin/orders/delivery') }}">
                @csrf
                <input type="hidden" name="product_id" value="{{ $data->id }}">
                <input type="hidden" name="email" value="{{ $data->email }}">
                <input type="hidden" name="order_id" value="{{ $data->id }}">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="lable-control">Select Shipping Company</label>
                                <select class="form-control" id="shipping_company" name="shipping_company">
                                    <option value="">Select Company</option>
                                    @foreach(DB::table('shipping_companies')->where('status' , 1)->get() as $r)
                                    <option value="{{ $r->name }}">{{ $r->name }}</option>
                                    @endforeach 
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="lable-control">Enter Tracking ID #</label>
                                <input name="tracking" required type="text" id="emailfield" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="lable-control">Order Status</label>
                                <select required class="form-control" name="order_status">
                                    <option value="not_approved">Not approved</option>
                                    <option value="approved">Approved</option>
                                    <option value="pending">Pending</option>
                                    <option value="arrange_shipment">Arrange shipment</option>
                                    <option value="ready_to_be_shipped_out">Ready to be shipped out</option>
                                    <option value="picking">Picking</option>
                                    <option value="delay_picking">Delay picking</option>
                                    <option value="picked">Picked</option>
                                    <option value="not_picked">Not picked</option>
                                    <option value="delivering">Delivering</option>
                                    <option value="delivered" selected="">Delivered</option>
                                    <option value="not_delivered">Not delivered</option>
                                    <option value="audited">Audited</option>
                                    <option value="canceled">Canceled</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
                    <button type="submit" id="delivery_btn" class="btn btn-primary font-weight-bold">Delivery
                        <span id="submit_spinner" class="spinner-border spinner-border-sm" style="display:none;" role="status" aria-hidden="true"></span>
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>
<style type="text/css">
    .extra_data td{
        border: 0;
    }
    .data_table td{
        border-top: 0;
        border-bottom: 1px solid #EBEDF3;
    }
    .steps-vertical {
        --bb-steps-dot-offset: 6px;
        flex-direction: column;
    }
    .steps {
        --bb-steps-color: #206bc4;
        --bb-steps-inactive-color: #dce1e7;
        --bb-steps-dot-size: .5rem;
        --bb-steps-border-width: 2px;
        display: flex;
        flex-wrap: nowrap;
        list-style: none;
        margin: 0;
        padding: 0;
        width: 100%;
    }
    .steps-vertical .step-item {
        min-height: auto;
        padding-left: calc(var(--bb-steps-dot-size) + 1rem);
        padding-top: 0;
        text-align: left;
    }
    .step-item {
        color: inherit;
        cursor: default;
        flex: 1 1 0;
        margin-top: 0;
        min-height: 1rem;
        padding-top: calc(var(--bb-steps-dot-size));
        position: relative;
        text-align: center;
    }
    .steps-vertical .step-item:before {
        left: 0;
        top: var(--bb-steps-dot-offset);
        transform: translate(0);
    }
    .step-item:before {
        align-items: center;
        border-radius: 100rem;
        box-sizing: content-box;
        color: #fff;
        content: "";
        display: flex;
        height: var(--bb-steps-dot-size);
        justify-content: center;
        left: 50%;
        position: absolute;
        top: 0;
        transform: translateX(-50%);
        width: var(--bb-steps-dot-size);
        z-index: 1;
    }
    .step-item:after, .step-item:before {
        background: #206bc4;
    }
    .steps-vertical .step-item:not(:last-child):after {
        content: "";
        height: calc(100% + 1rem);
        left: calc(var(--bb-steps-dot-size)* .5);
        position: absolute;
        top: var(--bb-steps-dot-offset);
        transform: translateX(-50%);
        width: var(--bb-steps-border-width);
    }
    .step-item:not(:last-child):after {
        content: "";
        left: 50%;
        position: absolute;
        transform: translateY(-50%);
        width: 100%;
    }
    .step-item:after {
        height: var(--bb-steps-border-width);
        top: calc(var(--bb-steps-dot-size)* .5);
    }
    .select2-container{
        width: 100% !important;
    }
</style>
@endsection
@section('script')
<script>
    function confirmorder(id) {
        var order_id = $('#order_id').val();
        var email_payment = $('#emailpayment').val();
        $('#confirm_btn').prop('disabled', true); // Disable the confirm button
        $('#confirm_spinner').show();
        $.ajax({
            type: 'get',
            url: '{{ url("admin/orders/confirmstatus") }}/' + id,
            data: {
                order_id: order_id,
                email: email_payment,
                _token: '{{ csrf_token() }}'
            },
            success: function(res) {
                $('#order_confirm_text').show();  
                $('#confirmorder').hide();   
                $('#confirm_btn').hide();
            }
        });
    }
    function confirmpayment(id) {
        var order_id = $('#order_id').val();
        var email_payment = $('#emailpayment').val();
        $('#payment_btn').prop('disabled', true); // Disable the payment button
        $('#payment_spinner').show();
        $.ajax({
            type: 'get',
            url: '{{ url("admin/orders/confirmpaymentstatus") }}/' + id,
            data: {
                order_id: order_id,
                email: email_payment,
                _token: '{{ csrf_token() }}'
            },
            success: function(res) {
                $('#confirmpayment').show();  
                $('#pendingpayment').hide();   
                $('#payment_btn').hide();
            }
        });
    }


$('#shipping_company').select2({
    placeholder: "Please Select Shipping Company",
});
</script>
<script type="text/javascript">
    $(document).ready(function() {
    $('.deliveryform').on('submit', function(event) {
        event.preventDefault(); // Prevent default form submission
         $('#submit_spinner').show();
            $('#delivery_btn').prop('disabled', true);
        $.ajax({
            url: $(this).attr('action'), // Use the form's action attribute
            type: 'POST',
            data: $(this).serialize(), // Serialize the form data
            success: function(response) {
                // Assuming the response contains the necessary data
                $('#shippingCompany').text('Shipping Company: ' + $('select[name="shipping_company"] option:selected').text());
                $('#trackingId').text('Tracking ID: ' + $('input[name="tracking"]').val());
                $('#orderStatus').text('Order Status: ' + $('select[name="order_status"] option:selected').text());

                // Show the delivery data and hide the button
                $('#deliveryData').show();
                $('.btn.btn-sm.btn-primary[data-target="#delivery"]').hide();
                
                // Optionally, close the modal if needed
                $('#delivery').modal('hide');
            },
            error: function(xhr) {
                // Handle errors if needed
                console.log(xhr.responseText);
            }
        });
    });
});
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#updatedeliveryForm').on('submit', function() {
            // Show the spinner and disable the submit button
            $('#update_spinner').show();
            $('#update_delivery').prop('disabled', true);
        });
    });
</script>
@endsection