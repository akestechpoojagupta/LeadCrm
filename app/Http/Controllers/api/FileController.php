<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\File;
use Auth;

class FileController extends Controller
{
//==============================> File Uploaded Code Start ===================================>

    public function store(Request $request)
    {
    if(!$request->hasFile('fileName')) {
        return response()->json(['upload_file_not_found'], 400);
    }

//==============================> Allowed Extension ====================================>
    $allowedfileExtension=['pdf','jpg','png','docx','gif','rar','txt','zip'];
    $files = $request->file('fileName'); 
    foreach ($files as $file) {      
        $extension = $file->getClientOriginalExtension();
        $check = in_array($extension,$allowedfileExtension);
        if($check) {
            foreach($request->fileName as $mediaFiles) {
                $file_path = $mediaFiles->store('public/images');
                $file_name = $mediaFiles->getClientOriginalName();

//=============================> Store Image file Into Directory And db =========================>
                $save = new File();
                $save->client_id = $request->client_id;
                $save->file_name = $file_name;
                $save->file_path = $file_path;
                $save->save();
            }
        } else {
            return response()->json(['invalid_file_format'], 422);
        }
 
        return response()->json(['file_uploaded'], 200);
 
    }
}
//==============================>File Uploaded Code End=========================================>

}
