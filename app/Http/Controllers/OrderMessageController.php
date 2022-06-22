<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use App\Models\OrderMessage;
use App\Models\Orders;
use App\Models\OrderMessageDocuments;
use Exception;

class OrderMessageController extends Controller
{
    public function order_message_list($id){

        $data['id'] = $id;

        return view('modals.order_messages.order_messages_list',$data);

    }

    public function fetch_messages($id){

        $order_messages = new OrderMessage();

        $results = $order_messages->with('users')->with('order_message_documents')->where('order_messages.order_id',$id)->orderBy('order_messages.id','asc')->get();

        $data['status'] = 'success';

        $data['result'] = $results;
                
        return response()->json($data);

    }


    public function store(Request $request){
        try{
            $request->validate([
                
                'message'   => 'required',
                'order_id'  => 'required',
                
            ]);

            $order_message              = new OrderMessage();

            $order_message->order_id    = $request->order_id;

            $order_message->reciever_id = $request->user_id;

            $order_message->sender_id   = Auth::user()->id;

            $order_message->message     = trim($request->message);

            $order_message->save();

            if($request->file('files')){

                foreach($request->file('files') as $key=>$value){
                  
                    $title = $value->getClientOriginalName();
                    
                    $full_path =  url('storage/app').'/'.$value->storeAs("order_message_docs/order_{$request->order_id}", $title);
                    
                    $order_message_documents = new OrderMessageDocuments();

                    $order_message_documents->order_id = $request->order_id;

                    $order_message_documents->order_message_id = $order_message->id;

                    $order_message_documents->sender_id = Auth::user()->id;

                    $order_message_documents->file_id = $full_path;

                    $order_message_documents->file_name = $title;

                    $order_message_documents->save();
                     
                }
    
            }

            return response()->json(['status'=>'success','message'=>'message saved successfully!','order_id'=>$request->order_id,'user_id'=>Auth::user()->id]);

        }catch(Exception $e){
            return response()->json(['status'=>'error','message'=>$e->message,'order_id'=>$request->order_id,'user_id'=>Auth::user()->id]);
        }
          
    }


}
