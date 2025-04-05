<div class="card-header flex-wrap">
    <div class="card-title">
        Attributes
    </div>
    <div class="card-toolbar">
        <a href="javascript:void(0) collapsed" data-toggle="modal" data-target="#generateall" class="btn btn-primary font-weight-bolder mr-2 btn-sm">
            Generate All
        </a>
        <a href="javascript:void(0) collapsed" data-toggle="modal" data-target="#importvariations" class="btn btn-primary font-weight-bolder mr-2 btn-sm">
            Add Or Update Via Excel
        </a>
        <a href="{{ url('admin/ecommerce/exportvariations') }}/{{ $product->id }}" class="btn btn-primary font-weight-bolder mr-2 btn-sm">
            Export Variations
        </a>
        <a href="javascript:void(0) collapsed" data-toggle="modal" data-target="#addvariationmodal" class="btn btn-primary font-weight-bolder mr-2 btn-sm">
            Add Variation
        </a>
        @if(DB::table('product_variations')->where('product_id' , $product->id)->exists())
        <a href="javascript:void(0);" onclick='confirmvariationDelete("{{ url('admin/ecommerce/deleteproductvariation') }}/{{ $product->id }}")' class="btn btn-danger font-weight-bolder mr-2 btn-sm">
            Delete Variations
        </a>
        @endif
    </div>
</div>
<div class="card-body table-responsive" style="height: 350px;overflow: auto;">
    <table class="table table-bordered table-responsive">
        <thead>
            <tr>
                <th>ID</th>
                <th>Carrier</th>
                <th>Condition</th>
                <th>Storage</th>
                <th>Color</th>
                <th>Price</th>
                <th>QTY</th>
                <th>Operations</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($variations as $variation)
                <tr>
                    <td>{{ $variation->id }}</td>
                    <td>{{ $variation->best_find }}</td>
                    <td>{{ $variation->condition }}</td>
                    <td>{{ $variation->storage }}</td>
                    <td>{{ $variation->color }}</td>
                    <td>{{ $variation->price }}</td>
                    <td>{{ $variation->qty }}</td>
                    <td>
                        <a href="" class="btn btn-icon btn-light btn-hover-primary btn-sm mx-3">
                            <span class="material-symbols-outlined">edit</span>
                        </a>
                        <a href="" class="btn btn-icon btn-light btn-hover-primary btn-sm">
                            <span class="material-symbols-outlined">delete</span>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>