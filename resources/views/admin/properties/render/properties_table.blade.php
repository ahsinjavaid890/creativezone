<table class="table table-bordered">
    <thead>
        <tr>
            <th class="text-center">
                <input type="checkbox" name="">
            </th>
            <th class="text-center">Property</th>
            <th class="text-center">Address</th>
            <th class="text-center">Providers & Routes</th>
            <!-- <th class="text-center">Routes</th> -->
            <th class="text-center">Status</th>
            <th class="text-center">Operations</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $r)
        <tr>
            <td class="text-center">
                <input type="checkbox" name="">
            </td>
            <td>
                <a href="{{ url('admin/properties/editproperty') }}/{{ $r->id }}" class="on-default remove-row fixed-side" data-placement="top" data-toggle="tooltip" title="Edit"> {{ $r->property_name }}</a>
                 , {{ $r->no_of_units }} Units <br>
                {{ $r->office_email }} <br> {{ $r->office_phone }}<br>
                <b>Reps:</b>@foreach(DB::table('properties_reps')->where('property_id' , $r->id)->get() as $rep) {{ $rep->name }} @if($loop->last) @else , @endif @endforeach
            </td>
            <td>{{ $r->property_address }},<br>{{ $r->city }}, {{ $r->state }}, {{ $r->zip_code }}, {{ $r->country }}</td>
            @php
                $providerNames = [];
                foreach(explode(',', $r->providers_recommended) as $provider) {
                    $pro = DB::table('providers')->where('id', $provider)->first();
                    if ($pro) {
                        $providerNames[] = $pro->name;
                    }
                }
            @endphp
            <td style="text-transform:capitalize;">

                @if($r->providers_recommended)
               <b>Provider: </b> {{ implode(', ', $providerNames) }}
               @endif
                <br>
                @if($r->route)
                <b>Routes</b>
                    @php
                        $routes = explode(',', $r->route);
                        $totalRoutes = count($routes);
                    @endphp
                    @foreach($routes as $index => $route)
                        {{ $route }} | @if($index < $totalRoutes - 1) @endif
                    @endforeach
                @endif
            </td>
            <td class="text-center pr-0">
                @if($r->status == 1)
                <a href="javascript::void(0)" onclick='confirmstatus("{{ url('admin/properties/changepropertiesstatus') }}/{{ $r->id }}")'>
                    <span class="label label-lg label-success label-inline">Enable</span>
                </a>
                @endif
                @if($r->status == 2)
                <a href="javascript::void(0)" onclick='confirmstatus("{{ url('admin/properties/changepropertiesstatus') }}/{{ $r->id }}")'>
                <span class="label label-lg label-danger label-inline">Disable</span>
                </a>
                @endif
            </td>
            <td class="text-center pr-0">
               <div class="dropdown dropdown-inline">
                    <a href="#" class="btn btn-icon btn-light btn-hover-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                       <span class="material-symbols-outlined">more_horiz</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                        <ul class="navi navi-hover">
                            <li class="navi-item">
                                <a href="https://www.google.com/maps/dir/?api=1&destination={{ $r->property_address }}" class="navi-link" target="_blank">
                                    <span class="navi-text">Direction</span>
                                </a>
                            </li>
                            <li class="navi-item">
                                <a href="https://www.google.com/maps?q={{ $r->property_address }}" class="navi-link"  target="_blank">
                                    <span class="navi-text">Google Map</span>
                                </a>
                            </li>
                            <li class="navi-item">
                                <a href="{{ url('admin/properties/propertienotes') }}/{{ $r->id }}" class="navi-link">
                                    <span class="navi-text">View All Notes</span>
                                </a>
                            </li>
                            <li class="navi-item">
                                <a href="" class="navi-link">
                                    <span class="navi-text">Email Logs</span>
                                </a>
                            </li>
                            <li class="navi-item">
                                <a href="{{ url('admin/properties/editproperty') }}/{{ $r->id }}" class="navi-link">
                                    <span class="navi-text">Edit</span>
                                </a>
                            </li>
                            <li class="navi-item">
                                <a href="javascript:void(0);" onclick='confirmDelete("{{ url('admin/properties/deleteproperty') }}/{{ $r->id }}")' class="navi-link">
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