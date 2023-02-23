<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\Template;
use Auth;

class TemplateController extends Controller
{
//==========================>Create Template Code Start======================================>
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'client_id'=>'required',
            'meta_key'=>'required',
        ]);
//=========================> Store create And Update Lead Label Detials Into db =========================>
        if($validator->passes()) {
            $all_data = $request->all();
            unset($all_data['client_id']);
            unset($all_data['meta_key']);
            unset($all_data['attachment']);
            if($request->hasFile('attachment')){
                $file = $request->file('attachment'); 
                $path = $file->store('uploads');
                $file_name = $file->getClientOriginalName();
                $file_path = url('uploads',[$file_name]);
                $all_data['uploads'] = 'uploads/'.$file_name;
                $all_data['file_url'] = $file_path;
            }
            $data['created_by'] = Auth::user()->id;
            $data['client_id'] = $request->client_id;
            $data['meta_key'] = $request->meta_key;
            $data['meta_description'] = json_encode($all_data);
            $data['updated_by'] = Auth::user($request->updated_by)->id;
            $response_data = Template::where(["meta_key"=>$request->meta_key,"client_id"=>$request->client_id])->first();
//==========================>Update Template Code Start======================================>
            if($response_data){
                $response = Template::where("meta_key",$request->meta_key)->update($data);
                $msg = 'Tamplate Updated Success !';
            }else{
                $response = Template::create($data);
                $msg = 'Tamplate Created Success !';
            }
            if($response){
                return ['status_code' => 200 , 'message' => $msg];
            }else{
                return ['status_code' => 201 , 'message' => 'Something went wrong !'];
            }   
        }
        return response()->json(['message'=>$validator->errors()->all(),'status_code'=>301]);
    }
//==========================>Create And Update Template Code End======================================>
    public function getTemplateDetails(Request $request)
    {
        $data = Template::where(["meta_key"=>$request->meta_key,"client_id"=>$request->client_id])->first();
        if($data){
            return ['status_code' => 200 , 'data' => $data, 'message' => "Record found !"];
        }else{
            return ['status_code' => 201 , 'data' => $data, 'message' => 'Record not found !'];
        }
    }
//==========================>Delete Template Code Start======================================>
    public function deleteTemplateDetails(Request $request)
    {
        $data = Template::where(["meta_key"=>$request->meta_key,"client_id"=>$request->client_id])->delete();
        if($data){
            return ['status_code' => 200 , 'message' => "Tamplate Deleted !"];
        }else{
            return ['status_code' => 201 , 'message' => 'Something went wrong !'];
        }
    }
//==========================>Delete Template Code End======================================>
}
