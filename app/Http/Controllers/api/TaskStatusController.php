<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Validator;
use App\Models\TaskStatus;
use Auth;

class TaskStatusController extends Controller
{
//==============================>Lead Label Create Code Start===================================>
    public function create(Request $request)
    {
         $validator = Validator::make($request->all(),[
            'client_id'=>'required',
            'title'=>'required',
            'color'=>'required',
        ]);
//=========================> Store create Lead Label Detials Into db =========================>
        if($validator->passes()) {
            $data['created_by'] = Auth::user()->id;
            $data['client_id'] = $request->client_id;
            $data['title'] = $request->title;
            $data['color'] = $request->color;
            $data['slug'] = Str::slug($request->title);
            $response = TaskStatus::create($data);
            if($response){
                return ['status_code' => 200 , 'message' => 'Lead Label Created Success !'];
            }else{
                return ['status_code' => 201 , 'message' => 'Something went wrong !'];
            }   
        }
        return response()->json(['message'=>$validator->errors()->all(),'status_code'=>301]);
    }
//==============================>Lead Label Create Code End===================================>


//==============================>Lead label Edit Code Start======================================>
    public function edit($id)
    {
        $lead = TaskStatus::find($id);
        return ['status_code' => 200 , 'data' => $lead];
    }
//==============================>Lead label Edit Code End======================================>

//===============================>Lead label Update Code Start==================================>
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'client_id'=>'required',
            'title'=>'required',
            'color'=>'required',
           
        ]);
//=========================> Store Update Lead Label Detials Into db =========================>
        if($validator->passes()) {
            $data['client_id'] = $request->client_id;
            $data['title'] = $request->title;
            $data['color'] = $request->color;
            $data['slug'] = Str::slug($request->title);
            $data['updated_by'] = Auth::user($request->updated_by)->id;
            $response = TaskStatus::where('id',$request->id)->update($data);
            if($response){
                return ['status_code' => 200 , 'message' => 'Lead Stetus Updated Success !'];
            }else{
                return ['status_code' => 201 , 'message' => 'Something went wrong !'];
            }   
        }
        return response()->json(['message'=>$validator->errors()->all(),'status_code'=>301]);
    }
//===============================>Lead label Update Code End==================================>


//=================================>Lead label Delete Code Start=================================>
    public function delete($id){   

        $response = TaskStatus::where('id',$id)->delete();

        if($response){
            return response()->json(['status_code' => 200 , 'message' => 'Successfully Deleted !']);
        }
        else{
            return response()->json(['status_code' => 201 , 'message' => 'Delete Failed !']);
        }
    }
//=================================>Lead label Delete Code End=================================>
}
