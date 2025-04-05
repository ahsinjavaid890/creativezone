@extends('admin.layouts.main-layout')
@section('title','All Questions')
@section('content')
 <!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <div class="d-flex align-items-center flex-wrap mr-2">
                <h5 class="text-blue font-weight-bold mt-2 mb-2 mr-5">
                    All Question Answer
                </h5>
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <a href="{{ url('admin/dashboard') }}" class="text-blue font-weight-bold mt-2 mb-2 mr-5">
                    Dashboard
                </a>
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <a href="{{ url('admin/services/allservices') }}" class="text-blue font-weight-bold mt-2 mb-2 mr-5">
                    All services
                </a>
                @if (!Request::is('admin/services/allquestions'))
                    <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                    <a href="{{ url('admin/services/editservice') }}/{{ $service->id }}" class="text-blue font-weight-bold mt-2 mb-2 mr-5">
                        {{ $service->name }}
                    </a>
                @endif
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <a href="javascript:void(0)" class="text-dark font-weight-bold mt-2 mb-2 mr-5">
                    All Questions
                </a>
            </div>
        </div>
    </div> 
    <!--end::Subheader-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class=" container-fluid ">
            @include('alerts.index')
            @if($data->count() > 0)
            <div class="card card-custom mt-5">
                <div class="card-body">
                @if (!Request::is('admin/services/allquestions'))
                    <form id="filterForm" method="GET" action="{{ url('admin/services/allquestion') }}/{{ $service->id }}">
                @else
                    <form id="filterForm" method="GET" action="{{ url('admin/services/allquestions') }}">
                @endif
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Question</label>
                                    <input type="text" class="form-control" name="question" value="{{ request('question') }}" >
                                </div>
                            </div>
                            <!-- <div class="col-md-4">
                                <div class="form-group">
                                    <label>Service</label>
                                    <select id="filter_child" name="providerservice" class="form-control">
                                        <option selected="" value="">Service</option>
                                        @foreach(DB::table('services')
                                                ->whereNotNull('parent_id')
                                                ->get() as $childService)
                                        <option value="{{ $childService->id }}" {{ request('providerservice') == $childService->id ? 'selected' : '' }}>{{ $childService->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div> -->
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Status</label>
                                    <select id="planstatus" name="status" class="form-control">
                                        <option value="">Status</option>
                                        <option value="1" {{ request('status') == 1 ? 'selected' : '' }}>Enable</option>
                                        <option value="2" {{ request('status') == 2 ? 'selected' : '' }}>Disable</option>
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
                        All Questions
                    </div>
                    @if (!Request::is('admin/services/allquestions'))
                    <div class="card-toolbar">
                        <a href="{{ url('admin/services/askquestion') }}?serviceid={{ $service->id }}" class="btn btn-sm btn-primary font-weight-bolder mr-2">
                            Add
                        </a>
                    </div>
                    @else
                    <div class="card-toolbar">
                        <a href="{{ url('admin/services/askquestion') }}" class="btn btn-sm btn-primary font-weight-bolder mr-2">
                            Add
                        </a>
                    </div>
                    @endif
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-bordered"  id="sortable-table">
                        <thead>
                            <tr>
                                <th class="text-center">Service</th>
                                <th class="text-center">Question</th>
                                <th class="text-center">Question Type</th>
                                <th class="text-center">Answer</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Operations</th>
                            </tr>
                        </thead>
                        <tbody>
                            @include('admin.services.render.question_table', ['data' => $data])
                        </tbody>
                    </table>
                    {!! $data->links('admin.pagination') !!}
                </div>
            </div>
            @else
            <div class="card">
                <div class="card-body">
                   <div class="text-center">
                      <img src="{{ url('public/images/nodata.svg') }}" alt="" width="120" height="120" class="mw-100">
                   </div>
                   <div class="card-px text-center  pt-15 pb-15">
                      <h2 class="fs-2x fw-bold mb-0">All Questions</h2>
                      @if(!Request::is('admin/services/allquestions'))
                      <p class="text-gray-500 fs-4 fw-semibold py-7">Click on the button bellow and create your first Question in {{ $service->name }}.</p>
                      <a  href="{{ url('admin/services/askquestion') }}?serviceid={{ $service->id }}" class="btn btn-primary er fs-6 px-8 py-4">New Question</a>
                      @else
                      <p class="text-gray-500 fs-4 fw-semibold py-7">Click on the button bellow and create your first Question.</p>
                      <a  href="{{ url('admin/services/askquestion') }}" class="btn btn-primary er fs-6 px-8 py-4">New Question</a>
                      @endif
                   </div>
                </div>
             </div>
            @endif
        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->
</div>
<style type="text/css">
    #sortable-table tbody tr{
        cursor: -webkit-grab;
    }
</style>
@endsection

@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.14.0/Sortable.min.js"></script>

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
            title: 'Are you sure you Want To Change Status of This Service Question?',
            text: "If Status is Not Published then This Service Question Will not show Frontend",
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
    document.addEventListener('DOMContentLoaded', function () {
        var sortable = Sortable.create(document.getElementById('sortable-table').querySelector('tbody'), {
            animation: 150,
            onEnd: function (evt) {
                var sortedIDs = Array.from(evt.from.children).map(function (row) {
                    return row.getAttribute('data-id');
                });
                fetch('{{ url('admin/services/updatequestionorder') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ order: sortedIDs })
                }).then(response => response.json())
                  .then(data => {
                  });
            }
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function () {
        function fetchquestion() {
            // Get the form data
            let formData = $('#filterForm').serialize();

            
            @if (!Request::is('admin/services/allquestions'))
                ajaxUrl = "{{ url('admin/services/allquestion') }}/{{ $service->id }}";
            @else
            let ajaxUrl = "{{ url('admin/services/allquestions') }}";
            @endif
            $.ajax({
                url: ajaxUrl,
                type: "GET",
                data: formData,
                success: function (data) {
                    // Replace the table body with new data
                    console.log(data);
                    $('tbody').html(data.tableData);
                    $('.pagination').html(data.paginationLinks);

                    
                    @if (!Request::is('admin/services/allquestions'))
                    let newUrl = "{{ url('admin/services/allquestion') }}/{{ $service->id }}"  + '?' + formData;
                    @else
                    let newUrl = "{{ url('admin/services/allquestions') }}"  + '?' + formData;
                    @endif
                    history.pushState(null, '', newUrl);
                },
                error: function (xhr, status, error) {
                    console.error(error);
                }
            });
        }

        // Attach change event to all inputs/selects in the form
        $('#filterForm input, #filterForm select').on('input change', function () {
            fetchquestion();
        });

        // Initialize Select2
        $('#planstatus').select2({
            placeholder: "Select",
            width: '100%',
            allowClear: true
        });
    });
</script>

@endsection