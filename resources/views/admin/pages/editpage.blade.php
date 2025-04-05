@extends('admin.layouts.main-layout')
@section('title','Edit Page')
@section('content')
 <!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <div class="d-flex align-items-center flex-wrap mr-2">
                <h5 class="text-blue font-weight-bold mt-2 mb-2 mr-5">
                    Edit Page
                </h5>
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <a href="{{ url('admin/dashboard') }}" class="text-blue font-weight-bold mt-2 mb-2 mr-5">
                    Dashboard
                </a>
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <a href="javascript:void(0)" class="text-dark font-weight-bold mt-2 mb-2 mr-5">
                    Website Settings
                </a>
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <a href="{{ url('admin/pages/all-pages') }}" class="text-blue font-weight-bold mt-2 mb-2 mr-5">
                    All Pages
                </a>
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <a href="javascript:void(0)" class="text-dark font-weight-bold mt-2 mb-2 mr-5">
                    Edit Page : <b class="text-danger">{{ $data->name }}</b>
                </a>
            </div>
        </div>
    </div>
    <style type="text/css">
        .activecard{
            background-color: #1370f2;
        }
        .activecard .card-label{
            color: white !important;
        }
    </style>
    <!--end::Subheader-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class=" container-fluid ">
            @include('alerts.index')
            
            <div class="row">
                <div class="col-md-3">
                    <a href="{{ url('admin/pages/editpage') }}/{{ $data->id }}/basic" class="card @if($type == 'basic') activecard @endif card-custom mt-5">
                        <div class="card-header flex-wrap">
                            <div class="card-title">
                                <h3 class="card-label">
                                    Basic Details
                                </h3>
                            </div>
                        </div>
                    </a>
                    @if($data->name == 'Homepage')
                    <a href="{{ url('admin/pages/editpage') }}/{{ $data->id }}/slider" class="card @if($type == 'slider') activecard @endif card-custom mt-5">
                        <div class="card-header flex-wrap">
                            <div class="card-title">
                                <h3 class="card-label">
                                    Sliders
                                </h3>
                            </div>
                        </div>
                    </a>
                    @endif
                    <a href="{{ url('admin/pages/editpage') }}/{{ $data->id }}/faq" class="card @if($type == 'faq') activecard @endif card-custom mt-5">
                        <div class="card-header flex-wrap">
                            <div class="card-title">
                                <h3 class="card-label">
                                    FAQ
                                </h3>
                            </div>
                        </div>
                    </a>
                    <a href="{{ url('admin/pages/editpage') }}/{{ $data->id }}/blogs" class="card @if($type == 'blogs') activecard @endif card-custom mt-5">
                        <div class="card-header flex-wrap">
                            <div class="card-title">
                                <h3 class="card-label">
                                    Blogs
                                </h3>
                            </div>
                        </div>
                    </a>
                    <a href="{{ url('admin/pages/editpage') }}/{{ $data->id }}/videos" class="card @if($type == 'videos') activecard @endif card-custom mt-5">
                        <div class="card-header flex-wrap">
                            <div class="card-title">
                                <h3 class="card-label">
                                    Videos
                                </h3>
                            </div>
                        </div>
                    </a>
                    <a href="{{ url('admin/pages/editpage') }}/{{ $data->id }}/testimonials" class="card @if($type == 'testimonials') activecard @endif card-custom mt-5">
                        <div class="card-header flex-wrap">
                            <div class="card-title">
                                <h3 class="card-label">
                                    Testimonials
                                </h3>
                            </div>
                        </div>
                    </a>
                    <a href="{{ url('admin/pages/editpage') }}/{{ $data->id }}/meta-tags" class="card @if($type == 'meta-tags') activecard @endif card-custom mt-5">
                        <div class="card-header flex-wrap">
                            <div class="card-title">
                                <h3 class="card-label">
                                    Metta Tags
                                </h3>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-9">
                    @if($type == 'basic')
                    <div class="card card-custom mt-5">
                        <div class="card-header flex-wrap">
                            <div class="card-title">
                                <h3 class="card-label">
                                    Basic Details
                                </h3>
                            </div>
                        </div>
                        <div class="card-body">
                            <form enctype="multipart/form-data" method="POST" action="{{ url('admin/pages/updatepage') }}">
                                @csrf
                                <input type="hidden" value="{{ $data->id }}" name="id">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="lable-control">Name</label>
                                            <input name="name" value="{{ $data->name }}" required type="text" id="emailfield" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="lable-control">URL</label>
                                            <input name="url" value="{{ $data->url }}" type="text" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="lable-control">Content</label>
                                            <textarea rows="10" class="summernote" name="content">{{ $data->Content }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary font-weight-bold">Save</button>
                            </form>
                        </div>
                    </div>
                    @endif
                    @if($type == 'faq')
                    <div class="card card-custom mt-5">
                        <div class="card-header flex-wrap">
                            <div class="card-title">
                                <h3 class="card-label">
                                    FAQ
                                </h3>
                            </div>
                        </div>
                        <div class="card-body">
                           <form method="POST" action="{{ url('admin/pages/faqwanttoshow') }}">
                                @csrf
                                <input type="hidden" name="id" value="{{ $data->id }}">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Want To Show FAQ?</label>
                                            <select onchange="showdisplay(this.value , 'faqcategories')" id="faqwanttoshow" class="form-control" name="faq_show">
                                                <option @if($data->faq_show == 1) selected @endif value="1">Yes</option>
                                                <option @if($data->faq_show == 0) selected @endif value="0">No</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group faqcategories">
                                            <label>Select FAQ Category</label>
                                            <select id="faqcategory" class="form-control" name="faq_cat_id">
                                                <option value="">Select Category</option>
                                                @foreach(DB::table('frequesntlyaskquest_categories')->where('status', 'Published')->get() as $r)
                                                    <option @if($data->faq_cat_id == $r->id) selected @endif value="{{ $r->id }}">{{ $r->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary font-weight-bold">Save</button>
                            </form>
                        </div>
                    </div>
                    @endif
                    @if($type == 'slider')
                    <div class="card card-custom mt-5">
                        <div class="card-header flex-wrap">
                            <div class="card-title">
                                <h3 class="card-label">
                                    Sliders
                                </h3>
                            </div>
                            <div class="card-toolbar">
                                <a href="javascript::void(0)" class="btn btn-primary font-weight-bolder" data-toggle="modal" data-target="#exampleModalScrollable">
                                    <i class="ki ki-plus icon-1x mr-2"></i> Add Slider Image
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Slider Image For Desktop</th>
                                    <th>Slider Image For Mobile</th>
                                    <th>Operation</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach(DB::table('slider_images')->where('object_type' , 'homepage_slider')->where('object_id' , $data->id)->get() as $r)
                                <tr>
                                    <td><img src="{{ url('public/images') }}/{{ $r->slider_image }}" width="100"></td>
                                    <td><img src="{{ url('public/images') }}/{{ $r->slider_image_mobile }}" width="50" height="50"></td>
                                    <td>
                                        <a href="javascript::void(0)" class="btn btn-icon btn-light btn-hover-primary btn-sm" data-toggle="modal" data-target="#editslider{{ $r->id }}">
                                          <span class="material-symbols-outlined">edit</span>
                                       </a>
                                       <a href="javascript:void(0);" onclick='confirmDelete("{{ url('admin/pages/deleteslider') }}/{{ $r->id }}")' class="btn btn-icon btn-light btn-hover-primary btn-sm">
                                          <span class="material-symbols-outlined">delete</span>
                                       </a>
                                        
                                    </td>
                                </tr>


                                <!-- Edit Silder Images -->
                                <div class="modal fade" id="editslider{{ $r->id }}" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <h5 class="modal-title" id="exampleModalLabel">Edit Slider Image</h5>
                                                    </div>
                                                </div>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <i aria-hidden="true" class="ki ki-close"></i>
                                                </button>
                                            </div>
                                            <form method="POST" action="{{ url('admin/pages/editslider') }}" enctype="multipart/form-data">
                                                @csrf
                                                <div class="modal-body">
                                                    <input type="hidden" name="id" value="{{ $r->id }}">
                                                    <input type="hidden" value="{{ $r->object_id }}" name="object_id">
                                                    <input type="hidden" name="object_type" class="form-control" value="homepage_slider">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label>Update Slider Image</label>
                                                                <input type="file" name="slider_image" class="form-control">
                                                                <img src="{{ url('public/images') }}/{{ $r->slider_image }}" class="img-thumbnail mt-2" width="100">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label>Update Slider Image for mobile</label>
                                                                <input type="file" name="slider_image_mobile" class="form-control">
                                                                <img src="{{ url('public/images') }}/{{ $r->slider_image_mobile }}" class="img-thumbnail mt-2" width="100">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <button type="submit" name="submit" class="btn btn-primary font-weight-bold">Save</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </tbody>
                        </table>

                        </div>
                    </div>
                    @endif
                    @if($type == 'blogs')
                    <div class="card card-custom mt-5">
                        <div class="card-header flex-wrap">
                            <div class="card-title">
                                <h3 class="card-label">
                                    Blogs
                                </h3>
                            </div>
                        </div>
                        <div class="card-body">
                           <form method="POST" action="{{ url('admin/pages/blogwanttoshow') }}">
                                @csrf
                                <input type="hidden" name="id" value="{{ $data->id }}">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Want To Show Blog?</label>
                                            <select  onchange="blogshowdisplay(this.value , 'blogcategories')" id="blogwanttoshow" class="form-control" name="blog_show">
                                                <option @if($data->blog_show == 1) selected @endif value="1">Yes</option>
                                                <option @if($data->blog_show == 0) selected @endif value="0">No</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group blogcategories">
                                            <label>Select Blog Category</label>
                                            <select id="blogcategory" class="form-control" name="blog_cat_id">
                                                <option value="">Select Category</option>
                                                @foreach(DB::table('blogcategories')->where('status', 1)->get() as $r)
                                                    <option @if($data->blog_cat_id == $r->id) selected @endif  value="{{ $r->id }}">{{ $r->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary font-weight-bold">Save</button>
                            </form>
                        </div>
                    </div>
                    @endif
                    @if($type == 'videos')
                    <div class="card card-custom mt-5">
                        <div class="card-header flex-wrap">
                            <div class="card-title">
                                <h3 class="card-label">
                                    Videos
                                </h3>
                            </div>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ url('admin/pages/videowanttoshow') }}">
                                @csrf
                                <input type="hidden" name="id" value="{{ $data->id }}">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Want To Show Video?</label>
                                            <select  onchange="videohowdisplay(this.value , 'videocategories')" id="videowanttoshow" class="form-control" name="video_show">
                                                <option @if($data->video_show == 1) selected @endif value="1">Yes</option>
                                                <option @if($data->video_show == 0) selected @endif value="0">No</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group videocategories">
                                            <label>Select Video Category</label>
                                            <select id="videocategory" class="form-control" name="video_cat_id">
                                                <option value="">Select Category</option>
                                                @foreach(DB::table('videocategories')->where('status', 1)->get() as $r)
                                                    <option @if($data->video_cat_id == $r->id) selected @endif  value="{{ $r->id }}">{{ $r->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary font-weight-bold">Save</button>
                            </form>
                        </div>
                    </div>
                    @endif
                    @if($type == 'testimonials')
                    <div class="card card-custom mt-5">
                        <div class="card-header flex-wrap">
                            <div class="card-title">
                                <h3 class="card-label">
                                    Testimonials
                                </h3>
                            </div>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ url('admin/pages/testimonials') }}">
                                @csrf
                                <input type="hidden" name="id" value="{{ $data->id }}">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Want To Show Testimonial?</label>
                                            <select onchange="videohowdisplay(this.value , 'videocategories')" id="videowanttoshow" class="form-control" name="testimonial_show">
                                                <option @if($data->testimonial_show == 1) selected @endif value="1">Yes</option>
                                                <option @if($data->testimonial_show == 0) selected @endif value="0">No</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group videocategories">
                                            <label>Select Testimonial Category</label>
                                            <select multiple id="videocategory" class="form-control" name="testimonials[]">
                                                <option value="">Select Category</option>
                                                @foreach(DB::table('testimonials')->where('status', 1)->get() as $r)
                                                    <option @foreach(explode(',' , $data->testimonials) as $t) @if($t == $r->id) selected @endif  @endforeach value="{{ $r->id }}">{{ $r->name }} ({{ $r->occupation }})</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary font-weight-bold">Save</button>
                            </form>
                        </div>
                    </div>
                    @endif
                    @if($type == 'meta-tags')
                    <div class="card card-custom mt-5">
                        <div class="card-header flex-wrap">
                            <div class="card-title">
                                <h3 class="card-label">
                                    Metta Tags
                                </h3>
                            </div>
                            <div class="card-toolbar">
                                <a href="javascript::void(0)" class="btn btn-primary font-weight-bolder" data-toggle="modal" data-target="#addmetatag">
                                    <i class="ki ki-plus icon-1x mr-2"></i> Add Meta Tags
                                </a>
                            </div>
                        </div>
                        @php
                            $mettatags = DB::table('meta_tags')->where('object_type' , 'pages')->where('object_id' , $data->id)->first();
                        @endphp
                        <div class="card-body">
                            <form method="POST" action="{{ url('admin/pages/addmetatags') }}" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" value="{{ $data->id }}" name="id">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Meta Tittle</label>
                                            <input @if($mettatags) value="{{ $mettatags->tittle }}" @endif type="text" name="tittle" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Meta Description</label>
                                            <textarea class="form-control" rows="3" name="description">@if($mettatags){{ $mettatags->description }} @endif</textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Meta Image</label>
                                            <input type="file" name="image" class="form-control" >
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Meta Keywords</label>
                                            <input @if($mettatags) value="{{ $mettatags->keywords }}" @endif type="text" class="form-control" name="keywords">
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" name="submit" class="btn btn-primary font-weight-bold">Save</button>
                            </form>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->
</div>

<div class="modal fade" id="exampleModalScrollable" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="row">
                    <div class="col-md-12">
                        <h5 class="modal-title" id="exampleModalLabel">Add New Silder Image</h5>
                    </div>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <form method="POST" action="{{ url('admin/pages/addsliderimage') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <input type="hidden" value="{{ $data->id }}" name="object_id">
                    <input type="hidden" name="object_type" class="form-control" value="homepage_slider">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Add Slider Image for desktop</label>
                                <input type="file" name="slider_image" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Add Slider Image for mobile</label>
                                <input type="file" name="slider_image_mobile" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary font-weight-bold">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')
<script type="text/javascript">
    $('#faqwanttoshow').select2({
        placeholder: "Select a Service",
        minimumResultsForSearch: -1
    });
    $('#faqcategory').select2({
        placeholder: "Select a FAQ Category",
    });
    
    $('#blogwanttoshow').select2({
        placeholder: "Select a Service",
        minimumResultsForSearch: -1
    });
    $('#blogcategory').select2({
        placeholder: "Select a Blog Category",
    });
    $('#videowanttoshow').select2({
        placeholder: "Select a Service",
        minimumResultsForSearch: -1
    });
    $('#videocategory').select2({
        placeholder: "Select a Video Category",
    });
</script>
<script type="text/javascript">

    function showdisplay(id , type) {
        if(id == 1)
        {
            $('.'+type).show();
        }else{
            $('.'+type).hide();
        }
    }
    function blogshowdisplay(id , type) {
        if(id == 1)
        {
            $('.'+type).show();
        }else{
            $('.'+type).hide();
        }
    }
    function videohowdisplay(id , type) {
        if(id == 1)
        {
            $('.'+type).show();
        }else{
            $('.'+type).hide();
        }
    }
    $(document).ready(function() {

        var faqwanttoshow = $('#faqwanttoshow').val();
        if(faqwanttoshow == 0)
        {
            $('.faqcategories').hide();
        }

        var blogwanttoshow = $('#blogwanttoshow').val();
        if(blogwanttoshow == 0)
        {
            $('.blogcategories').hide();
        }
        var videowanttoshow = $('#videowanttoshow').val();
        if(videowanttoshow == 0)
        {
            $('.videocategories').hide();
        }
    });
</script>
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
</script>
@endsection