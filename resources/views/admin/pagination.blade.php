@if ($paginator->hasPages())
<div class="d-flex justify-content-between align-items-center flex-wrap">
    <div class="d-flex flex-wrap py-2 mr-3">
        @php
            // Get the current URL with query parameters, excluding "page"
            $currentUrl = url()->current() . '?' . http_build_query(request()->except('page'));
        @endphp

        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
        <a href="javascript:void(0)" class="btn btn-icon btn-sm btn-light mr-2 my-1" aria-disabled="true">
            <i class="ki ki-bold-arrow-back icon-xs"></i>
        </a>
        @else
        <a href="{{ $currentUrl }}&page={{ $paginator->currentPage() - 1 }}" class="btn btn-icon btn-sm btn-light mr-2 my-1">
            <i class="ki ki-bold-arrow-back icon-xs"></i>
        </a>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
            <a href="javascript:void(0)" class="btn btn-icon btn-sm border-0 btn-light mr-2 my-1">{{ $element }}</a> 
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                    <a href="javascript:void(0)" class="btn btn-icon btn-sm border-0 btn-light btn-hover-primary active mr-2 my-1">{{ $page }}</a>
                    @else
                    <a href="{{ $currentUrl }}&page={{ $page }}" class="btn btn-icon btn-sm border-0 btn-light mr-2 my-1">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
        <a href="{{ $currentUrl }}&page={{ $paginator->currentPage() + 1 }}" class="btn btn-icon btn-sm btn-light mr-2 my-1">
            <i class="ki ki-bold-arrow-next icon-xs"></i>
        </a>
        @else
        <a href="javascript:void(0)" class="btn btn-icon btn-sm btn-light mr-2 my-1" aria-disabled="true">
            <i class="ki ki-bold-arrow-next icon-xs"></i>
        </a>
        @endif
    </div>

    <div class="d-flex align-items-center py-3">
        <form action="{{ url()->current() }}" method="GET" class="d-flex align-items-center">
            {{-- Preserve all query parameters except "page" --}}
            @foreach(request()->except('page') as $key => $value)
                <input type="hidden" name="{{ $key }}" value="{{ $value }}">
            @endforeach

            <select class="form-control form-control-sm font-weight-bold mr-4 border-0 bg-light" style="width: 75px;" name="per_page" onchange="this.form.submit()">
                <option value="50"{{ request('per_page') == 50 ? ' selected' : '' }}>50</option>
                <option value="25"{{ request('per_page') == 25 ? ' selected' : '' }}>25</option>
                <option value="10"{{ request('per_page') == 10 ? ' selected' : '' }}>10</option>
                <option value="20"{{ request('per_page') == 20 ? ' selected' : '' }}>20</option>
                <option value="30"{{ request('per_page') == 30 ? ' selected' : '' }}>30</option>
                <option value="100"{{ request('per_page') == 100 ? ' selected' : '' }}>100</option>
                <option value="200"{{ request('per_page') == 200 ? ' selected' : '' }}>200</option>
                <option value="300"{{ request('per_page') == 300 ? ' selected' : '' }}>300</option>
                <option value="400"{{ request('per_page') == 400 ? ' selected' : '' }}>400</option>
            </select>
        </form>
        <span class="text-muted">Displaying {{ $paginator->count() }} of {{ $paginator->total() }} records</span>
    </div>
</div>
@endif

@if (!$paginator->hasPages())
<div class="d-flex justify-content-between align-items-center flex-wrap">
    <div class="d-flex flex-wrap py-2 mr-3">
        
    </div>
    <div class="d-flex align-items-center py-3">
        <span class="text-muted">Displaying {{ $paginator->count() }} of {{ $paginator->total() }} records</span>
    </div>
</div>
@endif
