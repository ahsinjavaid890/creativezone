<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="keywords" content="Home" />
    <meta name="description" content="Join us and get the offers " />
    <meta name="author" content="Jiowireless" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="sssV7EtSgQKtFmYFmtOV90hmlmAdE38tnLSfaHdA">
    @yield('tittle')
    <link rel="icon" href="{{ url('public/front/img/favicon.png') }}" />
    <link rel="stylesheet" href="{{ url('public/front/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ url('public/front/css/animate.css') }}">
    <link rel="stylesheet" href="{{ url('public/front/css/swiper-bundle.css') }}">
    <link rel="stylesheet" href="{{ url('public/front/css/slick.css') }}">
    <link rel="stylesheet" href="{{ url('public/front/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ url('public/front/css/font-awesome-pro.css') }}">
    <link rel="stylesheet" href="{{ url('public/front/css/flaticon_shofy.css') }}">
    <link rel="stylesheet" href="{{ url('public/front/css/spacing.css') }}">
    <link rel="stylesheet" href="{{ url('public/front/css/main.css') }}">
    <link rel="stylesheet" href="{{ url('public/front/css/custom.css') }}">
    <link rel="stylesheet" href="{{ url('public/front/css/owl.carousel.min.css') }}">
    <link href="{{ url('public/front/backend/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
</head>

<body>
	@include('frontend.includes.simpleheader')
	@yield('content')
	<script src="{{ url('public/front/js/vendor/jquery.js') }}"></script>
    <script src="{{ url('public/front/js/vendor/waypoints.js') }}"></script>
    <script src="{{ url('public/front/js/bootstrap-bundle.js') }}"></script>
    <script src="{{ url('public/front/js/meanmenu.js') }}"></script>
    <script src="{{ url('public/front/js/swiper-bundle.js') }}"></script>
    <script src="{{ url('public/front/js/slick.js') }}"></script>
    <script src="{{ url('public/front/js/range-slider.js') }}"></script>
    <script src="{{ url('public/front/js/magnific-popup.js') }}"></script>
    <script src="{{ url('public/front/js/nice-select.js') }}"></script>
    <script src="{{ url('public/front/js/purecounter.js') }}"></script>
    <script src="{{ url('public/front/js/countdown.js') }}"></script>
    <script src="{{ url('public/front/js/wow.js') }}"></script>
    <script src="{{ url('public/front/js/isotope-pkgd.js') }}"></script>
    <script src="{{ url('public/front/js/imagesloaded-pkgd.js') }}"></script>
    <script src="{{ url('public/front/js/ajax-form.js') }}"></script>
    <script src="{{ url('public/front/js/main.js') }}"></script>
    <script src="{{ url('public/front/js/owl.carousel.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
    <script src="{{ url('public/front/backend/libs/sweetalert2/sweetalert2.min.js') }}"></script>
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
                    $('#cartshow').html(data.cartshow);
                    $('.cart-count').html(data.cartcount);
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
            $.ajax({
                url: '{{ url("mainsearch") }}', 
                method: 'GET',
                data: { q: query },
                success: function(data) {
                    var results = Object.values(data);
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
                $(this).alert('close'); 
            });
        }, 3000);
    });
    $(document).ready(function() {
    $('#cartIcon').on('click', function(e) {
        e.preventDefault();
        $('#cartSidebar').addClass('active');
    });
    $('#closeCart').on('click', function() {
        $('#cartSidebar').removeClass('active');
    });
    $(document).on('click', function(e) {
        if (!$(e.target).closest('#cartSidebar, #cartIcon').length) {
            $('#cartSidebar').removeClass('active');
        }
    });
});
$(document).ready(function() {
    $('.remove-item').on('click', function(e) {
        e.preventDefault();
        var productId = $(this).data('id'); 
        var cartItem = $('#cart-item-' + productId);
        
        $.ajax({
            url: "{{ url('cart/remove') }}", 
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}", 
                id: productId
            },
            success: function(response) {
                if (response.success) {
                    cartItem.remove(); 
                    // Optionally update the cart or redirect
                    // fetchCartItems();  // Uncomment if this function is defined and needed
                } else {
                    alert(response.message);
                }
            },
            error: function(xhr) {
                console.log(xhr.responseText);
            }
        });
    });
});
</script>
</body>
</html>