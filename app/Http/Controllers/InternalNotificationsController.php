<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InternalNotifications; 
use DB;
use Auth;
use App\Models\User;
// use Illuminate\Notifications\Notification;
use App\Models\NotificationUsers;
class InternalNotificationsController extends Controller
{
    public function notification_list(){

    }

    public function fetch_all_notifications(){

    }
    
    public function check_some_notifications(InternalNotifications $notification){
        $count_notification = $notification->join('notifications_users','notifications_users.notification_id','=','internal_notifications.id')
                                           ->where('notifications_users.user_id',Auth::user()->id)
                                           ->where('notifications_users.notify',0)
                                          ->count();
                                          $data['status'] = 'error';
                                          $data['message'] = 'data not found';
                                          $data['notification'] = 0;
        if($count_notification>0){
            
            $data['status'] = 'success';
            $data['message'] = 'data found successfully';
            $data['notification'] = $count_notification;
        }

        return response()->json($data);
    }

    public function fetch_new_notifications(InternalNotifications $notification){

        $data['status'] = 'error';

        $data['message'] = '0 new notifications found';

        $data['result'] = [];

        $data['new'] = 0;

        
        $notify = $notification->whereHas('notifications_users',function($query){

            $query->where('notifications_users.user_id',Auth::user()->id);
            $query->where('notifications_users.notify',0);
            
            
        })->orderBy('internal_notifications.id','desc')->get();
        
        if(count($notify) >=1 ){

            $data['status'] = 'success';

            $data['message'] = 'notifications found successfully';

            $results = collect([]);

            collect($notify)->each(function($item) use ($results){

                $result['id'] = $item['id'];
                $result['type'] = $item['type'];
                $result['notifiable_type'] = $item['notifiable_type'];
                $result['notifiable_id'] = $item['notifiable_id'];
                $result['data'] = json_decode($item['data']);
                $result['read_at'] = $item['read_at'];
                $result['created_at'] = $item['created_at'];
                $result['updated_at'] = $item['updated_at'];
                $result['user_id'] = $item['user_id'];
                $results->push($result);

            });

            $data['result'] = $results;

            $data['new'] = count($notify);
           
        }

        return response()->json($data);

    }

    public function notify_notification($id=null){

            $notification_users = new NotificationUsers();
        if(isset($id))
        {

            $noty = $notification_users->where(['notification_id'=>$id,'user_id'=>Auth::user()->id])->update(['notify'=>1]);

            if(Auth::user()->roles[0]->name  == 'Writer' || Auth::user()->roles[0]->name  == 'Writer Manager' || Auth::user()->roles[0]->name  == 'Admin' )
            {

                return  redirect(route('writers.index'));

            }else if(Auth::user()->roles[0]->name  == 'Sale Manager' || Auth::user()->roles[0]->name  == 'Sale Agent'){

                
                return redirect(route('orders.home'));

            }

        }else{
            // $noty = $notification_users->where(['notification_id'=>$id,'user_id'=>Auth::user()->id])->update(['notify'=>1]);

            $notification_users->where(['user_id'=>Auth::user()->id])->update(['notify'=>1]);
            return response()->json(['status'=>'success','message'=>'all notifications notified']);
        }
    }

}
