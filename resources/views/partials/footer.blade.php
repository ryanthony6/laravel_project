@unless (Route::is('login') || Route::is('register') || Route::is('password.request') || Route::is('profile.index') )
<footer class="text-center bg-footer" @if (Route::is('booking.history')) style="position: absolute; bottom: 0; width: 100%;" @endif>
    <!-- Grid container -->
    <div class="container pt-3">
      <!-- Section: Social media -->
      <section class="mb-2">
        <!-- Facebook -->
        <a
          class="container m-1 "
          href="#!"
          ><i class="fab fa-facebook-f footer-icon"></i
        ></a>
        <!-- Instagram -->
        <a
          class="container m-1"
          href="#!"
          ><i class="fab fa-instagram footer-icon"></i
        ></a>
        
      </section>
      <!-- Section: Social media -->
    </div>
    <!-- Grid container -->
  
    <!-- Copyright -->
    <div class="text-center p-2 text-white">
     Cahaya Sports© 2024 Copyright
    </div>
    <!-- Copyright -->
  </footer>
@endunless
