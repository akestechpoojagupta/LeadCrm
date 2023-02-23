<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\Client;
use Auth;

class ClientController extends Controller
{
//=================>Create Client Code Start<==================================
    public function create(Request $request)
    {
         $validator = Validator::make($request->all(),[
            'client_name'=>'required',
            'company_name'=>'required',
            'mobile_number'=>'required|numeric|digits:10|regex:/[6-9]{1}[0-9]{9}/',
            'whatsapp_number'=>'required|numeric|digits:10|regex:/[6-9]{1}[0-9]{9}/',
            'email'=>'required|email|max:255|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix',
            'enquiry'=>'required',
        ]);
//=============================> Store Create Client Detials Into db =========================>
        if($validator->passes()) {
            $data['created_by'] = Auth::user()->id;
            $data['client_name'] = $request->client_name;
            $data['company_name'] = $request->company_name;
            $data['mobile_number'] = $request->mobile_number;
            $data['whatsapp_number'] = $request->whatsapp_number;
            $data['email'] = $request->email;
            $data['enquiry'] = $request->enquiry;
            $response = Client::create($data);
            if($response){
                return ['status_code' => 200 , 'message' => 'Client Created Success !'];
            }else{
                return ['status_code' => 201 , 'message' => 'Something went wrong !'];
            }   
        }
        return response()->json(['message'=>$validator->errors()->all(),'status_code'=>301]);
    }
//===========================>Create Client Code End=================================>

//===========================>Edit Client Code Start=================================>

    public function edit($id)
    {
        $client = Client::find($id);
        return ['status_code' => 200 , 'data' => $client];
    }
//===========================>Edit Client Code End===================================>

//===========================>Update Client Code Start===============================>

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'client_name'=>'required',
            'company_name'=>'required',
            'mobile_number'=>'required|numeric|digits:10|regex:/[6-9]{1}[0-9]{9}/',
            'whatsapp_number'=>'required|numeric|digits:10|regex:/[6-9]{1}[0-9]{9}/',
            'email'=>'required|email|max:255|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix',
            'enquiry'=>'required',
        ]);
//=============================> Store Update Client Detials Into db =========================>
        if($validator->passes()) {
            $data['client_name'] = $request->client_name;
            $data['company_name'] = $request->company_name;
            $data['mobile_number'] = $request->mobile_number;
            $data['whatsapp_number'] = $request->whatsapp_number;
            $data['email'] = $request->email;
            $data['enquiry'] = $request->enquiry;
            $data['updated_by'] = Auth::user()->id;
            $response = Client::where('id',$request->id)->update($data);
            if($response){
                return ['status_code' => 200 , 'message' => 'Client Updated Success !'];
            }else{
                return ['status_code' => 201 , 'message' => 'Something went wrong !'];
            }   
        }
        return response()->json(['message'=>$validator->errors()->all(),'status_code'=>301]);
    }
//==========================>Update Client Code End==========================================>
    

//===========================>Delete Client Code Start=======================================>
    public function delete($id){   

        $response = Client::where('id',$id)->delete();

        if($response){
            return response()->json(['status_code' => 200 , 'message' => 'Successfully Deleted !']);
        }
        else{
            return response()->json(['status_code' => 201 , 'message' => 'Delete Failed !']);
        }
    }
//============================>Delete Client Code End=========================================>

//============================>Show All Client Code Start=====================================>
    public function showAll()
    {
        $client = Client::all();
        return ['status_code' => 200 , 'data' => $client];
    }
//============================>Show All Client Code End=======================================>
}
 

