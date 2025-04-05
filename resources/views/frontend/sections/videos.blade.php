<!--Stay up to date with our fresh video  -->
<div class="stay_up_date_section mt-60 mb-60">
   <div class="container">
       <div class="heading_date mb-40" style="padding: 0;">
           <h3 class="text-left">Stay up to date with our fresh video</h3>
       </div>
       <div class="row">

        @foreach($video as $r)
           <div class="col-sm-4">
               <div class="cardfg_open">
                   <div class="artical_img">
                      <iframe width="400" height="200" src="{{ url('public/images') }}/{{ $r->video }}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                   </div>
                   <div class="caret_heading rthe">
                       <h3><a href="{{ url('video') }}/{{ $r->name }}">{{ $r->name }}</a></h3>
                       <div class="cat_user_img d-flex justify-content-between">
                           <div class="fgt_op d-flex align-items-center">
                               <span>By JIOWIRELESS</span>
                           </div>
                           <div class="dateh">
                               <p>{{ Cmf::date_format($r->created_at) }}</p>
                           </div>
                       </div>
                   </div>
               </div>
           </div>
           @endforeach
       </div>
   </div>
</div>