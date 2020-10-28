<!doctype html>
<html class="no-js')}}" lang="">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>SOTONG</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- favicon
		============================================ -->
    <link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">
    <!-- Google Fonts
		============================================ -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,700,900" rel="stylesheet">
    <!-- Bootstrap CSS
		============================================ -->
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <!-- Bootstrap CSS
		============================================ -->
    <link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}">
    <!-- owl.carousel CSS
		============================================ -->
    <link rel="stylesheet" href="{{asset('css/owl.carousel.css')}}">
    <link rel="stylesheet" href="{{asset('css/owl.theme.css')}}">
    <link rel="stylesheet" href="{{asset('css/owl.transitions.css')}}">
    <!-- meanmenu CSS
		============================================ -->
        <link rel="stylesheet" href="{{asset('css/meanmenu/meanmenu.min.css')}}">
        <link rel="stylesheet" href="{{asset('css/animate.css')}}">
        <!-- animate CSS
            ============================================ -->
    <!-- normalize CSS
		============================================ -->
    <link rel="stylesheet" href="{{asset('css/normalize.css')}}">
    <!-- mCustomScrollbar CSS
		============================================ -->
    <link rel="stylesheet" href="{{asset('css/scrollbar/jquery.mCustomScrollbar.min.css')}}">
    <!-- jvectormap CSS
		============================================ -->
    <!-- notika icon CSS
		============================================ -->
    <link rel="stylesheet" href="{{asset('css/notika-custom-icon.css')}}">
    <!-- wave CSS
		============================================ -->
    {{-- <link rel="stylesheet" href="{{asset('css/wave/waves.min.css')}}"> --}}
    <!-- main CSS
		============================================ -->
    <link rel="stylesheet" href="{{asset('css/main.css')}}">
    <!-- style CSS
		============================================ -->
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <!-- responsive CSS
		============================================ -->
    <link rel="stylesheet" href="{{asset('css/responsive.css')}}">
    <!-- modernizr JS
		============================================ -->
    <script src="{{asset('js/vendor/modernizr-2.8.3.min.js')}}"></script>
<style>
@font-face {
  font-family: 'notika-icon';
  src:  url('fonts/notika-icon.eot?qzfrsz');
  src:  url('fonts/notika-icon.eot?qzfrsz#iefix') format('embedded-opentype'),
    url('fonts/notika-icon.ttf?qzfrsz') format('truetype'),
    url('fonts/notika-icon.woff?qzfrsz') format('woff'),
    url('fonts/notika-icon.svg?qzfrsz#notika-icon') format('svg');
  font-weight: normal;
  font-style: normal;
}

#disini a{
    /* padding: 50px;
    position: relative;
    top: 0;
    left: 0; */
}
</style>
</head>

<body>
    <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
    <!-- Start Header Top Area -->
    <div class="header-top-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <div class="logo-area">
						<h3  href="#Home" style="color:white;font-weight:400;">SOTONG PUTRA SHOKA</h3>
                        {{-- <a href="#"><img src="img/logo/logo.png" alt="" /></a> --}}
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- End Header Top Area -->
    <!-- Mobile Menu start -->
   @include('layouts.includes._mobile_nav')
   @include('layouts.includes._pc_nav')
    <!-- Mobile Menu end -->
    <!-- Main Menu area start-->
<div class="container">

            <td style="padding:20px;background:whitesmoke;" >
                <i class="notika-icon notika-alarm"></i>
            </td>
            
</div>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="alert-inner">
                        <div class="alert-hd">
                            <h2>Alert Basic Example</h2>
                            <p>Wrap any text and an optional dismiss button in <code>.alert</code> and one of the four contextual classes (<code>.alert-success</code>) for basic alert messages.</p>
                        </div>
                        <div class="alert-list">
                            <div > 
                                <table>
                                    <tr>
                                        <span id="disini"></span>
                                    </tr>
                                    </table>
                            </div>
                           
                        </div>
                    </div>
                </div>
    <!-- End Status area-->
    <!-- Start Sale Statistic area-->
   
    <!-- End Sale Statistic area-->
    <!-- Start Email Statistic area-->
 
    <!-- End Email Statistic area-->
    <!-- Start Realtime sts area-->

    <!-- End Realtime sts area-->
    <!-- Start Footer area-->

    <!-- End Footer area-->
    <!-- jquery
		============================================ -->
    <script src="{{asset('js/vendor/jquery-1.12.4.min.js')}}"></script>
    <!-- bootstrap JS
		============================================ -->
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <!-- wow JS
		============================================ -->
    <script src="{{asset('js/wow.min.js')}}"></script>
    <!-- price-slider JS
		============================================ -->
    <script src="{{asset('js/jquery-price-slider.js')}}"></script>
    <!-- owl.carousel JS
		============================================ -->
    <script src="{{asset('js/owl.carousel.min.js')}}"></script>
    <!-- scrollUp JS
		============================================ -->
    <script src="{{asset('js/jquery.scrollUp.min.js')}}"></script>
    <!-- meanmenu JS
		============================================ -->
    <script src="{{asset('js/meanmenu/jquery.meanmenu.js')}}"></script>
    <!-- counterup JS
		============================================ -->
    <script src="{{asset('js/counterup/jquery.counterup.min.js')}}"></script>
    <script src="{{asset('js/counterup/waypoints.min.js')}}"></script>
    <script src="{{asset('js/counterup/counterup-active.js')}}"></script>
    <!-- mCustomScrollbar JS
		============================================ -->
    <script src="{{asset('js/scrollbar/jquery.mCustomScrollbar.concat.min.js')}}"></script>


    <!--  wave JS
		============================================ -->
    <script src="{{asset('js/wave/waves.min.js')}}"></script>
    <script src="{{asset('js/wave/wave-active.js')}}"></script>

    <!-- plugins JS
		============================================ -->
    <script src="{{asset('js/plugins.js')}}"></script>
    <!-- main JS
		============================================ -->
    <script src="{{asset('js/main.js')}}"></script>
<script>
document.addEventListener('click',function(e)
{
  if(e.target.id.substr(0,6)=="notika"){

  alert(e.target.id)
  }

})
const disini=document.getElementById('disini')

let icons=[
     "alarm", "arrow-right", "avable", "back", "calendar", "chat", "checked", "close", "cloud", "credit-card", "dollar", "dot", "down-arrow", "draft", "edit", "eye", "facebook", "file", "finance", "flag", "house", "ip-locator", "left-arrow", "mail", "map", "menu", "menus", "minus-symbol", "more-button", "next", "next-pro", "paperclip", "phone", "picture", "pinterest", "plus-symbol", "print", "promos", "refresh", "right-arrow", "search", "sent", "settings", "social", "star", "success", "support", "tax", "trash", "travel", "twitter", "up-arrow", "wifi", "bar-chart", "app", "form", "windows", "skype", "menu-sidebar", "menu-after", "menu-before", "menu-befores"
]
elements=``;
icons.map(icon=>elements+=`
<td>
 <button data-toggle="tooltip" style="background:transparent;"data-placement="left" title=""  class="btn waves-effect" data-original-title="notika-${icon}"><i style="font-size: 24px;"id="notika-${icon}" class="notika-icon notika-${icon}" style="width:100%;height:100%"></i></button>
 </td    >`)
disini.innerHTML=elements

</script>

</body>

</html>