@foreach($data as $r)
    <tr>
        <td>
            <span style="width: 250px;">
                <div class="d-flex align-items-center">
                    <div class="ml-4">
                        <div class="text-dark-75 font-weight-bolder font-size-lg mb-0">{{ $r->name }}</div>
                        <a href="javascript:void(0)" class="text-muted font-weight-bold text-hover-primary">{{ $r->email }}</a><br>
                        <a href="javascript:void(0)" class="text-muted font-weight-bold text-hover-primary">{{ $r->phone }}</a>
                    </div>
                </div>
            </span>
        </td>
        <td class="text-center">{{ DB::table('buy_products')->where('id' , $r->product_id)->first()->name }}</td>
        <td class="text-center">
           {{ $r->best_find }}
        </td>
        <td class="text-center">
           {{ $r->condition }}
        </td>
        <td class="text-center">
           {{ $r->storage }}
        </td>
        <td class="text-center">
           {{ $r->color }}
        </td>
        <td class="text-center">
            @if($r->status == '1')
            <a href="javascript:void(0);" onclick='confirmstatus("{{ url('admin/orders/changestatusinquire') }}/{{ $r->id }}")'>
                <span class="label label-lg label-success label-inline">Enable</span>
            </a>
            @elseif($r->status == '2')
            <a href="javascript:void(0);" onclick='confirmstatus("{{ url('admin/orders/changestatusinquire') }}/{{ $r->id }}")'>
                <span class="label label-lg label-danger label-inline">Disable</span>
            </a>
            @endif
        </td>
        <td class="text-center">
           <a href="{{ url('admin/orders/viewproductinquirie') }}/{{ $r->id }}" class="btn btn-icon btn-light btn-hover-primary btn-sm mx-3">
              <span class="material-symbols-outlined">visibility</span>
           </a>
           <a href="javascript:void(0);" onclick='confirmDelete("{{ url('admin/orders/deleteproductinquriy') }}/{{ $r->id }}")' class="btn btn-icon btn-light btn-hover-primary btn-sm">
              <span class="material-symbols-outlined">delete</span>
           </a>
        </td>
    </tr>
    @endforeach