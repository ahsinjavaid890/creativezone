 @foreach($data as $r)
    <tr>
        <!-- <td><input type="checkbox" value="{{ $r->id }}" id="product_checkbox" name="product_checkbox"></td> -->
        <td class="text-center">
            @php
                $images = json_decode($r->images);
                $mainImage = $images[0] ?? null;
            @endphp
            @if ($mainImage)
                <img src="{{ url('public/images') }}/{{ $mainImage }}" width="50" height="50">
            @endif
        </td>

        <td class="text-center">
            <a href="{{ url('admin/ecommerce/editacessoriesproduct') }}/{{ $r->id }}">{{ $r->name }}</a>
        </td>
        <td class="text-center">
            @if($r->category_id)
                @if(DB::table('categories')->where('id' , $r->category_id)->first())
                    {{ DB::table('categories')->where('id' , $r->category_id)->first()->name }}
                @endif
            @endif
        </td>
        <td class="text-center">
            @if($r->model)
                @if(DB::table('models')->where('id' , $r->model)->first())
                    {{ DB::table('models')->where('id' , $r->model)->first()->name }}
                @endif
            @endif
        </td>
        <td class="text-center">@if($r->offer_price)${{ $r->offer_price }}@endif</td>
        <td class="text-center">${{ $r->sell_price }}</td>
        <td class="text-center pr-0">
            @if($r->status == 1)
            <a href="javascript::void(0)" onclick='confirmstatus("{{ url('admin/ecommerce/changeaccessoriesproductstatus') }}/{{ $r->id }}")'>
               <span class="label label-lg label-success label-inline">Enable</span>
            </a>
            @endif
            @if($r->status == 2)
            <a href="javascript::void(0)" onclick='confirmstatus("{{ url('admin/ecommerce/changeaccessoriesproductstatus') }}/{{ $r->id }}")'>
               <span class="label label-lg label-danger label-inline">Disable</span>
            </a>
            @endif
        </td>
        <td class="text-center pr-0">
           <div class="dropdown dropdown-inline">
                <a href="#" class="btn btn-icon btn-light btn-hover-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                   <span class="material-symbols-outlined">more_horiz</span>
                </a>
                <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                    <ul class="navi navi-hover">
                        <li class="navi-item">
                            <a href="{{ url('admin/ecommerce/acessoriesreview') }}/{{ $r->id }}" class="navi-link">
                                <span class="navi-text">Accessories Reviews</span>
                            </a>
                        </li>
                        <li class="navi-item">
                            <a href="{{ url('admin/ecommerce/editacessoriesproduct') }}/{{ $r->id }}" class="navi-link">
                                <span class="navi-text">Edit</span>
                            </a>
                        </li>
                        <li class="navi-item">
                            <a href="javascript:void(0);" onclick='confirmDelete("{{ url('admin/ecommerce/deleteacessoriesproduct') }}/{{ $r->id }}")' class="navi-link">
                                <span class="navi-text">Delete</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </td>
    </tr>
@endforeach