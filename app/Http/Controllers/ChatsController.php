<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
class ChatsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function fetch_my_message($id){

        $users = User::find($id);
        
        $result = Message::with('user')->where(['messages.user_id'=>Auth::user()->id,'messages.chat_user_id'=>$id])->paginate(15);

        return response()->json(['status'=>'success','message'=>'messages founds successfully','result'=>$result,'users'=>$users,'login_details'=>Auth::user()]);

    }

    public function index()
    {
        return view('chat');
    }

    public function fetchMessages()
    {
        return Message::with('user')->get();
    }

    public function sendMessage(Request $request)
    {
        $user = Auth::user();
        $message = $user->messages()->create([
            'message' => $request->input('message')
        ]);
        return ['status' => 'Message Sent!'];
    }
}
