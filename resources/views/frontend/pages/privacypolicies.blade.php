@extends('frontend.layouts.main')
@include('frontend.sections.mettatags')
@section('content')
<div class="container" style="margin-top: 140px;">
   <div class="breadcrumb-area" style=" background-color: #5cc99f; padding: 10px; border-radius: 8px; color: white; ">
      <div class="breadcrumb mb-0">
         <ul class="d-flex align-items-center">
            <li><a href="{{ url('') }}" class="text-white mx-1">Home</a></li>
            <li class="active"><i class="fa-solid fa-angle-right"></i> Privacy Policy</li>
         </ul>
      </div>
   </div>
</div>
<main>
   <div class="pt-5 mb-5">
      <div class="container">
         <div class="row">
            <div class="privacy-policy">
               <div class="prit_headinf">
                  <h1>Privacy Policy</h1>
               </div>
               <h2 class="custom-heading">Introduction</h2>
               <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).
               </p>
               <h2 class="custom-heading"> Personal Identification Information</h2>
               <p>We may collect personal identification information from Users in various ways, including, but not limited to, when Users visit our Site, register on the Site, fill out a form, and in connection with other activities, services, features, or resources we make available on our Site.
               </p>
               <h2 class="custom-heading"> Non-personal Identification Information</h2>
               <p>We may collect non-personal identification information about Users whenever they interact with our Site. Non-personal identification information may include the browser name, the type of computer, and technical information about Users' means of connection to our Site.
               </p>
               <h2 class="custom-heading">Web Browser Cookies</h2>
               <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).
               <h2 class="custom-heading">How We Protect Your Information</h2>
               <p>We adopt appropriate data collection, storage, and processing practices and security measures to protect against unauthorized access, alteration, disclosure, or destruction of your personal information.
               <h2 class="custom-heading">Sharing Your Personal Information:</h2>
               <p>We do not sell, trade, or rent Users' personal identification information to others. We may share generic aggregated demographic information not linked to any personal identification information regarding visitors and users with our business partners, trusted affiliates, and advertisers.
               <h2 class="custom-heading">Third-Party Websites</h2>
               <p>Our Site may use "cookies" to enhance User experience. Users may choose to set their web browser to refuse cookies or to alert them when cookies are being sent. If they do so, note that some parts of the Site may not function properly.
               <h2 class="custom-heading">Web Browser Cookies</h2>
               <p>Our Site may use "cookies" to enhance User experience. Users may choose to set their web browser to refuse cookies or to alert them when cookies are being sent. If they do so, note that some parts of the Site may not function properly.
               </p>
            </div>
         </div>
      </div>
   </div>
</main>
@endsection