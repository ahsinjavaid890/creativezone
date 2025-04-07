@extends('frontend.layouts.main')
@section('tittle')
<title>Videos | Creative Zone</title>
<link rel="canonical" href="{{Request::url()}}">
@endsection
@section('content')
 <main>

            <div class="bradcamp_sectgion pt-60">
                <div class="get_yu_dea mb-60 text-center">
                    <h2 style="font-size: 40px;">
                        <span>Our Latest</span> Videos
                    </h2>
                    <p>Here is our Videos collection to help you</p>
                </div>
            </div>
  <!--   <div class="wel_ser pt-60">
        <div class="container">
            <div class="video_spd">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <div class="tur_heading">
                        <h2>We have a tutorial for you.</h2>
                        <p>Please watch our video collection if needed. We created this video collection based on our customers' needs.</p>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="video_img">
                        <div class="pdf_sectionm"></div>
                        <video width="100%" height="260" controls>
                            <source src="https://tech.igiapp.com/jiowireless/frontend/img/repa.mp4" type="video/mp4">
                        </video>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div> -->

 <div class="video_list-section">
    <!-- <div class="container">
        <div class="selecty_blog">
        <div class="post_paid">
        <div class="col-sm-12">
            <div class="input_from_section">
                <input type="text" placeholder="Search by blog" name="searchblog" />
            </div>
        </div>
            <div class="col-sm-4">
                <div class="provider_selecrtx">
                            <select aria-selected="true">
                                <option>Category</option>
                                <option>1</option>
                                <option>2</option>
                            </select>
                    </div>
              </div>
            <div class="col-sm-4">
                <div class="provider_selecrtx">
                            <select aria-selected="true">
                                <option>Providers</option>
                                <option>1</option>
                                <option>2</option>
                            </select>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="provider_selecrtx" style="margin-right:0px !important;">
                            <select aria-selected="true">
                                <option>Sort By</option>
                                <option>1</option>
                                <option>2</option>
                            </select>
                   </div>
               </div>
              </div>
          </div>
    </div> -->
    <div class="stay_up_date_section mt-60 mb-0 pb-40">
        <div class="container">
            <div class="row">
                @foreach($data as  $r)
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
</div>

     </main>

@endsection