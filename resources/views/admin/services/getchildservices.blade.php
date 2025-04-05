<label>Select Child Service</label>
<select id="childseriveselect" name="childservice" required="" class="form-control">
    <option value="">Select Service</option>
    @foreach($data as $r)
    <option value="{{ $r->id }}">{{ $r->name }}</option>
    @endforeach
</select>
<script type="text/javascript">
    $('#childseriveselect').select2({
        placeholder: "Please Select Shild Service",
    });
</script>