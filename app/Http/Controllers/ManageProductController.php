<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use\App\Models\Product;

class ManageProductController extends Controller
{
   //==========================>Manage Product Create Code Start======================================>
   public function create(Request $request)
   {
        $validator = Validator::make($request->all(),[
           'product_name'=>'required',
           'short_description'=>'required',
           'long_description'=>'required',
           'hero_image'=>'required',
           'other_images'=>'required',
           'category'=>'required',
           'brand'=>'required',
           'mrp'=>'required',
           'sale_price'=>'required',
       ]);
//=============================> Store Create Manage Product Detials Into db =========================>
if($validator->passes()) {
    if($request->hasFile('hero_image')){
        $image = $request->file('hero_image'); 
        $path = $image->store('uploads');
        $image_name = $image->getClientOriginalName();
        $image_path = url('uploads',[$image_name]);
        $data['hero_image'] = 'uploads/'.$image_name;
       
    }
    if($request->hasFile('other_images')){
        $image = $request->file('other_images'); 
        $path = $image->store('uploads');
        $image_name = $image->getClientOriginalName();
        $image_path = url('uploads',[$image_name]);
        $data['other_images'] = 'uploads/'.$image_name;
       
    }
    $data['created_by'] = Auth::user()->id;
    $data['product_name'] =  $request->product_name;
    $data['short_description'] =  $request->short_description;
    $data['color'] =  $request->color;
    $data['product_slug'] = Str::product_slug($request->product_name);
    $response = LeadStatus::create($data);
    if($response){
        return ['status_code' => 200 , 'message' => 'Lead Stetus Created Success !'];
    }else{
        return ['status_code' => 201 , 'message' => 'Something went wrong !'];
    }   
}
return response()->json(['message'=>$validator->errors()->all(),'status_code'=>301]);
}

//===============================>Manage Product Edit Code Start==================================>
}
