<!doctype html>
<html lang="en">

  <head>
  <title>{{
    \App\infoPerusahaan::first()->nama
    }}</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    

    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="fonts/icomoon/style.css">

    <link rel="stylesheet" href="{{ asset('depot/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{ asset('depot/css/jquery.fancybox.min.css')}}">
    <link rel="stylesheet" href="{{ asset('depot/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{ asset('depot/css/owl.theme.default.min.css')}}">
    <link rel="stylesheet" href="fonts/flaticon/font/flaticon.css')}}">
    <link rel="stylesheet" href="{{ asset('depot/css/aos.css')}}">

    <!-- MAIN CSS -->
    <link rel="stylesheet" href="{{ asset('depot/css/style.css')}}">

  </head>

  <body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">

    

    <div class="site-wrap" id="home-section">

      <div class="site-mobile-menu site-navbar-target">
        <div class="site-mobile-menu-header">
          <div class="site-mobile-menu-close mt-3">
            <span class="icon-close2 js-menu-toggle"></span>
          </div>
        </div>
        <div class="site-mobile-menu-body"></div>
      </div>


      {{-- <div class="top-bar">
        <div class="container">
          <div class="row">
            <div class="col-12">
              <a href="#" class=""><span class="mr-2  icon-envelope-open-o"></span> <span class="d-none d-md-inline-block">info@yourdomain.com</span></a>
              <span class="mx-md-2 d-inline-block"></span>
              <a href="#" class=""><span class="mr-2  icon-phone"></span> <span class="d-none d-md-inline-block">1+ (234) 5678 9101</span></a>


              <div class="float-right">

                <a href="#" class=""><span class="mr-2  icon-twitter"></span> <span class="d-none d-md-inline-block">Twitter</span></a>
                <span class="mx-md-2 d-inline-block"></span>
                <a href="#" class=""><span class="mr-2  icon-facebook"></span> <span class="d-none d-md-inline-block">Facebook</span></a>

              </div>

            </div>

          </div>

        </div>
      </div> --}}

      <header class="site-navbar js-sticky-header site-navbar-target" role="banner">

        <div class="container">
          <div class="row align-items-center position-relative">


            <div class="site-logo">
              <a href="index.html" class="text-black"><span class="text-primary">
    {{\App\infoPerusahaan::first()->nama}}</a>
            </div>

            <div class="col-12">
              <nav class="site-navigation text-right ml-auto " role="navigation">

                <ul class="site-menu main-menu js-clone-nav ml-auto d-none d-lg-block">
                  <li></li>
               
                </ul>
              </nav>

            </div>

            <div class="toggle-button d-inline-block d-lg-none"><a href="#" class="site-menu-toggle py-5 js-menu-toggle text-black"><span class="icon-menu h3"></span></a></div>

          </div>
        </div>

      </header>

      <div class="ftco-blocks-cover-1">
        
        <div class="ftco-cover-1 overlay"  style="background-image: url({{ asset('depot/images/depot_delivery_1.jpg') }})">
          <div class="container">
            <div class="row align-items-center justify-content-center text-center">
              <div class="col-lg-6">
              <h1>{{\App\infoPerusahaan::first()->nama}}</h1>
                <p class="mb-5">{{\App\infoPerusahaan::first()->moto}}</p>
                <a href="/signin" class="btn btn-primary text-white px-4">Sign In</a>
                {{-- <form action="#">
                  <div class="form-group d-flex">
                    <input type="text" class="form-control" placeholder="Your tracking number">
                    <input type="submit" class="btn btn-primary text-white px-4" value="Track Now">
                  </div>
                </form> --}}
              </div>
            </div>
          </div>
        </div>
        <!-- END .ftco-cover-1 -->
   
      </div>

     







      <div class="site-section bg-light" id="pricing-section">
        <div class="container">
          <div class="row mb-5 justify-content-center text-center">
            <div class="col-md-7">
              <div class="block-heading-1" data-aos="fade-up" data-aos-delay="">
                <h2>Produk</h2>
                {{-- <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. </p> --}}
              </div>
            </div>
          </div>
          <div class="row mb-5">
            <div class="col-md-6 mb-4 mb-lg-0 col-lg-4" data-aos="fade-up" data-aos-delay="">

            </div>

            <div class="col-md-6 mb-4 mb-lg-0 col-lg-4" data-aos="fade-up" data-aos-delay="100">
              <div class="pricing">
                <h3 class="text-center text-black">Tahu Bulat</h3>
                <div class="price text-center mb-4 ">
                  <span><span>Rp.200</span> / buah</span>
                </div>
                <ul class="list-unstyled ul-check primary mb-5">

                </ul>
                <p class="text-center">
                  {{-- <a href="#" class="btn btn-primary btn-md text-white">Buy Now</a> --}}
                </p>
              </div>
            </div>

            <div class="col-md-6 mb-4 mb-lg-0 col-lg-4" data-aos="fade-up" data-aos-delay="200">

            </div>
          </div>


        </div>
      </div>


      <div class="site-section" id="faq-section">
        <div class="container">
          <div class="row mb-5">
            <div class="block-heading-1 col-12 text-center">
              <h2>Alamat</h2>
            </div>
          </div>
   <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3958.4716450550745!2d108.36043621477445!3d-7.186899394811196!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6f43087e24f9d3%3A0x34cfd3589f2615d0!2sSMK%20Negeri%201%20Kawali!5e0!3m2!1sid!2sid!4v1602473345765!5m2!1sid!2sid" width="100%" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
        </div>
      </div>
{{-- 
      <div class="block__73694 site-section border-top" id="why-us-section">
        <div class="container">
          <div class="row d-flex no-gutters align-items-stretch">

          <div class="col-12 col-lg-6 block__73422 order-lg-2" style="background-image: url({{asset('depot/images/depot_delivery_1.jpg')}});" data-aos="fade-left" data-aos-delay="">
            </div>



            <div class="col-lg-5 mr-auto p-lg-5 mt-4 mt-lg-0 order-lg-1" data-aos="fade-right" data-aos-delay="">
              <h2 class="mb-4 text-black">Why Depot</h2>
              <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Veniam error aliquid, dolores animi obcaecati quisquam accusamus soluta?</p>

              <ul class="ul-check primary list-unstyled mt-5">
                <li>Cargo express</li>
                <li>Secure Services</li>
                <li>Secure Warehouseing</li>
                <li>Cost savings</li>
                <li>Proven by great companies</li>
              </ul>

            </div>

          </div>
        </div>
      </div>
 --}}




    <footer class="site-footer">
      {{-- <div class="container">
        <div class="row">
          <div class="col-md-6">
            <div class="row">
              <div class="col-md-7">
                <h2 class="footer-heading mb-4"></h2>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eum voluptate debitis voluptatum et dolorum.</p>
              </div>
              <div class="col-md-4 ml-auto">
                <h2 class="footer-heading mb-4">Features</h2>
                <ul class="list-unstyled">
                  <li><a href="#">About Us</a></li>
                  <li><a href="#">Testimonials</a></li>
                  <li><a href="#">Terms of Service</a></li>
                  <li><a href="#">Privacy</a></li>
                  <li><a href="#">Contact Us</a></li>
                </ul>
              </div>

            </div>
          </div>
          <div class="col-md-4 ml-auto">


            <h2 class="footer-heading mb-4">Follow Us</h2>
            <a href="#about-section" class="smoothscroll pl-0 pr-3"><span class="icon-facebook"></span></a>
            <a href="#" class="pl-3 pr-3"><span class="icon-twitter"></span></a>
            <a href="#" class="pl-3 pr-3"><span class="icon-instagram"></span></a>
            <a href="#" class="pl-3 pr-3"><span class="icon-linkedin"></span></a>
            </form>
          </div>
        </div>
        <div class="row pt-5 mt-5 text-center">
          <div class="col-md-12">
            <div class="border-top pt-5">
              <p>
                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="icon-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank" >Colorlib</a>
                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                </p>
            </div>
          </div>

        </div>
      </div> --}}
    </footer>

    </div>

    <script src="{{ asset('depot/js/jquery-3.3.1.min.js')}}"></script>
    <script src="{{ asset('depot/js/popper.min.js')}}"></script>
    <script src="{{ asset('depot/js/bootstrap.min.js')}}"></script>
    <script src="{{ asset('depot/js/owl.carousel.min.js')}}"></script>
    <script src="{{ asset('depot/js/jquery.sticky.js')}}"></script>
    <script src="{{ asset('depot/js/jquery.waypoints.min.js')}}"></script>
    <script src="{{ asset('depot/js/jquery.animateNumber.min.js')}}"></script>
    <script src="{{ asset('depot/js/jquery.fancybox.min.js')}}"></script>
    <script src="{{ asset('depot/js/jquery.easing.1.3.js')}}"></script>
    <script src="{{ asset('depot/js/aos.js')}}"></script>

    <script src="{{ asset('depot/js/main.js')}}"></script>


  </body>

</html>
