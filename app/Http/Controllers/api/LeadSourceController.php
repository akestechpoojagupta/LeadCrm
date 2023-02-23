<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Validator;
use App\Models\LeadSource;
use Auth;

class LeadSourceController extends Controller
{
//===========================>Lead Source Create Code Start=================================>
    public function create(Request $request)
    {
         $validator = Validator::make($request->all(),[
            'title'=>'required',
            'type'=>'required',
        ]);
//=============================> Store Create Lead Source Detials Into db =========================>
        if($validator->passes()) {
            $data['created_by'] = Auth::user()->id;
            $data['title'] = $request->title;
            $data['type'] = $request->type;
            $data['slug'] = Str::slug($request->title);
            $response = LeadSource::create($data);
            if($response){
                return ['status_code' => 200 , 'message' => 'Lead Source Created Success !'];
            }else{
                return ['status_code' => 201 , 'message' => 'Something went wrong !'];
            }   
        }
        return response()->json(['message'=>$validator->errors()->all(),'status_code'=>301]);
    }
//===========================>Lead Source Create Code End=================================>


//============================>Lead Stetus Edit Code Start=================================>
    public function edit($id)
    {
        $lead = LeadSource::find($id);
        return ['status_code' => 200 , 'data' => $lead];
    }
//============================>Lead Stetus Edit Code End=================================>

//===========================>Lead Stetus Update Code Start=================================>
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'title'=>'required',
            'type'=>'required',
           
        ]);
//=========================> Store Update Lead Source Detials Into db =========================>
        if($validator->passes()) {
            $data['title'] = $request->title;
            $data['type'] = $request->type;
            $data['updated_by'] = Auth::user($request->color)->id;
            $data['slug'] = Str::slug($request->title);
            $response = LeadSource::where('id',$request->id)->update($data);
            if($response){
                return ['status_code' => 200 , 'message' => 'Lead Stetus Updated Success !'];
            }else{
                return ['status_code' => 201 , 'message' => 'Something went wrong !'];
            }   
        }
        return response()->json(['message'=>$validator->errors()->all(),'status_code'=>301]);
    }
//===========================>Lead Stetus Update Code End=================================>
//============================>Lead Stetus Delete Code Start====================================>

    public function delete($id){   

        $response = LeadSource::where('id',$id)->delete();

        if($response){
            return response()->json(['status_code' => 200 , 'message' => 'Successfully Deleted !']);
        }
        else{
            return response()->json(['status_code' => 201 , 'message' => 'Delete Failed !']);
        }
    }
//============================>Lead Stetus Delete Code End====================================>

}
