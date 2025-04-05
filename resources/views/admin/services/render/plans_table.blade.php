<table class="table table-bordered">
    <thead>
        <tr>
            <th>Plan</th>
            <th>Provider</th>
            <th>Service</th>
            <th style="min-width: 129px;">Attributes</th>
            <th class="text-center">Price</th>
            <th class="text-center">Commission</th>
            <th>Homepage Plan</th>
            <th>Provider Page Plan</th>
            <th class="text-center">Status</th>
            <th class="text-center">Operations</th>
        </tr>
    </thead>
    <tbody>                        
        @foreach($data as $r)
        <tr>
            <td style="width: 250px;">
                <a href="{{ url('admin/services/editplan') }}/{{ $r->id }}">{{ $r->planname }}</a>
            </td>
            <td>
                <a href="{{ url('admin/services/editprovider') }}/{{ $r->provider }}">
                    @if($r->provider)
                        {{ DB::table('providers')->where('id'  ,$r->provider)->first()->name }}
                    @endif
                </a>
            </td>
            <td>
                @if($r->providerservice)
                    @foreach(explode(',' , $r->providerservice) as $childServiceId)
                        @php
                            $childService = DB::table('services')->where('id', $childServiceId)->first();
                        @endphp
                        {{ $childService->name ?? 'Unknown Service' }}@if(!$loop->last), @endif
                    @endforeach
                @endif
            </td>
            <td>
                @php
                    $planatt = DB::table('plan_attributes')->where('plan_id', $r->id)->get();
                @endphp

                <div class="attributes-container">
                    <div class="attributes">
                        @foreach($planatt as $key => $att)
                            @php
                                $attribute = DB::table('attributes')->where('id', $att->attribute_id)->first();
                            @endphp
                            @if($att->value)
                                <span class="attribute-item" style="{{ $key < 3 ? '' : 'display: none;' }}">{{ $att->value }}</span>
                            @endif
                        @endforeach
                    </div>
                    <a class="show-more" href="javascript:void(0)" style="display: {{ count($planatt) > 3 ? 'inline' : 'none' }};">Show More</a>
                    <a class="show-less" href="javascript:void(0)" style="display: none;">Show Less</a>
                </div>
            </td>
            <td>${{ $r->price }}</td>
            <td class="text-center">
                @if(DB::table('commissions')->where('plan' , $r->id)->first())
                    ${{ DB::table('commissions')->where('plan' , $r->id)->first()->amount }}
                @else
                    Not Updated
                @endif
            </td>
            <td class="text-center">
                @if($r->show_on_home_page == 'Yes')
                    <a href="javascript:void(0)" onclick='confirmhomepage("{{ url('admin/services/changeshowonhomepage') }}/{{ $r->id }}")'>
                        <span class="label label-lg label-success label-inline">Yes</span>
                    </a>
                @endif
                @if($r->show_on_home_page == 'No')
                    <a href="javascript:void(0)" onclick='confirmhomepage("{{ url('admin/services/changeshowonhomepage') }}/{{ $r->id }}")'>
                        <span class="label label-lg label-danger label-inline">No</span>
                    </a>
                @endif
            </td>
            <td>
                @if($r->showthisonprovider == 'Yes')
                    <a href="javascript:void(0)"  onclick='confirmprovider("{{ url('admin/services/changesproviderpage') }}/{{ $r->id }}")'>
                        <span class="label label-lg label-success label-inline">Yes</span>
                    </a>
                @endif
                @if($r->showthisonprovider == 'No')
                    <a href="javascript:void(0)"  onclick='confirmprovider("{{ url('admin/services/changesproviderpage') }}/{{ $r->id }}")'>
                        <span class="label label-lg label-danger label-inline">No</span>
                    </a>
                @endif
            </td>
            <td class="text-center">
                @if($r->status == 1)
                    <a href="javascript:void(0)" onclick='confirmstatus("{{ url('admin/services/changeplanstatus') }}/{{ $r->id }}")'>
                        <span class="label label-lg label-success label-inline">Enable</span>
                    </a>
                @endif
                @if($r->status == 2)
                    <a href="javascript:void(0)" onclick='confirmstatus("{{ url('admin/services/changeplanstatus') }}/{{ $r->id }}")'>
                        <span class="label label-lg label-danger label-inline">Disable</span>
                    </a>
                @endif
                @if($r->status == 3)
                    <a href="javascript:void(0)" onclick='confirmstatus("{{ url('admin/services/changeplanstatus') }}/{{ $r->id }}")'>
                        <span class="label label-lg label-light-warning label-inline">Draft</span>
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
                                <a href="{{ url('admin/services/cloneplan') }}/{{ $r->id }}" class="navi-link">
                                    <span class="navi-text">Clone Plan</span>
                                </a>
                            </li>
                            <li class="navi-item">
                                <a href="{{ url('admin/services/editplan') }}/{{ $r->id }}" class="navi-link">
                                    <span class="navi-text">Edit</span>
                                </a>
                            </li>
                            <li class="navi-item">
                                <a href="javascript:void(0);" onclick='confirmDelete("{{ url('admin/services/deleteplan') }}/{{ $r->id }}")' class="navi-link">
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