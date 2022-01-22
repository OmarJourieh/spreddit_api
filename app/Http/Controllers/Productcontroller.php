<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Favorite;
use App\Models\User;
use Illuminate\Http\Request;
use auth;
class Productcontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function Data_encryption($word){


    }
    public function index()
    {
        //
    }
    public function addproduct(Request $request){
        if($file = $request->hasFile('image')) {
            $file = $request->image;
            $new_file = time().$file->getClientOriginalName();
            $path = $file->storeAs('/img', $new_file);
        } else {
            return "NULL";
        }

        Product::create([
            'id'=>$request->id,
            'name'=>$request->name,
            'user_id'=>$request->userId,
            'description'=>$request->description,
            'price' =>$request->price,
            'category_id'=>$request->categoryId,
            'isSold'=>$request->isSold,
            'image' => '/img/'. $new_file,
        ]);



    }
    public function getallproductsofuser($id){

        $products = User::find($id)->products;

        foreach ($products as $p) {
            $p['user'] = $p->user;
        }

        return $products;

    }
    public function getownerofproduct($id){

    return User::find(Product::find($id)->user_id);
    }
    public function deleteproduct($id){
        Favorite::where('product_id', $id)->delete();
        Product::find($id)->delete();

    }
    public function updateproduct(Request $request,$id){
        $updater=Product::find($id);

        if($file = $request->hasFile('image')) {
            $file = $request->image;
            $new_file = time().$file->getClientOriginalName();
            $path = $file->storeAs('/img', $new_file);


            $updater->image = '/img/'. $new_file;
        }

        $updater->name=$request->name;
        $updater->description=$request->description;
        $updater->price=$request->price;
        $updater->category_id=$request->categoryId;

        // $updater->user_id = $request->user_id;
        // $updater->isSold = $request->isSold;
        $updater->save();

        return $updater;
    }
    public function getallproducts(){

        $products = Product::all();

        foreach ($products as $p) {
            $p['user'] = $p->user;
        }

        return $products;
    }
    public function getproductbyid($id){
        $p = Product::find($id);
        $p['user'] = $p->user;
        return $p;
    }

    public function markproductsold($productId) {
        $p = Product::find($productId);
        $p->isSold = 1;
        $p->save();
    }

}
