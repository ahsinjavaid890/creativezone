<!-- Our Google Reviews Start-->
<div class="google_reviews pt-60 pb-40">
   <div class="container">
       <div class="sdb_oper">
           <div class="heading_sellers text-center mb-40">
               <h3>Our Customers says it all</h3>
               <p>Here is what they’re saying...</p>
           </div>
           <div class="google_review_list">
               <div class="owl-carousel owl-theme ourreviiew">.
                @php
                    $data = DB::table('pages')->where('status', 1)->first();
                    if ($data) {
                        $testimonialex = explode(',', $data->testimonials);
                        $testimonials = DB::table('testimonials')->whereIn('id', $testimonialex)->get();
                    } else {
                        $testimonials = [];
                    }
                @endphp
                @foreach($testimonials as $r)
                   <div class="item">
                       <div class="card_sys_review">
                           <div class="review_heading_tht">
                               <div class="d-flex align-items-center">
                                   <div class="ouy_sed">
                                       <img src="{{ url('public/images') }}/{{ $r->image }}" alt="profile_image" class="d-block w-100" style="border-radius: 34px;width: 50px !important;height: 50px;">
                                   </div>
                                   <div class="namh_ert">
                                       <h4>{{ $r->name }}</h4>
                                       <span>{{ $r->occupation }}</span>
                                   </div>
                               </div>
                               <p>{{ $r->testimonial }} </p>
                               <p>{{ Cmf::date_format($r->created_at) }}</p>
                           </div>
                       </div>
                   </div>
                   @endforeach
               </div>
           </div>
       </div>
   </div>
</div>
<!-- Our Google Reviews End -->