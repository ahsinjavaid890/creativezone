<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Update Stock : {{ DB::table('buy_products')->where('id' , $data->product_id)->first()->name }}</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <i aria-hidden="true" class="ki ki-close"></i>
    </button>
</div>
<div class="modal-body">
    <form id="editStockForm">
        <input type="hidden" class="product_idvalue" value="{{ $data->product_id }}" name="product_id">
        <input type="hidden" class="variation_id" value="{{ $data->id }}" name="variation_id">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Carrier</label>
                    <select class="form-control best_findvalue" onchange="besfind()" name="best_find">
                        @foreach(DB::table('product_variations')->where('product_id' , $data->product_id)->groupby('best_find')->get() as $r)
                        <option @if($data->best_find == $r->best_find) selected @endif value="{{ $r->best_find }}">{{ $r->best_find }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Condition</label>
                    <select class="form-control conditionvalue" onchange="besfind()" name="condition">
                        @foreach(DB::table('product_variations')->where('product_id' , $data->product_id)->groupby('condition')->get() as $r)
                        <option @if($data->condition == $r->condition) selected @endif value="{{ $r->condition }}">{{ $r->condition }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Color</label>
                    <select class="form-control colorvalue" onchange="besfind()" name="color">
                        @foreach(DB::table('product_variations')->where('product_id' , $data->product_id)->groupby('color')->get() as $r)
                        <option @if($data->color == $r->color) selected @endif value="{{ $r->color }}">{{ $r->color }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Storage</label>
                    <select class="form-control storagevalue" onchange="besfind()" name="storage">
                        @foreach(DB::table('product_variations')->where('product_id' , $data->product_id)->groupby('storage')->get() as $r)
                        <option @if($data->storage == $r->storage) selected @endif value="{{ $r->storage }}">{{ $r->storage }}</option>
                         @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Price</label>
                    <input type="text" placeholder="Price" class="form-control" name="price" id="price" value="{{ $data->price }}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>QTY</label>
                    <input type="text" placeholder="Quantity" class="form-control" id="qty" name="qty" value="{{ $data->qty }}">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group text-right">
                    <button type="submit" name="submit" class="btn btn-primary font-weight-bold">Save</button>
                </div>
            </div>
        </div>
    </form>
</div>