<table class="table table-bordered">
   <thead>
       <tr>
           <!-- <th><input type="checkbox" onclick="toggleCheckboxes(this)"></th> -->
           <th class="text-center">Product Name</th>
           <th class="text-center">Our Best Find</th>
           <th class="text-center">Condition</th>
           <th class="text-center">Storage</th>
           <th class="text-center">Color</th>
           <th class="text-center">Price</th>
           <th class="text-center">QTY</th>
           <th class="text-center">Operations</th>
       </tr>
   </thead>
   <tbody>
		@foreach($data as $r)
		<tr id="stockRow_{{ $r->id }}">
			<!-- <td><input type="checkbox" class="product-checkbox" value="{{ $r->product_id }}"></td> -->
			<td class="text-center">
				<a href="{{ url('admin/ecommerce/editproduct') }}/{{ $r->product_id }}">
					{{ DB::table('buy_products')->where('id' , $r->product_id)->first()->name }}
				</a>
			</td>
			<td class="text-center">{{ $r->best_find }}</td>
			<td class="text-center">{{ $r->condition }}</td>
			<td class="text-center">{{ $r->storage }}</td>
			<td class="text-center">{{ $r->color }}</td>
			<td class="stock-price text-center">@if($r->price) ${{ $r->price }} @endif</td>
			<td class="stock-quantity text-center">{{ $r->qty }}</td>
			<td class="text-center pr-0">
	           <a href="javascript:void(0);" data-id="{{ $r->id }}" class="btn btn-icon btn-light btn-hover-primary btn-sm mx-3 edit-stock-btn">
				   <span class="material-symbols-outlined">edit</span>
				</a>
	           <a href="javascript::void(0)" onclick='confirmDelete("{{ url('admin/ecommerce/deletestock') }}/{{ $r->id }}")' class="btn btn-icon btn-light btn-hover-primary btn-sm mx-3">
	              <span class="material-symbols-outlined">delete</span>
	           </a>
	        </td>
		</tr>
		@endforeach
   </tbody>
</table>

{!! $data->links('admin.pagination') !!}