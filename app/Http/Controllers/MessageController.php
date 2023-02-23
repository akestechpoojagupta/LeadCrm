<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Models\Message;

class MessageController extends Controller
{
//===========================>Create Message Code Start========================================>

    public function create(Request $request)
    {
         $validator = Validator::make($request->all(),[
            'client_id'=>'required',
            'message'=>'required',
            'description'=>'required',
        ]);
//=========================> Store create Message Detials Into db =========================>
        if($validator->passes()) {
            $data['created_by'] = Auth::user()->id;
            $data = array(
                'client_id' => $request->client_id , 
                'message' => $request->message, 
                'description' => $request->description,  
            );
            $response = Message::create($data);
            if($response){
                return ['status_code' => 200 , 'message' => 'Client Created Success !'];
            }else{
                return ['status_code' => 201 , 'message' => 'Something went wrong !'];
            }   
        }
        return response()->json(['message'=>$validator->errors()->all(),'status_code'=>301]);
    }
//===========================>Create Message Code End========================================>

//==============================>Edit Message Code Start======================================>
public function edit($id)
{
    $lead = Message::find($id);
    return ['status_code' => 200 , 'data' => $lead];
}
//==============================>Edit Message Code End======================================>

//===============================>Message Update Code Start==================================>
public function update(Request $request)
{
    $validator = Validator::make($request->all(),[
        'client_id'=>'required',
        'title'=>'required',
        'color'=>'required',
       
    ]);
//=========================> Store Update Message Detials Into db =========================>
    if($validator->passes()) {
        $data['client_id'] = $request->client_id;
        $data['message'] = $request->message;
        $data['description'] = $request->description;
        $data['updated_by'] = Auth::user($request->updated_by)->id;
        $response = Message::where('id',$request->id)->update($data);
        if($response){
            return ['status_code' => 200 , 'message' => 'Lead Stetus Updated Success !'];
        }else{
            return ['status_code' => 201 , 'message' => 'Something went wrong !'];
        }   
    }
    return response()->json(['message'=>$validator->errors()->all(),'status_code'=>301]);
}
//===============================>Update Message Code End==================================>

//=================================>Delete Message Code Start=================================>
public function delete($id){   

    $response = Message::where('id',$id)->delete();

    if($response){
        return response()->json(['status_code' => 200 , 'message' => 'Successfully Deleted !']);
    }
    else{
        return response()->json(['status_code' => 201 , 'message' => 'Delete Failed !']);
    }
}
//=================================>Delete Message Code End=================================>

}
