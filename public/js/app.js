(function () {
    "use strict";
  
    var carousels = function () {
      $(".owl-carousel1").owlCarousel({
        loop: true,
        center: true,
        margin: 0,
        responsiveClass: true,
        nav: false,
        responsive: {
          0: {
            items: 1,
            nav: false
          },
          680: {
            items: 2,
            nav: false,
            loop: false
          },
          1000: {
            items: 3,
            nav: true
          }
        }
      });
    };
  
    (function ($) {
      carousels();
    })(jQuery);
  })();

  const navbar = document.querySelector(".fixed-top");
  window.onscroll = () => {
    if (window.scrollY > 100) {
      navbar.classList.add("scroll-nav-active");
      navbar.classList.add("text-nav-active");
      navbar.classList.remove("navbar-dark");
    } else {
      navbar.classList.remove("scroll-nav-active");
      navbar.classList.add("navbar-dark");
    }
  }

  $(document).ready(function () {
    $('#contactForm').submit(function (e) {
        e.preventDefault();

        var form = $(this);
        var url = form.attr('action');
        var method = form.attr('method');
        var formData = form.serialize();

        $.ajax({
            type: method,
            url: url,
            data: formData,
            success: function (response) {
                // Tampilkan SweetAlert
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: response.message
                });

                // Clear form jika perlu
                form.trigger('reset');
            },
            error: function (error) {
                // Tampilkan SweetAlert untuk error jika diperlukan
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Something went wrong!'
                });
            }
        });
    });
});