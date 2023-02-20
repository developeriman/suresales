<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\TemplateController;


use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\GenerateCodeController;
Route::get('hash',function(){
     echo Hash::make(12345);
});
Route::get('/cache-clear', function () {
    Artisan::call('optimize:clear');
    Artisan::call('config:cache');
    Artisan::call('cache:clear');
    Artisan::call('view:clear');
    Artisan::call('route:clear');
    Artisan::call('config:clear');
    return 'Cache is cleared';
});

Route::get('/download-page',function(){
    return view('download'); 
});

Route::get('test',function(){

    return view('admin.generatecode.test'); 
});

//----- Admin Routes -----//

Route::group(['prefix' => 'admin'], function(){
    Route::get('/pass',[LoginController::class,'pass']);
    Route::get('/login',[LoginController::class,'adminLoginIndex']);
    Route::post('/login-submit',[LoginController::class,'adminLogin']);
    Route::get('/logout',[LoginController::class,'adminLogout']);
    Route::group(['middleware' => ['admin_auth']],function(){
        Route::get('/dashboard',[DashboardController::class, 'index']);
          Route::get('/template',[TemplateController::class, 'index']);
          Route::get('/generate-code',[GenerateCodeController::class, 'index']);
          Route::post('/templatesave',[TemplateController::class, 'store']);
          Route::post('/generatecode',[GenerateCodeController::class, 'store']);

    });
   
});