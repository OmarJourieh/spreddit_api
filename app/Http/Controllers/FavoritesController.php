<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorite;

class FavoritesController extends Controller
{

    public function addtofavorite(Request $request){
        Favorite::create(
            [
                'user_id'=>$request->user_id,
                'product_id'=>$request->product_id,
            ]
            );

    }
    public function deleteformfavorite(Request $request){
        $userid=$request->user_id;
        $productid=$request->product_id;
        foreach (Favorite::all() as $key) {
            if($key->user_id==$userid&&$key->product_id==$productid)
            $key->delete();
        }
    }

    public function getallfavorites($id) {
        $t= Favorite::where('user_id',$id)->get();
        $r=[];
        foreach ($t as $key) {
            array_push($r,$key->product);
        }
        
        foreach ($r as $p) {
            $p['user'] = $p->user;
        }


        return $r;
    }

    public function getfavoritesids($id) {
        $t= Favorite::where('user_id',$id)->get();
        $r=[];
        foreach ($t as $key) {
            array_push($r,$key->product->id);
        }


        return $r;
    }
    
}
