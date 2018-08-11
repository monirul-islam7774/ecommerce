
<!DOCTYPE html>
<html>
<head>
    <title>ShutiOnline.com</title>
    <!-- for-mobile-apps -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
        function hideURLbar(){ window.scrollTo(0,1); } </script>
    <!-- //for-mobile-apps -->
    <link href="{{asset('frontend/css/bootstrap.css')}}" rel="stylesheet" type="text/css" media="all" />
    <link href="{{asset('frontend/css/style.css')}}" rel="stylesheet" type="text/css" media="all" />
    <link href="{{asset('frontend/css/fasthover.css')}}" rel="stylesheet" type="text/css" media="all" />
    <link rel="stylesheet" href="{{asset('frontend/css/jquery.countdown.css')}}" />
    <!-- //for bootstrap working -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link href='//fonts.googleapis.com/css?family=Glegoo:400,700' rel='stylesheet' type='text/css'>
    <link href='//fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>


    @yield('header_style')

</head>

<body id="home1">

@include('layouts.header')

@yield('content')


<div class="follow">
    <div class="container">
        <div class="col-xs-6 w3agile_newsletter_left">
            <h3 style="text-align: center;">Follow Us</h3>
        </div>
        <div class="col-xs-6 w3_footer_grid">
            <div class="agileits_social_button">
                <ul>
                    <li><a href="https://www.facebook.com/Shutionline/" target="_blank" class="facebook"> </a></li>
                    <li><a href="#" class="twitter"> </a></li>
                    <li><a href="#" class="google"> </a></li>
                </ul>
            </div>
        </div>
        <div class="clearfix"> </div>
    </div>
</div>

<!-- footer -->
@include('layouts.footer')
<!-- //footer -->

<script src="{{asset('frontend/js/jquery.min.js')}}"></script>
<script type="text/javascript" src="{{asset('frontend/js/bootstrap-3.1.1.min.js')}}"></script>
<script type="text/javascript" src="{{asset('frontend/js/jquery.flexisel.js')}}"></script>

@yield('footer_script')


</body>



<script type="text/javascript">

    jQuery(document).ready(function($) {
        $(".scroll").click(function(event){
            event.preventDefault();
            $('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
        });
    });


</script>

</html>