<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Validator;
use App\Models\LeadStatus;
use Auth;

class LeadStatusController extends Controller
{
//==========================>Lead Stetus Create Code Start======================================>
    public function create(Request $request)
    {
         $validator = Validator::make($request->all(),[
            'title'=>'required',
            'type'=>'required',
            'color'=>'required',
        ]);
//=============================> Store Create Lead Source Detials Into db =========================>
        if($validator->passes()) {
            $data['created_by'] = Auth::user()->id;
            $data['title'] =  $request->title;
            $data['type'] =  $request->type;
            $data['color'] =  $request->color;
            $data['slug'] = Str::slug($request->title);
            $response = LeadStatus::create($data);
            if($response){
                return ['status_code' => 200 , 'message' => 'Lead Stetus Created Success !'];
            }else{
                return ['status_code' => 201 , 'message' => 'Something went wrong !'];
            }   
        }
        return response()->json(['message'=>$validator->errors()->all(),'status_code'=>301]);
    }

//===============================>Lead Stetus Edit Code Start==================================>
    public function edit($id)
    {
        $lead = LeadStatus::find($id);
        return ['status_code' => 200 , 'data' => $lead];
    }
//=============================>Lead Stetus Update Code Start===================================>
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'title'=>'required',
            'type'=>'required',
            'color'=>'required',
        ]);
    //=============================> Store Update Lead Source Detials Into db =========================>
        if($validator->passes()) {
            $data['title'] = $request->title;
            $data['type'] = $request->type;
            $data['color'] = $request->color;
            $data['updated_by'] = Auth::user($request->color)->id;
            $data['slug'] = Str::slug($request->title);
            $response = LeadStatus::where('id',$request->id)->update($data);
            if($response){
                return ['status_code' => 200 , 'message' => 'Lead Stetus Updated Success !'];
            }else{
                return ['status_code' => 201 , 'message' => 'Something went wrong !'];
            }   
        }
        return response()->json(['message'=>$validator->errors()->all(),'status_code'=>301]);
    }
//=============================>Lead Stetus Update Code End===================================>

//=============================>Lead Stetus Delete Code Start================================>
    public function delete($id){   

        $response = LeadStatus::where('id',$id)->delete();

        if($response){
            return response()->json(['status_code' => 200 , 'message' => 'Successfully Deleted !']);
        }
        else{
            return response()->json(['status_code' => 201 , 'message' => 'Delete Failed !']);
        }
    }
//=============================>Lead Stetus Delete Code End================================>

//==============================>Lead Stetus Show All Data Code Start=============================>
    public function showAll()
    {
        $client = LeadStatus::all();
        return ['status_code' => 200 , 'data' => $client];
    }
//==============================>Lead Stetus Show All Data Code End=============================>


}
