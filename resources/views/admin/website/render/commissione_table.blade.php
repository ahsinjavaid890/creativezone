<table class="table table-bordered">
    <thead>
        <tr>
            <th>Plan Name</th>
            <th>Parent Service</th>
            <th>Service</th>
            <th>Provider</th>
            <th>Country</th>
            <th>Amount</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse($data as $commission)
            <tr>
                <td>{{ $commission->planname }}</td>
                <td>{{ $commission->parent_service_name }}</td>
                <td>
                     @php
                        $serviceIds = explode(',', $commission->service);
                        $services = \App\Models\services::whereIn('id', $serviceIds)->pluck('name')->toArray();
                    @endphp
                    {{ implode(', ', $services) }}
                </td>
                <td>{{ $commission->provider_name }}</td>
                <td>{{ $commission->country_name }}</td>
                <td>${{ number_format($commission->amount, 2) }}</td>
                <td class="text-center ">
                    @if($commission->status == 1)
                    <a href="javascript::void(0)"  onclick='confirmstatus("{{ url('admin/website/settings/changecommissionstatus') }}/{{ $commission->id }}")'>
                        <span class="label label-lg label-success label-inline">Enable</span>
                    </a>
                    @endif
                    @if($commission->status == 2)
                    <a href="javascript::void(0)" onclick='confirmstatus("{{ url('admin/website/settings/changecommissionstatus') }}/{{ $commission->id }}")'>
                        <span class="label label-lg label-danger label-inline">Disable</span>
                    </a>
                    @endif
                </td>
                <td>
                   <a href="javascript:void(0)" onclick="addcommissionmodel({{ $commission->id }})" class="btn btn-icon btn-light btn-hover-primary btn-sm mx-3">
                      <span class="material-symbols-outlined">edit</span>
                   </a>
                   <a href="javascript:void(0);" onclick='confirmDelete("{{ url('admin/website/settings/deletecommission') }}/{{ $commission->id }}")' class="btn btn-icon btn-light btn-hover-primary btn-sm">
                      <span class="material-symbols-outlined">delete</span>
                   </a>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="9" class="text-center">No commissions found.</td>
            </tr>
        @endforelse
    </tbody>
</table>
{!! $data->links('admin.pagination') !!}