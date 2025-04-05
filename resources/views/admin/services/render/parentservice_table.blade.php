<table class="table table-bordered">
    <thead>
        <tr>
            <th class="text-center">Parent Service</th>
            <th class="text-center">Total Services</th>
            <th class="text-center">Status</th>
            <th class="text-center">Action</th>
        </tr>
    </thead>
    <tbody>
        @if($data->count())
        @foreach($data as $r)
            @if($r->trashstatus != 1)
            <tr>
                <td class="text-center pr-0">{{ $r->name }}</td>
                @php
                $service = DB::table('services')->where('parent_id', $r->id)->count();
                @endphp
                <td class="text-center pr-0"><a href="{{ url('admin/services/allservices') }}?name=&filter_parent_services={{ $r->id }}&status=">
                    {{ $service }}
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
                    </a>
                </td>
                <td class="text-center pr-0">
                   <a href="{{ url('admin/services/editservicecat') }}/{{ $r->id }}" class="btn btn-icon btn-light btn-hover-primary btn-sm mx-3">
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
            <td colspan="4" class="text-center">
                <div class="alert alert-warning" role="alert">
                    No records found.
                </div>
            </td>
        </tr>
        @endif
    </tbody>
</table>
{!! $data->links('admin.pagination') !!}