<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Validator;
use App\Models\TaskLabel;
use Auth;

class TaskLabelController extends Controller
{
//=============================>Task Label Create Code Start===================================>
    public function create(Request $request)
    {
         $validator = Validator::make($request->all(),[
            'client_id'=>'required',
            'title'=>'required',
            'color'=>'required',
        ]);
//=========================> Store Create Task Label Detials Into db =========================>
        if($validator->passes()) {
            $data['created_by'] = Auth::user()->id;
            $data['client_id'] = $request->client_id;
            $data['title'] = $request->title;
            $data['color'] = $request->color;
            $data['slug'] = Str::slug($request->title);
            $response = TaskLabel::create($data);
            if($response){
                return ['status_code' => 200 , 'message' => 'Lead Label Created Success !'];
            }else{
                return ['status_code' => 201 , 'message' => 'Something went wrong !'];
            }   
        }
        return response()->json(['message'=>$validator->errors()->all(),'status_code'=>301]);
    }
//=============================>Task Label Create Code End===================================>


//============================>Task label Edit Code Start========================================>
    public function edit($id)
    {
        $lead = TaskLabel::find($id);
        return ['status_code' => 200 , 'data' => $lead];
    }
//============================>Task label Edit Code End========================================>

//============================>Task label Update Code Start=====================================>
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'client_id'=>'required',
            'title'=>'required',
            'color'=>'required',
           
        ]);
//=========================> Store Update Task Label Detials Into db =========================>
        if($validator->passes()) {
            $data['client_id'] = $request->client_id;
            $data['title'] = $request->title;
            $data['color'] = $request->color;
            $data['updated_by'] = Auth::user($request->updated_by)->id;
            $data['slug'] = Str::slug($request->title);
            $response = TaskLabel::where('id',$request->id)->update($data);
            if($response){
                return ['status_code' => 200 , 'message' => 'Lead Stetus Updated Success !'];
            }else{
                return ['status_code' => 201 , 'message' => 'Something went wrong !'];
            }   
        }
        return response()->json(['message'=>$validator->errors()->all(),'status_code'=>301]);
    }
//============================>Task label Update Code End=====================================>

//=============================>Task label Delete Code Start================================>
    public function delete($id){   

        $response = TaskLabel::where('id',$id)->delete();

        if($response){
            return response()->json(['status_code' => 200 , 'message' => 'Successfully Deleted !']);
        }
        else{
            return response()->json(['status_code' => 201 , 'message' => 'Delete Failed !']);
        }
    }
//=============================>Task label Delete Code End================================>
}
