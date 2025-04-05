@extends('admin.layouts.main-layout')
@section('title','All orders | Orders')
@section('content')
 <!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <div class="d-flex align-items-center flex-wrap mr-2">
                <h5 class="text-blue font-weight-bold mt-2 mb-2 mr-5">
                    All Orders
                </h5>
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <a href="{{ url('admin/dashboard') }}" class="text-blue font-weight-bold mt-2 mb-2 mr-5">
                    Dashboard
                </a>
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <a href="javascript::void(0)" class="text-blue font-weight-bold mt-2 mb-2 mr-5">
                    Service Orders
                </a>
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <a href="javascript:void(0)" class="text-dark font-weight-bold mt-2 mb-2 mr-5">
                    All Order
                </a>
            </div>
        </div>
    </div>
    <!--end::Subheader-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class=" container-fluid ">
            <!--begin::Card-->
            @include('alerts.index')
            <div class="card card-custom mt-5">
                <div class="card-body">
                    <form id="filterForm" method="GET" action="{{ url('admin/orders/serviceorder') }}">
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Customer Name</label>
                                    <input  type="text" class="form-control" name="name" value="{{ request('name') }}">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Parent Service</label>
                                    <select id="filter_parent" name="filter_parent_services" class="form-control">
                                        <option selected="" value="">Choose Parent Service</option>
                                        @foreach(DB::table('services')
                                                ->whereNull('parent_id')
                                                ->get() as $parentService)
                                        <option value="{{ $parentService->id }}" {{ request('filter_parent_services') == $parentService->id ? 'selected' : '' }}>{{ $parentService->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Service</label>
                                    <select id="filter_child" name="filter_child_services" class="form-control">
                                        <option selected="" value="">Choose Service</option>
                                        @foreach(DB::table('services')
                                                ->whereNotNull('parent_id')
                                                ->get() as $childService)
                                        <option value="{{ $childService->id }}" {{ request('filter_child_services') == $childService->id ? 'selected' : '' }}>{{ $childService->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Provider</label>
                                    <select id="filterproviders" name="filter_providers" class="form-control">
                                        <option selected="" value="">Choose Service</option>
                                        @foreach(DB::table('providers')
                                                ->where('status' , 1)
                                                ->get() as $provider)
                                        <option value="{{ $provider->id }}" {{ request('filter_providers') == $provider->id ? 'selected' : '' }}>{{ $provider->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Country</label>
                                   <select id="country" name="country" class="form-control">
                                        <option selected="" value="">Choose country</option>
                                        @foreach(DB::table('countries')->get() as $country)
                                        <option value="{{ $country->code }}" @if($country->code == 'US')selected @elseif(request('country') == $country->code) selected @endif>{{ $country->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Zipcode</label>
                                    <input  type="text" class="form-control" name="pin_code" value="{{ request('pin_code') }}">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Sales Rep</label>
                                    <select class="form-control"  name="user_id" id="salerep">
                                        <option selected="" value="">Select Sales Rep</option>
                                        @foreach(DB::table('users')->get() as $r)
                                        <option  value="{{ $r->id }}" {{ request('user_id') == $r->id ? 'selected' : '' }}>{{ $r->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Unit No</label>
                                    <input type="text" class="form-control" value="{{ request('house_no') }}"  name="house_no">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Install Type</label>
                                    <select name="install_type" class="form-control" id="type">
                                        <option value="">Choose Type</option>
                                        <option value="Self-Install" {{ request('install_type') == 'Self-Install' ? 'selected' : '' }}>Self-Install</option>
                                        <option value="Professional" {{ request('install_type') == 'Professional' ? 'selected' : '' }}>Professional</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Order Status</label>
                                    <select name="order_status" class="form-control" id="order_status">
                                        <option value="">Select Status</option>
                                        <option value="Service request" {{ request('order_status') == 'Service request' ? 'selected' : '' }}>Service request</option>
                                        <option value="Pending" {{ request('order_status') == 'Pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="Completed" {{ request('order_status') == 'Completed' ? 'selected' : '' }}>Completed</option>
                                        <option value="Connected"  {{ request('order_status') == 'Connected' ? 'selected' : '' }}>Connected</option>
                                    </select> 
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Recouncil Status</label>
                                    <select name="reconcil_status" id="reconcil_status" class="form-control">
                                        <option value="">Select Reconcile Status</option>
                                        <option value="Lead" {{ request('reconcil_status') == 'Lead' ? 'selected' : '' }}>Lead</option>
                                        <option value="Pending"   {{ request('reconcil_status') == 'Pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="Installed"  {{ request('reconcil_status') == 'Installed' ? 'selected' : '' }}>Installed</option>
                                        <option value="Dealer Paid"  {{ request('reconcil_status') == 'Dealer Paid' ? 'selected' : '' }}>Dealer Paid</option>
                                        <option value="Dispute Chargeback"  {{ request('reconcil_status') == 'Dispute Chargeback' ? 'selected' : '' }}>Dispute Chargeback</option>
                                        <option value="Connected"  {{ request('reconcil_status') == 'Connected' ? 'selected' : '' }}>Connected</option>
                                        <option value="Rep paid"  {{ request('reconcil_status') == 'Rep paid' ? 'selected' : '' }}>Rep paid</option>
                                        <option value="Rep Chargeback"  {{ request('reconcil_status') == 'Rep Chargeback' ? 'selected' : '' }}>Rep Chargeback</option>
                                    </select> 
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card card-custom mt-5">
                <div class="card-header flex-wrap">
                    <div class="card-title">
                        <a href="{{ url('admin/orders/create-order') }}" class="btn btn-primary font-weight-bolder">
                            Enter Orders
                        </a>
                    </div>
                    <div class="card-toolbar">
                        <a href="javascript::void(0)" class="btn btn-primary font-weight-bolder">
                            Export
                        </a>
                    </div>
                </div>
                <div class="card-body table-responsive" id="table-data">
                    @include('admin.orders.render.serviceorder_table', ['data' => $data])
                </div>
            </div>
            <!--end::Card-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->
</div>
<style type="text/css">
.calendar-icon {
    cursor: pointer;
    margin-left: 8px;
    color: #007bff;
}

.save-icon {
    cursor: pointer;
    margin-left: 8px;
    color: #28a745;
}

.date-picker {
    margin-right: 8px;
}
</style>
@endsection
@section('script')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
function confirmDelete(url) {
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = url;
        }
    })
}
function confirmstatus(url) {
    Swal.fire({
        title: 'Are you sure you Want To Change Status of This Product?',
        text: "If Status is Not Published then This Product Will not show Frontend",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, Change it!'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = url;
        }
    })
}
</script>
<script>
document.querySelectorAll('.calendar-icon').forEach(function(icon) {
    icon.addEventListener('click', function() {
        const td = icon.closest('td');
        const currentDate = td.innerText.trim();
        const isOrderStatus = td.classList.contains('order_status');
        const fieldName = isOrderStatus ? 'order_status_date' : 'recouncil_status_date';
        td.innerHTML = `
            <input type="date" value="${currentDate}" name="${fieldName}" class="date-picker"/>
            <i class="fa fa-check save-icon" aria-hidden="true"></i>
        `;
        const input = td.querySelector('.date-picker');

        input.focus();

        td.querySelector('.save-icon').addEventListener('click', function() {
            const newDate = input.value || currentDate;
            td.innerHTML = `
                ${newDate}
                <i class="fa fa-calendar calendar-icon" aria-hidden="true"></i>
            `;

            updateDateInDatabase(isOrderStatus ? 'order_status' : 'recouncil_status', newDate, td.closest('tr').dataset.orderId);
        });
    });
});
</script>
<script type="text/javascript">
function updateDateInDatabase(statusType, newDate, orderId) {
    $.ajax({
        type: 'POST',
        url: '{{ url("admin/orders/changedate") }}',
        data: {
            order_id: orderId,
            status_type: statusType,
            new_date: newDate,
            _token: '{{ csrf_token() }}' 
        },
        success: function(res) {
            if (res.success) {
                console.log('Date updated successfully');
            } else {
                alert('Error updating the date. Please try again.');
            }
        },
        error: function() {
            alert('Error updating the date. Please try again.');
        }
    });
}

document.getElementById('perPageSelect').addEventListener('change', function() {
    var perPage = this.value;
    var url = new URL(window.location.href);
    url.searchParams.set('per_page', perPage);
    window.location.href = url.toString();
});
</script>
<script type="text/javascript">
    $(document).ready(function () {
        function fetchorder() {
            let formData = $('#filterForm').serialize();
            $.ajax({
                url: "{{ url('admin/orders/serviceorder') }}",
                type: "GET",
                data: formData,
                success: function (data) {
                    $('#table-data').html(data.tableData);
                    let newUrl = "{{ url('admin/orders/serviceorder') }}" + '?' + formData;
                    history.pushState(null, '', newUrl);
                },
                error: function (xhr, status, error) {
                    console.error(error);
                }
            });
        }
        $('#filterForm input, #filterForm select').on('input change', function () {
            fetchorder();
        });
        $('#country, #filter_parent, #filter_child, #filterproviders, #salerep, #type, #order_status, #reconcil_status').select2({
            placeholder: "Select",
            width: '100%',
            allowClear: true
        });
    });
</script>
@endsection