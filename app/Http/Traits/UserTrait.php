<?php
namespace App\Http\Traits;

use App\Models\UserProfileImage;
use App\Models\User;

use Illuminate\Support\Facades\Http;
use Auth;
trait UserTrait 
{
    
    public function is_admin(){
        $role = false;
        if(Auth::user()->roles[0]->name == 'Admin')
            return $role = true;
    }
    
    public function scan_profile_image($path){

        $response = Http::get('https://api.sightengine.com/1.0/check.json', [
            'url' =>  $path,
            'models' => 'nudity',
            'api_user' => '1572901016',
            'api_secret' => 'mxrRVuvJrBX99Cq99FPb'
          ]);

          
         $output = json_decode($response->body(), true);
 
          $data['status']         = '';
        
          $data['image_content']  = '';
          
          if(isset($output['nudity']['safe']) && ($output['nudity']['safe'] >= 0.90)){       
              
              $data['status'] = 'safe';
              
              $data['image_content'] = 'Safe';
              
              
          }else{
              
              $data['status'] = 'nudity';
              
              $data['image_content'] = 'nudity';
              
              
              if(isset($output['nudity']['partial_tag'])){
                  
                   $data['image_content'] = "this image is inapproriate. Please choose another image";
                   
              }
          }
          
        //   if(isset($output['weapon']) && $output['weapon'] >= 0.10){
              
        //       $data['status'] = 'harm';
              
        //       $data['image_content'] = 'Weapn Contain';
              
        //   }
          
        //   if(isset($output['alcohol']) && $output['alcohol'] >= 0.10){
              
        //       $data['status'] = 'harm';
        //       $data['image_content'] = 'Alcohol Contain';
        //   }
          
        //   if(isset($output['drugs']) && $output['drugs'] >= 0.10){
        //       $data['status'] = 'harm';
              
        //       $data['image_content'] = 'Drug Contain';
              
        //   }
          
        //   if(isset($output['gore']['prob']) && $output['drugs'] >= 0.10){
              
        //       $data['status'] = 'harm';
              
        //       $data['image_content'] = 'Gore Contain'; 
              
        //   }
          
          return $data;
         
    }

    public function user_profile_update($file,$id){
   
            $fileName = 'profile-image-'.date('YmdHis').'.'.$file->getClientOriginalExtension();

            $path = $file->storeAs("profile_images/user_{$id}", $fileName);
            
            // $data =$this->scan_profile_image(url("storage/app/{$path}"));
            $data['status'] = 'safe';

            if($data['status'] == 'safe'){
             
                $user_image          =  new User();
 
                $find_user_image     = $user_image->find($id);
                
                $find_user_image->profile_image_id = $path;
    
                $find_user_image->save();
                
                 $data['status'] = 'safe';
                 
                 $data['image_content'] = url("storage/app/{$path}");

            }
            else{
                
              unlink($_SERVER['DOCUMENT_ROOT']."/crm/storage/app/{$path}");
              
            }
            
            return $data;
    }




    public function files_store_any($data = array()){
   
      $fileName = 'profile-image-'.date('YmdHis').'.'.$file->getClientOriginalExtension();

      $path = $file->storeAs("profile_images/user_{$id}", $fileName);
      
      // $data =$this->scan_profile_image(url("storage/app/{$path}"));
      $data['status'] = 'safe';

      if($data['status'] == 'safe'){
       
          $user_image          =  new User();

          $find_user_image     = $user_image->find($id);
          
          $find_user_image->profile_image_id = $path;

          $find_user_image->save();
          
           $data['status'] = 'safe';
           
           $data['image_content'] = url("storage/app/{$path}");

      }
      else{
          
        unlink($_SERVER['DOCUMENT_ROOT']."/crm/storage/app/{$path}");
        
      }
      
      return $data;
}


    public function token($user){
        
        $user->tokens->each(function($token, $key) { $token->delete();});
        
        $token = $user->createToken('bearerToken')->plainTextToken;

        return $token;
        
    }

}
