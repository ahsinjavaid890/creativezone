@foreach($data as $r)
    <tr>
        <td class="text-center pr-0">
            <a href="{{ url('admin/ecommerce/editoberatingsystems') }}/{{ $r->id }}">{{ $r->name }}</a><br>{{ $r->phonenumber }}
        </td>
        <td class="text-center pr-0">
            <a href="{{ url('admin/ecommerce/editoberatingsystems') }}/{{ $r->id }}">{{ $r->address }}</a>
        </td>
        <td class="text-center pr-0"><b>Lattitude :</b> {{ $r->lattitude }}<br>
        <b>Longitude :</b> {{ $r->longitude }}
        </td>
        <td class="text-center pr-0">
            <a href="{{ url('admin/ecommerce/editoberatingsystems') }}/{{ $r->id }}">{{ $r->    timming }}</a>
        </td>
        <td class="text-center pr-0">
            @if($r->status == 1)
            <a href="javascript:void(0)"  onclick='confirmstatus("{{ url('admin/repair/changestatusrepairstore') }}/{{ $r->id }}")'>
                <span class="label label-lg label-success label-inline">Enable</span>
            </a>
            @endif
            @if($r->status == 2)
            <a href="javascript:void(0)"  onclick='confirmDelete("{{ url('admin/repair/changestatusrepairstore') }}/{{ $r->id }}")'>
                <span class="label label-lg label-danger label-inline">Disable</span>
            </a>
            @endif
        </td>
        <td class="text-center pr-0">
           <a href="{{ url('admin/repair/editrepairstore') }}/{{ $r->id }}" class="btn btn-icon btn-light btn-hover-primary btn-sm mx-3">
              <span class="material-symbols-outlined">edit</span>
           </a>
           <a href="javascript:void(0);" onclick='confirmDelete("{{ url('admin/repair/deleterepairstore') }}/{{ $r->id }}")' class="btn btn-icon btn-light btn-hover-primary btn-sm">
              <span class="material-symbols-outlined">delete</span>
            </a>
        </td>
    </tr>
@endforeach