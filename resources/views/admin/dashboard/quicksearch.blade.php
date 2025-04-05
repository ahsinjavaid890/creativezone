<div class="font-size-sm text-primary font-weight-bolder text-uppercase mb-2">Admin Pages</div>
@if($adminpages->count() > 0)
<div class="mb-10">
    @foreach($adminpages as $r)
    <div class="d-flex align-items-center flex-grow-1 mb-2">
        <div class="d-flex flex-column ml-3 mt-2 mb-2">
            <a href="{{ url('') }}/{{ $r->url }}" class="font-weight-bold text-dark text-hover-primary">
            {{ $r->name }}
            </a>
        </div>
    </div>
    @endforeach
</div>
@else
<div class="text-muted">No Admin Pages found</div>
@endif