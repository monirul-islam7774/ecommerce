<?php

namespace App\Http\Controllers;

use App\Gallery;
use App\Http\Requests\UploadRequest;

use Illuminate\Http\Request;
use App\Menu;
use App\Product;
use App\ProductPhoto;
use DB;
use Image;


class ShutiProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request,$id=null){


        if($id==NULL) {
            $menus = Menu::where('parentId','=', NULL)->paginate(5);
            return view('admin.menu-index', compact('menus'))
                ->with('i', ($request->input('page', 1) - 1) * 5);
        }
        else{
            $menus = Menu::where('parentId','=', $id)->paginate(5);
            return view('admin.menu-index', compact('menus','id'))
                ->with('i', ($request->input('page', 1) - 1) * 5);
        }
    }

    public function create($id=null)
    {
        return view('admin.create-menu',compact('id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$id=null)
    {
        if($id==null){
            $this->saveData($request);
            return redirect()->route('menu.index')
                ->with('success','Menu created successfully');
        }

        else{
            $getPid=$this->getData($id);
            $this->saveData($request);
            if(!empty($getPid->id)){
                return redirect()->route('menu.index',$id)
                    ->with('success','Menu created successfully');
            }
            else{
                return redirect()->route('menu.index',$getPid->parentId)
                    ->with('success','Menu created successfully');
            }

        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $menu = Menu::find($id);
        return view('admin.update-menu',compact('menu'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (!$id) {
            return redirect()->route('menu.create');
        }


        try {
            $getPid = $this->getData($id);
        } catch (\Exception $ex) {
            return redirect()->route('menu.index');
        }
        if (!empty($getPid->id))
        {
                Menu::find($id)->update($request->all());
                return redirect()->route('menu.index',$getPid->parentId)
                ->with('success','Menu updated successfully');


        }


    }
    public function changeStatus($id=null){

        if ($id==null) {
            return redirect()->route('menu.index');
        }

        else{
            try {
                $getPid = $this->getData($id);
                $cStatus=$getPid->status;
                if ($cStatus=='Disabled') {
                    $updateData=array(
                        'id'=>$id,
                        'status'=>'Enabled',

                    );
                    $update=$this->updateStatus($updateData);
                    if ($update) {
                        return redirect()->route('menu.index',$getPid->parentId);
                    }
                }
                else{
                    $updateData=array(
                        'id'=>$id,
                        'status'=>'Disabled',

                    );
                    $update=$this->updateStatus($updateData);
                    if ($update) {
                        return redirect()->route('menu.index',$getPid->parentId);
                    }
                }
            } catch (\Exception $e) {
            }
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $getPid = $this->getData($id);
        $childCsv = $getPid->childCsv;
        $parentCsv = $getPid->parentCsv;
        $parent = explode(",", $parentCsv);
        if ( $parent[0] == "") {
            $data = $this->getData($id);
            $csv = $data->childCsv;
            $c = explode(",", $childCsv);
            $f = array($id);
            $cv = explode(",", $csv);
            $updateCsv = array_diff($cv, $c);
            $updatedFinal = array_diff($updateCsv, $f);
            $finalCsv = implode(",", $updatedFinal);
            //dd($finalCsv);
            if (!empty($csv)) {
                foreach ($c as $d) {
                    //dd($d);
                    $product = Product::where('categoryId', '=', $d)->orwhere('categoryId','=',$id)->get();
                  // dd($product);
                    if (!empty($product)) {
                    foreach ($product as $product1) {
                       // dd($product1->image);
                            if ($product1->image != 'avatar.jpg') {
                                unlink(public_path() . '/images/' . $product1->image);
                                $productPhotos = ProductPhoto::where('productId', '=', $product1->id)->get();
                               // dd($productPhotos);
                                if (!empty($productPhotos)) {
                                    foreach ($productPhotos as $pp) {
                                        if ($pp->image != 'avatar.jpg') {
                                            unlink(public_path() . '/product-images/' . $pp->image);
                                        }
                                    }
                                }
                            }
                        Menu::find($d)->delete();
                        }
                        Menu::find($id)->delete();

                    }
                    else{

                        Menu::find($d)->delete();
                        Menu::find($id)->delete();
                    }

                }


            }

                else{
                        // dd($id);
                        $product = Product::where('categoryId', '=', $id)->first();
                        if (!empty($product)) {
                            if ($product->image != 'avatar.jpg') {
                                unlink(public_path() . '/images/' . $product->image);
                                $productPhotos = ProductPhoto::where('productId', '=', $product->id)->get();
                                if (!empty($productPhotos)) {
                                    foreach ($productPhotos as $pp) {
                                        if ($pp->image != 'avatar.jpg') {
                                            unlink(public_path() . '/product-images/' . $pp->image);
                                        }
                                    }
                                }
                            }

                        }
                        Menu::find($id)->delete();
                    }



                return redirect()->route('menu.index')
                    ->with('success', 'Menu deleted successfully');


        }
        else{
            foreach ($parent as $p) {
                if (!empty($childCsv)) {
                    $data = $this->getData($p);
                    $csv = $data->childCsv;
                    $c = explode(",", $childCsv);
                    $f = array($id);
                    $cv = explode(",", $csv);
                    $updateCsv = array_diff($cv, $c);
                    $updatedFinal = array_diff($updateCsv, $f);
                    $finalCsv = implode(",", $updatedFinal);
                    //dd($finalCsv);
                    foreach ($c as $d) {
                        $product = Product::where('categoryId', '=', $d)->orwhere('categoryId','=',$id)->get();
                        // dd($product);
                        if (!empty($product)) {
                            foreach ($product as $product1) {
                                // dd($product1->image);
                                if ($product1->image != 'avatar.jpg') {
                                    unlink(public_path() . '/images/' . $product1->image);
                                    $productPhotos = ProductPhoto::where('productId', '=', $product1->id)->get();
                                    // dd($productPhotos);
                                    if (!empty($productPhotos)) {
                                        foreach ($productPhotos as $pp) {
                                            if ($pp->image != 'avatar.jpg') {
                                                unlink(public_path() . '/product-images/' . $pp->image);
                                            }
                                        }
                                    }
                                }
                                Menu::find($d)->delete();
                            }
                            $ab = Menu::find($data->id)->update([
                                'childCsv' => $finalCsv
                            ]);
                            Menu::find($id)->delete();

                        }
                        else{

                            Menu::find($d)->delete();
                            $ab = Menu::find($data->id)->update([
                                'childCsv' => $finalCsv
                            ]);
                            Menu::find($id)->delete();
                        }
                    }

                }
                else {
                   // dd($id);
                    if (!empty($getPid->parentId)) {
                        // dd($id);
                        $product = Product::where('categoryId', '=', $d)->where('categoryId', '=', $id)->get();
                        //dd($product);
                        if (!empty($product)){
                            foreach ($product as $product1) {
                                if (!empty($product1)) {
                                    if ($product->$product1 != 'avatar.jpg') {
                                        unlink(public_path() . '/images/' . $product1->image);
                                    }
                                    $productPhotos = ProductPhoto::where('productId', '=', $product1->id)->get();
                                    if (!empty($productPhotos)) {
                                        foreach ($productPhotos as $pp) {
                                            if ($pp->image != 'avatar.jpg') {
                                                unlink(public_path() . '/product-images/' . $pp->image);
                                            }
                                        }
                                    }
                                }
                            }
                    }
                        $data = $this->getData($p);
                        $csv = $data->childCsv;
                        $c = explode(",", $childCsv);
                        $f = array($id);
                        $cv = explode(",", $csv);
                        $updateCsv = array_diff($cv, $c);
                        $updatedFinal = array_diff($updateCsv, $f);
                        $finalCsv = implode(",", $updatedFinal);
                       // dd($updatedFinal);
                        if(empty($updatedFinal)){
                            $ab = Menu::find($data->id)->update([
                                'childCsv' => NULL
                            ]);
                            Menu::find($id)->delete();
                        }
                        else{
                            $ab = Menu::find($data->id)->update([
                                'childCsv' => $finalCsv
                            ]);
                            Menu::find($id)->delete();
                        }


                    }

                }
            }
            return redirect()->route('menu.index')
                ->with('success','Menu deleted successfully');


        }

    }



    public function getData($id)
    {
        $id = (int)$id;
        $row=Menu::where('id','=',$id)->first();
        if (!$row) {
            throw new \Exception("Could not find row $id");
        }
        return $row;
    }

    private $parentId;
    private $parentCsv;
    private $childCsv;
    private $pCsv;
    private $cCsv;
    private $tCsv;

    public function saveData($value)
    {
       // die('<pre>'.print_r($menu->id,true));
        if ($value->id == null) {
            $this->parentId=null;
            $this->parentCsv=null;
        }
        else
        {
            $data=$this->getData($value->id);
            $this->parentId=$data->parentId;
            $this->pCsv=$data->parentCsv;
            $this->cCsv=$data->childCsv;
            //die('<pre>'.print_r($cCsv,true));
        }
        if ($this->pCsv==null) {
            $this->parentCsv=$value->id;
        }
        else{
            $pCsvEpl=explode(',',$this->pCsv);
            array_push($pCsvEpl,$value->id);
            $this->tCsv=implode(',',$pCsvEpl);
            $this->parentCsv=$this->tCsv;
            //die('<pre>'.print_r($tCsv,true));
        }

        $dataValue = array(
            'menuTitle' => $value->menuTitle,
            'parentId'  => $value->id,
            'parentCsv'  => $this->parentCsv,
            'childCsv'  => $this->childCsv,
            'status'=> 'Enabled',
            //'link'  => $menu->link,
        );
        //die('<pre>'.'main '.print_r($dataValue,true));
        $menu=new Menu();
        $val=$menu->create($dataValue);
        if(!empty($val->parentId)) {
            $lastInsertId = $val->id;
            if ($lastInsertId) {
                if ($this->cCsv == null) {
                    $data = array(
                        'id' => $value->id,
                        'childCsv' => $lastInsertId,
                    );
                    $updateCcsv = $this->updateChildCsv($data);
                    if ($updateCcsv) {
                        $data = $this->getData($value->id);
                        $getParentCsv = $data->parentCsv;
                        $prtCsv = explode(',', $getParentCsv);
                        $EmptyTestArray = array_filter($prtCsv);
                        if (!empty($EmptyTestArray)) {
                            foreach ($prtCsv as $pCsv) {
                                $getCsv = $this->getData($pCsv);
                                $cCsv = $getCsv->childCsv;
                                $cCsvEpl = explode(',', $cCsv);
                                array_push($cCsvEpl, $lastInsertId);
                                $tCsv = implode(',', $cCsvEpl);
                                $data = array(
                                    'id' => $pCsv,
                                    'childCsv' => $tCsv,
                                );
                                $this->updateChildCsv($data);
                            }
                            return true;
                        }
                    }
                } else {
                    $cCsvEpl = explode(',', $this->cCsv);
                    $selected = array();
                    foreach ($cCsvEpl as $valueCsv) {
                        try {
                            array_push($selected, $valueCsv);
                            $dataById = $this->getData($valueCsv);
                            //die('<pre>'.print_r($dataById,true));
                            $dataCsv = $dataById->childCsv;
                            $chCsv = explode(',', $dataCsv);
                            $EmptyTestArray = array_filter($chCsv);
                            if (!empty($EmptyTestArray)) {
                                foreach ($EmptyTestArray as $item) {
                                    array_push($selected, $item);
                                }
                            }

                        } catch (\Exception $e) {
                        }
                    }
                    //die('<pre>'.print_r($selected,true));
                    array_push($selected, $lastInsertId);
                    //die('<pre>'.print_r($selected,true));
                    $tCsv = implode(',', $selected);
                    //die('<pre>'.print_r($tCsv,true));
                    //die('<pre>'.print_r($tCsv,true));
                    $data = array(
                        'id' => $value->id,
                        'childCsv' => $tCsv,
                    );
                    $updateCcsv = $this->updateChildCsv($data);
                    if ($updateCcsv) {
                        $data = $this->getData($value->id);
                        $getParentCsv = $data->parentCsv;
                        $prtCsv = explode(',', $getParentCsv);
                        $EmptyTestArray = array_filter($prtCsv);
                        if (!empty($EmptyTestArray)) {
                            foreach ($prtCsv as $pCsv) {
                                $getCsv = $this->getData($pCsv);
                                $cCsv = $getCsv->childCsv;
                                $cCsvEpl = explode(',', $cCsv);
                                array_push($cCsvEpl, $lastInsertId);
                                $tCsv = implode(',', $cCsvEpl);
                                $data = array(
                                    'id' => $pCsv,
                                    'childCsv' => $tCsv,
                                );
                                $this->updateChildCsv($data);
                            }
                            return true;
                        }
                    }
                }
            }
        }
    }


    public function updateChildCsv(array $data)
    {
        $menu = Menu::find($data['id'])->update($data);
        return $menu;
    }



    public function updateStatus($data){
        $menu = Menu::find($data['id'])->update($data);
        return $menu;
    }

    public function productIndex(Request $request){

        $products = DB::table('products')->get();
            return view('admin.product-index', compact('products'))
                ->with('i', ($request->input('page', 1) - 1) * 5);

    }

    public function createProduct()
    {
        $menus =  DB::table('menus')->get();
        return view('admin.create-product',compact('menus'));
    }

    public function productStore(Request $request)
    {

        if($request->hasFile('image')){
            $avatar=$request->file('image');
            $filename=time().'.'.$avatar->getClientOriginalExtension();
            Image::make($avatar)->save(public_path('/images/'.$filename));
            $credentials = [
                'image'    =>$filename,
                'name'     =>$request->name,
                'productCode'     =>$request->productCode,
                'price'     =>$request->price,
                'details'     =>$request->details,
                'offerPrice'     =>'BDT ' .(($request->price)-(($request->offerPercentage/100)*($request->price))).' Tk',
                'offerPercentage'     =>$request->offerPercentage,
                'status'     =>$request->status,
                'categoryId'     =>$request->categoryId,
                'color'     =>$request->color,
                'size'     =>$request->size,

            ];
            $product = Product::create($credentials);
            return redirect()->route('product.index')
                ->with('success','Product Store successfully');
        }



    }


    public function editProduct($id)
    {
        $product = Product::find($id);
        return view('admin.update-product',compact('product'));
    }
    public function updateProduct(Request $request, $id)
    {
        $credentials = [
            'name'     =>$request->name,
            'productCode'     =>$request->productCode,
            'price'     =>$request->price,
            'details'     =>$request->details,
            'offerPrice'     =>'BDT ' .(($request->price)-(($request->offerPercentage/100)*($request->price))).' Tk',
            'offerPercentage'     =>$request->offerPercentage,
            'status'     =>$request->status,
            'color'     =>$request->color,
            'size'     =>$request->size,
        ];
         //dd($credentials);
              Product::find($id)->update($credentials);
              return redirect()->route('product.index')
                  ->with('success','Product updated successfully');
          }


    public function destroyProduct($id)
    {
        $del=Product::find($id);
        //dd($del);
        if($del->image!='avatar.jpg'){
            unlink(public_path().'/images/'.$del->image);
        }
        $productPhotos=ProductPhoto::where('productId','=',$del->id)->get();
        if(!empty($productPhotos)){
            foreach($productPhotos as $p){
                if($p->image!='avatar.jpg'){
                    unlink(public_path().'/product-images/'.$del->image);
                }
            }
        }
            Product::find($id)->delete();
            return redirect()->route('product.index')
                ->with('success','Product deleted successfully');

    }

    public function productPhotoIndex(Request $request){

        $productPhotos = DB::table('productphotos')->get();
        return view('admin.product-photo-index', compact('productPhotos'))
            ->with('i', ($request->input('page', 1) - 1) * 5);

    }
    public function createProductPhoto($id)
    {

       // dd($product);
        return view('admin.create-product-photo',compact('id'));
    }

    public function productPhotoStore(Request $request)
    {
      //  dd($request);
        $input=$request->all();
        $productId=Product::where('productCode','=',$input['productCode'])->first();
       // dd($productId);
        $images=array();
        if($files=$request->file('image')){
            foreach($files as $file){
                $filename=$file->getClientOriginalName();
                Image::make($file)->save(public_path('/product-images/'.$filename));
                $images[]=$filename;
            }
            foreach($images as $i) {
                ProductPhoto::create([
                    'productId'=>$productId->id,
                    'image' => $i,
                    'categoryId'=>$productId->categoryId,
                    'productCode' => $input['productCode'],]);
            }
            return redirect()->route('productPhoto.index')
                ->with('success', 'Product Photo Store successfully');
        }

    }

    public function editProductPhoto($id)
    {
        $productPhoto = ProductPhoto::find($id);
        return view('admin.update-product-photo',compact('productPhoto'));
    }
    public function updateProductPhoto(Request $request, $id)
    {
       // dd($request->file('image'));
        if($request->file('image')){
            $file=$request->file('image');
            $filename=$file->getClientOriginalName();
            //dd($filename);
            Image::make($file)->save(public_path('/product-images/'.$filename));

            $user=new ProductPhoto();
            $user->image=$filename;
            //$id=Sentinel::getUser()->id;
            $del=ProductPhoto::find($id);
            //dd($del);
            if($del->image!='avatar.jpg'){
                unlink(public_path().'/product-images/'.$del->image);
            }

            $credentials = [
                'image'    =>$filename,
            ];
           // $p=new ProductPhoto();
           // $p->($data['id'])->update($credentials);
            ProductPhoto::find($del['id'])->update($credentials);

            return redirect()->route('productPhoto.index')
                ->with('success','Product updated successfully');
        }

    }

    public function productPhotoDestroy($id)
    {
        $del=ProductPhoto::find($id);
        //dd($del);
        if($del->image!='avatar.jpg'){
            unlink(public_path().'/product-images/'.$del->image);
        }
        ProductPhoto::find($id)->delete();
        return redirect()->route('productPhoto.index')
            ->with('success','ProductPhoto deleted successfully');
    }

    public function login(){
        return view('auth.login');
    }

    public function adminIndex(){
        return view('admin.index');
    }

    public function galleryIndex(Request $request){

        $gallery = DB::table('gallery')->get();
        return view('admin.gallery-index', compact('gallery'))
            ->with('i', ($request->input('page', 1) - 1) * 5);

    }

    public function createGallery()
    {
        $mainmenus =Menu::where('status','=','Enabled')->get();

        return view('admin.create-gallery',compact('mainmenus'));
    }

    public function galleryStore(Request $request)
    {

        $input=$request->all();

        // dd($productId);
        $images=array();
        if($files=$request->file('image')){
            foreach($files as $file){
                $filename=$file->getClientOriginalName();
                Image::make($file)->save(public_path('/gallery-images/'.$filename));
                $images[]=$filename;
            }
            foreach($images as $i) {
                Gallery::create([
                    'image' => $i,
                    'title' => $input['title'],]);
            }
            return redirect()->route('gallery.index')
                ->with('success', 'GalleryStore successfully');
        }



    }

    public function editGallery($id)
    {
        $gallery = Gallery::find($id);
        return view('admin.update-gallery',compact('gallery'));
    }
    public function updateGallery(Request $request, $id)
    {

        if($request->hasFile('image')){
            $avatar=$request->file('image');
            $filename=$avatar->getClientOriginalName();
            Image::make($avatar)->save(public_path('/gallery-images/'.$filename));
            $gallery=new Gallery();
            $gallery->image=$filename;
            //$id=Sentinel::getUser()->id;
            $del=Gallery::find($id);
            //dd($del);
            if($del->image!='avatar'){
                unlink(public_path().'/gallery-images/'.$del->image);
            }

            $credentials = [
                'image'    =>$filename,
                'title'    =>$request->title,
            ];
            // $p=new ProductPhoto();
            // $p->($data['id'])->update($credentials);
            Gallery::find($del['id'])->update($credentials);

            return redirect()->route('gallery.index')
                ->with('success','Gallery updated successfully');
        }
        else{
            $del=Gallery::find($id);
            $update=Gallery::where('id',$del->id)->update(['title'=>$request->title]);
            return redirect()->route('gallery.index')
                ->with('success','Gallery updated successfully');
        }


    }

    public function destroyGallery($id)
    {
        $del=Gallery::find($id);
        //dd($del);
        if($del->image!='avatar.jpg'){
            unlink(public_path().'/gallery-images/'.$del->image);
        }
        Gallery::find($id)->delete();
        return redirect()->route('gallery.index')
            ->with('success','Photo deleted successfully');
    }

}
