@php
    $settings = DB::table('site_settings')->where('smallname' , env('APP_NAME'))->first();
@endphp
<footer>
    <div class="tp-footer-area">
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