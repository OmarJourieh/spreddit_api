<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Models\Category;

class CategoriesController extends Controller
{
    public function index()
    {
        return Category::all();
    }

    public function getcategorybyid($id) {
        return Category::find($id);
    }

    public function getproductsbycategory($id) {
        $category = Category::find($id);

        $products = $category->products;

        foreach ($products as $p) {
            $p['user'] = $p->user;
        }
        return $products;
    }

    public function addcategory(Request $request) {
        if($request->hasFile('image')){
            $file=$request->image;
            $new_file=time().$file->getClientOriginalName();
            $file->move('/storage/user',$new_file);
        }
        Category::create([
            // 'id'=>$request->id,
            'name'=>$request->name,
            'image'=>'/storage/user/'.$new_file,
        ]);
    }

    public function deletecategory($id) {
        Category::find($id)->delete();
    }

    public function updatecategory(Request $request, $id) {
        $updater=Category::find($id);
        $updater->name=$request->name;
        $updater->save();
    }

}
