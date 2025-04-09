<header>
    <div class="header-area homepage1 header header-sticky d-none d-lg-block" id="header">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="header-elements">
                        <div class="site-logo">
                            <a href="{{ url('')}}"><img src="{{ url('newfront/assets/img/logo/logo1.jpg') }}" alt="" /></a>
                        </div>
                        <div class="main-menu">
                            <ul>
                                <li>
                                    <a href="{{ url('') }}">Home</a>
                                </li>
                                <li><a href="{{ url('aboutus') }}">About Us</a></li>
                                <li>
                                    <a href="{{ url('all-events') }}">Our Event</a>
                                </li>
                                <li>
                                    <a href="{{ url('blogs') }}">Our Blogs</a>
                                </li>
                                <li>
                                    <a href="{{ url('contact') }}">Contact Us</a>
                                </li>
                            </ul>
                        </div>
                        <div class="btn-area">
                            <ul>
                                @if(Auth::guard('artist')->check())
                                <li class="p-2">
                                    <a href="{{ url('dashboard') }}">Dashboard</i></a>
                                </li>
                                <li>
                                    <a href="{{ route('logout') }}"onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Log Out</i></a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                      @csrf
                                   </form>
                                </li>
                                @else
                                <li class="p-2">
                                    <a href="{{ url('login') }}">Login</i></a>
                                </li>
                                <li>
                                    <a href="{{ url('register') }}">Registration</i></a>
                                </li>
                                @endif
                            </ul>
                        </div>

                        <div class="header-search-form-wrapper">
                            <div class="tx-search-close tx-close"><i class="fa-solid fa-xmark"></i></div>
                            <div class="header-search-container">
                                <form role="search" class="search-form">
                                    <input type="search" class="search-field" placeholder="Search …" value="" name="s" />
                                    <button type="submit" class="search-submit"><img src="{{ url('newfront/assets/img/icons/search1.svg') }}" alt="" /></button>
                                </form>
                            </div>
                        </div>
                        <div class="body-overlay"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!--===== MOBILE HEADER STARTS =======-->
    <div class="mobile-header mobile-haeder1 d-block d-lg-none">
        <div class="container-fluid">
            <div class="col-12">
                <div class="mobile-header-elements">
                    <div class="mobile-logo">
                        <a href="{{ url('')}}"><img src="{{ url('newfront/assets/img/logo/logo1.png') }}" alt="" /></a>
                    </div>
                    <div class="mobile-nav-icon dots-menu">
                        <i class="fa-solid fa-bars-staggered"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="mobile-sidebar mobile-sidebar1">
        <div class="logosicon-area">
            <div class="logos">
                <img src="{{ url('newfront/assets/img/logo/logo1.png') }}" alt="" />
            </div>
            <div class="menu-close">
                <i class="fa-solid fa-xmark"></i>
            </div>
        </div>
        <div class="mobile-nav mobile-nav1">
            <ul class="mobile-nav-list nav-list1">
                <li>
                    <a href="#">Home</a>
                </li>
                <li><a href="about.html">About Event</a></li>
                <li>
                    <a href="#">Speakers</a>
                </li>

                <li>
                    <a href="#">Our Event</a>
                </li>
                <li>
                    <a href="#">Our Blogs</a>
                </li>
                <li>
                    <a href="#">Contact Us</a>
                </li>
            </ul>
            <div class="allmobilesection">
                <a href="contact.html" class="vl-btn1">Contact Now</a>
                <div class="single-footer">
                    <h3>Contact Info</h3>
                    <div class="footer1-contact-info">
                        <div class="contact-info-single">
                            <div class="contact-info-icon">
                                <span><i class="fa-solid fa-phone-volume"></i></span>
                            </div>
                            <div class="contact-info-text">
                                <a href="tel:+3(924)4596512">+3(924)4596512</a>
                            </div>
                        </div>
                        <div class="contact-info-single">
                            <div class="contact-info-icon">
                                <span><i class="fa-solid fa-envelope"></i></span>
                            </div>
                            <div class="contact-info-text">
                                <a href="mailto:info@example.com">info@example.com</a>
                            </div>
                        </div>
                        <div class="single-footer">
                            <h3>Our Location</h3>
                            <div class="contact-info-single">
                                <div class="contact-info-icon">
                                    <span><i class="fa-solid fa-location-dot"></i></span>
                                </div>
                                <div class="contact-info-text">
                                    <a href="mailto:info@example.com">55 East Birchwood Ave.Brooklyn, <br />
                                            New York 11201,United States</a
                                        >
                                    </div>
                                </div>
                            </div>
                            <div class="single-footer">
                                <h3>Social Links</h3>
                                <div class="social-links-mobile-menu">
                                    <ul>
                                        <li>
                                            <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
                                    </li>
                                    <li>
                                        <a href="#"><i class="fa-brands fa-instagram"></i></a>
                                    </li>
                                    <li>
                                        <a href="#"><i class="fa-brands fa-linkedin-in"></i></a>
                                    </li>
                                    <li>
                                        <a href="#"><i class="fa-brands fa-youtube"></i></a>
                                    </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>