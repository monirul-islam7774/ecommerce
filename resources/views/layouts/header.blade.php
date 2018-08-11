<?php

$mainmenus = \App\Menu::where('parentId', '=', NULL)->where('status','=','Enabled')->get();
$menus = \App\Menu::where('parentId', '!=', NULL)->where('status','=','Enabled')->get();
$count = (int)sizeof($mainmenus);
if($count==0){
    $col=1;
}
else
 $col = floor(12 / $count);
?>


<div class="header">
    <div class="container">

        <div  class="w3l_logo">
            <h1 ><a  href="{{url('/')}}">SHUTI<span>Tradition of Bangladesh</span></a></h1>
        </div>
        <div class="search">
            <input class="search_box" type="checkbox" id="search_box">
            <label class="icon-search" for="search_box"><span class="glyphicon glyphicon-search"
                                                              aria-hidden="true"></span></label>
            <div class="search_form">
                <form action="{{url('search')}}" method="get">
                    <input autocomplete="off" type="text" name="Search" placeholder="Search...">
                    {{ csrf_field() }}
                    <input type="submit" value="Send">
                </form>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<div class="navigation">
    <div class="container">
        <nav class="navbar navbar-default">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header nav_2">
                <button type="button" class="navbar-toggle collapsed navbar-toggle1" data-toggle="collapse"
                        data-target="#bs-megadropdown-tabs">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <div class="collapse navbar-collapse" id="bs-megadropdown-tabs">
                @if( Request::is('/') || Request::is('photo_gallery') ||Request::is('contact_us') ||Request::is('about_us'))
                    <ul class="nav navbar-nav">
                        <li >
                            <a  {!! (Request::is('/') ? 'class="act"' : '') !!} href="{{url('/')}}" class="">Home</a>
                        </li>
                        <!-- Mega Menu -->
                        <li class="dropdown" >
                            <a   href="#" class="dropdown-toggle" data-toggle="dropdown">Products <b class="caret"></b></a>
                            <ul class="dropdown-menu multi-column columns-3">
                                <div class="row">
                                    @foreach($mainmenus as $menu)
                                        <div class="col-sm-{{$col}}">
                                            <ul class="multi-column-dropdown">
                                                <h6><a href="{{url('product/'.$menu->menuTitle.'&_id='.$menu->id)}}">{{$menu->menuTitle}}</a></h6>

                                                @foreach($menus as $submenu)
                                                    @if($submenu->parentId==$menu->id)
                                                        <li><a href="{{url('product/'.$submenu->menuTitle.'&_id='.$submenu->id)}}">{{$submenu->menuTitle}}</a></li>
                                                        <ul style="margin-left: 3%;" class="multi-column-dropdown">
                                                            @foreach($menus as $submenus)
                                                                @if($submenus->parentId==$submenu->id)
                                                                    <li> <a href="{{url('product/'.$submenus->menuTitle.'&_id='.$submenus->id)}}"><i class="fa fa-long-arrow-right" aria-hidden="true"></i> {{$submenus->menuTitle}}</a></li>
                                                                @endif
                                                            @endforeach
                                                        </ul>
                                                    @endif
                                                @endforeach

                                            </ul>
                                        </div>
                                    @endforeach
                                    <div class="clearfix"></div>
                                </div>
                            </ul>
                        </li>
                        <li >
                            <a {!! (Request::is('photo_gallery') ? 'class="act"' : '') !!} href="{{url('photo_gallery')}}">Gallery</a>
                        </li>
                        <li><a {!! (Request::is('about_us') ? 'class="act"' : '') !!} href="{{url('about_us')}}">About Us</a></li>
                        <li><a  {!! (Request::is('contact_us') ? 'class="act"' : '') !!} href="{{url('contact_us')}}">Contact Us</a></li>
                    </ul>
                    @else
                    <ul class="nav navbar-nav">
                        <li >
                            <a  href="{{url('/')}}" class="">Home</a>
                        </li>
                        <!-- Mega Menu -->
                        <li class="dropdown" >
                            <a class="act"   href="#" class="dropdown-toggle" data-toggle="dropdown">Products <b class="caret"></b></a>
                            <ul class="dropdown-menu multi-column columns-3">
                                <div class="row">
                                    @foreach($mainmenus as $menu)

                                        <div class="col-sm-{{$col}}">
                                            <ul class="multi-column-dropdown">
                                                <h6><a href="{{url('product/'.$menu->menuTitle.'&_id='.$menu->id)}}">{{$menu->menuTitle}}</a></h6>

                                                @foreach($menus as $submenu)
                                                    @if($submenu->parentId==$menu->id)
                                                        <li><a href="{{url('product/'.$submenu->menuTitle.'&_id='.$submenu->id)}}">{{$submenu->menuTitle}}</a></li>
                                                        <ul style="margin-left: 3%;" class="multi-column-dropdown">
                                                            @foreach($menus as $submenus)
                                                                @if($submenus->parentId==$submenu->id)
                                                                    <li> <a href="{{url('product/'.$submenus->menuTitle.'&_id='.$submenus->id)}}"><i class="fa fa-long-arrow-right" aria-hidden="true"></i> {{$submenus->menuTitle}}</a></li>
                                                                @endif
                                                            @endforeach
                                                        </ul>
                                                    @endif
                                                @endforeach

                                            </ul>
                                        </div>
                                    @endforeach
                                    <div class="clearfix"></div>
                                </div>
                            </ul>
                        </li>
                        <li >
                            <a  href="{{url('photo_gallery')}}">Gallery</a>
                        </li>
                        <li><a href="{{url('about_us')}}">About Us</a></li>
                        <li><a  href="{{url('contact_us')}}">Contact Us</a></li>
                    </ul>
                    @endif

            </div>
        </nav>
    </div>
</div>
