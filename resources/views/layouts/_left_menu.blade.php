<?php

$mainmenus = \App\Menu::where('parentId', '=', NULL)->where('status','=','Enabled')->get();
$menus = \App\Menu::where('parentId', '!=', NULL)->where('status','=','Enabled')->get();
$single=\App\Menu::where([['parentId', '=', NULL],
                          ['childCsv','=',NULL],
                          ['status','=','Enabled'],
                           ])->get();

?>

<div class="col-md-4 w3ls_dresses_grid_left">
    <div class="w3ls_dresses_grid_left_grid">
        <h3>Categories</h3>
        <div class="w3ls_dresses_grid_left_grid_sub">
            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">

                @foreach($mainmenus as $menu)
                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="headingOne">
                        <h4 class="panel-title asd">
                            <a class="pa_italic collapsed"  href="{{url('product/'.$menu->menuTitle.'&_id='.$menu->id)}}" aria-expanded="true">
                                <span class="glyphicon glyphicon-minus" aria-hidden="true"></span><i class="glyphicon glyphicon-minus" aria-hidden="true"></i>{{strtoupper($menu->menuTitle)}}
                            </a>
                        </h4>
                    </div>
                    <div id="collapseOne"  role="tabpanel" aria-labelledby="headingOne">
                        <div class="panel-body panel_text">
                            <ul>
                                @foreach($menus as $item)
                                    @if($item->parentId==$menu->id)
                                     <li><a href="{{url('product/'.$item->menuTitle.'&_id='.$item->id)}}">{{strtoupper($item->menuTitle)}}</a></li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <ul class="panel_bottom">
                @foreach($single as $item)
                <li><a href="products.html">{{strtoupper($item->menuTitle)}}</a></li>
                @endforeach
            </ul>
        </div>
    </div>

</div>