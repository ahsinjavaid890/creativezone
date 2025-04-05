<select id="showplans" name="plan" required="" class="form-control">
    <option value="">Select Plans</option>
    @foreach($email as $r)
    <option value="{{ $r->id }}">{{ $r->name }}</option>
    @endforeach
</select>

