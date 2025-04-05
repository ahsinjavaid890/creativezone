<table class="table table-bordered">
    <thead>
        <tr>
            <th class="text-center">Services</th>
            <th class="text-center">Parent Service</th>
            <th class="text-center">Ask Questions</th>
            <th class="text-center">Status</th>
            <th class="text-center">Operations</th>
        </tr>
    </thead>
    <tbody>
        @if($data->count())
        @foreach($data as $r)
           @if($r->trashstatus != 1)
           <tr>
             <td class="text-center pr-0">
                 <a href="{{ url('admin/services/editservice') }}/{{ $r->id }}">
                   {!! $r->icon !!}  {{ $r->name }}
                 </a>
             </td>
             <td class="text-center pr-0">@if($r->parent_id){{ DB::table('services')->where('id' , $r->parent_id)->first()->name }}@endif</td>
             <td class="text-center">
                <a href="{{ url('admin/services/allquestion') }}/{{ $r->id }}" class="btn btn-primary btn-light btn-hover-primary btn-sm mx-3">
                 All Questions
                </a>
             </td>
             <td class="text-center pr-0">
                 <a href="javascript::void(0)" onclick='confirmstatus("{{ url('admin/services/changestatus') }}/{{ $r->id }}")'>
                     @if($r->status == 1)
                     <span class="label label-lg label-success label-inline">Enable</span>
                     @endif
                     @if($r->status == 2)
                     <span class="label label-lg label-danger label-inline">Disable</span>
                     @endif
                     @if($r->status == 3)
                     <span class="label label-lg label-light-warning label-inline">Draft</span>
                     @endif
                 </a>
             </td>
             <td class="text-center pr-0">
                <a href="{{ url('admin/services/editservice') }}/{{ $r->id }}" class="btn btn-icon btn-light btn-hover-primary btn-sm mx-3">
                   <span class="material-symbols-outlined">edit</span>
                </a>
                <a href="javascript:void(0);" onclick='confirmDelete("{{ url('admin/services/deleteservice') }}/{{ $r->id }}")' class="btn btn-icon btn-light btn-hover-primary btn-sm">
                   <span class="material-symbols-outlined">delete</span>
                </a>
             </td>
           </tr>
           @endif
        @endforeach
        @else
         <tr>
            <td colspan="5" class="text-center">
                <div class="alert alert-warning" role="alert">
                    No records found.
                </div>
            </td>
        </tr>
        @endif
    </tbody>
</table>
{!! $data->links('admin.pagination') !!}