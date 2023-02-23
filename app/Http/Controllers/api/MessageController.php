<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\{Message,File};
use Auth;

class MessageController extends Controller
{
//===========================>Create Message Code Start======================================>

    public function create(Request $request)
    {
         $validator = Validator::make($request->all(),[
            'client_id'=>'required',
            'message'=>'required',
            'description'=>'required',
        ]);
        if($validator->passes()) {
            if($request->hasFile('file')){
                $files = $request->file('file'); 
                foreach ($files as $file) {      
                    $path = $file->store('uploads');
                    $file_name = $file->getClientOriginalName();
                    $file_path = url('uploads',[$file_name]);
                    $save = new File();
                    $save->client_id = $request->client_id;
                    $save->file_name = $file_name;
                    $save->file_path = $file_path;
                    $save->save();
                }
            }
//=============================> Store Create Message Detials Into db =========================>
            $data['client_id'] = $request->client_id;
            $data['created_by'] = Auth::user()->id;
            $data['message'] = $request->message;
            $data['description'] = $request->description;
            $response = Message::create($data);
            if($response){
                return ['status_code' => 200 , 'message' => 'Message Created Success !'];
            }else{
                return ['status_code' => 201 , 'message' => 'Something went wrong !'];
            }   
        }
        return response()->json(['message'=>$validator->errors()->all(),'status_code'=>301]);
    }
//===========================>Create Message Code End======================================>

//===========================>Edit Message Code Start======================================>
    public function edit($id)
    {
        $response = Message::find($id);
        return ['status_code' => 200 , 'data' => $response];
    }
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'client_id'=>'required',
            'message'=>'required',
            'description'=>'required',
            
        ]);
//=============================> Store Update  Message Detials Into db =========================>
        if($validator->passes()) {
            $data = array(
                'client_id' => $request->client_id , 
                'message' => $request->message, 
                'description' => $request->description, 
                'updated_by' => Auth::user()->id
            );
            $response = Message::where('id',$request->id)->update($data);
            if($response){
                return ['status_code' => 200 , 'message' => 'Messages Updated Success !'];
            }else{
                return ['status_code' => 201 , 'message' => 'Something went wrong !'];
            }   
        }
        return response()->json(['message'=>$validator->errors()->all(),'status_code'=>301]);
    }
//===========================>Edit Message Code End======================================>

//===========================>Delete Message Code Start======================================>
    public function delete($id){   

        $response = Message::where('id',$id)->delete();

        if($response){
            return response()->json(['status_code' => 200 , 'message' => 'Successfully Deleted !']);
        }
        else{
            return response()->json(['status_code' => 201 , 'message' => 'Delete Failed !']);
        }
    }
//===========================>Delete Message Code Start======================================>

//===========================>Show All Message Code Start======================================>

    public function showAll($id)
    {
        $message = Message::where('client_id', $id)->get();
        return response()->json(['status_code' => 200 , 'data' => $message]);
    }
//===========================>Show All Message Code End======================================>
    

}
