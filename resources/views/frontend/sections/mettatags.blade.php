@section('tittle')
	@if(isset($mettatags))
	@if($mettatags)
	<title>{{ $mettatags->tittle }}</title>
	<meta name="DC.Title" content="{{ $mettatags->tittle }}">
	<meta name="rating" content="general">
	<meta name="description" content="{{ $mettatags->description }}">
	<meta property="og:type" content="website">
	<meta property="og:image" content="{{ url('public/images') }}/{{ $mettatags->image }}">
	<meta property="og:title" content="{{ $mettatags->tittle }}">
	<meta property="og:description" content="{{ $mettatags->description }}">
	<meta property="og:site_name" content="{{ Cmf::get_store_value('site_name') }}">
	<meta property="og:url" content="{{ URL::current() }}">
	<link rel="canonical" href="{{ URL::current() }}">
	<meta property="og:locale" content="it_IT">
	<meta name="keywords" content="{{ $mettatags->keywords }}">
	@else
	<title>Artist</title>
	<link rel="canonical" href="{{Request::url()}}">
	@endif
	@else
	<title>Artist</title>
	<link rel="canonical" href="{{Request::url()}}">
	@endif
@endsection