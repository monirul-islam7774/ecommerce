@extends('layouts.default')

@section('content')

    <div style="margin: 0;padding: 0;" class="w3agile_special_deals_grids">
        <div style="margin: 0;padding: 0;"  class="col-md-12 w3agile_special_deals_grid_left">
            <div class="w3agile_special_deals_grid_left_grid">

                @if($banner)
                    <img
                            src="{{asset('gallery-images/'.$banner->image)}}" alt=" "
                            class="img-responsive banner1"/>
                @else
                    <img
                            src="{{asset('gallery-images/default.jpg')}}" alt=" "
                            class="img-responsive banner1"/>
                @endif


            </div>
        </div>
    </div>
    <!-- //banner -->

    <!-- breadcrumbs -->
    <div class="breadcrumb_dress">
        <div class="container">
            <ul>
                <li><a href="{{url('/')}}"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> Home</a> <i>/</i></li>
                <li>Contact Us</li>
            </ul>
        </div>
    </div>
    <!-- //breadcrumbs -->

    <!-- mail -->
    <div style="padding: 5em 0;" class="mail">
        <div class="container">
            <h3>Contact Us</h3>
            <div class="agile_mail_grids">
                <div class="col-md-5 contact-left">
                    <h4>Address</h4>
                    <p><i class="fa fa-map-marker" aria-hidden="true"></i> Shop-3, Dr. Rifatullah's Happy Arcade<br>
                        <span> Road-3 (Mirpur Road), Dhaka-1205</span></p>
                    <ul>
                        <li><i class="fa fa-phone" aria-hidden="true"></i> 01711991734 & 01911486565</li>
                        <li><i class="fa fa-bell" aria-hidden="true"></i> Hours 11:00 - 23:00</li>
                        <li><i class="fa fa-envelope" aria-hidden="true"></i> info@shutionline.com</li>
                    </ul>
                </div>
                <div class="col-md-7 contact-left">
                    <h4>Contact Form</h4>
                    <form action="#" method="post">
                        <input type="text" name="Name" value="Name" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Name';}" required="">
                        <input type="email" name="Email" value="Email" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Email';}" required="">
                        <input type="text" name="Telephone" value="Telephone" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Telephone';}" required="">
                        <textarea name="message" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Message...';}" required="">Message...</textarea>
                        <input type="submit" value="Submit" >
                    </form>
                </div>
                <div class="clearfix"> </div>
            </div>

            <div class="contact-bottom">
                <div id="map" style="width:100%;height:500px"></div>
            </div>
        </div>
    </div>

@stop

@section('footer_script')
    <script>
        function myMap() {
            var mapCanvas = document.getElementById("map");
            var myCenter = new google.maps.LatLng(23.7401013,90.3828502);
            var mapOptions = {center: myCenter, zoom: 18};
            var map = new google.maps.Map(mapCanvas,mapOptions);
            var marker = new google.maps.Marker({
                position: myCenter,
                animation: google.maps.Animation.BOUNCE
            });
            marker.setMap(map);
        }
    </script>

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCK2lOKFxq_DDvbubXeO-nQhxwRnEmZFAo&callback=myMap"></script>

@stop