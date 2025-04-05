<!-- Stay up to date with our fresh article -->
@if($blog && $blog->count() > 0)
<div class="stay_up_date_section mt-60 mb-60">
   <div class="container">
       <div class="row">
           <div class="heading_syat mb-20" style="padding: 0;">
               <h3 class="text-left">Stay up to date with our fresh article</h3>
           </div>
           <div class="owl-carousel owl-theme ourreviiew">
                @foreach($blog as $r)
                <div class="item">
                   <div class="cardfg_open">
                       <div class="artical_img">
                            <img src="{{ url('public/images') }}/{{ $r->image }}" alt="">
                       </div>
                       <div class="caret_heading">
                           <a href="{{ url('video-category') }}/{{ DB::table('blogcategories')->where('id' , $r->category_id)->first()->url }}" style="padding: 5px;background-color: #1370f2;border-radius: 5px;color: white;" href="">{{ DB::table('blogcategories')->where('id' , $r->category_id)->first()->name }}</a>
                           <h3 style="margin-top: 20px;"><a href="{{ url('blog') }}/{{ $r->url }}">{{ $r->title }}</a></h3>
                           <p>{{ Cmf::stripAndLimit($r->content) }}</p>
                       </div>
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
                @endforeach
           </div>
       </div>
   </div>
</div>
@endif