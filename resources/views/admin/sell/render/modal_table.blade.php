<table class="table table-bordered">
    <thead>
        <tr>
            <th class="text-center">Image</th>
            <th class="text-center">Name</th>
            <th class="text-center">Sell Category</th>
            <th class="text-center">Status</th>
            <th class="text-center">Operations</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $r)
        <tr>
            <td class="text-center pr-0">
                @if($r->image)
                <img src="{{ url('public/images/') }}/{{ $r->image }}" class="image-thumbnail" width="50">
                @else
                <img src="{{ url('public/images/noimage.jpeg') }}" class="img-thumbnail" width="50">
                @endif
            </td>
            <td class="text-center pr-0">
                <a href="{{ url('admin/ecommerce/editmodal') }}/{{ $r->id }}">{{ $r->name }}</a>
            </td>
            <td class="text-center pr-0">
                @if(DB::table('categories')->where('id' , $r->category_id)->first())
                <a href="{{ url('admin/ecommerce/editproductcategories') }}/{{ $r->category_id }}">{{ DB::table('categories')->where('id' , $r->category_id)->first()->name }}</a>
                @endif
            </td>
            <td class="text-center pr-0">
                @if($r->status == 1)
                <a href="javascript::void(0)"  onclick='confirmstatus("{{ url('admin/ecommerce/changemodalstatus') }}/{{ $r->id }}")'>
                <span class="label label-lg label-success label-inline">Enable</span>
                </a>
                @endif
                @if($r->status == 2)
                <a href="javascript::void(0)"  onclick='confirmstatus("{{ url('admin/ecommerce/changemodalstatus') }}/{{ $r->id }}")'>
                <span class="label label-lg label-danger label-inline">Disable</span>
                </a>
                @endif
            </td>
            <td class="text-center pr-0" style="text-transform: capitalize;">{{ Cmf::date_format($r->updated_at) }}</td>
            <td class="text-center pr-0">
               <a href="{{ url('admin/ecommerce/editmodal') }}/{{ $r->id }}" class="btn btn-icon btn-light btn-hover-primary btn-sm mx-3" >
                     <span class="material-symbols-outlined">edit</span>
               </a>
               <a href="javascript::void(0)" onclick='confirmDelete("{{ url('admin/ecommerce/deletemodal') }}/{{ $r->id }}")' class="btn btn-icon btn-light btn-hover-primary btn-sm mx-3">
                  <span class="material-symbols-outlined">delete</span>
               </a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
    {!! $data->links('admin.pagination') !!}