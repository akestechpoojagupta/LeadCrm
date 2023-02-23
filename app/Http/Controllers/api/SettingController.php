<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\Setting;
use Auth;
class SettingController extends Controller
{
//=============================>Create Websetting Code Start==================================>
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'client_id'=>'required',
            'meta_key'=>'required',
        ]);
//=============================> Store Create And Update Page Label Detials Into db =========================>
        if($validator->passes()) {
            $all_data = $request->all();
            unset($all_data['client_id']);
            unset($all_data['meta_key']);
            unset($all_data['company_logo']);
            if($request->hasFile('company_logo')){
                $image = $request->file('company_logo'); 
                $path = $image->store('logo');
                $image_name = $image->getClientOriginalName();
                $image_path = url('logo',[$image_name]);
                $all_data['logo'] = 'logo/'.$image_name;
                $all_data['logo_url'] = $image_path;
            }
            $data['created_by'] = Auth::user()->id;
            $data['client_id'] = $request->client_id;
            $data['meta_key'] = $request->meta_key;
            $data['meta_description'] = json_encode($all_data);
            $data['updated_by'] = Auth::user($request->color)->id;
            $response_data = Setting::where(["meta_key"=>$request->meta_key,"client_id"=>$request->client_id])->first();
//=============================>Update Websetting Code ==================================>
            if($response_data){
                $response = Setting::where("meta_key",$request->meta_key)->update($data);
                $msg = 'Setting Updated Success !';
            }else{
                $response = Setting::create($data);
                $msg = 'Setting Created Success !';
            }
            if($response){
                return ['status_code' => 200 , 'message' => $msg];
            }else{
                return ['status_code' => 201 , 'message' => 'Something went wrong !'];
            }   
        }
        return response()->json(['message'=>$validator->errors()->all(),'status_code'=>301]);
    }
//=============================>Create And Update Websetting Code End==================================>

    public function getMetaDetails(Request $request)
    {
        $data = Setting::where(["meta_key"=>$request->meta_key,"client_id"=>$request->client_id])->first();
        if($data){
            return ['status_code' => 200 , 'data' => $data, 'message' => "Record found !"];
        }else{
            return ['status_code' => 201 , 'data' => $data, 'message' => 'Record not found !'];
        }
    }
//=============================>Delete Websetting Code Start==================================>
    public function deleteMetaDetails(Request $request)
    {
        $data = Setting::where(["meta_key"=>$request->meta_key,"client_id"=>$request->client_id])->delete();
        if($data){
            return ['status_code' => 200 , 'message' => "Setting Deleted !"];
        }else{
            return ['status_code' => 201 , 'message' => 'Something went wrong !'];
        }
    }
//=============================>Create Websetting Code End==================================>
}
