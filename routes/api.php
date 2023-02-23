<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\api\ClientController;
use App\Http\Controllers\api\MessageController;
use App\Http\Controllers\api\FileController;
use App\Http\Controllers\api\SettingController;
use App\Http\Controllers\api\LeadStatusController;
use App\Http\Controllers\api\LeadSourceController;
use App\Http\Controllers\api\TemplateController;
use App\Http\Controllers\api\LeadLabelController;
use App\Http\Controllers\api\TaskStatusController;
use App\Http\Controllers\api\TaskLabelController;
use App\Http\Controllers\api\PageController;
use App\Http\Controllers\api\ManageProductController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
//========================>Start Clients Controller ====================================> 
    Route::middleware('auth:api')->group(function(){
    Route::post('client/create',[ClientController::class,'create']);
    Route::get('client/edit/{id}',[ClientController::class,'edit']);
    Route::post('client/update',[ClientController::class,'update']);
    Route::delete('client/delete/{id}', [ClientController::class,'delete']);
    Route::get('client/all', [ClientController::class,'showAll']);
//========================>End Clients Controller ====================================>

//========================>Start Message Controller ====================================>
    Route::post('message/create',[MessageController::class,'create']);
    Route::get('message/edit/{id}',[MessageController::class,'edit']);
    Route::post('message/update',[MessageController::class,'update']);
    Route::delete('message/delete/{id}',[MessageController::class,'delete']);
    Route::get('message/all/{id}', [MessageController::class,'showAll']);
//========================>End Message Controller ====================================>

//========================>Start File Controller ====================================>
    Route::post('file/store', [FileController::class, 'store']);
    Route::post('setting/create', [SettingController::class, 'create']);
    Route::get('setting/get_meta_detail', [SettingController::class, 'getMetaDetails']);
//========================>End File Controller ====================================>

//========================>Start Lead Status Controller ====================================>
    Route::post('leadstatus/create', [LeadStatusController::class, 'create']);
    Route::get('leadstatus/edit/{id}',[LeadStatusController::class,'edit']);
    Route::post('leadstatus/update',[LeadStatusController::class,'update']);
    Route::delete('leadstatus/delete/{id}',[LeadStatusController::class,'delete']);

//========================>End Lead Status Controller ====================================>

//========================>Start Lead Source Controller ====================================>
    Route::post('leadsource/create', [LeadSourceController::class, 'create']);
    Route::get('leadsource/edit/{id}',[LeadSourceController::class,'edit']);
    Route::post('leadsource/update',[LeadSourceController::class,'update']);
    Route::delete('leadsource/delete/{id}', [LeadSourceController::class,'delete']);
//========================>End Lead Source Controller ====================================>

//========================>Start Template Controller ====================================>
    Route::post('template/create', [TemplateController::class, 'create']);
    Route::get('template/get_details', [TemplateController::class, 'getTemplateDetails']);
    Route::delete('template/delete', [TemplateController::class, 'deleteTemplateDetails']);
//========================>End Template Controller ====================================>

//========================>Start Lead Label Controller ====================================>
    Route::post('leadlabel/create', [LeadLabelController::class, 'create']);
    Route::get('leadlabel/edit/{id}',[LeadLabelController::class,'edit']);
    Route::post('leadlabel/update',[LeadLabelController::class,'update']);
    Route::delete('leadlabel/delete/{id}', [LeadLabelController::class,'delete']);
//========================>End Lead Label Controller ====================================>

//========================>Start Task Status Controller ====================================>
    Route::post('taskstatus/create', [TaskStatusController::class, 'create']);
    Route::get('taskstatus/edit/{id}',[TaskStatusController::class,'edit']);
    Route::post('taskstatus/update',[TaskStatusController::class,'update']);
    Route::delete('taskstatus/delete/{id}', [TaskStatusController::class,'delete']);
    //========================>End Task Status Controller ====================================>

//========================>Start Task Label Controller ====================================>
    Route::post('tasklabel/create', [TaskLabelController::class, 'create']);
    Route::get('tasklabel/edit/{id}',[TaskLabelController::class,'edit']);
    Route::post('tasklabel/update',[TaskLabelController::class,'update']);
    Route::delete('tasklabel/delete/{id}', [TaskLabelController::class,'delete']);
//========================>End Task Label Controller ====================================>

//========================>Start Page Controller ====================================>
    Route::post('page/create', [PageController::class, 'create']);
    Route::get('page/edit/{id}',[PageController::class,'edit']);
    Route::post('page/update',[PageController::class,'update']);
    Route::delete('page/delete/{id}', [PageController::class,'delete']);
//=========================>End Page Controller ====================================>

});

//========================>Start Login Controller ====================================>
Route::post('/login',[LoginController::class,'login']);
//========================>End Login Controller ====================================>

//========================>Start Page Controller ====================================>
Route::post('product/create', [ManageProductController::class, 'create']);

//=========================>End Page Controller ====================================>