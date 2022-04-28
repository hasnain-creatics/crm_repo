<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\UserController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::fallback(function () {

    return redirect('admin/home');

});

Route::get('/', function () {
    return redirect('login');
});

Auth::routes();


Route::group(['prefix'=>'admin','middleware'=>'auth'],function(){
    
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::group(['prefix'=>'roles'],function(){

        Route::get('/', [RolesController::class,'index']);

        Route::get('/get_roles',[RolesController::class,'get_roles'])->name('get_roles');

        Route::get('/get_single_role/{id}',[RolesController::class,'show']);
        
        Route::get('/add',[RolesController::class,'create'])->name('role.add');
        
        Route::get('/edit/{id}',[RolesController::class,'edit']);
        
        Route::post('/update',[RolesController::class,'update']);    
    
    });

    Route::group(['prefix'=>'roles/permissions'],function(){

        Route::get('/{id}',[RolesController::class,'role_permissions'])->name('roles.permission');

        Route::get('/get_role_permissions/{id}',[RolesController::class,'get_role_permissions']);

        Route::post('/update_permission',[RolesController::class,'update_permmission']);
        
    });

    Route::group(['prefix'=>'user'],function(){

        Route::get('/',[UserController::class,'index'])->name('user.index');

        Route::get('/get_users',[UserController::class,'get_users']);

        Route::get('/add',[UserController::class,'create'])->name('user.add');
        
        Route::get('/add/{id}',[UserController::class,'edit'])->name('user.edit');

        Route::post('/update',[UserController::class,'update'])->name('user.update');

        Route::get('/fetch_designation',[UserController::class,'fetch_all_designation'])->name('fetch_all_designation');

        Route::get('/fetch_cities',[UserController::class,'fetch_cities'])->name('fetch_cities');

        Route::get('/fetch_managers/{id}',[UserController::class,'fetch_managers']);

        Route::get('/delete/{id}',[UserController::class,'destroy'])->name('user.delete');
        

    });

});
// Route::view('/roles', [RolesController::class, 'index']);
