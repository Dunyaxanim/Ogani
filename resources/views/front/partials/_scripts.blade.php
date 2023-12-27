<!-- Js Plugins -->
<script src="{{ asset('projects/front/js/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('projects/front/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('projects/front/js/jquery.nice-select.min.js') }}"></script>
<script src="{{ asset('projects/front/js/jquery-ui.min.js') }}"></script>
<script src="{{ asset('projects/front/js/jquery.slicknav.js') }}"></script>
<script src="{{ asset('projects/front/js/mixitup.min.js') }}"></script>
<script src="{{ asset('projects/front/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('projects/front/js/main.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>


<script>
    $(document).ready(function() {
        $('.favory a').on('click', function(event) {
            event.preventDefault();
            event.stopPropagation();
            var productId = $(this).data('post');
            $.ajax({
                type: 'POST',
                url: `/favory/${productId}`,
                data: {
                    "_token": "{{ csrf_token() }}",
                    productId: productId
                },
                success: function(response) {
                    if (response) {
                        event.target.classList.toggle('green-heart')
                        let wishlist_count = document.getElementsByClassName(
                            'wishlist_count');
                        let count = wishlist_count[0].innerHTML;
                        let firstWishlistCountElement = wishlist_count[0];
                        if (event.target.classList.contains('green-heart')) {
                            count++;
                        } else {
                            count--;
                        }

                        firstWishlistCountElement.innerText = count;
                    }
                },
                error: function(error) {
                    window.location.href = "login-index";
                }
            });
        });

        $('.featured__item.route').on('click', function(event) {
            event.stopPropagation();
        });
    });
</script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const elements = document.querySelectorAll('.route');
        elements.forEach(function(element) {
            element.addEventListener('click', function() {
                const path = this.getAttribute('data-href');
                window.location.href = path;
            });
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('.basket a').on('click', function(event) {
            event.preventDefault();
            event.stopPropagation();
            const productId = $(this).data('post');
            const count = $(this).data('count');
            $.ajax({
                type: 'POST',
                url: `/basket/${productId}?count=${count}`,
                data: {

                    "_token": "{{ csrf_token() }}",
                    productId: productId,
                    count: count
                },
                success: function(response) {
                    if (response) {
                        $('.basket_count').text(response['basketcount']);
                        $('.total').text(response['total']);
                    }
                },
                error: function(error) {
                    window.location.href = "/login-index";
                }
            });
        });

        $('.featured__item.route').on('click', function(event) {
            event.stopPropagation();
        });
    });
</script>

<script>
    const message = document.querySelector('.deleted-message')
    if (message) {
        setTimeout(() => {
            message.classList.add("fade");
        }, 4000);
    }
</script>

@yield('_scripts')
