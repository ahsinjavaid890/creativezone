<div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <div class="d-flex align-items-center flex-wrap mr-2">
            <h5 class="text-blue font-weight-bold mt-2 mb-2 mr-5">
                EDIT ORDER #{{ $data->id }}
            </h5>
            <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
            <a href="{{ url('admin/dashboard') }}" class="text-blue font-weight-bold mt-2 mb-2 mr-5">
                Dashboard
            </a>
            <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
            <a href="{{ url('admin/ecommerce/orders') }}" class="text-blue font-weight-bold mt-2 mb-2 mr-5">
                Orders
            </a>
            <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
            <a href="javascript:void(0)" class="text-dark font-weight-bold mt-2 mb-2 mr-5">
                EDIT ORDER #{{ $data->id }}
            </a>
        </div>
    </div>
</div>
<div class="d-flex flex-column-fluid">
    <div class=" container-fluid ">
        @include('alerts.index')
        <div class="row">
           <div class="col-md-8">
                <div class="card card-custom mt-5">
                    <div class="card-header flex-wrap"> 
                        <h3 class="card-title align-items-start flex-column">
                            <span class="card-label font-weight-bolder text-dark">Order information : #{{ $data->id }}</span>
                        </h3>
                        <div class="card-toolbar">
                            <span class="label label-lg label-light-warning label-inline" style="text-transform:capitalize;">{{ $data->order_status }}</span>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <tbody>
                                @foreach(DB::table('order_items')->where('order_id' , $data->id)->get() as $r)
                                <tr>
                                    <td class="text-center">
                                        <img src="{{ url('public/images') }}/{{ DB::table('gallary_images')->where('object_id' , $r->product_id)->where('type' , 'product_buy')->first()->image }}" width="50" alt="Image">
                                    </td>
                                    <td>
                                        <a href="{{ url('admin/ecommerce/editproduct') }}/{{ DB::table('buy_products')->where('id' , $r->product_id)->first()->url }}">{{ DB::table('buy_products')->where('id' , $r->product_id)->first()->name }}</a>
                                    </td>
                                    <td class="text-center pr-0">${{ number_format($r->price, 2) }} X {{ $r->quantity }}</td>
                                    <td class="text-center pr-0">${{ number_format($r->price*$r->quantity, 2) }}</td>
                                </tr>
                                @endforeach
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td class="text-center pr-0">Sub Total</td>
                                    <td class="text-center pr-0">${{ number_format($data->subtotal, 2) }}</td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td class="text-center pr-0"><b>Total Amount</b></td>
                                    <td class="text-center pr-0">${{ number_format($data->subtotal, 2) }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <!-- <div class="row p-3 border-bottom border-top d-flex justify-content-between align-items-center">
                            <div class="col-md-8">
                                <h5>Confirm Order</h5>
                            </div>
                            <div class="col-md-4">
                                <button class="btn btn-primary form-control">Confirm Order</button>
                            </div>
                        </div> -->
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-md-6">
                                <button data-toggle="modal" data-target="#updatestatusmodal" class="btn btn-primary">Update Status</button>
                            </div>
                        </div>
                    </div>
                </div>
           </div>
           <div class="col-md-4">
               <div class="card card-custom mt-5">
                    <div class="card-header flex-wrap"> 
                        <h3 class="card-title align-items-start flex-column">
                            <span class="card-label font-weight-bolder text-dark">Customer</span>
                        </h3>
                    </div>
                    <div class="card-body p-0">
                           <div class="p-7">
                              <p class="mb-1 fw-semibold"></p>
                              <p class="mb-1">Don't have an account yet</p>
                           </div>
                           <div class="hr my-1"></div>
                           <div class="p-7">
                              <div class="d-flex justify-content-between align-items-center">
                                 <h4>Shipping information</h4>
                                 <!-- <a class="btn-trigger-update-shipping-address btn-action text-decoration-none" href="javascript:void(0)" data-placement="top" data-bs-toggle="tooltip" data-bs-original-title="Update address">
                                    <svg class="icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                       <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                       <path d="M4 20h4l10.5 -10.5a2.828 2.828 0 1 0 -4 -4l-10.5 10.5v4"></path>
                                       <path d="M13.5 6.5l4 4"></path>
                                    </svg>
                                 </a> -->
                              </div>
                              <dl class="shipping-address-info mb-0">
                                 <dd>{{ $data->name }}</dd>
                                 <dd>
                                    <a href="tel:+923041602002">
                                       <svg class="icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                          <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                          <path d="M5 4h4l2 5l-2.5 1.5a11 11 0 0 0 5 5l1.5 -2.5l5 2v4a2 2 0 0 1 -2 2a16 16 0 0 1 -15 -15a2 2 0 0 1 2 -2"></path>
                                       </svg>
                                       <span dir="ltr">{{ $data->phone }}</span>
                                    </a>
                                 </dd>
                                 <dd><a href="mailto:{{ $data->email }}">{{ $data->email }}</a></dd>
                                 <dd>{{ $data->house_no }}</dd>
                                 <dd>{{ $data->landmark }}</dd>
                                 <dd>{{ $data->city }} , {{ $data->state }}</dd>
                                 <dd>{{ $data->country }}</dd>
                              </dl>
                           </div>
                        </div>
                    <div class="card-footer">
                        <!-- <button class="btn btn-warning form-control">Cancel Order</button> -->
                    </div>
                </div>
           </div> 
        </div>
    </div>
</div>
<div class="modal fade" id="updatestatusmodal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <form id="updateorderstatus" method="POST" action="{{ url('admin/orders/updateorderstatus') }}" class="modal-content">
            @csrf
            <input type="hidden" value="{{ $data->id }}" name="id">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update shipping status</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Status <span class="text-danger">*</span></label>
                    <select class="form-control" name="status" id="status">
                        <option @if($data->order_status == 'Not Approved')  selected @endif value="Not Approved">Not Approved</option>
                        <option @if($data->order_status == 'Approved')  selected @endif  value="Approved">Approved</option>
                        <option @if($data->order_status == 'Pending')  selected @endif  value="Pending">Pending</option>
                        <option @if($data->order_status == 'Arrange shipment')  selected @endif  value="Arrange shipment">Arrange shipment</option>
                        <option @if($data->order_status == 'Ready to be shipped out')  selected @endif  value="Ready to be shipped out">Ready to be shipped out</option>
                        <option @if($data->order_status == 'Picking')  selected @endif  value="Picking">Picking</option>
                        <option @if($data->order_status == 'Delay picking')  selected @endif  value="Delay picking">Delay picking</option>
                        <option @if($data->order_status == 'Picked')  selected @endif  value="Picked">Picked</option>
                        <option @if($data->order_status == 'Not picked')  selected @endif  value="Not picked">Not picked</option>
                        <option @if($data->order_status == 'Delivering')  selected @endif  value="Delivering">Delivering</option>
                        <option @if($data->order_status == 'Delivered')  selected @endif  value="Delivered">Delivered</option>
                        <option @if($data->order_status == 'Not delivered')  selected @endif  value="Not delivered">Not delivered</option>
                        <option @if($data->order_status == 'Audited')  selected @endif  value="Audited">Audited</option>
                        <option @if($data->order_status == 'Canceled')  selected @endif  value="Canceled">Canceled</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
                <button type="submit" id="updatestatusbutton" class="btn btn-primary font-weight-bold">Update</button>
            </div>
        </form>
    </div>
</div>

<script type="text/javascript">
    $('#updateorderstatus').on('submit',(function(e) {
        $('#updatestatusbutton').html('<i class="fa fa-spin fa-spinner"></i>');
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            type:'POST',
            url: $(this).attr('action'),
            data:formData,
            cache:false,
            contentType: false,
            processData: false,
            success: function(data){
                $('#updatestatusmodal').modal('hide');
                orderpagerenew('{{ $data->id }}');
            }
        });
    }));

    function orderpagerenew(id) {
        $.ajax({
            type: "POST",
            url: "{{ url('admin/orders/orderpagerenew') }}",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                id: id
            },
            success: function(res) {
                $('#kt_content').html(res)
            }
        });
    }
</script>