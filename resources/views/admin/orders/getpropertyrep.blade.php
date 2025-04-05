<select id="repselect" name="child_service" required="" class="form-control">
    <option value="">Select Reps</option>
    @foreach($data as $r)
    <option value="{{ $r->id }}">{{ $r->name }}</option>
    @endforeach
</select>