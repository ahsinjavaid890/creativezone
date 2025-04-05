<table class="table table-bordered">
    <thead>
        <tr>
            <th class="text-center">Date</th>
            <th class="text-center">Customer Name</th>
            <th class="text-center">Services</th>
            <th class="text-center">Community</th>
            <th style="min-width: 137px;" class="text-center">Status</th>
            <th style="min-width: 130px;" class="text-center">Operations</th>
        </tr>
    </thead>
    <tbody>
    @foreach($data as $r)
    <tr>
        @php
            $orderType = DB::table('order_types')->where('id', $r->order_type)->first();
            $type = $orderType ? $orderType->name : ' '; 

            $rep = DB::table('users')->where('id' , $r->user_id)->first();
            $salerep = $rep ? $rep->name : ' ';

            $parentservice = DB::table('services')->wherenull('parent_id')->where('id' , $r->parent_service)->where('trashstatus', '!=', 1)->first();
            $parentServiceName = $parentservice ? $parentservice->name : ' ';

            $getchild = explode(',', $r->child_service);
            $childeservices = DB::table('services')->whereIn('id', $getchild)->get();
            $childServiceNames = $childeservices->pluck('name')->implode(', ') ?: ' ';

            $provider = DB::table('providers')->where('id' , $r->provider)->first();
            $providerName = $provider ? $provider->name : ' ';

            $plan =  DB::table('plans')->where('id' , $r->plan)->first();
            $planName = $plan ? $plan->planname : ' ';

            $communitytype = DB::table('properties')->where('property_type' , $r->property_type)->first();
            $communityTypeName = $communitytype ? $communitytype->property_type : ' ';

            $communityname = DB::table('properties')->where('id' , $r->property)->first();
            $communityName = $communityname ? $communityname->property_name : ' ';

            $reps = DB::table('properties_reps')->where('property_id' , $communityname->id ?? 0)->get();
            $repNames = $reps->pluck('name')->implode(', ') ?: ' ';

            $orderstatus = DB::table('order_statuses')->where('order_id' , $r->id)->get();
        @endphp
        <td class="text-center">
           {{ $type }} <br>
           <a target="_blank" href="{{ url('admin/users/edituser') }}/{{$r->salerep}}">{{ $salerep }}</a><br>
            {{ $r->created_at->format('d/m/Y g:i a') }}
        </td>
        <td>
            <a target="_blank" href="{{ url('admin/orders/editorder') }}/{{ $r->id }}"> {{ $r->name ?? ' ' }} </a>, {{ $r->phone ?? ' ' }} ,{{ $r->address ?? ' ' }} <br>
            {{ $r->pin_code ?? ' ' }} , {{ $country = DB::table('countries')->where('code' , $r->country)->first()->name ?? ' ' }}
        </td>
        <td>
           {{ $parentServiceName }} , {{ $childServiceNames }} , {{ $providerName }} , {{ $planName }} , <br>
           {{ $r->accountno ?? ' ' }}, {{ $r->install_type ?? ' ' }}, {{ $r->instal_date ?? ' ' }}
        </td>
        <td class="text-center pr-0">
            {{ $communityTypeName }} , {{ $communityName }} , {{ $communityname->no_of_units ?? ' ' }} <br>
            {{ $communityname->phone ?? ' ' }}, {{ $repNames }}
        </td>
        <td class="text-center pr-0">
            @if($r->order_status == 'Pending')
            <span class="label label-lg label-light-Danger label-inline">Pending</span>
            @elseif($r->order_status == 'Completed')
            <span class="label label-lg label-light-primary label-inline">Completed</span>
            @elseif($r->order_status == 'Connected')
            <span class="label label-lg label-light-warning label-inline">Connected</span>
            @elseif($r->order_status == 'Service request')
            <span class="label label-lg label-light-warning label-inline">Service request</span>
            @endif  <br>
            <a href="javascript::void(0)" data-toggle="modal" data-target="#orderdate{{ $r->id }}">
                 @if($r->orderdate)
                {{ Cmf::date_format($r->orderdate) }}
                 @else
                 
                @endif
                </a>

                <div class="modal fade" id="orderdate{{ $r->id }}" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Order Status</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <i aria-hidden="true" class="ki ki-close"></i>
                                </button>
                            </div>
                            <div class="modal-body">
                                <table class="table table-bordered">
                                    <tbody>
                                        @foreach($orderstatus as $order)
                                        <tr data-order-id="{{ $order->id }}">
                                            <th>Order Status</th>
                                            <td>{{ $order->order_status }}</td>
                                            <td class="order_status">
                                                {{ $order->order_status_date }}
                                                <i class="fa fa-calendar calendar-icon" aria-hidden="true"></i>
                                            </td>
                                        </tr>
                                        <tr data-order-id="{{ $order->id }}">
                                            <th>Recouncil Status</th>
                                            <td>{{ $order->recouncil_status }}</td>
                                            <td class="recouncil_status">
                                                {{ $order->recouncil_status_date }}
                                                <i class="fa fa-calendar calendar-icon" aria-hidden="true"></i>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </td>
            <td class="text-center pr-0">
               <a href="{{ url('admin/orders/editorder') }}/{{ $r->id }}" class="btn btn-icon btn-light btn-hover-primary btn-sm mx-3">
                  <span class="material-symbols-outlined">edit</span>
               </a>
               <a href="javascript:void(0);" onclick='confirmDelete("{{ url('admin/orders/deleteorder') }}/{{ $r->id }}")' class="btn btn-icon btn-light btn-hover-primary btn-sm">
                  <span class="material-symbols-outlined">delete</span>
               </a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
{!! $data->links('admin.pagination') !!}