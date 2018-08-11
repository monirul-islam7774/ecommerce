@extends('layouts.default')

@section('header_style')

    <meta property="og:title" content="{{strtoupper($product->name)}}" />
    <meta property="og:type" content="website" />
    <meta property="og:image" content="{{asset('images/'.$product->image)}}" />
    <meta property="og:url" content="www.shutionline.com/product_details/productCode-{{$product->productCode}}" />
    <meta property="og:description" content="{{$product->details}}" />

    <meta name="twitter:card" content="summary">
    <meta name="twitter:creator" content="shutionline.com">
    <meta name="twitter:title" content="{{strtoupper($product->name)}}">
    <meta name="twitter:description" content="{{$product->details}}">
    <meta name="twitter:image" content="{{asset('images/'.$product->image)}}">


    <link rel="stylesheet" href="{{asset('frontend/css/flexslider.css')}}" type="text/css" media="screen"/>
    <link rel="stylesheet" href="{{asset('frontend/css/etalage.css')}}" type="text/css" media="screen"/>
@stop

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
                <li><a href="{{url('/')}}"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> Home</a>
                    <i>/</i></li>
                <li>Product Details</li>
            </ul>
        </div>
    </div>
    <!-- //breadcrumbs -->

    <!-- single -->
    <div style="padding:5em 0 0 0;" class="single">
        <div class="container">
            <div class="col-md-12">
                <div class="single_left">
                    <div class="grid images_3_of_2">
                        <ul id="etalage">
                            @foreach($photos as $photo)
                                <li>
                                    <a href="optionallink.html">
                                        <img class="etalage_thumb_image megnifying_borber"
                                             src="{{asset('product-images/'.$photo->image)}}" class="img-responsive"/>
                                        <img class="etalage_source_image"
                                             src="{{asset('product-images/'.$photo->image)}}" class="img-responsive"
                                             title=""/>
                                    </a>
                                </li>
                            @endforeach

                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="desc1 span_3_of_2 simpleCart_shelfItem">
                        <h3 class="item_name">{{strtoupper($product->name)}}</h3>
                        <span class="code">PRODUCT CODE : {{$product->productCode}}</span>
                        <br>
                        <hr style="border-top: 4px solid #ff9b05">

                        <div class="price det_pad">
                            <span class="text">PRICE :</span><br>
                            @if($product->status=='Offer')
                                <span class="price-new item_price">{{'BDT ' .$product->price. ' Tk'}}</span><span
                                        class="price-old">{{$product->offerPrice}}</span>
                            @else
                                <span class="price-new item_price">{{'BDT ' .$product->price. ' Tk'}}</span>

                            @endif
                            <br>
                        </div>

                        <?php
                        $color = explode(',', $product->color);
                        $size = explode(',', $product->size);
                        ?>

                        <div class="det_nav1 det_pad">
                            <span class="text">{{strtoupper('Available size ')}}:</span>
                            <div class=" sky-form col col-4">
                                <ul>
                                    @foreach($size as $sz)
                                        <li>{{strtoupper($sz)}}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                        <div class="color-quality">
                            <div class="color-quality-left">
                                <span class="text">{{strtoupper('Available color ')}}:</span>
                                <ul style="margin-top: 1em">
                                    @foreach($color as $col)
                                        <li><a href="#"  class="brown"><span style="background: {{$col}}"></span></a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>

                            <div class="clearfix"></div>
                        </div>
                        <hr>

                        <div style="padding: 0">
                            <div class="agileits_social_button">
                                <span class="text">SHARE WITH YOUR FRIENDS :</span>
                                <ul style="margin-top: 1em">
                                    <li><a href="https://www.facebook.com/sharer.php?u=http%3A%2F%2Fwww.shutionline.com/product_details/productCode-{{$product->productCode}}" target="_blank" class="facebook"> </a></li>
                                    <li><a href="https://twitter.com/intent/tweet?text={{$product->name}}%20http%3A%2F%2Fwww.shutionline.com/product_details/productCode-{{$product->productCode}}" target="_blank" class="twitter"> </a></li>
                                    <li><a href="https://plus.google.com/share?url=www.shutionline.com/product_details/productCode-{{$product->productCode}}" target="_blank" class="google"> </a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="additional_info">
        <div class="container">
            <div class="sap_tabs">
                <div id="horizontalTab1" style="display: block; width: 100%; margin: 0px;">
                    <ul>
                        <li class="resp-tab-item" aria-controls="tab_item-0" role="tab"><span>Product Information</span>
                        </li>
                    </ul>
                    <div class="tab-1 resp-tab-content additional_info_grid" aria-labelledby="tab_item-0">
                        <h3>{{strtoupper($product->name)}}</h3>
                        <?php
                        $info=explode(',',$product->details)
                        ?>
                        @for($i=0;$i<sizeof($info);$i++)
                            <p><i class="fa fa-hand-o-right" aria-hidden="true"></i> {{$info[$i]}}</p>
                        @endfor
                    </div>

                </div>
            </div>

        </div>
    </div>

    @if(sizeof($related)>4)
        <div style="padding:3em 0 ;"  class="new-products">
            <div class="container">
                <h3><a href="">Related Product</a></h3>
                <ul id="flexiselDemo2">
                    @foreach($related as $item)
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

                                        <p><a class="item_add" href="{{url('product_details','productCode-'.$item->productCode)}}">View Details</a></p>
                                    </div>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>

            </div>
        </div>
    @elseif(sizeof($related)>0 && sizeof($related)<5)
        <div style="padding:3em 0;"  class="new-products">
            <div class="container">
                <h3><a href="">Related Product</a></h3>
                <ul id="flexiselDemo3">
                    @foreach($related as $item)
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
    @endif
@stop

@section('footer_script')
    <!-- flixslider -->
    <script defer src="{{asset('frontend/js/jquery.etalage.min.js')}}"></script>
    <script defer src="{{asset('frontend/js/jquery.flexslider.js')}}"></script>
    <script src="{{asset('frontend/js/imagezoom.js')}}"></script>
    <script src="{{asset('frontend/js/easyResponsiveTabs.js')}}" type="text/javascript"></script>
    <script>
        // Can also be used with $(document).ready()
        jQuery(document).ready(function ($) {

            $('#etalage').etalage({
                thumb_image_width: 300,
                thumb_image_height: 400,
                source_image_width: 700,
                source_image_height: 900,
                zoom_area_width: 530,


                show_hint: true,
                click_callback: function (image_anchor, instance_id) {
                    //alert('Callback example:\nYou clicked on an image with the anchor: "' + image_anchor + '"\n(in Etalage instance: "' + instance_id + '")');
                }
            });

        });
        $(window).load(function () {
            $('.flexslider').flexslider({
                animation: "slide",
                controlNav: "thumbnails"
            });
        });

        $(document).ready(function () {
            $('#horizontalTab1').easyResponsiveTabs({
                type: 'default', //Types: default, vertical, accordion
                width: 'auto', //auto or any width like 600px
                fit: true   // 100% fit in a container
            });
        });

        $(window).load(function () {
            $("#flexiselDemo2").flexisel({
                visibleItems: 4,
                animationSpeed: 800,
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
                animationSpeed: 800,
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