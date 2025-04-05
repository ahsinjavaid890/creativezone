<table class="table table-bordered">
    <thead>
        <tr>
            <th class="text-center">Provider</th>
            <th class="text-center">Country</th>
            <th class="text-center">Parent Service</th>
            <th class="text-center">Service</th>
            <th class="text-center">Service Area</th>
            <th class="text-center">Featured</th>
            <th class="text-center">Provider Page</th>
            <th class="text-center">Status</th>
            <th class="text-center">Operations</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $r)
        <tr>
            <td style="width: 100px;" class="text-center">
                <a href="{{ url('admin/services/editprovider') }}/{{ $r->id }}">{{ $r->name }}</a>
            </td>
            <td style="width: 30px;" class="text-center">{{ $r->country }}</td>
            <td class="text-center">
                @if($r->service){{ DB::table('services')->where('id' , $r->service)->first()->name }} @endif
            </td>
            <td style="width: 100px;" class="text-center">
                @foreach(DB::table('provider_child_services')->where('provider_id' , $r->id)->get() as $c)
                    @php
                        $childService = DB::table('services')->where('id', $c->service_id)->first();
                    @endphp
                    {{ $childService->name ?? 'Unknown Service' }}@if(!$loop->last), @endif
                @endforeach
            </td>
            <td class="text-center">
                @if($r->availability_type == 'zip_code')
                    <a href="{{ url('admin/services/downloadzipcode') }}/{{ $r->id }}">({{ DB::table('provider_zipcodes')->where('provider_id' , $r->id)->count() }}) Zip Code</a>
                @elseif($r->availability_type == 'state_city')

                @elseif($r->availability_type == 'by_location')

                @else
                    Not Selected
                @endif
            </td>
            <td class="text-center">
                @if($r->featured == 1)
                <a href="{{ url('admin/services/changedfeatures') }}/{{ $r->id }}" class="badge badge-primary badge-sm">Yes</a>
                @else
                <a href="{{ url('admin/services/changedfeatures') }}/{{ $r->id }}" class="badge badge-warning badge-sm">No</a>
                @endif
            </td>
            <td class="text-center">
                @if($r->provider_page_status == 1)
                <a href="{{ url('admin/services/changedproviderpage') }}/{{ $r->id }}" class="badge badge-primary badge-sm">Yes</a>
                @else
                <a href="{{ url('admin/services/changedproviderpage') }}/{{ $r->id }}" class="badge badge-warning badge-sm">No</a>
                @endif
            </td>
            <td class="text-center pr-0">
                <a href="javascript::void(0)" onclick='confirmstatus("{{ url('admin/services/changeproviderstatus') }}/{{ $r->id }}")'>
                    @if($r->status == 1)
                    <span class="label label-lg label-success label-inline">Enable</span>
                    @endif
                    @if($r->status == 2)
                    <span class="label label-lg label-danger label-inline">Disable</span>
                    @endif
                    @if($r->status == 3)
                    <span class="label label-lg label-light-warning label-inline">Draft</span>
                    @endif
                </a>
            </td>
            <td class="text-center pr-0">
               <div class="dropdown dropdown-inline">
                    <a href="#" class="btn btn-icon btn-light btn-hover-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                       <span class="material-symbols-outlined">more_horiz</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                        <ul class="navi navi-hover">
                            <li class="navi-item">
                                <a href="{{ url('admin/services/providerfaq') }}/{{ $r->id }}" class="navi-link">
                                    <span class="navi-text">Provider FAQ</span>
                                </a>
                            </li>
                            <li class="navi-item">
                                <a href="{{ url('admin/services/providerreview') }}/{{ $r->id }}" class="navi-link">
                                    <span class="navi-text">Provider Reviews</span>
                                </a>
                            </li>
                            <li class="navi-item">
                                <a href="{{ url('admin/services/editprovider') }}/{{ $r->id }}" class="navi-link">
                                    <span class="navi-text">Edit</span>
                                </a>
                            </li>
                            <li class="navi-item">
                                <a href="javascript:void(0);" onclick='confirmDelete("{{ url('admin/services/deleteprovider') }}/{{ $r->id }}")' class="navi-link">
                                    <span class="navi-text">Delete</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
{!! $data->links('admin.pagination') !!}