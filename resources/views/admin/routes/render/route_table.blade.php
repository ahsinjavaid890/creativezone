<table class="table table-bordered">
    <thead>
        <tr>
            <th class="text-center">Name | No of Properties</th>
            <th class="text-center">Starting Point</th>
            <th class="text-center">Last Visiting Date</th>
            <th class="text-center">Last Visited</th>
            <th class="text-center">Total Visits</th>
            <th class="text-center">Next Visit</th>
            <th class="text-center">Total Distance</th>
            <th class="text-center">Status</th>
            <th class="text-center">Operations</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $r)
        <tr>
            <td class="text-center">
                <a href="">{{ $r->name }}</a>
            </td>
            <td class="text-center">{{ $r->starting_point }}</td>
            <td class="text-center">
                @if($r->visitng_date)
                    {{ Cmf::date_format($r->visitng_date) }}
                @endif
            </td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td class="text-center pr-0">
                @if($r->status == 1)
                <span class="label label-lg label-success label-inline">Enable</span>
                @endif
                @if($r->status == 2)
                <span class="label label-lg label-danger label-inline">Disable</span>
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
                                <a href="{{ url('admin/routes/routeproperties') }}/{{ $r->id }}" class="navi-link">
                                    <span class="navi-text">Properties</span>
                                </a>
                            </li>
                            <li class="navi-item">
                                <a href="javascript:void(0);" onclick='confirmstatus("{{ url('admin/routes/routestatus') }}/{{ $r->id }}")' class="navi-link">
                                    <span class="navi-text">Change Status</span>
                                </a>
                            </li>
                            <li class="navi-item">
                                <a href="{{ url('admin/routes/editroute') }}/{{ $r->id }}" class="navi-link">
                                    <span class="navi-text">Edit</span>
                                </a>
                            </li>
                            <li class="navi-item">
                                <a href="javascript:void(0);" onclick='confirmDelete("{{ url('admin/routes/deleteroutes') }}/{{ $r->id }}")' class="navi-link">
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