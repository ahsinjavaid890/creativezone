@extends('frontend.layouts.main')
@section('tittle')
<title>Dashboard</title>
<link rel="canonical" href="{{Request::url()}}">
@endsection
@section('content')
<main>
   <section class="profile__area pt-120 pb-120">
      <div class="container">
         <div class="profile__inner p-relative">
            <div class="row">
               <div class="col-md-12">
                  @if (session('success'))
                      <div class="alert alert-success">
                          {{ session('success') }}
                      </div>
                  @endif

                  @if ($errors->any())
                      <div class="alert alert-danger">
                          <ul>
                              @foreach ($errors->all() as $error)
                                  <li>{{ $error }}</li>
                              @endforeach
                          </ul>
                      </div>
                  @endif
               </div>
               <div class="col-xxl-3 col-lg-3">
                  <div class="profile__tab">
                     <nav>
                        <div class="nav nav-tabs tp-tab-menu flex-column" id="profile-tab" role="tablist">
                           <button class="nav-link active" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false"><span><i class="fa-regular fa-user-pen"></i></span>Profile</button>
                           <!-- <button class="nav-link" id="nav-address-tab" data-bs-toggle="tab" data-bs-target="#nav-address" type="button" role="tab" aria-controls="nav-address" aria-selected="false"><span><i class="fa-light fa-location-dot"></i></span> Address </button> -->
                           <button class="nav-link" id="nav-order-tab" data-bs-toggle="tab" data-bs-target="#nav-order" type="button" role="tab" aria-controls="nav-order" aria-selected="false"><span><i class="fa-light fa-clipboard-list-check"></i></span> My Orders </button>
                           <button class="nav-link" id="nav-sell-tab" data-bs-toggle="tab" data-bs-target="#nav-sell" type="button" role="tab" aria-controls="nav-sell" aria-selected="false"><span><i class="fa-regular fa-bell"></i></span>Sell Inquiries</button>
                           <button class="nav-link" id="nav-repair-tab" data-bs-toggle="tab" data-bs-target="#nav-repair" type="button" role="tab" aria-controls="nav-repair" aria-selected="false"><span><i class="fa-regular fa-bell"></i></span>Repair Inquiries</button>
                           <button class="nav-link" id="nav-password-tab" data-bs-toggle="tab" data-bs-target="#nav-password" type="button" role="tab" aria-controls="nav-password" aria-selected="false"><span><i class="fa-regular fa-lock"></i></span> Change Password</button>
                           <button class="nav-link"  href="{{ route('logout') }}"onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><span><i class="fa fa-sign-out"></i></span> Logout</button>
                           <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                              @csrf
                           </form>
                           <span id="marker-vertical" class="tp-tab-line d-none d-sm-inline-block"></span>
                        </div>
                     </nav>
                  </div>
               </div>
               <div class="col-xxl-9 col-lg-9">
                  <div class="profile__tab-content">
                     <div class="tab-content" id="profile-tabContent">
                        <div class="tab-pane fade show active" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                           <div class="profile__main">
                              <div class="profile__main-top pb-40">
                                 <div class="row align-items-center">
                                    <div class="col-md-6">
                                       <div class="profile__main-inner d-flex flex-wrap align-items-center">
                                          
                                          <div class="profile__main-content">
                                             <h4 class="profile__main-title">{{ Auth::user()->name }}</h4>
                                             <p>You have <span>08</span> notifications</p>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <!-- start -->
                              <div class="profile__info">
                                 <div class="profile__info-content">
                                    <form enctype="multipart" action="{{ url('user/profileupdate') }}" method="POST">
                                       @csrf
                                       <input type="hidden" name="id" value="{{ Auth::user()->id }}">
                                       <div class="row">
                                          <div class="col-xxl-6 col-md-6 mb-2">
                                             <div class="profile__input-box">
                                                <div class="profile__input">
                                                   <input type="text" placeholder="Enter your username" value="{{ Auth::user()->name }}" name="name">
                                                   <span>
                                                      <svg width="17" height="19" viewBox="0 0 17 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                         <path d="M9 9C11.2091 9 13 7.20914 13 5C13 2.79086 11.2091 1 9 1C6.79086 1 5 2.79086 5 5C5 7.20914 6.79086 9 9 9Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                         <path d="M15.5 17.6C15.5 14.504 12.3626 12 8.5 12C4.63737 12 1.5 14.504 1.5 17.6" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                      </svg>
                                                   </span>
                                                </div>
                                             </div>
                                          </div>
                                          <div class="col-xxl-6 col-md-6 mb-2">
                                             <div class="profile__input-box">
                                                <div class="profile__input">
                                                   <input readonly type="email" placeholder="Enter your email" value="{{ Auth::user()->email }}" name="email">
                                                   <span>
                                                      <svg width="18" height="16" viewBox="0 0 18 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                         <path d="M13 14.6H5C2.6 14.6 1 13.4 1 10.6V5C1 2.2 2.6 1 5 1H13C15.4 1 17 2.2 17 5V10.6C17 13.4 15.4 14.6 13 14.6Z" stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                                         <path d="M13 5.3999L10.496 7.3999C9.672 8.0559 8.32 8.0559 7.496 7.3999L5 5.3999" stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                                      </svg>
                                                   </span>
                                                </div>
                                             </div>
                                          </div>
                                          <div class="col-xxl-6 col-md-6 mb-2">
                                             <div class="profile__input-box">
                                                <div class="profile__input">
                                                   <input type="text" placeholder="Enter your phone" value="{{ Auth::user()->phone }}" name="phone">
                                                   <span>
                                                      <svg width="15" height="18" viewBox="0 0 15 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                         <path d="M13.9148 5V13C13.9148 16.2 13.1076 17 9.87892 17H5.03587C1.80717 17 1 16.2 1 13V5C1 1.8 1.80717 1 5.03587 1H9.87892C13.1076 1 13.9148 1.8 13.9148 5Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                         <path opacity="0.4" d="M9.08026 3.80054H5.85156" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                         <path opacity="0.4" d="M7.45425 14.6795C8.14522 14.6795 8.70537 14.1243 8.70537 13.4395C8.70537 12.7546 8.14522 12.1995 7.45425 12.1995C6.76327 12.1995 6.20312 12.7546 6.20312 13.4395C6.20312 14.1243 6.76327 14.6795 7.45425 14.6795Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                      </svg>
                                                   </span>
                                                </div>
                                             </div>
                                          </div>
                                          <div class="col-xxl-6 col-md-6 mb-2">
                                             <div class="profile__input-box">
                                                <div class="profile__input">
                                                   <select name="gender">
                                                      <option value="">Select Gender</option>
                                                      <option @if(Auth::user()->gender == 'Male') selected @endif value="Male">Male</option>
                                                      <option @if(Auth::user()->gender == 'Female') selected @endif value="Female">Female</option>
                                                      <option  @if(Auth::user()->gender == 'Other') selected @endif value="Other">Others</option>
                                                   </select>
                                                </div>
                                             </div>
                                          </div>
                                          <div class="col-xxl-12 mb-2">
                                             <div class="profile__input-box">
                                                <div class="profile__input">
                                                   <input type="text" placeholder="Enter your address" value="{{ Auth::user()->address }}"  id="address-input" name="address">
                                                   <div id="map"></div>
                                                   <span>
                                                      <svg width="16" height="18" viewBox="0 0 16 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                         <path d="M7.99377 10.1461C9.39262 10.1461 10.5266 9.0283 10.5266 7.64946C10.5266 6.27061 9.39262 5.15283 7.99377 5.15283C6.59493 5.15283 5.46094 6.27061 5.46094 7.64946C5.46094 9.0283 6.59493 10.1461 7.99377 10.1461Z" stroke="currentColor" stroke-width="1.5"/>
                                                         <path d="M1.19707 6.1933C2.79633 -0.736432 13.2118 -0.72843 14.803 6.2013C15.7365 10.2663 13.1712 13.7072 10.9225 15.8357C9.29079 17.3881 6.70924 17.3881 5.06939 15.8357C2.8288 13.7072 0.263493 10.2583 1.19707 6.1933Z" stroke="currentColor" stroke-width="1.5"/>
                                                      </svg>
                                                   </span>
                                                </div>
                                             </div>
                                          </div>
                                          <div class="col-xxl-12 mb-2">
                                             <div class="profile__input-box">
                                                <div class="profile__input">
                                                   <textarea name="about_me" placeholder="Enter your bio">{{ Auth::user()->about_me }}</textarea>
                                                </div>
                                             </div>
                                          </div>
                                          <div class="col-xxl-12">
                                             <div class="profile__btn">
                                                <button type="submit" class="tp-btn">Update Profile</button>
                                             </div>
                                          </div>
                                       </div>
                                    </form>
                                 </div>
                              </div>
                              <!-- end -->
                           </div>
                        </div>
                        <div class="tab-pane fade" id="nav-password" role="tabpanel" aria-labelledby="nav-password-tab">
                           <div class="profile__password">
                              <form action="{{ url('user/changeprofilepassword') }}" method="POST">
                                  @csrf <!-- CSRF token for security -->
                                  <input type="hidden" name="id" value="{{ Auth::user()->id }}">
                                  <div class="row">
                                      <div class="col-sm-12">
                                          <div class="form-field">
                                              <div class="form-field__control">
                                                  <div class="icon">
                                                      <i class="fa-regular fa-lock"></i>
                                                  </div>
                                                  <input id="old_password" name="old_password" type="password" class="form-field__input" placeholder="Old Password" required/>
                                                  <label for="old_password" class="form-field__label">Old Password</label> 
                                                  <div class="form-field__bar"></div>
                                              </div>
                                          </div>
                                      </div>
                                      <div class="col-sm-12">
                                          <div class="form-field">
                                              <div class="form-field__control">
                                                  <div class="icon">
                                                      <i class="fa-regular fa-lock"></i>
                                                  </div>
                                                  <input id="new_password" name="new_password" type="password" class="form-field__input" placeholder="New Password" required/>
                                                  <label for="new_password" class="form-field__label">New Password</label> 
                                                  <div class="form-field__bar"></div>
                                              </div>
                                          </div>
                                      </div>
                                      <div class="col-sm-12">
                                          <div class="form-field">
                                              <div class="form-field__control">
                                                  <div class="icon">
                                                      <i class="fa-regular fa-lock"></i>
                                                  </div>
                                                  <input id="new_password_confirmation" name="new_password_confirmation" type="password" class="form-field__input" placeholder="Confirm Password" required/>
                                                  <label for="new_password_confirmation" class="form-field__label">Confirm Password</label> 
                                                  <div class="form-field__bar"></div>
                                              </div>
                                          </div>
                                      </div>
                                      <div class="col-xxl-6 col-md-6">
                                          <div class="profile__btn">
                                              <button type="submit" class="tp-btn">Update</button>
                                          </div>
                                      </div>
                                  </div>
                              </form>
                           </div>
                        </div>
                        <div class="tab-pane fade" id="nav-address" role="tabpanel" aria-labelledby="nav-address-tab">
                           <div class="profile__address">
                              <div class="row">
                                 <div class="col-md-12">
                                    <p>There was no address found.</p>
                                 </div>
                                 <div class="col-md-6">
                                    <div class="add_plu_btn" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                       <a href="#"> <i class="far fa-plus"></i> Add New Address</a>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="tab-pane fade" id="nav-order" role="tabpanel" aria-labelledby="nav-order-tab">
                           <div class="profile__ticket table-responsive">
                              <table class="table table-hover table-responsive-lg text-center custom-tables">
                                 <thead class="bg-dark text-white" style="">
                                    <tr>
                                       <th scope="col " style="color: white !important;">Order ID</th>
                                       <th scope="col " style="color: white !important;">Product</th>
                                       <th scope="col " style="color: white !important;">Status</th>
                                       <th scope="col " style="color: white !important;" class="text-center">Actions</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    
                                 </tbody>
                              </table>
                           </div>
                        </div>
                        <div class="tab-pane fade" id="nav-sell" role="tabpanel" aria-labelledby="nav-sell-tab">
                           <div class="profile__notification">
                              <div class="profile__notification-top mb-30">
                                 <h3 class="profile__notification-title">My Sell Inquires</h3>
                              </div>
                              <div class="profile__ticket table-responsive">
                                 <table class="table table-striped">
                                    <thead>
                                       <tr>
                                          <th scope="col">Uniquer ID</th>
                                          <th scope="col">Name</th>
                                          <th scope="col">Email</th>
                                          <th scope="col">Action</th>
                                       </tr>
                                    </thead>
                                    <tbody>
                                       @foreach(DB::table('sell_inquiries')->orderBy('created_at', 'DESC')->get() as $r)
                                           <tr>
                                               <td class="text-center">
                                                   {{ $r->unique_id }}
                                               </td>
                                               <td class="text-center">
                                                   {{ $r->name }}
                                               </td>
                                               <td class="text-center">
                                                   {{ $r->email }}
                                               </td>
                                               <td class="text-center">
                                                  <a href="javascript:void(0);" onclick='confirmDelete("{{ url('user/deletesellinqurie') }}/{{ $r->id }}")' class="btn btn-icon btn-light btn-hover-primary btn-sm">
                                                     <span class="material-symbols-outlined">delete</span>
                                                   </a>
                                               </td>
                                           </tr>
                                       @endforeach
                                    </tbody>
                                 </table>
                              </div>
                           </div>
                        </div>
                        <div class="tab-pane fade" id="nav-repair" role="tabpanel" aria-labelledby="nav-repair-tab">
                           <div class="profile__notification">
                              <div class="profile__notification-top mb-30">
                                 <h3 class="profile__notification-title">My Repair Inquires</h3>
                              </div>
                              <div class="profile__ticket table-responsive">
                                 <table class="table table-striped">
                                    <thead>
                                       <tr>
                                          <th scope="col">Device Problem</th>
                                          <th scope="col">Modal</th>
                                          <th scope="col">address</th>
                                          <th scope="col">Status</th>
                                          <th scope="col">Action</th>
                                       </tr>
                                    </thead>
                                    <tbody>
                                       @foreach(DB::table('repair_inquiries')->orderBy('created_at', 'DESC')->get() as $r)
                                        <tr>
                                            <td class="text-center">
                                                @foreach(explode(', ', $r->device_problem) as $de)
                                                    {{ $de }} <br>
                                                @endforeach
                                            </td>
                                            <td class="text-center">
                                                {{ DB::table('models')->where('id' , $r->model_id)->first()->name }}
                                            </td>
                                            <td class="text-center">
                                                @if($r->address)
                                                {{ $r->address }}<br>
                                                {{ $r->city }}, 
                                                {{ $r->state }},  
                                                {{ $r->zipcode }}
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                @if($r->status == 1)
                                                <a href="javascript:void(0)" class="btn btn-primary btn-sm">
                                                    <span class="label label-lg label-primary label-inline">Completed</span>
                                                </a>
                                                @endif
                                                @if($r->status == 0)
                                                <a href="javascript:void(0)" class="btn btn-primary btn-sm"  onclick='confirmDelete("{{ url('user/changesatusinqurie') }}/{{ $r->id }}")'>
                                                    <span class="label label-lg label-danger label-inline">Pending</span>
                                                </a>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                               <a href="javascript:void(0);" onclick='confirmDelete("{{ url('user/deleteinqurie') }}/{{ $r->id }}")' class="btn btn-icon btn-light btn-hover-primary btn-sm">
                                                  <span class="material-symbols-outlined">delete</span>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                 </table>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </section>
   <!-- profile area end -->
