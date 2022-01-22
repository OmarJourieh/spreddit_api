<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\User;

class MessagesController extends Controller
{
    public function sendmessage(Request $request) {
        $sender_id = $request->sender_id;
        $receiver_id = $request->receiver_id;
        $content = $request->content;

        Message::create([
            'sender_id' => $sender_id,
            'receiver_id' => $receiver_id,
            'content' => $content,
        ]);
    }

    public function getallmessageswithuser(Request $request) {
        $sender_id = $request->sender_id;
        $receiver_id = $request->receiver_id;

        $data =  [];
        $sent= Message::where('sender_id', $sender_id)->where('receiver_id', $receiver_id)->get();
        $received = Message::where('sender_id', $receiver_id)->where('receiver_id', $sender_id)->get();

        $data['sent'] = $sent;
        $data['received'] = $received;

        return $data;
    }

    public function getconversations(Request $request) {
        $sender_id = $request->sender_id;

        $sent= Message::where('sender_id', $sender_id)->orWhere('receiver_id', $sender_id)->get();
        $ob = array();
        $ids = array();
        foreach ($sent as $msg) {
            if($sender_id != $msg->usersender->id)
            {
                if(!in_array($msg->usersender->id, $ids)){
                    array_push($ob, $msg->usersender);
                    array_push($ids, $msg->usersender->id);
                }
            }
            //if($sender_id != $msg->userreceiver->id)
            else
            {
                if(!in_array($msg->userreceiver->id, $ids)){
                    array_push($ob, $msg->userreceiver);
                    array_push($ids, $msg->userreceiver->id);
                }
            }
        }

//         $r=[];
//         foreach ($ob as $key) {
//             array_push($r,$key->id);
//         }
        
//         $messages = Message::whereIn('receiver_id', $r)->get();

//         // return $messages;
//         $user = User::find($sender_id);
//         $messages2 = $user->userreceiver;
//         $messages1 = $user->usersender;

//         return $messages1;

        return $ob;
    }

}
