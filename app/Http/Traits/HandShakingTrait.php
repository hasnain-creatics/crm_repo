<?php

namespace App\Http\Traits;

use Twilio\Rest\Client;
use Twilio\Rest\TwilioException;
use Twilio\Jwt\ClientToken;
use Auth;
use DB;
use App\Models\User;
use App\Models\Orders;
use App\Events\NotificationEvent;
use Pusher\Pusher;

trait HandShakingTrait
{
    // protected $twilio_account_sid;

    // protected $twilio_auth_token;

    // protected $twilio_app_sid;

    // protected $twilio_phone_number;

    // public function send_verification_code($number,$mesg){

    //     $this->twilio_account_sid  = config('app.twilio')['TWILIO_ACCOUNT_SID'];

    //     $this->twilio_auth_token   = config('app.twilio')['TWILIO_AUTH_TOKEN'];

    //     $this->twilio_app_sid      = config('app.twilio')['TWILIO_APP_SID'];

    //     $this->twilio_phone_number = config('app.twilio')['TWILIO_PHONE_NUMBER'];

    //     return $this->twilio_account_details($number,$mesg);

    // }

    // protected function twilio_account_details($number,$mesg)
    // {
    //     $accountSid = $this->twilio_account_sid;

    //     $authToken  = $this->twilio_auth_token;

    //     $appSid     = $this->twilio_app_sid;

    //     $client     = new Client($accountSid, $authToken);

    //     try{

    //         $msg_detail['from'] = $this->twilio_phone_number;

    //         $msg_detail['body'] = $mesg;

    //         $sent = $client->messages->create($number,$msg_detail);

    //         return ['status'=>'success','message'=>'success'];

    //     }catch (\Twilio\Exceptions\RestException $e){

    //         return ['status'=>'error','message'=>$e->getMessage()];

    //     }
    // }


    protected function ssave($data)
    {

        $data->save();

        return $data;
    }
    public function active_writer_managers()
    {

        $writers = User::select('users.id')

            ->whereHas('roles', function ($q) {

                $q->whereIn('name', ['Writer Manager', 'Admin']);
            })->get();

        return $writers;
    }
    public function full_name($id)
    {

        $detail = User::find($id);
        if($detail){
            return $detail->first_name . ' ' . $detail->last_name;
        }else{
            return 'no name';
        }
        
    }

    public function all_assigned_user_order($notifications, $order_id)
    {
        $ids = [];

        $orders = Orders::where('sale_orders.id', $order_id);

        $orders = $orders->with('order_assigns');

        $orders_result = $orders->first();

        if ($orders_result->order_assigns) {

            //collect($orders_result->order_assigns)->each(function ($item) use ($notifications) {
                foreach($orders_result->order_assigns as $item){

                    $notification_users                     =   new \App\Models\NotificationUsers();

                    $notification_users->user_id            =   $item->user_id;

                    $notification_users->notification_id    =   $notifications->id;

                    $notification_users->created_by         =   Auth::user()->id;
                 
                    $ids[] =            $notification_users->user_id ;
                   
                    $notification_users->save();   

        
               }
            //});

            $notification_userss                     =   new \App\Models\NotificationUsers();

            $notification_userss->user_id            =   $orders_result->created_by_user_id;

            $notification_userss->notification_id    =   $notifications->id;

            $notification_userss->created_by         =   Auth::user()->id;

            $ids[] = $notification_userss->user_id;

            $notification_userss->save();
          
        }
        return $ids;
    }


    public function alert_notify($my_channel=null,$my_event=null,$alert_id=null,$new_message=null)
    {
        $options =  [
            'cluster' => 'ap2',
            'useTLS' => true
        ];

        $pusher = new Pusher(
            "a9e17b308b857320b4bd",
            "ef1ecb20ab13d36802f2",
            1437513,
            $options
        );

        $datas['update_notifications'] = 'yes';

        $datas['alert_id'] = $alert_id;

        if(isset($new_message)){

            $datas['new_message'] = 'yes';

        }

        if(isset($my_channel) && isset($my_event)){

            $pusher->trigger($my_channel, $my_event, $datas);

        }else{

            $pusher->trigger('my-channel', 'my-event', $datas);

        }
        
    }

