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
                <li><a href="index.html"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> Home</a>
                    <i>/</i></li>
                <li>Search</li>
            </ul>
        </div>
    </div>
    <!-- //breadcrumbs -->

    <!-- dresses -->
    <div style="padding:5em 0;" class="dresses">
        <div class="container">
            <div class="w3ls_dresses_grids">
                @include('layouts._left_menu')
                <div class="col-md-8 w3ls_dresses_grid_right">
                    <h4>
                        Result For <b>'{!! ($value) !!}'</b>.
                    </h4>
                    @if(sizeof($products)>0)
                        <div style="margin-top: 3em" class="w3ls_dresses_grid_right_grid3">

                            @foreach($products as $product)
                                <div class="col-md-4 agileinfo_new_products_grid agileinfo_new_products_grid_dresses">
                                    <div class="agile_ecommerce_tab_left dresses_grid">
                                        <div class="hs-wrapper hs-wrapper2">

                                            @foreach($photos as $photo)
                                                @if($product->productCode==$photo->productCode)
                                                    <img src="{{asset('product-images/'.$photo->image)}}" alt=" "
                                                         class="img-responsive"/>
                                                @endif
                                            @endforeach
                                            @foreach($photos as $photo)
                                                @if($product->productCode==$photo->productCode)
                                                    <img src="{{asset('product-images/'.$photo->image)}}" alt=" "
                                                         class="img-responsive"/>
                                                @endif
                                            @endforeach
                                            <div class="w3_hs_bottom w3_hs_bottom_sub1">
                                                <ul>
                                                    <li>
                                                        <a href="{{url('product_details','productCode-'.$product->productCode)}}"><span
                                                                    class="glyphicon glyphicon-eye-open"
                                                                    aria-hidden="true"></span></a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <h5><a href="{{url('product_details','productCode-'.$product->productCode)}}">{{$product->name}}</a></h5>
                                        <div class="simpleCart_shelfItem">
                                            @if($product->status=='Offer')
                                                <p><i class="item_price">{{$product->offerPrice}}
                                                    </i><span>{{$product->price}}</span></p>
                                            @else
                                                <p><i class="item_price">BDT {{$product->price}} Tk</i></p>
                                            @endif
                                            <p><a class="item_add" href="{{url('product_details','productCode-'.$product->productCode)}}">Details</a></p>
                                        </div>
                                        <div class="dresses_grid_pos">
                                            <h6>New</h6>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <div class="clearfix"></div>
                        </div>
                    @else
                        <h2>
                            No Product Found For <b>'{!! ($value) !!}'</b>.
                        </h2>
                    @endif
                </div>


            </div>
            <div class="pull-right">
                {!! $products->links() !!}
            </div>
        </div>
    </div>

    @if(sizeof($related_products)>4)
        <div style="padding:3em 0;" class="new-products">
            <div class="container">
                <h3><a href="">Related Product</a></h3>
                <ul id="flexiselDemo2">
                    @foreach($related_products as $item)
                        <li>
                            <div class="w3l_related_products_grid">
                                <div class="agile_ecommerce_tab_left dresses_grid">
                                    <div class="hs-wrapper hs-wrapper3">
                                        @foreach($related_photos as $photo)
                                            @if($item->productCode==$photo->productCode)
                                                <img src="{{asset('product-images/'.$photo->image)}}" alt=" "
                                                     class="img-responsive">

                                            @endif
                                        @endforeach
                                        @foreach($related_photos as $photo)
                                            @if($item->productCode==$photo->productCode)
                                                <img src="{{asset('product-images/'.$photo->image)}}" alt=" "
                                                     class="img-responsive">

                                            @endif
                                        @endforeach

                                        <div class="w3_hs_bottom">
                                            <div class="flex_ecommerce">
                                                <a href="{{url('product_details','productCode-'.$item->productCode)}}"><span
                                                            class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></a>
                                            </div>
                                        </div>
                                    </div>
                                    <h5><a href="{{url('product_details','productCode-'.$item->productCode)}}">{{$item->name}}</a></h5>
                                    <div class="simpleCart_shelfItem">
                                        @if($item->offerPercentage=='')
                                            <p class="flexisel_ecommerce_cart"><i class="item_price">BDT {{$item->price}}
                                                    Tk</i></p>
                                        @else
                                            <p class="flexisel_ecommerce_cart"> <i
                                                        class="item_price">{{$item->offerPrice}}</i> <span>{{$item->price}}</span></p>

                                        @endif

                                        <p><a class="item_add" href="{{url('product_details','productCode-'.$item->productCode)}}">Details</a></p>
                                    </div>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>

            </div>
        </div>
    @elseif(sizeof($related_products)>0 && sizeof($related_products)<5)
        <div style="padding:3em 0;" class="new-products">
            <div class="container">
                <h3><a href="">Related Product</a></h3>
                <ul id="flexiselDemo3">
                    @foreach($related_products as $item)
                        <li>
                            <div class="w3l_related_products_grid">
                                <div class="agile_ecommerce_tab_left dresses_grid">
                                    <div class="hs-wrapper hs-wrapper3">
                                        @foreach($related_photos as $photo)
                                            @if($item->productCode==$photo->productCode)
                                                <img src="{{asset('product-images/'.$photo->image)}}" alt=" "
                                                     class="img-responsive">

                                            @endif
                                        @endforeach
                                        @foreach($related_photos as $photo)
                                            @if($item->productCode==$photo->productCode)
                                                <img src="{{asset('product-images/'.$photo->image)}}" alt=" "
                                                     class="img-responsive">

                                            @endif
                                        @endforeach

                                        <div class="w3_hs_bottom">
                                            <div class="flex_ecommerce">
                                                <a href="{{url('product_details','productCode-'.$item->productCode)}}"><span
                                                            class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></a>
                                            </div>
                                        </div>
                                    </div>
                                    <h5><a href="{{url('product_details','productCode-'.$item->productCode)}}">{{$item->name}}</a></h5>
                                    <div class="simpleCart_shelfItem">
                                        @if($item->offerPercentage=='')
                                            <p class="flexisel_ecommerce_cart"><i class="item_price">BDT {{$item->price}}
                                                    Tk</i></p>
                                        @else
                                            <p class="flexisel_ecommerce_cart"> <i
                                                        class="item_price">{{$item->offerPrice}}</i> <span>{{$item->price}}</span></p>

                                        @endif

                                        <p><a class="item_add" href="{{url('product_details','productCode-'.$item->productCode)}}">Details</a></p>
                                    </div>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>

            </div>
        </div>

        <!-- //dresses -->
    @endif

@stop

@section('footer_script')


    <script>

        $(window).load(function () {
            $("#flexiselDemo2").flexisel({
                visibleItems: 4,
                animationSpeed: 500,
                autoPlay: true,
                autoPlaySpeed: 4000,
                pauseOnHover: true,
                enableResponsiveBreakpoints: true,
                responsiveBreakpoints: {
                    portrait: {
                        changePoint: 480,
                        visibleItems: 1
                    },
                    landscape: {
                        changePoint: 640,
                        visibleItems: 2
                    },
                    tablet: {
                        changePoint: 768,
                        visibleItems: 3
                    }
                }
            });

        });
        $(window).load(function () {
            $("#flexiselDemo3").flexisel({
                visibleItems: 4,
                animationSpeed: 500,
                autoPlay: false,
                autoPlaySpeed: 4000,
                pauseOnHover: true,
                enableResponsiveBreakpoints: true,
                responsiveBreakpoints: {
                    portrait: {
                        changePoint: 480,
                        visibleItems: 1
                    },
                    landscape: {
                        changePoint: 640,
                        visibleItems: 2
                    },
                    tablet: {
                        changePoint: 768,
                        visibleItems: 3
                    }
                }
            });

        });

    </script>
@stop