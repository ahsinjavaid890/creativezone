@extends('frontend.layouts.main')
@section('tittle')
<title>Dashboard</title>
<link rel="canonical" href="Request::url()">
@endsection
@section('content')
<style type="text/css">
   .user-dashboard .nav-item button{
      width: 100% !important;
   }
   .faq-inner-section-area .user-dashboard ul{
      width: 100% !important;
   }
   .faq-inner-section-area .user-dashboard ul li{
      margin-top: 10px;
   }
   .expovent__count-item {
      background: #5cc99f;
      border-radius: 12px;
      padding: 10px;
   }
   .expovent__count-number {
       color: #ffffff;
       margin-bottom: 10px;
       font-size: 30px;
       font-weight: 700;
   }
   .expovent__count-text {
      color: #ffffff;
/*      border: 1px solid #414141;*/
   }
</style>
<div class="faq-inner-section-area sp1">
   <div class="container">
      <div class="row">
         <div class="col-lg-7 m-auto">
            <div class="heading2 text-center space-margin60">
               @if(Auth::check())
               <h2>HI {{ Auth::guard('artist')->user()->fname }} {{ Auth::guard('artist')->user()->lname }}</h2>
               @endif
            </div>
         </div>
      </div>
      <div class="row">
         <div class="col-lg-3 mr-3">
            <div class="faq-widget-area user-dashboard">
               <ul class="nav nav-pills d-block" id="pills-tab" role="tablist">
                  <li class="nav-item" role="presentation">
                     <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="false" tabindex="-1">Dashboard</button>
                  </li>
                  @if(Auth::guard('artist')->user()->status == 0)
                  @else
                  <li class="nav-item" role="presentation">
                     <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false" tabindex="-1">Portfolio</button>
                  </li>
                  <li class="nav-item" role="presentation">
                     <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false" tabindex="-1">Upload work</button>
                  </li>

                  <li class="nav-item" role="presentation">
                     <button class="nav-link" id="pills-contact1-tab" data-bs-toggle="pill" data-bs-target="#pills-contact1" type="button" role="tab" aria-controls="pills-contact1" aria-selected="false" tabindex="-1">Participate in new job</button>
                  </li>

                  <li class="nav-item" role="presentation">
                     <button class="nav-link m-0" id="pills-contact2-tab" data-bs-toggle="pill" data-bs-target="#pills-contact2" type="button" role="tab" aria-controls="pills-contact2" aria-selected="true">Review results</button>
                  </li>
                  <li class="nav-item" role="presentation">
                     <button class="nav-link m-0" id="pills-contact2-tab" data-bs-toggle="pill" data-bs-target="#pills-contact2" type="button" role="tab" aria-controls="pills-contact2" aria-selected="true">Review other offers</button>
                  </li>
                  <li class="nav-item" role="presentation">
                     <button class="nav-link m-0" id="pills-contact2-tab" data-bs-toggle="pill" data-bs-target="#pills-contact2" type="button" role="tab" aria-controls="pills-contact2" aria-selected="true">History of jobs participation</button>
                  </li>
                  @endif
               </ul>
               <div class="space48"></div>
            </div>
         </div>
         <div class="col-lg-9">
            <div class="faq-widget-area">
               
               <div class="tab-content" id="pills-tabContent" style="background: #F4F4F4;border-radius: 16px; padding: 18px;">
                  <div class="tab-pane fade  active show" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab" tabindex="0">
                     <div class="faq-section-area">
                        <div class="row g-20">

                        @if(Auth::guard('artist')->user()->status == 0)
                          <div class="col-lg-12 mt-3">
                              <div class="expovent__count-item mb-20">
                                  <div class="expovent__count-content">
                                      <span class="expovent__count-text">Your account is pending approval. Please wait for admin approval.</span>
                                  </div>
                              </div>
                          </div>
                        @else
                          <div class="col-lg-6 mt-3">
                              <div class="expovent__count-item mb-20">
                                  <div class="expovent__count-content">
                                      <h3 class="expovent__count-number">1250+</h3>
                                      <span class="expovent__count-text">Total Registration</span>
                                  </div>
                              </div>
                          </div>
                          <div class="col-lg-6 mt-3">
                              <div class="expovent__count-item mb-20">
                                  <div class="expovent__count-thumb include__bg transition-3" ></div>
                                  <div class="expovent__count-content">
                                      <h3 class="expovent__count-number">125+</h3>
                                      <span class="expovent__count-text">Total Speakers</span>
                                  </div>
                              </div>
                          </div>
                          <div class="col-lg-6 mt-3">
                              <div class="expovent__count-item mb-20">
                                  <div class="expovent__count-thumb include__bg transition-3" ></div>
                                  <div class="expovent__count-content">
                                      <h3 class="expovent__count-number">35</h3>
                                      <span class="expovent__count-text">New Events</span>
                                  </div>
                              </div>
                          </div>
                          <div class="col-lg-6 mt-3">
                              <div class="expovent__count-item mb-20">
                                  <div class="expovent__count-thumb include__bg transition-3" ></div>
                                  <div class="expovent__count-content">
                                      <h3 class="expovent__count-number">2560+</h3>
                                      <span class="expovent__count-text">Total Ticket Sold</span>
                                  </div>
                              </div>
                          </div>
                          @endif
                      </div>
                     </div>
                  </div>
                  <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab" tabindex="0">
                     <div class="faq-section-area">
                        <div class="row">
                           <div class="col-lg-6">
                              <div class="accordian-area">
                                 <div class="accordion" id="accordionExample3">
                                    <div class="accordion-item">
                                       <h2 class="accordion-header">
                                          <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseEleven" aria-expanded="true" aria-controls="collapseEleven">What is Eventify, and who is it for?</button>
                                       </h2>
                                       <div id="collapseEleven" class="accordion-collapse collapse show" data-bs-parent="#accordionExample3">
                                          <div class="accordion-body">
                                             <p>Eventify 2024 will be held on 26 at USA , located in New York. Full event details, including timings and venue information, will be provided after registration.</p>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="space20"></div>
                                    <div class="accordion-item">
                                       <h2 class="accordion-header">
                                          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwelve" aria-expanded="false" aria-controls="collapseTwelve">When and where is Eventify 2024 taking place?</button>
                                       </h2>
                                       <div id="collapseTwelve" class="accordion-collapse collapse" data-bs-parent="#accordionExample3">
                                          <div class="accordion-body">
                                             <p>Eventify 2024 will be held on 26 at USA , located in New York. Full event details, including timings and venue information, will be provided after registration.</p>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="space20"></div>
                                    <div class="accordion-item">
                                       <h2 class="accordion-header">
                                          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThirteen" aria-expanded="false" aria-controls="collapseThirteen">How much does it cost to attend Eventify 2024?</button>
                                       </h2>
                                       <div id="collapseThirteen" class="accordion-collapse collapse" data-bs-parent="#accordionExample3">
                                          <div class="accordion-body">
                                             <p>Eventify 2024 will be held on 26 at USA , located in New York. Full event details, including timings and venue information, will be provided after registration.</p>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="space20"></div>
                                    <div class="accordion-item">
                                       <h2 class="accordion-header">
                                          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFourteen" aria-expanded="false" aria-controls="collapseFourteen">Will there be networking opportunities Eventify?</button>
                                       </h2>
                                       <div id="collapseFourteen" class="accordion-collapse collapse" data-bs-parent="#accordionExample3">
                                          <div class="accordion-body">
                                             <p>Eventify 2024 will be held on 26 at USA , located in New York. Full event details, including timings and venue information, will be provided after registration.</p>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="space20"></div>
                                    <div class="accordion-item">
                                       <h2 class="accordion-header">
                                          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFifteen" aria-expanded="false" aria-controls="collapseFifteen">How can I access session materials after event?</button>
                                       </h2>
                                       <div id="collapseFifteen" class="accordion-collapse collapse" data-bs-parent="#accordionExample3">
                                          <div class="accordion-body">
                                             <p>Eventify 2024 will be held on 26 at USA , located in New York. Full event details, including timings and venue information, will be provided after registration.</p>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>

                           <div class="col-lg-6">
                              <div class="accordian-area">
                                 <div class="accordion" id="accordionExample4">
                                    <div class="accordion-item">
                                       <h2 class="accordion-header">
                                          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThirtysix" aria-expanded="true" aria-controls="collapseThirtysix">What is Eventify, and who is it for?</button>
                                       </h2>
                                       <div id="collapseThirtysix" class="accordion-collapse collapse" data-bs-parent="#accordionExample4">
                                          <div class="accordion-body">
                                             <p>Eventify 2024 will be held on 26 at USA , located in New York. Full event details, including timings and venue information, will be provided after registration.</p>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="space20"></div>
                                    <div class="accordion-item">
                                       <h2 class="accordion-header">
                                          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThirtyseven" aria-expanded="false" aria-controls="collapseThirtyseven">When and where is Eventify 2024 taking place?</button>
                                       </h2>
                                       <div id="collapseThirtyseven" class="accordion-collapse collapse" data-bs-parent="#accordionExample4">
                                          <div class="accordion-body">
                                             <p>Eventify 2024 will be held on 26 at USA , located in New York. Full event details, including timings and venue information, will be provided after registration.</p>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="space20"></div>
                                    <div class="accordion-item">
                                       <h2 class="accordion-header">
                                          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThirtyeight" aria-expanded="false" aria-controls="collapseThirtyeight">How much does it cost to attend Eventify 2024?</button>
                                       </h2>
                                       <div id="collapseThirtyeight" class="accordion-collapse collapse" data-bs-parent="#accordionExample4">
                                          <div class="accordion-body">
                                             <p>Eventify 2024 will be held on 26 at USA , located in New York. Full event details, including timings and venue information, will be provided after registration.</p>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="space20"></div>
                                    <div class="accordion-item">
                                       <h2 class="accordion-header">
                                          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThirtynine" aria-expanded="false" aria-controls="collapseThirtynine">Will there be networking opportunities Eventify?</button>
                                       </h2>
                                       <div id="collapseThirtynine" class="accordion-collapse collapse" data-bs-parent="#accordionExample4">
                                          <div class="accordion-body">
                                             <p>Eventify 2024 will be held on 26 at USA , located in New York. Full event details, including timings and venue information, will be provided after registration.</p>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="space20"></div>
                                    <div class="accordion-item">
                                       <h2 class="accordion-header">
                                          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFourty" aria-expanded="false" aria-controls="collapseFourty">How can I access session materials after event?</button>
                                       </h2>
                                       <div id="collapseFourty" class="accordion-collapse collapse" data-bs-parent="#accordionExample4">
                                          <div class="accordion-body">
                                             <p>Eventify 2024 will be held on 26 at USA , located in New York. Full event details, including timings and venue information, will be provided after registration.</p>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab" tabindex="0">
                     <div class="faq-section-area">
                        <div class="row">
                           <div class="col-lg-6">
                              <div class="accordian-area">
                                 <div class="accordion" id="accordionExample5">
                                    <div class="accordion-item">
                                       <h2 class="accordion-header">
                                          <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSixteen" aria-expanded="true" aria-controls="collapseSixteen">What is Eventify, and who is it for?</button>
                                       </h2>
                                       <div id="collapseSixteen" class="accordion-collapse collapse show" data-bs-parent="#accordionExample5">
                                          <div class="accordion-body">
                                             <p>Eventify 2024 will be held on 26 at USA , located in New York. Full event details, including timings and venue information, will be provided after registration.</p>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="space20"></div>
                                    <div class="accordion-item">
                                       <h2 class="accordion-header">
                                          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSeventeen" aria-expanded="false" aria-controls="collapseSeventeen">When and where is Eventify 2024 taking place?</button>
                                       </h2>
                                       <div id="collapseSeventeen" class="accordion-collapse collapse" data-bs-parent="#accordionExample5">
                                          <div class="accordion-body">
                                             <p>Eventify 2024 will be held on 26 at USA , located in New York. Full event details, including timings and venue information, will be provided after registration.</p>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="space20"></div>
                                    <div class="accordion-item">
                                       <h2 class="accordion-header">
                                          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseEightteen" aria-expanded="false" aria-controls="collapseEightteen">How much does it cost to attend Eventify 2024?</button>
                                       </h2>
                                       <div id="collapseEightteen" class="accordion-collapse collapse" data-bs-parent="#accordionExample5">
                                          <div class="accordion-body">
                                             <p>Eventify 2024 will be held on 26 at USA , located in New York. Full event details, including timings and venue information, will be provided after registration.</p>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="space20"></div>
                                    <div class="accordion-item">
                                       <h2 class="accordion-header">
                                          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseNineteen" aria-expanded="false" aria-controls="collapseNineteen">Will there be networking opportunities Eventify?</button>
                                       </h2>
                                       <div id="collapseNineteen" class="accordion-collapse collapse" data-bs-parent="#accordionExample5">
                                          <div class="accordion-body">
                                             <p>Eventify 2024 will be held on 26 at USA , located in New York. Full event details, including timings and venue information, will be provided after registration.</p>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="space20"></div>
                                    <div class="accordion-item">
                                       <h2 class="accordion-header">
                                          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwenty" aria-expanded="false" aria-controls="collapseTwenty">How can I access session materials after event?</button>
                                       </h2>
                                       <div id="collapseTwenty" class="accordion-collapse collapse" data-bs-parent="#accordionExample5">
                                          <div class="accordion-body">
                                             <p>Eventify 2024 will be held on 26 at USA , located in New York. Full event details, including timings and venue information, will be provided after registration.</p>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>

                           <div class="col-lg-6">
                              <div class="accordian-area">
                                 <div class="accordion" id="accordionExample6">
                                    <div class="accordion-item">
                                       <h2 class="accordion-header">
                                          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFourtyone" aria-expanded="true" aria-controls="collapseFourtyone">What is Eventify, and who is it for?</button>
                                       </h2>
                                       <div id="collapseFourtyone" class="accordion-collapse collapse" data-bs-parent="#accordionExample6">
                                          <div class="accordion-body">
                                             <p>Eventify 2024 will be held on 26 at USA , located in New York. Full event details, including timings and venue information, will be provided after registration.</p>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="space20"></div>
                                    <div class="accordion-item">
                                       <h2 class="accordion-header">
                                          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFourtytwo" aria-expanded="false" aria-controls="collapseFourtytwo">When and where is Eventify 2024 taking place?</button>
                                       </h2>
                                       <div id="collapseFourtytwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample6">
                                          <div class="accordion-body">
                                             <p>Eventify 2024 will be held on 26 at USA , located in New York. Full event details, including timings and venue information, will be provided after registration.</p>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="space20"></div>
                                    <div class="accordion-item">
                                       <h2 class="accordion-header">
                                          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFourtythree" aria-expanded="false" aria-controls="collapseFourtythree">How much does it cost to attend Eventify 2024?</button>
                                       </h2>
                                       <div id="collapseFourtythree" class="accordion-collapse collapse" data-bs-parent="#accordionExample6">
                                          <div class="accordion-body">
                                             <p>Eventify 2024 will be held on 26 at USA , located in New York. Full event details, including timings and venue information, will be provided after registration.</p>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="space20"></div>
                                    <div class="accordion-item">
                                       <h2 class="accordion-header">
                                          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFourtyfour" aria-expanded="false" aria-controls="collapseFourtyfour">Will there be networking opportunities Eventify?</button>
                                       </h2>
                                       <div id="collapseFourtyfour" class="accordion-collapse collapse" data-bs-parent="#accordionExample6">
                                          <div class="accordion-body">
                                             <p>Eventify 2024 will be held on 26 at USA , located in New York. Full event details, including timings and venue information, will be provided after registration.</p>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="space20"></div>
                                    <div class="accordion-item">
                                       <h2 class="accordion-header">
                                          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFourtyfive" aria-expanded="false" aria-controls="collapseFourtyfive">How can I access session materials after event?</button>
                                       </h2>
                                       <div id="collapseFourtyfive" class="accordion-collapse collapse" data-bs-parent="#accordionExample6">
                                          <div class="accordion-body">
                                             <p>Eventify 2024 will be held on 26 at USA , located in New York. Full event details, including timings and venue information, will be provided after registration.</p>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="tab-pane fade" id="pills-contact1" role="tabpanel" aria-labelledby="pills-contact1-tab" tabindex="0">
                     <div class="faq-section-area">
                        <div class="row">
                           <div class="col-lg-6">
                              <div class="accordian-area">
                                 <div class="accordion" id="accordionExample7">
                                    <div class="accordion-item">
                                       <h2 class="accordion-header">
                                          <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwentyone" aria-expanded="true" aria-controls="collapseTwentyone">What is Eventify, and who is it for?</button>
                                       </h2>
                                       <div id="collapseTwentyone" class="accordion-collapse collapse show" data-bs-parent="#accordionExample7">
                                          <div class="accordion-body">
                                             <p>Eventify 2024 will be held on 26 at USA , located in New York. Full event details, including timings and venue information, will be provided after registration.</p>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="space20"></div>
                                    <div class="accordion-item">
                                       <h2 class="accordion-header">
                                          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwentytwo" aria-expanded="false" aria-controls="collapseTwentytwo">When and where is Eventify 2024 taking place?</button>
                                       </h2>
                                       <div id="collapseTwentytwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample7">
                                          <div class="accordion-body">
                                             <p>Eventify 2024 will be held on 26 at USA , located in New York. Full event details, including timings and venue information, will be provided after registration.</p>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="space20"></div>
                                    <div class="accordion-item">
                                       <h2 class="accordion-header">
                                          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwentythree" aria-expanded="false" aria-controls="collapseTwentythree">How much does it cost to attend Eventify 2024?</button>
                                       </h2>
                                       <div id="collapseTwentythree" class="accordion-collapse collapse" data-bs-parent="#accordionExample7">
                                          <div class="accordion-body">
                                             <p>Eventify 2024 will be held on 26 at USA , located in New York. Full event details, including timings and venue information, will be provided after registration.</p>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="space20"></div>
                                    <div class="accordion-item">
                                       <h2 class="accordion-header">
                                          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwentyfour" aria-expanded="false" aria-controls="collapseTwentyfour">Will there be networking opportunities Eventify?</button>
                                       </h2>
                                       <div id="collapseTwentyfour" class="accordion-collapse collapse" data-bs-parent="#accordionExample7">
                                          <div class="accordion-body">
                                             <p>Eventify 2024 will be held on 26 at USA , located in New York. Full event details, including timings and venue information, will be provided after registration.</p>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="space20"></div>
                                    <div class="accordion-item">
                                       <h2 class="accordion-header">
                                          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwentyfive" aria-expanded="false" aria-controls="collapseTwentyfive">How can I access session materials after event?</button>
                                       </h2>
                                       <div id="collapseTwentyfive" class="accordion-collapse collapse" data-bs-parent="#accordionExample7">
                                          <div class="accordion-body">
                                             <p>Eventify 2024 will be held on 26 at USA , located in New York. Full event details, including timings and venue information, will be provided after registration.</p>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>

                           <div class="col-lg-6">
                              <div class="accordian-area">
                                 <div class="accordion" id="accordionExample8">
                                    <div class="accordion-item">
                                       <h2 class="accordion-header">
                                          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFourtySix" aria-expanded="true" aria-controls="collapseFourtySix">What is Eventify, and who is it for?</button>
                                       </h2>
                                       <div id="collapseFourtySix" class="accordion-collapse collapse" data-bs-parent="#accordionExample8">
                                          <div class="accordion-body">
                                             <p>Eventify 2024 will be held on 26 at USA , located in New York. Full event details, including timings and venue information, will be provided after registration.</p>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="space20"></div>
                                    <div class="accordion-item">
                                       <h2 class="accordion-header">
                                          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFourtySeven" aria-expanded="false" aria-controls="collapseFourtySeven">When and where is Eventify 2024 taking place?</button>
                                       </h2>
                                       <div id="collapseFourtySeven" class="accordion-collapse collapse" data-bs-parent="#accordionExample8">
                                          <div class="accordion-body">
                                             <p>Eventify 2024 will be held on 26 at USA , located in New York. Full event details, including timings and venue information, will be provided after registration.</p>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="space20"></div>
                                    <div class="accordion-item">
                                       <h2 class="accordion-header">
                                          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFourtyEight" aria-expanded="false" aria-controls="collapseFourtyEight">How much does it cost to attend Eventify 2024?</button>
                                       </h2>
                                       <div id="collapseFourtyEight" class="accordion-collapse collapse" data-bs-parent="#accordionExample8">
                                          <div class="accordion-body">
                                             <p>Eventify 2024 will be held on 26 at USA , located in New York. Full event details, including timings and venue information, will be provided after registration.</p>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="space20"></div>
                                    <div class="accordion-item">
                                       <h2 class="accordion-header">
                                          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFourtyNine" aria-expanded="false" aria-controls="collapseFourtyNine">Will there be networking opportunities Eventify?</button>
                                       </h2>
                                       <div id="collapseFourtyNine" class="accordion-collapse collapse" data-bs-parent="#accordionExample8">
                                          <div class="accordion-body">
                                             <p>Eventify 2024 will be held on 26 at USA , located in New York. Full event details, including timings and venue information, will be provided after registration.</p>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="space20"></div>
                                    <div class="accordion-item">
                                       <h2 class="accordion-header">
                                          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFourtyTen" aria-expanded="false" aria-controls="collapseFourtyTen">How can I access session materials after event?</button>
                                       </h2>
                                       <div id="collapseFourtyTen" class="accordion-collapse collapse" data-bs-parent="#accordionExample8">
                                          <div class="accordion-body">
                                             <p>Eventify 2024 will be held on 26 at USA , located in New York. Full event details, including timings and venue information, will be provided after registration.</p>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="tab-pane fade" id="pills-contact2" role="tabpanel" aria-labelledby="pills-contact2-tab" tabindex="0">
                     <div class="faq-section-area">
                        <div class="row">
                           <div class="col-lg-6">
                              <div class="accordian-area">
                                 <div class="accordion" id="accordionExample9">
                                    <div class="accordion-item">
                                       <h2 class="accordion-header">
                                          <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwentysix" aria-expanded="true" aria-controls="collapseTwentysix">What is Eventify, and who is it for?</button>
                                       </h2>
                                       <div id="collapseTwentysix" class="accordion-collapse collapse show" data-bs-parent="#accordionExample9">
                                          <div class="accordion-body">
                                             <p>Eventify 2024 will be held on 26 at USA , located in New York. Full event details, including timings and venue information, will be provided after registration.</p>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="space20"></div>
                                    <div class="accordion-item">
                                       <h2 class="accordion-header">
                                          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwentyseven" aria-expanded="false" aria-controls="collapseTwentyseven">When and where is Eventify 2024 taking place?</button>
                                       </h2>
                                       <div id="collapseTwentyseven" class="accordion-collapse collapse" data-bs-parent="#accordionExample9">
                                          <div class="accordion-body">
                                             <p>Eventify 2024 will be held on 26 at USA , located in New York. Full event details, including timings and venue information, will be provided after registration.</p>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="space20"></div>
                                    <div class="accordion-item">
                                       <h2 class="accordion-header">
                                          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwentyeight" aria-expanded="false" aria-controls="collapseTwentyeight">How much does it cost to attend Eventify 2024?</button>
                                       </h2>
                                       <div id="collapseTwentyeight" class="accordion-collapse collapse" data-bs-parent="#accordionExample9">
                                          <div class="accordion-body">
                                             <p>Eventify 2024 will be held on 26 at USA , located in New York. Full event details, including timings and venue information, will be provided after registration.</p>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="space20"></div>
                                    <div class="accordion-item">
                                       <h2 class="accordion-header">
                                          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwentynine" aria-expanded="false" aria-controls="collapseTwentynine">Will there be networking opportunities Eventify?</button>
                                       </h2>
                                       <div id="collapseTwentynine" class="accordion-collapse collapse" data-bs-parent="#accordionExample9">
                                          <div class="accordion-body">
                                             <p>Eventify 2024 will be held on 26 at USA , located in New York. Full event details, including timings and venue information, will be provided after registration.</p>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="space20"></div>
                                    <div class="accordion-item">
                                       <h2 class="accordion-header">
                                          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThirty" aria-expanded="false" aria-controls="collapseThirty">How can I access session materials after event?</button>
                                       </h2>
                                       <div id="collapseThirty" class="accordion-collapse collapse" data-bs-parent="#accordionExample9">
                                          <div class="accordion-body">
                                             <p>Eventify 2024 will be held on 26 at USA , located in New York. Full event details, including timings and venue information, will be provided after registration.</p>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>

                           <div class="col-lg-6">
                              <div class="accordian-area">
                                 <div class="accordion" id="accordionExample10">
                                    <div class="accordion-item">
                                       <h2 class="accordion-header">
                                          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThirtyone" aria-expanded="true" aria-controls="collapseThirtyone">What is Eventify, and who is it for?</button>
                                       </h2>
                                       <div id="collapseThirtyone" class="accordion-collapse collapse" data-bs-parent="#accordionExample10">
                                          <div class="accordion-body">
                                             <p>Eventify 2024 will be held on 26 at USA , located in New York. Full event details, including timings and venue information, will be provided after registration.</p>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="space20"></div>
                                    <div class="accordion-item">
                                       <h2 class="accordion-header">
                                          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThirtytwo" aria-expanded="false" aria-controls="collapseThirtytwo">When and where is Eventify 2024 taking place?</button>
                                       </h2>
                                       <div id="collapseThirtytwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample10">
                                          <div class="accordion-body">
                                             <p>Eventify 2024 will be held on 26 at USA , located in New York. Full event details, including timings and venue information, will be provided after registration.</p>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="space20"></div>
                                    <div class="accordion-item">
                                       <h2 class="accordion-header">
                                          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThirtythree" aria-expanded="false" aria-controls="collapseThirtythree">How much does it cost to attend Eventify 2024?</button>
                                       </h2>
                                       <div id="collapseThirtythree" class="accordion-collapse collapse" data-bs-parent="#accordionExample10">
                                          <div class="accordion-body">
                                             <p>Eventify 2024 will be held on 26 at USA , located in New York. Full event details, including timings and venue information, will be provided after registration.</p>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="space20"></div>
                                    <div class="accordion-item">
                                       <h2 class="accordion-header">
                                          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThirtyfour" aria-expanded="false" aria-controls="collapseThirtyfour">Will there be networking opportunities Eventify?</button>
                                       </h2>
                                       <div id="collapseThirtyfour" class="accordion-collapse collapse" data-bs-parent="#accordionExample10">
                                          <div class="accordion-body">
                                             <p>Eventify 2024 will be held on 26 at USA , located in New York. Full event details, including timings and venue information, will be provided after registration.</p>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="space20"></div>
                                    <div class="accordion-item">
                                       <h2 class="accordion-header">
                                          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThirtyfive" aria-expanded="false" aria-controls="collapseThirtyfive">How can I access session materials after event?</button>
                                       </h2>
                                       <div id="collapseThirtyfive" class="accordion-collapse collapse" data-bs-parent="#accordionExample10">
                                          <div class="accordion-body">
                                             <p>Eventify 2024 will be held on 26 at USA , located in New York. Full event details, including timings and venue information, will be provided after registration.</p>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>               