</main>
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Add New Address</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <form id="myForm" action="{{ url('user/addadress') }}" method="post">
            @csrf
            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
            <div class="modal-body mtr_op">
               <div class="fgt_srd">
                  <div class="profile__input-box">
                     <div class="profile__input modal_new_ad">
                        <select name="type" id="type" class="form-control">
                           <option value="Work">Work</option>
                           <option value="Home" selected>Home</option>
                        </select>
                     </div>
                  </div>
                  <div class="profile__input-box">
                     <div class="profile__input modal_new_ad">
                        <input type="text" required name="name" placeholder="Name (Required)">
                     </div>
                  </div>
                  <div class="profile__input-box">
                     <div class="profile__input modal_new_ad">
                        <input type="text" required name="contact_number" placeholder="Phone number (Required)">
                     </div>
                  </div>
                  <div class="profile__input-box">
                     <div class="profile__input modal_new_ad">
                        <input type="text" required name="street_address" placeholder="House No, Building Name (Required)" id="user-address">
                     </div>
                  </div>
                  <div class="profile__input-box">
                     <div class="profile__input modal_new_ad">
                        <input type="text" name="nearby" placeholder="Nearby Famous Shop/mall/Landmark" id="nearby-address">
                     </div>
                  </div>
                  <div class="profile__input-box">
                     <div class="profile__input modal_new_ad">
                        <input type="text" required name="city" placeholder="City (Required)">
                     </div>
                  </div>
                  <div class="profile__input-box">
                     <div class="profile__input modal_new_ad">
                        <input type="text" required name="state" placeholder="State (Required)">
                     </div>
                  </div>
                  <div class="profile__input-box">
                     <div class="profile__input modal_new_ad">
                        <input type="text" required name="country" placeholder="Country (Required)">
                     </div>
                  </div>
                  <div class="profile__input-box">
                     <div class="profile__input modal_new_ad">
                        <input type="text" required name="pincode" placeholder="Pin code (Required)">
                     </div>
                  </div>
               </div>
            </div>
            <div class="modal-footer">
               <button type="submit" class="btn btn-primary">Save Address</button>
            </div>
         </form>
      </div>
   </div>
</div>
<style type="text/css">
   .profile__ticket{
      height: 400px;
   }
</style>
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