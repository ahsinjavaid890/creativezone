<li class="navi-item">
    <a href="{{ url('admin/services/addprovider') }}" class="navi-link" target="_blank">
        <span class="navi-text">Add Provider</span>
    </a>
</li>
<li class="navi-item">
    <a href="javascript:void(0)" onclick="selectchildservice({{ $links->id }})" class="navi-link">
        <span class="navi-text">Available Provider</span>
    </a>
</li>
<li class="navi-item">
    <a href="javascript:void(0)" onclick="allprovider({{ $links->id }})" class="navi-link">
        <span class="navi-text">Not Available Provider</span>
    </a>
</li>
<li class="navi-item" id="weblink">
    <a href="{{ $links->website }}" class="navi-link" target="_blank">
        <span class="navi-text">Website</span>
    </a>
</li>
<li class="navi-item" id="portllink">
    <a href="{{ $links->url }}" class="navi-link"  target="_blank">
        <span class="navi-text">Portal Link</span>
    </a>
</li>
<li class="navi-item">
    <a data-toggle="modal" data-target="#exampleModalSizeXl" href="javascript:void(0)" class="navi-link">
        <span class="navi-text">Provider Notes</span>
    </a>
</li>