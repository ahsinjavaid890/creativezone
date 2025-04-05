@extends('frontend.layouts.main')
@include('frontend.sections.mettatags')
@section('content')
@section('content')
<style type="text/css">
    .faq .card {
        border: 0;
        border-radius: 16px !important;
        margin-bottom: 5px;
    }
    .first-section-of-page{
        background-color: #f4f7fa;
    }
    .faqlinks ul a{
        border: none !important;
    }
    .faqlinks ul {
        display: block;
        padding: 0;
        margin: 0;
        width: 100%;
        text-align: center;
    }
    .faqlinks li {
        padding: 5px 0 5px 17px;
        cursor: pointer;
    }
</style>
<section class="first-section-of-page">
    <div id="faq" class="container py-5">
        <div class="row faq">
            <div class="col-md-3 pb-4 mb-4 faqlinks">
               <div class="">
                  <div class="card">
                     <div class="card-body p-0">
                        <div class="card-list-heading p-3">
                            <h3 style="color: #2b3481;">Browse by topic</h3>
                            <hr>
                        </div>
                        <ul class="nav nav-tabs" id="nav-tab" role="tablist">
                            <li><a  class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Overview</a></li>
                            <li><a  class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="true">Overview</a></li>
                        </ul>
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-md-9">
                <div class="row">
                    <div class="tab-content" id="nav-tabContent">
                      <div class="tab-pane fade active show" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                            <div class="card">
                                <div class="card-header">
                                <h3>Content's background color is the same for the tab</h3>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                            <div class="card">
                                <div class="card-header">
                                <h3> is the same for the tab</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection