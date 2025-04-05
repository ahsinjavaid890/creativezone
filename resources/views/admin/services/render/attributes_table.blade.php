@foreach($data as $r)
<tr data-id="{{ $r->id }}">
   <td class="text-center">{{ $r->name }}</td>
   <td class="text-center">{{ DB::table('services')->where('id' , $r->service_id)->first()->name }}</td>
   <td class="text-center">{{ $r->type }}</td>
   <td class="text-center">
      @foreach(explode(',' , $r->value) as $values)
      {{ $values }}
      @endforeach
   </td>
   <td class="text-center pr-0">
      @if($r->status == 1)
      <a href="javascript::void(0)" onclick='confirmstatus("{{ url('admin/services/changeattributestatus') }}/{{ $r->id }}")'>
         <span class="label label-lg label-success label-inline">Enable</span>
      </a>
      @endif
      @if($r->status == 2)
      <a href="javascript::void(0)" onclick='confirmstatus("{{ url('admin/services/changeattributestatus') }}/{{ $r->id }}")'>
      <span class="label label-lg label-danger label-inline">Disable</span>
      </a>
      @endif
   </td>
   <td class="text-center pr-0">
      <a href="javascript::void(0)" onclick="editattribute({{ $r->id }})"  class="btn btn-icon btn-light btn-hover-primary btn-sm mx-3">
        <span class="material-symbols-outlined">edit</span>
      </a>
      <a href="javascript:void(0);" onclick='confirmDelete("{{ url('admin/services/deleteattribute') }}/{{ $r->id }}")' class="btn btn-icon btn-light btn-hover-primary btn-sm">
        <span class="material-symbols-outlined">delete</span>
      </a>
   </td>
</tr>
@endforeach