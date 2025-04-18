@extends('admin.layouts.main-layout')
@section('title','View Messages')
@section('content')
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class=" container-fluid ">
            <!--begin::Card-->
            @include('alerts.index')
            <div class="card card-custom mt-5">
                <div class="card-header flex-wrap">
                    <div class="card-title">
                        <h3 class="card-label">
                            View Message
                            <div class="text-muted pt-2 font-size-sm">View Messages</div>
                        </h3>
                    </div>
                </div>
                <div class="card-body">
                    <b>Name</b> : {{$data->name }}<br>
                    <b>Email</b> : {{$data->email}}<br>
                    <b>Phone Number</b> : {{$data->phone}}<br>
                    <b>Subject</b> : {{$data->subject}}<br>
                    <b>Message</b> : {{$data->message}}<br>
                </div>
            </div>
            <!--end::Card-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->
</div>
@endsection