    public function send_all_writers_managers($notifications, $saved_user_id = null)
    {
        // collect($this->active_writer_managers())->each(function ($item) use ($notifications, $saved_user_id) {
            $ids = [];

            foreach($this->active_writer_managers() as $item){

            if (isset($saved_user_id)) {

                if ($item->id != $saved_user_id) {

                        $notification_users                     =   new \App\Models\NotificationUsers();

                        $notification_users->user_id            =   $item->id;

                        $ids[] = $notification_users->user_id;

                        $notification_users->notification_id    =   $notifications->id;

                        $notification_users->created_by         =   Auth::user()->id;

                        $notification_users->save();

                    }

                } else {

                    $notification_users                     =   new \App\Models\NotificationUsers();

                    $notification_users->user_id            =   $item->id;

                    $ids[] = $notification_users->user_id;

                    $notification_users->notification_id    =   $notifications->id;

                    $notification_users->created_by         =   Auth::user()->id;

                    $notification_users->save();
                } 
        }
        return $ids;
    }

    public function sales_user_notification($data){
        $data->save();
    }


    public function for_sales($notifications){
        $ids = [];
        if(Auth::user()->roles[0]->type == 'manager'){
                
            $notification_users  =   new \App\Models\NotificationUsers();
            $notification_users->notification_id = $notifications->id;
            $notification_users->created_by = Auth::user()->id;
            $notification_users->user_id = User::select('users.id')
                                                ->whereHas('roles',function($query){
                                                $query->where('name','Admin');
                                            })->first()->id;
            $ids[] = $notification_users->user_id;
            $this->sales_user_notification($notification_users);

        }else if(Auth::user()->roles[0]->type == 'agent'){
            $notification_users_admin  = new \App\Models\NotificationUsers();
            $admin_id = User::select('users.id')->whereHas('roles',function($query){
                $query->where('name','Admin');
            })->first();
            $notification_users_admin->user_id = $admin_id->id;
            $notification_users_admin->notification_id = $notifications->id;
            $notification_users_admin->created_by = Auth::user()->id;
            $ids[] = $notification_users_admin->user_id;
            $this->sales_user_notification($notification_users_admin);

            $notification_users_manager                    =   new \App\Models\NotificationUsers();
            $notification_users_manager->notification_id = $notifications->id;
            $notification_users_manager->created_by = Auth::user()->id;
            $notification_users_manager->user_id = Auth::user()->assigned_to;
            $ids[] = $notification_users_manager->user_id;
            $this->sales_user_notification($notification_users_manager);

            if(!Auth::user()->is_lead){

                $notification_users_lead                    =   new \App\Models\NotificationUsers();
                $notification_users_lead->notification_id = $notifications->id;
                $notification_users_lead->created_by = Auth::user()->id;
                $notification_users_lead->user_id = Auth::user()->lead_id;
                $ids[] = $notification_users_lead->user_id;

                $this->sales_user_notification($notification_users_lead);

            }

        }

      return $ids;
    }
    public function send_admin($notifications){
        $ids = [];
        $notification_users_admin  =   new \App\Models\NotificationUsers();

        $notification_users_admin->user_id = User::select('users.id')->whereHas('roles',function($q){$q->where('name','Admin');})->first()->id;
        $ids[] = $notification_users_admin->user_id;
        $notification_users_admin->notification_id = $notifications->id;

        $notification_users_admin->created_by = Auth::user()->id;

        $notification_users_admin->save();
        return $ids;

    }
    public function save_notification($data, $notification_type)
    {

        $notifications       = new \App\Models\InternalNotifications();

        $notifications->type = $notification_type;

        $saved_data          = $this->ssave($data);
        
        if ($notification_type == 'new_lead_added'){

            $created_at = date('d M Y H:i:s', strtotime($saved_data->created_at));

            $notifications->data   = json_encode([
                "message"=>"{$this->full_name($saved_data->created_by)}, Created a New Lead as LEAD-{$saved_data->id} on {$created_at}",
                "roles"=>['Sale Manager','Admin'],
                "links"=>['leads'],
                "url"=>url("admin/leads")
            ]);

            $notifications->created_at = date('Y-m-d H:i:s');

            $notifications->save();

            $ids = $this->for_sales($notifications);
            $this->alert_notify(null,null,$ids);
        }
        else 
         if ($notification_type == 'lead_updated'){
            $created_at = date('d M Y H:i:s', strtotime($saved_data->created_at));

            $notifications->data   = json_encode([
                "message"=>"{$this->full_name(Auth::user()->id)}, Updated the Lead, LEAD-{$saved_data->id} on {$created_at}",
                "roles"=>['Sale Manager','Admin'],
                "links"=>['leads'],
                "url"=>url("admin/leads")
            ]);

            $notifications->created_at = date('Y-m-d H:i:s');

            $notifications->save();

            $notification_users  =   new \App\Models\NotificationUsers();

            $notification_users->user_id = $saved_data->created_by;
            
            $notification_users->notification_id = $notifications->id;

            $notification_users->created_by = Auth::user()->id;

            $notification_users->save();

           $ids= $this->send_admin($notifications);

           $ids[] = $notification_users->user_id;

           $this->alert_notify(null,null,$ids);
        }
        else if($notification_type == 'lead_transfered'){

            $created_at = date('d M Y H:i:s', strtotime($saved_data->created_at));

            $notifications->data   = json_encode([
                "message"=>"{$this->full_name($saved_data->created_by)}, Transfered Lead-{$saved_data->lead_id} to {$this->full_name($saved_data->user_id)} on {$created_at}",
                "links"=>['leads'],
                "url"=>url("admin/leads")
            ]);

            $notifications->created_at = date('Y-m-d H:i:s');

            $notifications->save();

            $notification_users  =   new \App\Models\NotificationUsers();

            $notification_users->user_id = $saved_data->user_id;
            
            $notification_users->notification_id = $notifications->id;

            $notification_users->created_by = Auth::user()->id;

            $notification_users->save();
            
           $ids= $this->send_admin($notifications);

           $ids[] = $notification_users->user_id;

           $this->alert_notify(null,null,$ids);

        }
        else
        if ($notification_type == 'new_order_added'){

            $created_at = date('d M Y H:i:s', strtotime($saved_data->created_at));

            $notifications->data   = json_encode([
                "message"=>"{$this->full_name($saved_data->created_by_user_id)}, Created New Order as ORDER-{$saved_data->id} on {$created_at}",
                "roles"=>['Sales','Writers Manager','Admin'],
                "links"=>['orders'],
                "url"=>url("admin/orders")
            ]);

            $notifications->created_at = date('Y-m-d H:i:s');

            $notifications->save();

            $this->send_all_writers_managers($notifications, $saved_data->created_by_user_id);

            $ids = $this->for_sales($notifications);

            $this->alert_notify(null,null,$ids);

        }else
    
        if ($notification_type == 'task_assigned') {

            $created_at = date('d M Y H:i:s', strtotime($saved_data->created_at));

            $notifications->data   = json_encode([
                "message"=>"{$this->full_name($saved_data->created_by)}, Assigned {$this->full_name($saved_data->user_id)} to ORDER-{$saved_data->sale_order_id} on {$created_at}",
                "links"=>['task_details',$saved_data->sale_order_id],
                "url"=>url("admin/writers/task_details/{$saved_data->sale_order_id}")
            ]);

            $notifications->created_at = date('Y-m-d H:i:s');

            $notifications->save();

            $this->send_all_writers_managers($notifications, $saved_data->user_id);

            $notification_users                     =   new \App\Models\NotificationUsers();

            $notification_users->user_id            =   $saved_data->user_id;

            $notification_users->notification_id    =   $notifications->id;

            $notification_users->created_by         =   Auth::user()->id;

            $notification_users->save();

            $this->alert_notify();

        } else
        if ($notification_type == 'order_status_change') {

            $created_at = date('d M Y H:i:s', strtotime($saved_data->created_at));

            $notifications->data   =  json_encode([
                                        "message"=>"{$this->full_name($saved_data->created_by)}, Changed Status:{$saved_data->title} ORDER-{$saved_data->order} on {$created_at}",
                                        "url"=>url("admin/writers/task_details/{$saved_data->sale_order_id}")
                                    ]);

            $notifications->save();

            $ids = $this->all_assigned_user_order($notifications, $saved_data->order);
     
            $writer_manager_id = $this->send_all_writers_managers($notifications);

            foreach($writer_manager_id as $keys=>$values){

                $ids[] = $values;

            }
                                    
            $this->alert_notify(null,null,$ids);

        } 
        // else if($notification_type = 'new_document_sent_from_writer'){

        //     $created_at = date('d M Y H:i:s', strtotime($saved_data->created_at));

        //     $notifications->data   =    json_encode([
        //                                     "message"=>"{$this->full_name($saved_data->created_by)}, New document received from writer on ORDER-{$saved_data->order} please check !. ",
        //                                     "url"=>"/"
        //                                 ]);

        //     $notifications->save();

        //     // $sales_details = $this->for_sales($notifications);
        
        //     // $this->alert_notify(null,null,$sales_details);

        // }
        else
        if ($notification_type == 'user_task_status_changed') {

            $created_at = date('d M Y H:i:s', strtotime($saved_data->created_at));

            $notifications->data   =    json_encode([
                                            "message"=>"{$this->full_name($saved_data->created_by)}, Ratings on ORDER-{$saved_data->order_id} : {$saved_data->text} on {$created_at}",
                                            "url"=>url("admin/writers/task_details/{$saved_data->order_id}")
                                        ]);

            $notifications->save();

            $ids = $this->send_all_writers_managers($notifications, $saved_data->user_id);

            $this->alert_notify(null,null,$ids);

        } else
        if ($notification_type == 'user_ratings_update') {

            $created_at = date('d M Y H:i:s', strtotime($saved_data->created_at));

            $notifications->data   = json_encode([
                                        "message"=>"{$this->full_name($saved_data->created_by)}, updated ratings ratings on ORDER-{$saved_data->order_id} : {$saved_data->rating} on {$created_at}",
                                        "url"=>url("admin/writers/task_details/{$saved_data->order_id}")
                                    ]);

            $notifications->save();

           $ids= $this->send_all_writers_managers($notifications, $saved_data->user_id);

            $this->alert_notify(null,null,$ids);
        } else
        if ($notification_type == 'user_ratings_add') {

            $created_at = date('d M Y H:i:s', strtotime($saved_data->created_at));

            $notifications->data   =  json_encode([
                "messag"=>"{$this->full_name($saved_data->created_by)}, added ratings {$saved_data->rating} against ORDER-{$saved_data->order_id} on {$this->full_name($saved_data->user_id)}",
                "url"=>url("admin/writers/task_details/{$saved_data->order_id}")
            ]);

            $notifications->save();

            $ids = $this->send_all_writers_managers($notifications, $saved_data->user_id);

            $this->alert_notify(null,null,$ids);

        } else
        if ($notification_type == 'new_documents_added') {

            $created_at = date('d M Y H:i:s', strtotime($saved_data->created_at));
            
         
                $notifications->data   = json_encode([
                    "message"=>"{$this->full_name($saved_data->created_by)}, added some doucments against ORDER-{$saved_data->sale_order_id} on {$created_at}",
                    "url"=>url("admin/writers/task_details/{$saved_data->sale_order_id}")
                ]); 
        


            $notifications->save();

            $ids= $this->send_all_writers_managers($notifications);

            $this->alert_notify(null,null,$ids);

        }else 
        if($notification_type == 'order_feedback_added'){
   
            $created_at = date('d M Y H:i:s', strtotime($saved_data->created_at));

            // $notifications->data   = json_encode([
            //         "message"=>"{$this->full_name($saved_data->created_by)}, added some feedback against ORDER-{$saved_data->order_id} on {$created_at}",
            //         "url"=>'/'
            // ]);


            if($saved_data->deadline){

                $notifications->data   = json_encode([
                    "message"=>"{$this->full_name($saved_data->created_by)}, added feedback with some doucments against ORDER-{$saved_data->order_id} with new deadline {$saved_data->deadline} on {$created_at}",
                    "url"=>url("admin/writers/task_details/{$saved_data->order_id}")
                ]);

            }else{
        
                $notifications->data   = json_encode([
                    "message"=>"{$this->full_name($saved_data->created_by)}, added feeback against ORDER-{$saved_data->order_id} on {$created_at}",
                    "url"=>url("admin/writers/task_details/{$saved_data->order_id}")
                ]); 
        
            } 

            $notifications->save();

            $ids= $this->send_all_writers_managers($notifications);

            $this->alert_notify(null,null,$ids);


        }
        else if($notification_type == 'order_message_alert'){

            $created_at = date('d M Y H:i:s', strtotime($saved_data->created_at));

            $notifications->data   = json_encode([
                    "message"=>"{$this->full_name($saved_data->created_by)}, sent new message on ORDER-{$saved_data->order_id}",
                    "url"=>'/'
            ]);

            $notifications->save();

            $ids = $this->send_all_writers_managers($notifications);

            $orders = Orders::where('sale_orders.id', $saved_data->order_id);

            $orders = $orders->with('order_assigns');

            $orders_result = $orders->first();

            if ($orders_result->order_assigns) {

                    foreach($orders_result->order_assigns as $item){

                        $notification_users                     =   new \App\Models\NotificationUsers();

                        $notification_users->user_id            =   $item->user_id;

                        $notification_users->notification_id    =   $notifications->id;

                        $notification_users->created_by         =   Auth::user()->id;
                    
                        $ids[] =  $notification_users->user_id ;
                    
                        $notification_users->save();   
            
                }
            }   

            $sales_details = $this->for_sales($notifications);

            foreach($sales_details as $key=>$value){

                $ids[] = $value;

            }

            $this->alert_notify(null,null,$ids,'new_message');

        }
    
        return $saved_data;
    }
}
