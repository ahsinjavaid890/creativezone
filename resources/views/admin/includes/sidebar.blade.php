
<!--begin::Aside-->
<div class="aside aside-left aside-fixed d-flex flex-column flex-row-auto" id="kt_aside">
    <!--begin::Brand-->
    <div class="brand flex-column-auto" id="kt_brand">
        <!--begin::Logo-->
        <a style=" background-color: white; margin-top: 15px; border-radius: 11px; " href="{{url('admin/dashboard')}}">
            <img style=" padding: 5px; width: 100%; " alt="Logo"
                src="{{ url('public/newfront/assets/img/logo/logo1.png') }}" />
        </a>
        <!--end::Logo-->
    </div>
    <!--end::Brand-->
    <!--begin::Aside Menu-->
    <div class="aside-menu-wrapper flex-column-fluid" id="kt_aside_menu_wrapper">
        <!--begin::Menu Container-->
        <div id="kt_aside_menu" class="aside-menu my-4" data-menu-vertical="1" data-menu-scroll="1"
            data-menu-dropdown-timeout="500">
            <!--begin::Menu Nav-->
            <ul class="menu-nav">
                <li class="menu-item {{ str_contains($currentUrl, 'dashboard') ? 'menu-item-active' : '' }}" aria-haspopup="true">
                    <a href="{{url('admin/dashboard')}}" class="menu-link">
                        <span class="material-symbols-outlined">dashboard</span>
                        <span class="menu-text">Dashboard</span>
                    </a>
                </li>
                <li class="menu-section">
                    <h4 class="menu-text">MENU</h4>
                    <i class="menu-icon ki ki-bold-more-hor icon-md"></i>
                </li>
                <li class="menu-item menu-item-submenu {{ str_contains($currentUrl, 'orders') ? 'menu-item-open' : '' }}" aria-haspopup="true" data-menu-toggle="hover">
                    <a href="javascript:;" class="menu-link menu-toggle">
                        <span class="material-symbols-outlined">category</span>
                        <span class="menu-text">Categories & Tags</span><i class="menu-arrow"></i>
                    </a>
                    <div class="menu-submenu">
                        <i class="menu-arrow"></i>
                        <ul class="menu-subnav">
                            <li class="menu-item menu-item-parent" aria-haspopup="true">
                                <span class="menu-link"><span class="menu-text">Roles</span></span>
                            </li>
                            <li class="menu-item {{ str_contains($currentUrl, 'allcategories') ? 'menu-item-active' : '' }}" aria-haspopup="true">
                                <a href="{{ url('admin/categories/allcategories') }}" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot"><span></span></i><span class="menu-text">All Categories</span>
                                </a>
                            </li>
                            <li class="menu-item {{ str_contains($currentUrl, 'alltags') ? 'menu-item-active' : '' }}" aria-haspopup="true">
                                <a href="{{ url('admin/categories/alltags') }}" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot"><span></span></i><span class="menu-text">All Tags</span>
                                </a>
                            </li>
                            <!-- <li class="menu-item {{ str_contains($currentUrl, 'allsubcategories') ? 'menu-item-active' : '' }}" aria-haspopup="true">
                                <a href="{{ url('admin/categories/allsubcategories') }}" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot"><span></span></i><span class="menu-text">All Sub Categories</span>
                                </a>
                            </li> -->
                        </ul>
                    </div>
                </li>
                <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
                    <a href="javascript:;" class="menu-link menu-toggle">
                        <span class="material-symbols-outlined">artist</span>
                        <span class="menu-text">Artist Management</span><i class="menu-arrow"></i>
                    </a>
                    <div class="menu-submenu">
                        <i class="menu-arrow"></i>
                        <ul class="menu-subnav">
                            <li class="menu-item menu-item-parent" aria-haspopup="true">
                                <span class="menu-link"><span class="menu-text">Buy</span></span>
                            </li>
                            <li class="menu-item {{ str_contains($currentUrl, 'pendingartist') ? 'menu-item-active' : '' }}" aria-haspopup="true">
                                <a href="{{ url('admin/artist/pendingartist') }}" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot"><span></span></i><span class="menu-text">Pending Approvals</span>
                                </a>
                            </li>
                            <li class="menu-item {{ str_contains($currentUrl, 'approvedartist') ? 'menu-item-active' : '' }}" aria-haspopup="true">
                                <a href="{{ url('admin/artist/approvedartist') }}" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot"><span></span></i><span class="menu-text">Approved Artist</span>
                                </a>
                            </li>
                            <li class="menu-item {{ str_contains($currentUrl, 'rejectartist') ? 'menu-item-active' : '' }}" aria-haspopup="true">
                                <a href="{{ url('admin/artist/rejectartist') }}" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot"><span></span></i><span class="menu-text">Reject Artist</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
                    <a href="javascript:;" class="menu-link menu-toggle">
                        <span class="material-symbols-outlined">Event</span>
                        <span class="menu-text">Event Management</span><i class="menu-arrow"></i>
                    </a>
                    <div class="menu-submenu">
                        <i class="menu-arrow"></i>
                        <ul class="menu-subnav">
                            <li class="menu-item menu-item-parent" aria-haspopup="true">
                                <span class="menu-link"><span class="menu-text">Buy</span></span>
                            </li>
                            <li class="menu-item {{ str_contains($currentUrl, 'allevents') ? 'menu-item-active' : '' }}" aria-haspopup="true">
                                <a href="{{ url('admin/events/allevents') }}" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot"><span></span></i><span class="menu-text">All Events</span>
                                </a>
                            </li>
                            <li class="menu-item {{ str_contains($currentUrl, 'createnewevent') ? 'menu-item-active' : '' }}" aria-haspopup="true">
                                <a href="{{ url('admin/events/createnewevent') }}" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot"><span></span></i><span class="menu-text">Add Events</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
                    <a href="javascript:;" class="menu-link menu-toggle">
                        <span class="material-symbols-outlined">work</span>
                        <span class="menu-text">Job Management</span><i class="menu-arrow"></i>
                    </a>
                    <div class="menu-submenu">
                        <i class="menu-arrow"></i>
                        <ul class="menu-subnav">
                            <li class="menu-item menu-item-parent" aria-haspopup="true">
                                <span class="menu-link"><span class="menu-text">Buy</span></span>
                            </li>
                            <li class="menu-item {{ str_contains($currentUrl, 'newjob') ? 'menu-item-active' : '' }}" aria-haspopup="true">
                                <a href="{{ url('admin/jobs/newjob') }}" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot"><span></span></i><span class="menu-text">New Job Postings</span>
                                </a>
                            </li>
                            <li class="menu-item {{ str_contains($currentUrl, 'ongoingjob') ? 'menu-item-active' : '' }}" aria-haspopup="true">
                                <a href="{{ url('admin/jobs/ongoingjob') }}" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot"><span></span></i><span class="menu-text">Ongoing Jobs</span>
                                </a>
                            </li>
                            <li class="menu-item {{ str_contains($currentUrl, 'completejobs') ? 'menu-item-active' : '' }}" aria-haspopup="true">
                                <a href="{{ url('admin/jobs/completejobs') }}" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot"><span></span></i><span class="menu-text">Completed Jobs</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
                    <a href="javascript:;" class="menu-link menu-toggle">
                        <span class="material-symbols-outlined">help</span>
                        <span class="menu-text">FAQ</span><i class="menu-arrow"></i>
                    </a>
                    <div class="menu-submenu">
                        <i class="menu-arrow"></i>
                        <ul class="menu-subnav">
                            <li class="menu-item menu-item-parent" aria-haspopup="true">
                                <span class="menu-link"><span class="menu-text">FAQ</span></span>
                            </li>
                            <li class="menu-item {{ str_contains($currentUrl, 'faqcategories') ? 'menu-item-active' : '' }}" aria-haspopup="true">
                                <a href="{{ url('admin/faq/faqcategories') }}" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot"><span></span></i><span class="menu-text">Categories</span>
                                </a>
                            </li>
                            <li class="menu-item {{ str_contains($currentUrl, 'allfaq') ? 'menu-item-active' : '' }}" aria-haspopup="true">
                                <a href="{{ url('admin/faq/allfaq') }}" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot"><span></span></i><span class="menu-text">ALL FAQ</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
                    <a href="javascript:;" class="menu-link menu-toggle">
                        <span class="material-symbols-outlined">rss_feed</span>
                        <span class="menu-text">Blogs</span><i class="menu-arrow"></i>
                    </a>
                    <div class="menu-submenu">
                        <i class="menu-arrow"></i>
                        <ul class="menu-subnav">
                            <li class="menu-item menu-item-parent" aria-haspopup="true">
                                <span class="menu-link"><span class="menu-text">Blogs</span></span>
                            </li>
                            <li class="menu-item {{ str_contains($currentUrl, 'blogcategories') ? 'menu-item-active' : '' }}" aria-haspopup="true">
                                <a href="{{ url('admin/blogs/blogcategories') }}" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot"><span></span></i><span
                                        class="menu-text">Categories</span>
                                </a>
                            </li>
                            <li class="menu-item {{ str_contains($currentUrl, 'allblogs') ? 'menu-item-active' : '' }}" aria-haspopup="true">
                                <a href="{{ url('admin/blogs/allblogs') }}" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot"><span></span></i><span class="menu-text">ALL
                                    Blogs</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
                    <a href="javascript:;" class="menu-link menu-toggle">
                        <span class="material-symbols-outlined">play_circle</span>
                        <span class="menu-text">Videos</span><i class="menu-arrow"></i>
                    </a>
                    <div class="menu-submenu">
                        <i class="menu-arrow"></i>
                        <ul class="menu-subnav">
                            <li class="menu-item menu-item-parent" aria-haspopup="true">
                                <span class="menu-link"><span class="menu-text">Videos</span></span>
                            </li>
                            <li class="menu-item {{ str_contains($currentUrl, 'videocategories') ? 'menu-item-active' : '' }}" aria-haspopup="true">
                                <a href="{{ url('admin/video/videocategories') }}" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot"><span></span></i><span
                                        class="menu-text">Categories</span>
                                </a>
                            </li>
                            <li class="menu-item {{ str_contains($currentUrl, 'video') ? 'menu-item-active' : '' }}" aria-haspopup="true">
                                <a href="{{ url('admin/video/allvideos') }}" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot"><span></span></i><span class="menu-text">ALL Videos</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                    <li class="menu-item {{ str_contains($currentUrl, 'alltestimonials') ? 'menu-item-active' : '' }}" aria-haspopup="true" data-menu-toggle="hover">
                        <a href="{{ url('admin/testimonials/alltestimonials') }}" class="menu-link menu-toggle">
                            <span class="material-symbols-outlined">rate_review</span>
                            <span class="menu-text">Testimonials</span>
                        </a>
                    </li>
                <li class="menu-item {{ str_contains($currentUrl, 'allreviews') ? 'menu-item-active' : '' }}" aria-haspopup="true" data-menu-toggle="hover">
                    <a href="{{ url('admin/reviews/allreviews') }}" class="menu-link menu-toggle">
                        <span class="material-symbols-outlined">reviews</span>
                        <span class="menu-text">Reviews</span>
                    </a>
                <li class="menu-section">
                    <h4 class="menu-text">Website Settings</h4>
                    <i class="menu-icon ki ki-bold-more-hor icon-md"></i>
                </li>
                <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
                    <a href="javascript:;" class="menu-link menu-toggle">
                        <span class="material-symbols-outlined">settings</span>
                        <span class="menu-text">settings</span><i class="menu-arrow"></i>
                    </a>
                    <div class="menu-submenu">
                        <i class="menu-arrow"></i>
                        <ul class="menu-subnav">
                            <li class="menu-item menu-item-parent" aria-haspopup="true">
                                <span class="menu-link"><span class="menu-text">Videos</span></span>
                            </li>
                            <li class="menu-item {{ str_contains($currentUrl, 'settings') ? 'menu-item-active' : '' }}" aria-haspopup="true" data-menu-toggle="hover">
                                <a href="{{ url('admin/website/settings/commission') }}" class="menu-link menu-toggle">
                                    <i class="menu-bullet menu-bullet-dot"><span></span></i>
                                    <span class="menu-text">Commission</span>
                                </a>
                            </li>
                            <li class="menu-item {{ str_contains($currentUrl, 'settings') ? 'menu-item-active' : '' }}" aria-haspopup="true" data-menu-toggle="hover">
                                <a href="{{ url('admin/website/settings') }}" class="menu-link menu-toggle">
                                    <i class="menu-bullet menu-bullet-dot"><span></span></i>
                                    <span class="menu-text">Site settings</span>
                                </a>
                            </li>
                            <li class="menu-item {{ str_contains($currentUrl, 'sitelinks') ? 'menu-item-active' : '' }}" aria-haspopup="true">
                                <a href="{{ url('admin/website/sitelinks') }}" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot"><span></span></i><span class="menu-text">ALL Site Links</span>
                                </a>
                            </li>
                            <li class="menu-item {{ str_contains($currentUrl, 'sitelinkcat') ? 'menu-item-active' : '' }}" aria-haspopup="true">
                                <a href="{{ url('admin/website/sitelinkcat') }}" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot"><span></span></i><span class="menu-text">ALL Site Links Category</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                    <li class="menu-item menu-item-submenu {{ str_contains($currentUrl, 'contact/messages') ? 'menu-item-active' : '' }}" aria-haspopup="true" data-menu-toggle="hover">
                        <a href="{{ url('admin/contact/messages') }}" class="menu-link menu-toggle">
                            <span class="material-symbols-outlined">business_messages</span>
                            <span class="menu-text">Contact Messages</span>
                        </a>
                    </li>
                <li class="menu-section">
                    <h4 class="menu-text">Profile</h4>
                    <i class="menu-icon ki ki-bold-more-hor icon-md"></i>
                </li>
                    <li class="menu-item menu-item-submenu {{ str_contains($currentUrl, 'profile') ? 'menu-item-active' : '' }}"  aria-haspopup="true" data-menu-toggle="hover">
                        <a href="{{ url('admin/profile') }}" class="menu-link menu-toggle">
                            <span class="material-symbols-outlined">person</span>
                            <span class="menu-text">My Profile</span>
                        </a>
                    </li>
                <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
                    <a onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"
                        href="{{ route('admin.logout') }}" class="menu-link menu-toggle">
                        <span class="material-symbols-outlined">logout</span>
                        <span class="menu-text">Logout</span>
                        <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </a>
                </li>
            </ul>
            <!--end::Menu Nav-->
        </div>
        <!--end::Menu Container-->
    </div>
    <!--end::Aside Menu-->
</div>
<!--end::Aside-->