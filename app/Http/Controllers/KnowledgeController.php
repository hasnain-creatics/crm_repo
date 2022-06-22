<?php

namespace App\Http\Controllers;
use App\Models\Knowledge;
use Auth;
use DB;

use Illuminate\Http\Request;

class KnowledgeController extends Controller
{

    public function upload($screen_name){

        return view('modals.knowledge.knowledge_upload_video',compact('screen_name'));

    }

    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required',
            'video_title' => 'required',
            'screen_name' => 'required',
            'image' => 'required',
           
        ]);
 


        $title = time().'.'.$request->file->getClientOriginalExtension();

        $request->file->storeAs("tutorial", $title);

        $image = time().'.'.$request->image->getClientOriginalExtension(); 
        
        $request->image->storeAs("tutorial/thumb", $image);

       $storeFile = new Knowledge;
       $storeFile->title=  $request->video_title;
       $storeFile->screen_name=  $request->screen_name;
       $storeFile->doc = $title;
       $storeFile->image = $image;
       $storeFile->created_by = Auth::user()->id;
       $storeFile->updated_by = Auth::user()->id;
       $storeFile->save();

        return response()->json(['status'=>'success','message'=>'File Uploaded Successfully','id'=>$storeFile->id]);

    }


    public function video_listing($screen_name=null){

        $knowledger = new Knowledge();
        
        $request = new Request();
       
        $result = $knowledger->where('screen_name',$screen_name)->orderBy('id','desc')->get();
        $found_video = false;
        if(isset($result)){
            if(count($result) > 0){
                $found_video = true;
                $first_video_id = $result[0]->id;
                $first_video_link = $result[0]->doc;
                $first_video_title = $result[0]->title;
        
            }else{
                $found_video = false;
                $first_video_id = '';
                $first_video_link = '';
                $first_video_title = '';
                
            }

        }else{
            $result = [];
        }

      
        
        return view('modals.knowledge.knowledge_watch_video',compact('result','screen_name','first_video_link','first_video_title','first_video_id','found_video'));

    }

    public function play_video($id){

                $knowledger = new Knowledge();
                $data = $knowledger->find($id);
                return response()->json($data);
        
    }



}
