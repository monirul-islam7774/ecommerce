<?php

$mainmenus = \App\Menu::where('parentId', '=', NULL)->where('status','=','Enabled')->get();

?>

<div class="footer">
    <div class="container">
        <div class="w3_footer_grids">
            <div class="col-md-4 w3_footer_grid">
                <h3>Contact</h3>
                <ul class="address">
                    <li><i class="glyphicon glyphicon-map-marker" aria-hidden="true"></i>Shop-3, Dr. Rifatullah's Happy Arcade,<span>Road-3 (Mirpur Road), Dhaka-1205.</span></li>
                    <li><i class="glyphicon glyphicon-envelope" aria-hidden="true"></i> info@shutionline.com</li>
                    <li><i class="glyphicon glyphicon-earphone" aria-hidden="true"></i> 01711991734 & 01911486565</li>
                </ul>
            </div>
            <div class="col-md-4 w3_footer_grid">
                <h3>Information</h3>
                <ul class="info">
                    <li><a href="{{url('/')}}">Home</a></li>
                    <li><a href="{{url('about_us')}}">About Us</a></li>
                    <li><a href="{{url('contact_us')}}">Contact Us</a></li>
                    <li><a href="{{url('photo_gallery')}}">Gallery</a></li>
                </ul>
            </div>
            <div class="col-md-4 w3_footer_grid">
                <h3>Category</h3>
                <ul class="info">
                    @foreach($mainmenus as $menu)
                    <li><a href="{{url('product/'.$menu->menuTitle.'&_id='.$menu->id)}}">{{strtoupper($menu->menuTitle)}}</a></li>
                        @endforeach
                </ul>
            </div>
            <div class="clearfix"> </div>
        </div>
    </div>
    <div class="footer-copy">
        <div class="footer-copy1">
            <div class="footer-copy-pos">
                <a href="#home1" class="scroll"><img src="{{asset('frontend/images/arrow.png')}}" alt=" " class="img-responsive" /></a>
            </div>
        </div>
        <div class="container">
            <p>Developed by <a href="http://exodias.com/" target="_blank">Exodias Inc.</a></p>
        </div>
    </div>
</div>