@endsection
@section('script')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDYUTCpyRfNY8Und6oYaKi5Vkqip7OIWEU&libraries=geometry,places&callback=initMap&v=weekly" async defer></script>
   <script>
        function initMap() {
            const map = new google.maps.Map(document.getElementById("map"), {
                center: { lat: 37.7749, lng: -122.4194 },
                zoom: 8
            });

            const inputs = [
                { id: "address-input"},
                { id: "user-address"},
                { id: "nearby-address"}
            ];

            inputs.forEach(({ id, zipcodeId }) => {
                const input = document.getElementById(id);
                const autocomplete = new google.maps.places.Autocomplete(input, {
                    componentRestrictions: { country: 'us' }
                });

                autocomplete.addListener("place_changed", () => {
                    const place = autocomplete.getPlace();

                    if (!place.geometry) {
                        console.log("No details available for input: '" + place.name + "'");
                        return;
                    }

                    map.setCenter(place.geometry.location);
                    map.setZoom(15);

                    const addressComponents = place.address_components;
                    let zipcode = '';
                    for (const component of addressComponents) {
                        if (component.types.includes("postal_code")) {
                            zipcode = component.long_name;
                            break; 
                        }
                    }
                    document.getElementById(zipcodeId).value = zipcode;
                });
            });
        }
    </script>
    <script type="text/javascript">
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
            title: 'Are you sure you Want To Change Status of This Plan?',
            text: "If Status is Not Published then This Plan Will not show Frontend",
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