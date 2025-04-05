@extends('admin.layouts.main-layout')
@section('title','All Questions')
@section('content')
 <!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <div class="d-flex align-items-center flex-wrap mr-2">
                <h5 class="text-blue font-weight-bold mt-2 mb-2 mr-5">
                    All Questions
                </h5>
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <a href="{{ url('admin/dashboard') }}" class="text-blue font-weight-bold mt-2 mb-2 mr-5">
                    Dashboard
                </a>
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <a href="javascript:void(0)" class="text-dark font-weight-bold mt-2 mb-2 mr-5">
                    Sell
                </a>
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
            <!--begin::Card-->
            @include('alerts.index')
            <div class="card card-custom mt-5">
                <div class="card-header flex-wrap"> 
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label font-weight-bolder text-dark">All Questions</span>
                    </h3>
                    <div class="card-toolbar">
                        <a href="{{ url('admin/sell/addnewquestion') }}" class="btn btn-primary font-weight-bolder">
                            <i class="ki ki-plus icon-1x mr-2"></i> Add New Question
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Category</th>
                                <th>Model</th>
                                <th>Question</th>
                                <th>Status</th>
                                <th>Options</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                             @foreach($questions as $question)
                                <tr>
                                    <td class="text-center">{{ DB::table('categories')->where('id' , $question->category_id)->first()->name }}</td>
                                    <td class="text-center">{{ DB::table('models')->where('id' , $question->model_id)->first()->name }}</td>
                                    <td>{{ $question->question_text }}</td>
                                    <td class="text-center">
                                        @if($question->status == 1)
                                        <span class="label label-lg label-success label-inline">Enable</span>
                                        @endif
                                        @if($question->status == 2)
                                        <span class="label label-lg label-danger label-inline">Disable</span>
                                        @endif
                                    </td>
                                    <td>
                                        <ul>
                                            @foreach($question->options as $option)
                                            <li>{{ $option->option_text }} - ${{ $option->price }}</li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td class="text-center">
                                       <a href="{{ url('admin/sell/editquestion') }}/{{ $question->id }}" class="btn btn-icon btn-light btn-hover-primary btn-sm mx-3">
                                          <span class="material-symbols-outlined">edit</span>
                                       </a>
                                       <a href="javascript:void(0);" onclick='confirmDelete("{{ url('admin/sell/deletequestion') }}/{{ $question->id }}")' class="btn btn-icon btn-light btn-hover-primary btn-sm">
                                          <span class="material-symbols-outlined">delete</span>
                                       </a>
                                    </td>
                                </tr>
                                @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!--end::Card-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->
</div>
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
            title: 'Are you sure you Want To Change Status of This Service?',
            text: "If Status is Not Published then This Service Will not show Frontend",
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
@endsection