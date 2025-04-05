<label>Providers </label>
<select  class="form-control"  name="provider" id="getprovider" onchange="selectproviderservice(this.value)" >
    <option>Select Providers</option>
    @foreach($data as $r)
    <option value="{{ $r->provider_id }}">{{ $r->provider_name }}</option>
    @endforeach
</select>
<script type="text/javascript">
    $('#getprovider').select2({
         placeholder: "Select Providers",
    });
</script>