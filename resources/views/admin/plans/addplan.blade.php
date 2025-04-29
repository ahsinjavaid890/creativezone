@extends('admin.layouts.main-layout')
@section('title','Add Plan')
@section('content')
 <!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <div class="d-flex align-items-center flex-wrap mr-2">
                <h5 class="text-blue font-weight-bold mt-2 mb-2 mr-5">
                    Add Plan
                </h5>
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <a href="{{ url('admin/dashboard') }}" class="text-blue font-weight-bold mt-2 mb-2 mr-5">
                    Dashboard
                </a>
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <a href="javascript:void(0)" class="text-dark font-weight-bold mt-2 mb-2 mr-5">
                    Plan Management
                </a>
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <a href="{{ url('admin/plans/allplans') }}" class="text-blue font-weight-bold mt-2 mb-2 mr-5">
                   All Plan
                </a>
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <a href="javascript:void(0)" class="text-dark font-weight-bold mt-2 mb-2 mr-5">
                    Add Plan
                </a>
            </div>
        </div>
    </div>
    <!--end::Subheader-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class=" container-fluid ">
            <!--begin::Card-->

            <div class="row">
                <div class="col-md-12">
                    @include('alerts.index')
                </div>
            </div>
            <form enctype="multipart/form-data" method="POST" action="{{ url('admin/plans/addplan') }}">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-custom">
                            <div class="card-header flex-wrap"> 
                                <h3 class="card-title align-items-start flex-column">
                                    <span class="card-label font-weight-bolder text-dark">Plans Details</span>
                                </h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Plan Name <span class="text-danger">*</span></label>
                                            <input type="text" required placeholder="Plan Name" class="form-control" name="name" id="planName">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Plan Slug <span class="text-danger">*</span></label>
                                            <input type="text" name="slug" readonly required class="form-control" id="planSlug">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Price <span class="text-danger">*</span></label>
                                            <input type="text"  placeholder="Price" class="form-control" name="price" id="price">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                       <div class="form-group">
                                            <label>Select Billing Cycle <span class="text-danger">*</span></label>
                                            <select id="billing_cycle" required class="form-control" name="billing_cycle">
                                                <option value="">Choose Currency</option>
                                                <option value="month">Monthly</option>
                                                <option value="year">Yearly</option>
                                            </select>
                                        </div> 
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Features <span class="text-danger">*</span></label>
                                            <select id="features" required multiple class="form-control" name="features[]">
                                                <option value="">Choose Features</option>
                                                @foreach(DB::table('plan_features')->get() as $f)
                                                <option value="{{ $f->id }}">{{ $f->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Trial Days <span class="text-danger">*</span></label>
                                            <input type="text"  placeholder="Trial Days" class="form-control" name="trial_days" id="trial_days">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Max Event Listings <span class="text-danger">*</span></label>
                                            <input type="text"  placeholder="Max Event Listings" class="form-control" name="max_event_listings" id="max_event_listings" >
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Priority Support<span class="text-danger">*</span></label>
                                            <input type="text" name="priority_support" placeholder="Priority Support" required class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                         <div class="form-group">
                                            <label>Description <span class="text-danger">*</span></label>
                                            <textarea required class="form-control summernote" name="description" rows="4"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary font-weight-bold">Add New Plan</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
@section('script')
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDYUTCpyRfNY8Und6oYaKi5Vkqip7OIWEU&libraries=geometry,places&v=weekly"></script>

<script type="text/javascript">
    $(document).ready(function () {
        // Initialize Select2
        $('#billing_cycle').select2({
            placeholder: "Select Billing Cycle",
            width: '100%',
            allowClear: true
        });
        $('#features').select2({
            placeholder: "Select Features",
            width: '100%',
            allowClear: true
        });
    });
</script>
<script>
    function slugify(text) {
        return text
            .toString()
            .toLowerCase()
            .trim()
            .replace(/\s+/g, '-')           // Replace spaces with -
            .replace(/[^\w\-]+/g, '')       // Remove all non-word chars
            .replace(/\-\-+/g, '-');        // Replace multiple - with single -
    }

    document.getElementById('planName').addEventListener('input', function() {
        const name = this.value;
        const slug = slugify(name);
        document.getElementById('planSlug').value = slug;
    });
</script>
@endsection