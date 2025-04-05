@php
    $url = request()->segment(count(request()->segments()));
@endphp
<div class="offcanvas__area offcanvas__radius">
    <div class="offcanvas__wrapper">
        <div class="offcanvas__close">
            <button class="offcanvas__close-btn offcanvas-close-btn">
                <svg width="12" height="12" viewBox="0 0 12 12" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path d="M11 1L1 11" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                        stroke-linejoin="round" />
                    <path d="M1 1L11 11" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
            </button>
        </div>
        <div class="offcanvas__content">
            <div class="offcanvas__top mb-70 d-flex justify-content-between align-items-center">
                <div class="offcanvas__logo logo">
                    <a href="{{ url('') }}">
                        <img src="{{ url('public/front/img/logo.png') }}" alt="logo">
                    </a>
                </div>
            </div>
            <div class="offcanvas__category pb-40">
                <div class="tp-category-mobile-menu">
                </div>
            </div>
        </div>
    </div>
</div>
<header>
    <div class="tp-header-area p-relative z-index-11 bg-white tp-header-sticky">
        <div class="tp-header-main">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-xl-2 col-lg-2 col-md-12">
                        <div class="logo">
                            <a href="{{ url('') }}">
                                <img src="{{ url('public/front/img/logo.png') }}" alt="logo">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<style type="text/css">
    .tp-header-main {
        box-shadow: none !important;
        position: fixed;
        width: 100%;
        background: white;
        z-index: 10000;
    }
</style>