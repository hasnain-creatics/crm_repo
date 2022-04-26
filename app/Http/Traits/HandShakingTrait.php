<?php
namespace App\Http\Traits;
use Twilio\Rest\Client;
use Twilio\Rest\TwilioException;
use Twilio\Jwt\ClientToken;
trait HandShakingTrait 
{
    protected $twilio_account_sid;
    
    protected $twilio_auth_token;

    protected $twilio_app_sid;

    protected $twilio_phone_number;
    
    public function send_verification_code($number,$mesg){

        $this->twilio_account_sid  = config('app.twilio')['TWILIO_ACCOUNT_SID'];

        $this->twilio_auth_token   = config('app.twilio')['TWILIO_AUTH_TOKEN'];

        $this->twilio_app_sid      = config('app.twilio')['TWILIO_APP_SID'];

        $this->twilio_phone_number = config('app.twilio')['TWILIO_PHONE_NUMBER'];
        
        return $this->twilio_account_details($number,$mesg);

    }

    protected function twilio_account_details($number,$mesg)
    {
        $accountSid = $this->twilio_account_sid;

        $authToken  = $this->twilio_auth_token;

        $appSid     = $this->twilio_app_sid;
        
        $client     = new Client($accountSid, $authToken);

        try{

            $msg_detail['from'] = $this->twilio_phone_number;

            $msg_detail['body'] = $mesg;

            $sent = $client->messages->create($number,$msg_detail);

            return ['status'=>'success','message'=>'success'];
         
        }catch (\Twilio\Exceptions\RestException $e){

            return ['status'=>'error','message'=>$e->getMessage()];

        }
    }
}