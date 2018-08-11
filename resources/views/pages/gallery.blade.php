@extends('layouts.default')

@section('content')
    <!-- banner -->
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
                <li>Gallery</li>
            </ul>
        </div>
    </div>
    <!-- //breadcrumbs -->

    <!-- dresses -->
    <div style="padding:5em 0;" class="w3l_related_products">
        <div class="container">

            <div class="w3ls_dresses_grids">

                <div class="col-md-12 w3ls_dresses_grid_right">
                    <h3 ><a style="text-decoration: none;" href="">Photo Gallery</a></h3>
                    @foreach($photos as $photo)
                    <div style="padding-bottom: 3em;" class="col-md-3 w3ls_dresses_grid_right_left">
                        <div class="w3ls_dresses_grid_right_grid1">
                            <img src="{{asset('gallery-images/'.$photo->image)}}" alt=" " class="img-responsive" />
                            <div class="w3ls_dresses_grid_right_grid1_pos">
                                <h3>Printed <span>Cotton</span> Top</h3>
                            </div>
                        </div>
                    </div>
                   @endforeach
                    <div class="clearfix"> </div>
                </div>

            </div>
        </div>
    </div>

@stop

@section('footer_script')


@stop