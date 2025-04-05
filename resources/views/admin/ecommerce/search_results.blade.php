@if($products->isEmpty())
<div class="alert alert-warning" role="alert">
    No products found.
</div>
@else
<div style="box-shadow: 0 2px 10px rgb(0 0 0 / 6%), 0 2px 10px rgb(0 0 0 / 0%);height: 300px;overflow: auto;" class="list-group list-group-flush list-group-hoverable list-selected-products mt-3">
    @foreach($products as $product)
    @php
        $image = DB::table('gallary_images')->where('type' , 'product_buy_small')->where('object_id' , $product->id)->first();
    @endphp
        <div class="list-group-item">
            <div class="row align-items-center">
                <div class="col-auto">
                    @if($image)
                    <img width="50" src="{{ url('public/images') }}/{{ $image->image }}">
                    @endif
                </div>
                <div class="col text-truncate">
                    <a href="javascript:void(0)" onclick="addproductfromcollection({{$product->id}}, {{ $collectionid }})" class="text-body d-block">{{ $product->name }}</a>
                    <div class="text-secondary text-truncate"></div>
                </div>
                <div class="col-auto">
                    <a href="javascript:void(0)" onclick="addproductfromcollection({{$product->id}} , {{ $collectionid }})" class="text-decoration-none list-group-item-actions btn-trigger-remove-selected-product" title="Delete">
                        <span class="material-symbols-outlined">check</span>
                    </a>
                </div>
            </div>
        </div>
    @endforeach
</div>
@endif

<script type="text/javascript">
    function addproductfromcollection(productid , collectionid) {
        $.ajax({
            url: "{{ url('admin/ecommerce/addproductfromcollection') }}",
            type: "GET",
            data: {'productid': productid,'collectionid': collectionid},
            success: function(data) {
                $('.showcollectionproducts').html(data);
            }
        });
    }
</script>