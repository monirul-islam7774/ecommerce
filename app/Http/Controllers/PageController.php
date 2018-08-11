<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Menu;
use App\ProductPhoto;
use App\Gallery;

class PageController extends Controller
{

    public function home(){
        $offers=Product::where('status','=','Offer')->limit(10)->latest()->get();
        $ofr[0]=0;$nw[0]=0;
        for($i=0;$i<sizeof($offers);$i++){
            $ofr[$i]=$offers[$i]->productCode;
        }

          $offer_photos=ProductPhoto::whereIn('productCode',$ofr)->get();

        $news=Product::where('status','=','New')->limit(10)->latest()->get();
        for($i=0;$i<sizeof($news);$i++){
            $nw[$i]=$news[$i]->productCode;
        }

          $new_photos=ProductPhoto::whereIn('productCode',$nw)->get();

        $slider=Gallery::where('title','slider')->get();
        $banner1=Gallery::where('title','banner1')->inRandomOrder()->first();
        $banner2=Gallery::where('title','banner2')->inRandomOrder()->first();

        return view('layouts.home',compact('offers','news','offer_photos','new_photos','slider','banner1','banner2'));
    }
    public function product($category){
        $b=strpos($category,'=')+1;
        $a=strpos($category,'&');
        $title=substr($category,0,$a);

        $c_id=substr($category,$b);
        $id=Menu::select('id','childCsv')->where('id','=',$c_id)->first();

        if($id->childCsv!=''){
            $allId=explode(',',$id->childCsv);
            $allId[sizeof($allId)]="$id->id";
        }else{
            $allId[0]="$id->id";
        }
        $banner=Gallery::where('title',$title)->inRandomOrder()->first();

        $products=Product::whereIn('categoryId',$allId)->latest()->paginate(9);
        $photos=ProductPhoto::whereIn('categoryId',$allId)->get();


        $related_products=Product::whereIn('categoryId',$allId)->limit(5)->inRandomOrder()->get();
        $ary[0]=0;
        for($i=0;$i<sizeof($related_products);$i++){
            $ary[$i]=$related_products[$i]->productCode;
        }


          $related_photos=ProductPhoto::whereIn('productCode',$ary)->get();




        return view('pages.product',compact('products','photos','related_products','related_photos','banner'));
    }

    public function productDetails($code){
        $code=substr($code,12);
        $product=Product::where('productCode',$code)->first();
        $photos=ProductPhoto::where('productCode',$code)->get();

        $id=$product->categoryId;
        $title=Menu::where('id',$id)->first();


        $related=Product::where('categoryId',$product->categoryId)->where('id','!=',$product->id)->latest()->limit(10)->get();

        $ary[0]=0;
        for($i=0;$i<sizeof($related);$i++){
            $ary[$i]=$related[$i]->productCode;
        }

        $banner=Gallery::where('title','product_details')->inRandomOrder()->first();

        $related_photos=ProductPhoto::whereIn('ProductCode',$ary)->get();

        return view('pages.product_details',compact('product','photos','related','related_photos','banner'));
    }

    public function contactUs(){

        $banner=Gallery::where('title','contact_us')->inRandomOrder()->first();

        return view('pages.contact_us',compact('banner'));
    }

    public function gallery(){
        $banner=Gallery::where('title','gallery')->inRandomOrder()->first();
        $photos=Gallery::where('title','photo_gallery')->latest()->get();
        return view('pages.gallery',compact('banner','photos'));
    }

    public function aboutUs(){
        $banner=Gallery::where('title','about_us')->inRandomOrder()->first();
        return view('pages.about_us',compact('banner'));
    }
    public function signin(){
        return redirect('home');
    }


    public function searchProduct(Request $request){

        $value=$request->Search;;

        $banner=Gallery::where('title','search')->inRandomOrder()->first();

        $products=Product::where('name','like','%'.$value.'%')->orWhere('productCode','like','%'.$value.'%')->orWhere('price','like','%'.$value.'%')->orWhere('color','like','%'.$value.'%')->orWhere('size','like','%'.$value.'%')->paginate(9);
        $allId[0]=0;
        for($i=0;$i<sizeof($products);$i++){
            $allId[$i]=$products[$i]->categoryId;
        }

        $photos=ProductPhoto::whereIn('categoryId',$allId)->get();


        $related_products=Product::whereIn('categoryId',$allId)->limit(5)->inRandomOrder()->get();
        $ary[0]=0;
        for($i=0;$i<sizeof($related_products);$i++){
            $ary[$i]=$related_products[$i]->productCode;
        }

        $related_photos=ProductPhoto::whereIn('productCode',$ary)->get();

        return view('pages.search',compact('products','photos','related_products','related_photos','banner','value'));

    }
}
