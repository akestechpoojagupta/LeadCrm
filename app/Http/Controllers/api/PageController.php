<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Validator;
use App\Models\Page;
use Auth;

class PageController extends Controller
{
//=============================>Page Label Create Code Start====================================>
     public function create(Request $request)
     {
          $validator = Validator::make($request->all(),[
             'client_id'=>'required',
             'title'=>'required',
             'description'=>'required',
             'image'=>'required',
             
         ]);
//=============================> Store Update Page Label Detials Into db =========================>
         if($validator->passes()) {
            if($request->hasFile('image')){
                $image = $request->file('image'); 
                $path = $image->store('uploads');
                $image_name = $image->getClientOriginalName();
                $image_path = url('uploads',[$image_name]);
                $data['image'] = 'uploads/'.$image_name;
               
            }
            $data['created_by'] = Auth::user()->id;
             $data['client_id'] = $request->client_id;
             $data['title'] = $request->title;
             $data['description'] = $request->description;
             $data['slug'] = Str::slug($request->title);
           
             $response = Page::create($data);
             if($response){
                 return ['status_code' => 200 , 'message' => 'Lead Label Created Success !'];
             }else{
                 return ['status_code' => 201 , 'message' => 'Something went wrong !'];
             }   
         }
         return response()->json(['message'=>$validator->errors()->all(),'status_code'=>301]);
     }
//=============================>Page Label Create Code End====================================>
 
 
//==============================>Page label Edit Code Start==================================>
     public function edit($id)
     {
         $lead = Page::find($id);
         return ['status_code' => 200 , 'data' => $lead];
     }
//==============================>Page label Edit Code End==================================>

//=============================>Page label Update Code Start==================================>
     public function update(Request $request)
     {
         $validator = Validator::make($request->all(),[
            'client_id'=>'required',
            'title'=>'required',
            'description'=>'required',
            'image'=>'required',
            
         ]);
//=============================> Store Update Page Label Detials Into db =========================>
         if($validator->passes()) {
            if($request->hasFile('image')){
                $image = $request->file('image'); 
                $path = $image->store('uploads');
                $image_name = $image->getClientOriginalName();
                $image_path = url('uploads',[$image_name]);
                $data['image'] = 'uploads/'.$image_name;
               
            }
            $data['client_id'] = $request->client_id;
            $data['title'] = $request->title;
            $data['description'] = $request->description;
             $data['slug'] = Str::slug($request->title);
             $data['updated_by'] = Auth::user($request->color)->id;
             $response = Page::where('id',$request->id)->update($data);
             if($response){
                 return ['status_code' => 200 , 'message' => 'Lead Stetus Updated Success !'];
             }else{
                 return ['status_code' => 201 , 'message' => 'Something went wrong !'];
             }   
         }
         return response()->json(['message'=>$validator->errors()->all(),'status_code'=>301]);
     }
//=============================>Page label Update Code End==================================>
 
//===============================>Page label Delete Code Start==================================>
     public function delete($id){   
 
         $response = Page::where('id',$id)->delete();
 
         if($response){
             return response()->json(['status_code' => 200 , 'message' => 'Successfully Deleted !']);
         }
         else{
             return response()->json(['status_code' => 201 , 'message' => 'Delete Failed !']);
         }
     }
//===============================>Page label Delete Code End==================================>
}
