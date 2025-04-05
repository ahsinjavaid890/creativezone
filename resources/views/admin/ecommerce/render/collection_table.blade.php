@foreach($data as $r)
    <tr>
        <td class="text-center pr-0">
            <a href="{{ url('admin/ecommerce/editcollection') }}/{{ $r->id }}">{{ $r->name }}</a>
        </td>
        <td class="text-center pr-0">
            {{ $r->collectiontype }}
        </td>
        <td class="text-center pr-0">
            {{ DB::table('collection_products')->where('collection_id' , $r->id)->count() }}
        </td>
        <td class="text-center pr-0" style="text-transform: capitalize;">{{ Cmf::date_format($r->updated_at) }}</td>
        <td class="text-center pr-0">
            @if($r->status == 1)
            <a href="javascript::void(0)" onclick='confirmstatus("{{ url('admin/ecommerce/changecollectionstatus') }}/{{ $r->id }}")'>
            <span class="label label-lg label-success label-inline">Enable</span>
            </a>
            @endif
            @if($r->status == 2)
            <a href="javascript::void(0)" onclick='confirmstatus("{{ url('admin/ecommerce/changecollectionstatus') }}/{{ $r->id }}")'>
            <span class="label label-lg label-danger label-inline">Disable</span>
            </a>
            @endif
        </td>
        <td class="text-center pr-0">
           <a href="{{ url('admin/ecommerce/editcollection') }}/{{ $r->id }}" class="btn btn-icon btn-light btn-hover-primary btn-sm mx-3">
              <span class="material-symbols-outlined">edit</span>
           </a>
           <a href="javascript:void(0);" onclick='confirmDelete("{{ url('admin/ecommerce/deletecollection') }}/{{ $r->id }}")' class="btn btn-icon btn-light btn-hover-primary btn-sm">
              <span class="material-symbols-outlined">delete</span>
           </a>
        </td>
    </tr>
    @endforeach