<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Rate;
use App\Models\Block;

class Usercontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }
    public function adduser(Request $request){

        if($request->hasFile('image')){
            $file=$request->image;
            $new_file=time().$file->getClientOriginalName();
            $file->move('/storage/user',$new_file);
        }
        User::create([
            'id'=>$request->id,
            'username'=>$request->username,
            'address' => $request->address,
            'phone'=>$request->phone,
            'email'=>$request->email,
            'password'=>$request->password,
            'isAdmin'=>false,
            'image'=>'/storage/user/'.$new_file,


        ]);
        return true;
    }

    public function addadmin(Request $request){
        if($request->hasFile('image')){
            $file=$request->image;
            $new_file=time().$file->getClientOriginalName();
            $file->move('/storage/user',$new_file);
        }
        User::create([
            'id'=>$request->id,
            'username'=>$request->username,
            'address' => $request->address,
            'phone'=>$request->phone,
            'email'=>$request->email,
            'password'=>$request->password,
            'isAdmin'=>true,
            'image'=>'/storage/user/'.$new_file,


        ]);
        return true;
    }
    public function getallusers(){
        return User::all();

    }
    public function login(Request $request){
        foreach(User::all() as $y){
            if($y->email==$request->email&&$y->password==$request->password){
                return true;
            }
        }
        return false;
    }
    public function getuserbyid($id){
        return User::find($id);

    }
    public function updatedatauser(Request $request, $id){
        $r=User::find($id);
        if($file = $request->hasFile('image')) {
            $file = $request->image;
            $new_file = time().$file->getClientOriginalName();
            $path = $file->storeAs('/img', $new_file);


            $r->image = '/img/'. $new_file;
        }

        $r->username=$request->name;
        $r->email=$request->email;
        $r->address=$request->address;
        $r->phone=$request->phone;
        // $r->id=$request->id;
        $r->save();
        return $r;

    }

    public function deleteuser($id){
        User::find($id)->delete();
    }


    public function blockuser(Request $request)
    {
        Block::create(
            [
                'id'=>$request->id,
                'blocker_id'=>$request->blocker_id,
                'blocked_id'=>$request->blocked_id,
            ]
            );


    }
    public function getalluserblockedbyme(Request $request){
        $t=Block::where('blocker_id',$request->blocker_id)->get();
        $r=[];
        foreach ($t as $key) {
            array_push($r,$key->blockuser);
        }
        return $r;

    }
    public function unblockuser(Request $request){
        $blocker=$request->blocker_id;
        $blocked=$request->blocked_id;
        foreach (Block::all() as $key) {
            if($key->blocker_id==$blocker&&$key->blocked_id==$blocked)
            $key->delete();
            # code...
        }
    }


    public function rateuser($rater_id, $rated_id, $rate) {
        Rate::create([
            'rater_id' => $rater_id,
            'rated_id' => $rated_id,
            'rate' => $rate,
        ]);
    }

    public function getgivenrate($rater_id, $rated_id) {
        $rate = Rate::where('rater_id', $rater_id)->where('rated_id', $rated_id)->get();
        $hasRate = Rate::where('rater_id', $rater_id)->where('rated_id', $rated_id)->get()->count();
        if($hasRate == 0) {
            return 0;
        }
        return $rate;
    }

    public function getaveragerate($rated_id) {
        $data = Rate::where('rated_id', $rated_id)->get();
        $o=0;
        foreach ($data as $key) {
            $o=$o+$key->rate;
            # code...
        }
        $count =  $data->count();
        if($count == 0) {
            return 0;
        }
        return round($o/$count, 1);
    }

}
