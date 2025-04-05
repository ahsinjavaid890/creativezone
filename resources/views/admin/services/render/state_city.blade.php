<div class="row" id="state_city">
    <div class="col-md-12">
       <div class="form-group">
            <label>Select State</label>
            <select multiple id="select_state" name="select_state[]" class="form-control" onchange="selectcity(this.value)">
                @foreach(DB::table('states')->groupby('name')->get() as $s)
                <option value="{{ $s->code }}">{{ $s->name }}</option>
                @endforeach
            </select>
       </div>
    </div> 
    <div class="col-md-12" id="city">
        <div class="form-group">
            <label>Select City</label>
            <select class="form-control" multiple id="city_select" name="city[]">
                
            </select>
        </div>
    </div>
</div>
<script>
$(document).ready(function() {
    $('#select_state').select2({
        placeholder: "Select a state",
        width: '100%'
    });
    
    $('#city_select').select2({
        placeholder: "Select City",
    });
});
</script>