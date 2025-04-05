<table class="table table-bordered">
    <thead>
        <tr>
            <th class="text-center">Product Name</th>
            <th class="text-center">Name</th>
            <th class="text-center">Status</th>
            <th class="text-center">Operations</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $r)
            <tr>
                <td>
                    <a href="{{ url('admin/ecommerce/editshipping') }}/{{ $r->id }}">
                       {{ $r->name }}
                    </a>
                </td>
                <td>
                    <a target="_blank" href="{{ url('admin/ecommerce/editproduct') }}/{{ $r->product_id }}">
                       {{ DB::table('buy_products')->where('id' , $r->product_id)->first()->name }}
                    </a>
                </td>
                <td class="text-center pr-0">
                    @if($r->status == 1)
                    <a href="javascript::void(0)" onclick='confirmstatus("{{ url('admin/ecommerce/changeshipppingstatus') }}/{{ $r->id }}")'>
                    <span class="label label-lg label-success label-inline">Enable</span>
                    </a>
                    @endif
                    @if($r->status == 2)
                    <a href="javascript::void(0)" onclick='confirmstatus("{{ url('admin/ecommerce/changeshipppingstatus') }}/{{ $r->id }}")'>
                    <span class="label label-lg label-danger label-inline">Disable</span>
                    </a>
                    @endif
                </td>
                <td class="text-center pr-0">
                   <a href="{{ url('admin/ecommerce/editshipping') }}/{{ $r->id }}" class="btn btn-icon btn-light btn-hover-primary btn-sm mx-3" >
                         <span class="material-symbols-outlined">edit</span>
                   </a>
                   <a href="javascript::void(0)" onclick='confirmDelete("{{ url('admin/ecommerce/deleteshipping') }}/{{ $r->id }}")' class="btn btn-icon btn-light btn-hover-primary btn-sm mx-3">
                      <span class="material-symbols-outlined">delete</span>
                   </a>
                </td>
            </tr>
        @endforeach
       
    </tbody>
</table>
{!! $data->links('admin.pagination') !!}