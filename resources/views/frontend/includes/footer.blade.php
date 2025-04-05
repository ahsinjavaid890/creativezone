@php
    $settings = DB::table('site_settings')->where('smallname' , env('APP_NAME'))->first();
@endphp
<footer>
    <div class="tp-footer-area">
        <div class="tp-footer-top pt-60 pb-40">
            <div class="container">
                <div class="row">
                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
                        <div class="tp-footer-widget footer-col-1 mb-30">
                            <div class="tp-footer-widget-content">
                                <div class="tp-footer-logo">
                                    <a href="{{ url('') }}">
                                        <img src="{{ url('public/images') }}/{{ $settings->footer_logo }}" alt="{{ $settings->site_name }}" class="img-fluid">
                                    </a>
                                </div>
                                <p>{{ $settings->footer_description }}</p>
                                <p><a href="tel:{{ $settings->site_phonenumber }}"><i class="fa fa-phone me-1" aria-hidden="true"></i>{{ $settings->site_phonenumber }}</a></p>
                                <p><a href="mailto:{{ $settings->site_email }}"><i class="fa-light fa-envelope me-1"></i>{{ $settings->site_email }}</a></p>
                            </div>
                        </div>
                    </div>
                    @foreach(DB::table('sitelink_cats')->get() as $r)
                    <div class="col-xl-2 col-lg-3 col-md-2 col-sm-6">
                        <div class="tp-footer-widget footer-col-2 mb-30">
                            <div class="tp-footer-widget-content">
                                <div class="socaiL-headf">
                                    <h3>{{ $r->name }}</h3>
                                </div>
                                <ul>

                                    @if($r->name == 'Social')
                                    @foreach(DB::table('sitelinks')->where('category', 'Social')->get() as $s)
                                    @if($s->name == 'Facebook')
                                    <li>
                                        <a href="{{ $s->url }}" target="_blank">
                                            <i class="fa-brands fa-facebook-f me-1"></i> <span>{{ $s->name }}</span>
                                        </a>
                                    </li>
                                    @endif
                                    @if($s->name == 'Instagram')
                                    <li>
                                        <a href="{{ $s->url }}" target="_blank">
                                            <i class="fa-brands fa-instagram me-1"></i> <span>{{ $s->name }}</span>
                                        </a>
                                    </li>
                                    @endif
                                    @if($s->name == 'Twitter')
                                    <li>
                                        <a href="{{ $s->url }}" target="_blank">
                                            <i class="fa-brands fa-twitter me-1"></i><span>{{ $s->name }}</span>
                                        </a>
                                    </li>
                                    @endif
                                    @if($s->name == 'Youtube')
                                    <li>
                                        <a href="{{ $s->url }}" target="_blank">
                                            <i class="fa-brands fa-youtube me-1"></i><span>{{ $s->name }}</span>
                                        </a>
                                    </li>
                                    @endif
                                    @endforeach
                                    @else
                                    @foreach(DB::table('sitelinks')->where('category', $r->name)->get() as $s)
                                    <li><a href="{{ url($s->url) }}">{{ $s->name }}</a></li>
                                    @endforeach
                                    @endif

                                </ul>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="tp-footer-bottom">
            <div class="container">
                <div class="tp-footer-bottom-wrapper">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <div class="tp-footer-copyright text-center">
                                <p>Copyright &copy; {{ date('Y') }}. A Jio Wireless Company. All rights reserved.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- Cart Sidebar -->
<div id="cartSidebar" class="cart-sidebar">
    <div class="cart-header">
        <h3>Cart</h3>
        <button id="closeCart" class="close-btn">&times;</button>
    </div>
    <div class="cart-body" id="cartshow">
        
    </div>
    <div class="cart-footer">
        @auth
        <a href="{{ url('user/checkout') }}" class="btn btn-primary form-control cart-proceedbutton">Proceed To Checkout</a>
        @endauth
        @guest
        <a href="{{ url('login') }}?redirectback=cart" class="btn btn-primary form-control cart-proceedbutton">Login To Checkout</a>
        @endguest
    </div>
</div>
<div id="cartOverlay" class="cart-overlay"></div>