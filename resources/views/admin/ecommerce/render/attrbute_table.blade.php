<table class="table table-bordered">
    <thead>
        <tr>
            <th class="text-center">Name</th>
            <th class="text-center">Values</th>
            <th class="text-center">Operations</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $r)
            <tr>
                <td class="text-center pr-0">
                    {{ $r->name }}
                </td>
                <td>
                    <ul style="height: 200px; overflow: scroll;">
                        @foreach(DB::table('attribute_values')->where('attribute_id' , $r->id)->get() as $value)
                        <li>{{ $value->value }}</li>
                        @endforeach
                    </ul>
                </td>
                <td class="text-center pr-0">
                   <a href="{{ url('admin/ecommerce/editattributes') }}/{{ $r->id }}" class="btn btn-icon btn-light btn-hover-primary btn-sm mx-3" >
                      <span class="material-symbols-outlined">edit</span>
                   </a>
                   <a href="{{ url('admin/ecommerce/deleteattributes') }}/{{ $r->id }}" class="btn btn-icon btn-light btn-hover-primary btn-sm mx-3">
                      <span class="material-symbols-outlined">delete</span>
                   </a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
{!! $data->links('admin.pagination') !!}