<!DOCTYPE html>
<html lang="zxx">

<head>
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="keywords" content="Home" />
    <meta name="description" content="Join us and get the offers " />
    <meta name="author" content="Jiowireless" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="sssV7EtSgQKtFmYFmtOV90hmlmAdE38tnLSfaHdA">
    @yield('tittle')
    <link rel="icon" href="{{ url('public/front/img/favicon.png') }}" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Sora:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- Bootstrap css -->
    <link href="{{ url('public/front/comunityasset/css/bootstrap.min.css') }}" rel="stylesheet" media="screen">
    <!-- SlickNav css -->
    <link rel="stylesheet" href="{{ url('public/front/css/custom.css') }}">
    <link href="{{ url('public/front/comunityasset/css/slicknav.min.css') }}" rel="stylesheet">
    <!-- Swiper css -->
    <link rel="stylesheet" href="{{ url('public/front/comunityasset/css/swiper-bundle.min.css') }}">
    <!-- Font Awesome icon css-->
    <link href="{{ url('public/front/comunityasset/css/all.min.css') }}" rel="stylesheet" media="screen">
    <!-- Animated css -->
    <link href="{{ url('public/front/comunityasset/css/animate.css') }}" rel="stylesheet">
    <!-- Magnific css -->
    <link href="{{ url('public/front/comunityasset/css/magnific-popup.css') }}" rel="stylesheet">
    <!-- Main custom css -->
    <link href="{{ url('public/front/comunityasset/css/custom.css') }}" rel="stylesheet" media="screen">
    <link rel="stylesheet" href="{{ url('public/front/css/font-awesome-pro.css') }}">
    <link rel="stylesheet" href="{{ url('public/front/css/spacing.css') }}">
</head>
  <body class="tt-magic-cursor">
     
    @include('frontend.includes.header')
      @yield('content')
    @include('frontend.includes.footer')
      <!-- Jquery Library File -->
      <script src="{{ url('public/front/comunityasset/js/jquery-3.7.1.min.js') }}"></script>
      <!-- Bootstrap js file -->
      <script src="{{ url('public/front/comunityasset/js/bootstrap.min.js') }}"></script>
      <!-- Validator js file -->
      <script src="{{ url('public/front/comunityasset/js/validator.min.js') }}"></script>
      <!-- SlickNav js file -->
      <script src="{{ url('public/front/comunityasset/js/jquery.slicknav.js') }}"></script>
      <!-- Swiper js file -->
      <script src="{{ url('public/front/comunityasset/js/swiper-bundle.min.js') }}"></script>
      <!-- Counter js file -->
      <script src="{{ url('public/front/comunityasset/js/jquery.waypoints.min.js') }}"></script>
      <script src="{{ url('public/front/comunityasset/js/jquery.counterup.min.js') }}"></script>
      <!-- Magnific js file -->
      <script src="{{ url('public/front/comunityasset/js/jquery.magnific-popup.min.js') }}"></script>
      <!-- SmoothScroll -->
      <script src="{{ url('public/front/comunityasset/js/SmoothScroll.js') }}"></script>
      <!-- Parallax js -->
      <script src="{{ url('public/front/comunityasset/js/parallaxie.js') }}"></script>
      <!-- MagicCursor js file -->
      <script src="{{ url('public/front/comunityasset/js/gsap.min.js') }}"></script>
      <script src="{{ url('public/front/comunityasset/js/magiccursor.js') }}"></script>
      <!-- Text Effect js file -->
      <script src="{{ url('public/front/comunityasset/js/splitType.js') }}"></script>
      <script src="{{ url('public/front/comunityasset/js/ScrollTrigger.min.js') }}"></script>
      <!-- Wow js file -->
      <script src="{{ url('public/front/comunityasset/js/wow.js') }}"></script>
      <!-- Main Custom js file -->
      <script src="{{ url('public/front/comunityasset/js/function.js') }}"></script>



         <script>
        $('.gallery-container').each(function() {
            $(this).magnificPopup({
                delegate: 'a',
                type: 'image',
                gallery: {
                    enabled: true
                }
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            fetchCartItems();
        });
        function fetchCartItems() {
                $.ajax({
                    url: '{{ url("cart/items") }}',
                    type: 'GET',
                    success: function(data) {
                        $('#cartshow').html(data);
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching cart items:', error);
                    }
                });
            }
    </script>
    @yield('script')
    <script>
    $(document).ready(function() {
        $('#search-input').on('input', function() {
            var query = $(this).val();
            if (query.length > 0) {
                // Perform an AJAX call to get search results
                $.ajax({
                    url: '{{ url("mainsearch") }}', // Your server-side search endpoint
                    method: 'GET',
                    data: { q: query },
                    success: function(data) {
                        var results = Object.values(data); // Convert object to array
                        var $resultsContainer = $('#search-results');
                        $resultsContainer.empty().removeClass('d-none');
                        if (results.length > 0) {
                            $.each(results, function(index, item) {
                                var resultItem = `
                                    <div class="result-item">
                                        <a href="${item.url}" class="result-link">
                                            <img src="${item.image}" alt="${item.name}">
                                            <div class="info">
                                                <div class="name">${item.name}</div>
                                                <div class="price">${item.sell_price ? item.sell_price : 'N/A'}</div>
                                            </div>
                                        </a>
                                    </div>
                                `;
                                $resultsContainer.append(resultItem);
                            });
                        } else {
                            $resultsContainer.html('<div class="no-results">No results found</div>');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX error:', status, error);
                    }
                });
            } else {
                $('#search-results').addClass('d-none');
            }
        });
    });
</script>

<script>
    $(document).ready(function() {
        setTimeout(function() {
            $('.alert').fadeOut('slow', function() {
                $(this).alert('close'); // This line ensures the alert is properly closed after the fade-out
            });
        }, 3000); // Adjust the delay time (5000 milliseconds = 5 seconds) before the fade starts
    });
</script>
  </body>
</html>