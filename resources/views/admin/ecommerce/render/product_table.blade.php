<table class="table table-bordered">
    <thead>
        <tr>
            <th><input type="checkbox" onclick="toggleCheckboxes(this)"></th>
            <th class="text-center">Image</th>
            <th class="text-center">Tittle</th>
            <th class="text-center">Variations / Stock</th>
            <th class="text-center">Category</th>
            <th class="text-center">Reviews</th>
            <th class="text-center">Brand</th>
            <th class="text-center">Status</th>
            <th class="text-center">Operations</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $r)
            <tr>
                <td><input type="checkbox" value="{{ $r->id }}" id="product_checkbox" name="product_checkbox"></td>
                <td class="text-center">
                    @if(DB::table('gallary_images')->where('object_id' , $r->id)->where('type' , 'product_buy')->first())
                    <img src="{{ url('public/images') }}/{{ DB::table('gallary_images')->where('object_id' , $r->id)->where('type' , 'product_buy')->first()->image }}" width="50" alt="Image">
                    @else
                    <img src="{{ url('public/images/noimage.jpeg') }}" width="50" alt="Image">
                    @endif
                </td>

                <td>
                    <a href="{{ url('admin/ecommerce/editproduct') }}/{{ $r->id }}">
                       {{ Cmf::adminstripAndLimit($r->name) }}
                    </a>
                    <br>
                    <ul style=" margin-bottom: 0; margin-top: 2px; margin-left: 0; padding-left: 20px; ">
                        <li>Product Id : {{ $r->id }}</li>
                        <li>Storage : {{ $r->storage }}</li>
                        <li>Ram : {{ $r->memory_internal }}</li>
                    </ul>
                </td>
                <td class="text-center">
                    {{ DB::table('product_variations')->where('product_id' , $r->id)->count() }} / {{ DB::table('product_variations')->where('product_id' , $r->id)->sum('qty') }}
                </td>
                <td>
                    @if($r->category_id)
                        @if(DB::table('categories')->where('id' , $r->category_id)->first())
                            {{ DB::table('categories')->where('id' , $r->category_id)->first()->name }}
                        @endif
                    @endif
                </td>
                <td> {{ $totalReviews[$r->id] ?? 0 }} Reviews </td>
                <td class="text-center pr-0">{{ $r->brand }}</td>
                @php
                    $product_variation = DB::table('product_variations')->where('id', $r->id)->first();
                    $product_image = DB::table('gallary_images')->where('object_id', $r->id)->first();
                @endphp
                <td class="text-center pr-0">
                    @if($r->status == 1)
                        <a href="javascript:void(0)" onclick='confirmstatus("{{ url('admin/ecommerce/changeproductstatus') }}/{{ $r->id }}")'>
                            <span class="label label-lg label-success label-inline">Enable</span>
                        </a>
                    @elseif($r->status == 2)
                        <a href="javascript:void(0)" onclick='confirmstatus("{{ url('admin/ecommerce/changeproductstatus') }}/{{ $r->id }}")'>
                            <span class="label label-lg label-danger label-inline">Disable</span>
                        </a>
                    @endif
                </td>
                </td>
                <td class="text-center pr-0">
                   <div class="dropdown dropdown-inline">
                        <a href="#" class="btn btn-icon btn-light btn-hover-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                           <span class="material-symbols-outlined">more_horiz</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                            <ul class="navi navi-hover">
                                <li class="navi-item">
                                    <a href="{{ url('admin/ecommerce/productshipping') }}/{{ $r->id }}" class="navi-link">
                                        <span class="navi-text">Product Shipping</span>
                                    </a>
                                </li>
                                <li class="navi-item">
                                    <a href="{{ url('admin/ecommerce/productreview') }}/{{ $r->id }}" class="navi-link">
                                        <span class="navi-text">Product Reviews</span>
                                    </a>
                                </li>
                                <li class="navi-item">
                                    <a href="{{ url('admin/ecommerce/editproduct') }}/{{ $r->id }}" class="navi-link">
                                        <span class="navi-text">Edit</span>
                                    </a>
                                </li>
                                <li class="navi-item">
                                    <a href="javascript:void(0);" onclick='confirmDelete("{{ url('admin/ecommerce/deleteproduct') }}/{{ $r->id }}")' class="navi-link">
                                        <span class="navi-text">Delete</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </td>
            </tr>
        @endforeach
</tbody>
</table>
{!! $data->links('admin.pagination') !!}