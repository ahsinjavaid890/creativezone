<select id="showplans" name="plan" required="" class="form-control">
    <option value="">Select Plans</option>
    @foreach($data as $r)
    <option value="{{ $r->id }}">{{ $r->planname }}</option>
    @endforeach
</select>

