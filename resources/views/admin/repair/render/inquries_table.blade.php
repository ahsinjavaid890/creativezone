@foreach($data as $r)
    <tr>
        <td class="text-center">
            @foreach(explode(', ', $r->device_problem) as $de)
                {{ $de }} <br>
            @endforeach
        </td>
        <td class="text-center">
            {{ DB::table('models')->where('id' , $r->model_id)->first()->name }}
        </td>
        <td class="text-center">
            {{ $r->repairoption }}
        </td>
        <td class="text-center">
            @if($r->address)
            {{ $r->address }}<br>
            {{ $r->city }}, 
            {{ $r->state }},  
            {{ $r->zipcode }}
            @endif
        </td>
        <td class="text-center">
            @if($r->status == 1)
            <a href="javascript:void(0)"  onclick='confirmstatus("{{ url('admin/repair/changesatusinqurie') }}/{{ $r->id }}")'>
                <span class="label label-lg label-success label-inline">Completed</span>
            </a>
            @endif
            @if($r->status == 0)
            <a href="javascript:void(0)"  onclick='confirmDelete("{{ url('admin/repair/changesatusinqurie') }}/{{ $r->id }}")'>
                <span class="label label-lg label-danger label-inline">Pending</span>
            </a>
            @endif
        </td>
        <td class="text-center">
           <a href="javascript:void(0);" onclick='confirmDelete("{{ url('admin/repair/deleteinqurie') }}/{{ $r->id }}")' class="btn btn-icon btn-light btn-hover-primary btn-sm">
              <span class="material-symbols-outlined">delete</span>
            </a>
        </td>
    </tr>
@endforeach