<table class="table table-bordered">
    <thead>
        <tr>
            <th class="text-center">Image</th>
            <th class="text-center">Name</th>
            <th class="text-center">Type</th>
            <th class="text-center">Status</th>
            <th class="text-center">Operations</th>
        </tr>
    </thead>
    <tbody>
    @foreach($data as $r)
    <tr>
        <td class="text-center">
            @if($r->image)
            <img src="{{ url('public/images') }}/{{ $r->image }}" width="50" alt="{{ $r->name }}">
            @else
            <img src="{{ url('public/images/no-image.png') }}" width="50" alt="{{ $r->name }}">
            @endif
        </td>
        <td>
            <a href="{{ url('admin/ecommerce/editproductcategories') }}/{{ $r->id }}">{{ $r->name }}</a>
        </td>
        <td class="text-center pr-0" style="text-transform: capitalize;">{{ $r->category_type }}</td>
        <td class="text-center pr-0">
            @if($r->status == 1)
            <a href="javascript::void(0)" onclick='confirmstatus("{{ url('admin/ecommerce/changestatus') }}/{{ $r->id }}")'>
               <span class="label label-lg label-success label-inline">Enalbe</span>
            </a>
            @endif
            @if($r->status == 2)
            <a href="javascript::void(0)" onclick='confirmstatus("{{ url('admin/ecommerce/changestatus') }}/{{ $r->id }}")'>
               <span class="label label-lg label-danger label-inline">Disable</span>
            </a>
            @endif
        </td>
        <td class="text-center pr-0">
            <a href="{{ url('admin/ecommerce/editproductcategories') }}/{{ $r->id }}" class="btn btn-icon btn-light btn-hover-primary btn-sm mx-3" >
                 <span class="material-symbols-outlined">edit</span>
           </a>
           <a href="javascript::void(0)" onclick='confirmDelete("{{ url('admin/ecommerce/deleteproductcategories') }}/{{ $r->id }}")' class="btn btn-icon btn-light btn-hover-primary btn-sm mx-3">
              <span class="material-symbols-outlined">delete</span>
           </a>
        </td>
    </tr>
    @endforeach
    </tbody>
</table>
{!! $data->links('admin.pagination') !!}