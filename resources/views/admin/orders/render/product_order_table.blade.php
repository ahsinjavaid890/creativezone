@foreach($data as $r)
    <tr>
        <td>
            <span>
                <div class="d-flex align-items-center">
                    <div class="ml-4">
                        <div class="text-dark-75 font-weight-bolder font-size-lg mb-0">{{ $r->first_name }} {{ $r->last_name }}</div>
                        <a href="javascript:void(0)" class="text-muted font-weight-bold text-hover-primary">{{ $r->email }}</a><br>
                        <a href="javascript:void(0)" class="text-muted font-weight-bold text-hover-primary">{{ $r->phonenumber }}</a>
                    </div>
                </div>
            </span>
        </td>
        <td  style="width: 330px;">
            <span >
                <div class="d-flex align-items-center">
                    <div class="ml-4">
                        <div class="text-dark-75 font-weight-bolder font-size-lg mb-0">{{ $r->address }}</div>
                        <a href="javascript:void(0)" class="text-muted font-weight-bold text-hover-primary">{{ $r->zipcode }} , {{ $r->city }} {{ $r->state }} , {{ $r->country }}</a>
                    </div>
                </div>
            </span>
        </td>
        <td class="text-center">${{ number_format($r->total_price, 2) }}</td>
        <td class="text-center">
            @if($r->payment_status == 'paid')
            <span class="label label-lg label-success label-inline">Paid</span>
            @elseif($r->payment_status == 'pending')
            <span class="label label-lg label-light-primary label-inline">Pending</span>
            @else
            <span class="label label-lg label-light-danger label-inline">Failed</span>
            @endif
        </td>
        <td class="text-center">
            @if($r->status == 'completed')
            <span class="label label-lg label-success label-inline">Completed</span>
            @elseif($r->status == 'pending')
            <span class="label label-lg label-light-primary label-inline">Pending</span>
            @else
            <span class="label label-lg label-light-danger label-inline">Cancelled</span>
            @endif
        </td>
        <td class="text-center">
           <a href="{{ url('admin/orders/viewproductorder') }}/{{ $r->id }}" class="btn btn-icon btn-light btn-hover-primary btn-sm mx-3">
              <span class="material-symbols-outlined">visibility</span>
           </a>
           <a href="javascript:void(0);" onclick='confirmDelete("{{ url('admin/orders/deleteproductorder') }}/{{ $r->id }}")' class="btn btn-icon btn-light btn-hover-primary btn-sm">
              <span class="material-symbols-outlined">delete</span>
           </a>
        </td>
    </tr>
    @endforeach