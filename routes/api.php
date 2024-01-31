<?php

use App\Http\Controllers\ArticlesController;
use App\Http\Controllers\AudioController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FileController;

use App\Http\Controllers\ElderController;
use App\Http\Controllers\ImageCategoriesController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


// PDF file Controller
Route::controller(FileController::class)->prefix('/books/')->group(function () {
// get all data Books
    Route::get('Get',  'Get');
 // file upload
    Route::post('upload', 'store')->name('file.upload');
 // get elder -> Book
    Route::get('get_data_id/{id}',  'Get_dataId');
 // Edit Book And Update
    Route::get('edit_data_id/{id}/edit',  'Edit_Book');
    Route::post('update_data_id/{id}',  'Update_Book');

});

// elder Controller
Route::controller(ElderController::class)->prefix('/elders/')->group(function () {
    // this all data from database
    Route::get('get', 'Get');
    // get data use just id
    Route::get('Get_data_elder_id/{id}', 'Id_Data_elder');

    // this create data with database
    Route::post('insert',  'store');
    // this get id Book -> details Elder
    Route::get('getid_Elder_All_Books/{id}', 'Get_id');
    // get audio relation -> elder  all => Id
    Route::get('get_Audio_Relation_Elder/{id}', 'Get_Audio_Id_Elder');

    // Edit ELDER And Update
    Route::post('/update_elder/{id}',  'Update_Elder');
    Route::get('/editelder/{id}/edit',  'Edit_Elder');
    Route::get('get_Articles/{id}',  'get_Articles');

});

// Audio Controller
Route::controller(AudioController::class)->prefix('/Audio/')->group(function () {
// get all audio from DB
Route::get('get_audio','Get_audio');
// this create data with database
Route::post('insert_audio', 'store_Audio');
// this get id Audio -> details Elder
Route::get('getid_Audio/{id}','Get_id');
// edit and update Audio
Route::get('Edit/{id}','edit');
// update-
Route::post('Update_Audio/{id}' , 'update_Audio');
});





Route::controller(ImageCategoriesController::class)->prefix('/Images-Categories/')->group(function(){
    Route::post('Insert','Store');
    Route::post('Update','Update');
    Route::post('Delete','Delete');
    Route::Get('Get','Get');
    Route::Get('Get_id_relation/{id}','Get_data_from_Images');

});


Route::controller(ImageController::class)->prefix('/Images/')->group(function(){
    Route::post('Insert','Store');
    Route::post('Update','Update');
    Route::post('Delete','Delete');
    Route::Get('Get','Get');
});


Route::controller(ArticlesController::class)->prefix('/Articles/')->group(function(){
    Route::post('Insert','Store');
    Route::post('Update/{id}','Update');
    Route::Get('Get_dataId/{id}','Get_dataId');
    Route::Get('Get','Get');
});
