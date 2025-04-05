<div class="card-body">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label>Community</label>
                <select onchange="selectproperty(this.value)" id="allproperties" class="form-control" name="property">
                    @foreach(DB::table('properties')->where('property_type' , $data->property_type)->get() as $r)
                    <option @if($r->id == $data->id) selected @endif  value="{{ $r->id }}">{{ $r->property_name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-11">
                    <div class="form-group">
                        <label>Community Rep</label>
                        <select class="form-control" name="reps" id="showpropertiesrep">
                            <option value="">Community Reps</option>
                            @foreach(DB::table('properties_reps')->where('property_id' , $data->id)->get() as $r)
                            <option value="{{ $r->id }}">{{ $r->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-1" style="padding: 0; padding-top: 1px !important;">
                    <div class="dropdown dropdown-inline">
                        <a href="#" class="btn btn-icon btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="material-icons add-circle" style="cursor: pointer;">more_vert</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                            <ul class="navi navi-hover">
                                <li class="navi-item">
                                    <a target="_blank" href="{{ url('admin/properties/addproperty') }}" class="navi-link">
                                        <span class="navi-text">Add New Community</span>
                                    </a>
                                </li>
                                <li class="navi-item">
                                    <a target="_blank" href="{{ url('admin/properties/editproperty') }}/{{ $data->id }}" class="navi-link">
                                        <span class="navi-text">Edit Community</span>
                                    </a>
                                </li>
                                <li class="navi-item">
                                    <a target="_blank" href="https://www.google.com/maps?q={{ urlencode($data->property_address) }}" class="navi-link">
                                        <span class="navi-text">Map Location</span>
                                    </a>
                                </li>
                                <li class="navi-item">
                                    <a target="_blank" href="https://www.google.com/maps/dir/?api=1&destination='{{$data->property_address}}'" class="navi-link">
                                        <span class="navi-text">Direction</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
             <span id="apartment_note" style="float: left;font-size: 10px;">{{ $data->location_notes }}  | {{ $data->no_of_units }} | #{{ $data->office_phone }}  | {{ $data->level }} </span>
        </div>
    </div>
</div>

<script type="text/javascript">
function selectproperty(id) {
    $.ajax({
        type: 'get',
        url: '{{ url("admin/orders/selectproperty") }}/'+id,
        success: function(res) {
            $('#refferdby').html(res);   
        }
    });
}
$('#showpropertiesrep').select2({
    placeholder: "Choose Community Rep",
    width: '100%',
    allowClear: true
});
$('#allproperties').select2({
    placeholder: "Choose Community",
    width: '100%',
    allowClear: true
});
</script>