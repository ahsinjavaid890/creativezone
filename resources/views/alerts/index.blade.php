@if(session()->has('message'))
<div class="alert alert-primary alert-dismissible fade show" role="alert" id="session-alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    <strong>Success!</strong> {{ session()->get('message') }}
</div>
@endif 

@if(session()->has('warning'))
<div class="alert alert-warning alert-dismissible fade show" role="alert" id="session-alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    <strong>Warning!</strong> {{ session()->get('warning') }}
</div>
@endif
@if(session()->has('error'))
<div class="alert alert-danger alert-dismissible fade show" role="alert" id="session-alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    <strong>Error!</strong> {{ session()->get('error') }}
</div>
@endif
@if(session()->has('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert" id="session-alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    <strong>Success!</strong> {{ session()->get('cv') }}
</div>
@endif

