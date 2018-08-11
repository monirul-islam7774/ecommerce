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


    <div style="margin:2% 0;" >

        <div class="container">
            @include('layouts._left_menu')
            <h2 style="text-align: center;margin:2% 0;"><a href="">About Us</a></h2>
            <p style="padding: 0 6%" >The Shutionline.com is an intuitive community page where you'll find our forthcoming trends, collection, promotions and more. We welcome you to comment, offer your valued feedback and ask inquiries to have a great experience with us.
                This page is directed daily and we do our best to answer each one of you in a timely manner. Try our new apparel and stay connected.</p>

        </div>
    </div>
@stop

@section('footer_script')

@stop