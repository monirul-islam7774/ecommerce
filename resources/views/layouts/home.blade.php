@extends('layouts.default')

@section('content')

    <!-- banner -->
    <!--banner-starts-->
    <div class="bnr">
        <div id="top" class="callbacks_container">
            <ul class="rslides" id="slider4">
                @foreach($slider as $pic)
                    <li >
                        <img class="banner1" src="{{asset('gallery-images/'.$pic->image)}}" alt=""/>
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="clearfix"></div>
    </div>
    <!--banner-ends-->
    <!--Slider-Starts-Here-->

    <?php
    $mainmenus = \App\Menu::where('parentId', '=', NULL)->where('status', '=', 'Enabled')->get();
    $count = (int)sizeof($mainmenus);
    ?>
    <!-- special-deals -->
    @if($count>1)
        <div style="padding:2em 0 0 0" class="special-deals">

            <div class="w3agile_special_deals_grids">
                <div class="col-md-6 w3agile_special_deals_grid_left">
                    <div class="w3agile_special_deals_grid_left_grid">
                        <a href="{{url('product/'.$mainmenus[0]->menuTitle.'&_id='.$mainmenus[0]->id)}}">
                            @if($banner1)
                                <img
                                        src="{{asset('gallery-images/'.$banner1->image)}}" alt=" "
                                        class="img-responsive"/>
                            @else
                                <img
                                        src="{{asset('frontend/images/default1.jpg')}}" alt=" "
                                        class="img-responsive"/>
                            @endif
                        </a>

                        <div class="w3agile_special_deals_grid_left_grid_pos">
                            <h4>{{$mainmenus[0]->menuTitle}} <span>Collection</span></h4>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 w3agile_special_deals_grid_left">
                    <div class="w3agile_special_deals_grid_left_grid">
                        <a href="{{url('product/'.$mainmenus[1]->menuTitle.'&_id='.$mainmenus[1]->id)}}">
                            @if($banner2)
                                <img
                                        src="{{asset('gallery-images/'.$banner2->image)}}" alt=" "
                                        class="img-responsive"/>
                            @else
                                <img
                                        src="{{asset('frontend/images/default1.jpg')}}" alt=" "
                                        class="img-responsive"/>
                            @endif
                        </a>

                        <div class="w3agile_special_deals_grid_left_grid_pos">
                            <h4>{{$mainmenus[1]->menuTitle}} <span>Collection</span></h4>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    @endif
    <!-- //special-deals -->
    <!-- new-products -->
    <div style="padding:3em 0;" class="new-products">
        <div class="container">
            <h3><a href="">New Products</a></h3>
            <ul id="flexiselDemo2">
                @foreach($news as $item)
                    <li>
                        <div class="w3l_related_products_grid">
                            <div class="agile_ecommerce_tab_left dresses_grid">
                                <div class="hs-wrapper hs-wrapper3">
                                    @foreach($new_photos as $photo)
                                        @if($item->productCode==$photo->productCode)
                                            <img src="{{asset('product-images/'.$photo->image)}}" alt=" "
                                                 class="img-responsive">

                                        @endif
                                    @endforeach
                                    @foreach($new_photos as $photo)
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
                                <h5>
                                    <a href="{{url('product_details','productCode-'.$item->productCode)}}">{{$item->name}}</a>
                                </h5>
                                <div class="simpleCart_shelfItem">
                                    @if($item->offerPercentage=='')
                                        <p class="flexisel_ecommerce_cart"><i class="item_price">BDT {{$item->price}}
                                                Tk</i></p>
                                    @else
                                        <p class="flexisel_ecommerce_cart"><i
                                                    class="item_price">{{$item->offerPrice}}</i>
                                            <span>{{$item->price}}</span></p>

                                    @endif

                                    <p><a class="item_add"
                                          href="{{url('product_details','productCode-'.$item->productCode)}}">Details</a></p>
                                </div>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>

        </div>
    </div>
    <!-- //new-products -->
    @if(sizeof($offers)>0)
        <div style="padding:3em 0;" class="w3l_related_products">
            <div class="container">
                <h3><a href="">offer Products</a></h3>
                <ul id="flexiselDemo3">
                    @foreach($offers as $item)

                        <li>
                            <div class="w3l_related_products_grid">
                                <div class="agile_ecommerce_tab_left dresses_grid">
                                    <div class="hs-wrapper hs-wrapper3">
                                        @foreach($offer_photos as $photo)
                                            @if($item->productCode==$photo->productCode)
                                                <img src="{{asset('product-images/'.$photo->image)}}" alt=" "
                                                     class="img-responsive">

                                            @endif
                                        @endforeach
                                        @foreach($offer_photos as $photo)
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
                                    <h5>
                                        <a href="{{url('product_details','productCode-'.$item->productCode)}}">{{$item->name}}</a>
                                    </h5>
                                    <div class="simpleCart_shelfItem">
                                        @if($item->offerPercentage=='')
                                            <p class="flexisel_ecommerce_cart"><i class="item_price">BDT {{$item->price}}
                                                    Tk</i></p>
                                        @else
                                            <p class="flexisel_ecommerce_cart"><i
                                                        class="item_price">{{$item->offerPrice}}</i>
                                                <span>{{$item->price}}</span></p>

                                        @endif

                                        <p><a class="item_add"
                                              href="{{url('product_details','productCode-'.$item->productCode)}}">Details</a></p>
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

    <script src="{{asset('frontend/js/responsiveslides.min.js')}}"></script>

    <script>
        $(function () {
            // Slideshow 4
            $("#slider4").responsiveSlides({
                auto: true,
                pager: true,
                nav: true,
                speed: 700,
                namespace: "callbacks",
                before: function () {
                    $('.events').append("<li>before event fired.</li>");
                },
                after: function () {
                    $('.events').append("<li>after event fired.</li>");
                }
            });

        });


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