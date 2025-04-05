<div class="form-group">
    <input type="text" class="form-control" placeholder="Search Products" id="searchProducts">
    <input type="hidden" value="{{ $collectionid }}" id="collectionid">
</div>
<div id="searchResults"></div>
@if(DB::table('collection_products')->where('collection_id' , $collectionid)->count() > 0)
<div class="list-group list-group-flush list-group-hoverable list-selected-products mt-3">
    <label class="form-label">
        <b>Selected products {{ DB::table('collection_products')->where('collection_id' , $collectionid)->count() }}</b>
    </label>
    @foreach(DB::table('collection_products')->orderby('id' , 'desc')->where('collection_id' , $collectionid)->get() as $r)
    @php
        $product = DB::table('buy_products')->where('id' , $r->product_id)->first();
        $image = DB::table('gallary_images')->where('type' , 'product_buy_small')->where('object_id' , $r->product_id)->first();
    @endphp
    <div class="list-group-item">
        <div class="row align-items-center">
            <div class="col-auto">
                <img width="50" src="{{ url('public/images') }}/{{ $image->image }}">
            </div>
            <div class="col text-truncate">
                <a href="{{ url('admin/ecommerce/editproduct') }}/{{ $r->product_id }}" class="text-body d-block" target="_blank">{{ $product->name }}</a>
                <div class="text-secondary text-truncate"></div>
            </div>
            <div class="col-auto">
                <a href="javascript:void(0)" onclick="removeproductfromcollection({{$r->product_id}} , {{ $collectionid }})" class="text-decoration-none list-group-item-actions btn-trigger-remove-selected-product" title="Delete">
                    <span class="material-symbols-outlined">close</span>
                </a>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endif

<script>
    $(document).ready(function() {
        $('#searchProducts').on('keyup', function() {
            let query = $(this).val();
            if (query.length > 2) {
                $.ajax({
                    url: "{{ url('admin/ecommerce/searchproducts') }}",
                    type: "GET",
                    data: {'query': query,'collectionid': $('#collectionid').val()},
                    success: function(data) {
                        $('#searchResults').html(data);
                    }
                });
            } else {
                $('#searchResults').html('');
            }
        });
    });
    function removeproductfromcollection(productid  , collectionid) {
        $.ajax({
            url: "{{ url('admin/ecommerce/removeproductfromcollection') }}",
            type: "GET",
            data: {'productid': productid,'collectionid': collectionid},
            success: function(data) {
                $('.showcollectionproducts').html(data);
            }
        });
    }
</script>