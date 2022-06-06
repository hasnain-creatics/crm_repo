<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\LeadsController;
use App\Http\Controllers\IssueController;
use App\Http\Controllers\SubjectsController;
use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\WebsiteController;
use App\Http\Controllers\WriterController;
use App\Http\Controllers\NoticeBoardController;
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
    
    Route::get('/dashboard/countes', [App\Http\Controllers\HomeController::class, 'writer_dashboard_counters'])->name('dashboard.counts');
    
    Route::get('/dashboard/writer_urgent_tasks', [App\Http\Controllers\HomeController::class, 'writer_urgent_tasks'])->name('dashboard.writer_urgent_tasks');
    
    Route::get('/dashboard/inprogress_task', [App\Http\Controllers\HomeController::class, 'inprogress_task'])->name('dashboard.inprogress_task');

    Route::get('/dashboard/unassigned_task', [App\Http\Controllers\HomeController::class, 'writer_unassigned_tasks'])->name('dashboard.unassigned_task');

    Route::get('/dashboard/new_task', [App\Http\Controllers\HomeController::class, 'writer_new_tasks'])->name('dashboard.new_task');

    Route::get('/dashboard/qa_required_task', [App\Http\Controllers\HomeController::class, 'qa_required_task'])->name('dashboard.qa_required_task');

    Route::get('/dashboard/writer_feedback_tasks', [App\Http\Controllers\HomeController::class, 'writer_feedback_tasks'])->name('dashboard.writer_feedback_tasks');

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

        Route::get('/get_all_users',[UserController::class,'get_all_users']);
        
        Route::post('/check_email_exists',[UserController::class,'check_email_exists'])->name('check_email_exists');

        Route::get('/add',[UserController::class,'create'])->name('user.add');
        
        Route::get('/add/{id}',[UserController::class,'edit'])->name('user.edit');

        Route::post('/update',[UserController::class,'update'])->name('user.update');

        Route::get('/fetch_designation',[UserController::class,'fetch_all_designation'])->name('fetch_all_designation');

        Route::get('/fetch_cities',[UserController::class,'fetch_cities'])->name('fetch_cities');

        Route::get('/fetch_managers/{id}',[UserController::class,'fetch_managers']);
        
        Route::get('/fetch_leads/{id}',[UserController::class,'fetch_leads']);

        Route::get('/delete/{id}',[UserController::class,'destroy'])->name('user.delete');
        
        Route::get('/status_update/{id}',[UserController::class,'status_update']);

        Route::get('/show/{id}',[UserController::class,'show']);

        Route::get('/profile',[UserController::class,'profile']);
        
        Route::post('/profile_update}',[UserController::class,'profile_update'])->name('user.profile_update');

    });

    Route::group(['prefix'=>'orders'],function(){

        Route::get('/',[OrdersController::class,'index'])->name('orders.home');

        Route::get('/add',[OrdersController::class,'create'])->name('orders.add');

        Route::get('/add/{id}',[OrdersController::class,'edit'])->name('orders.edit');

        Route::get('/lead/{id}',[OrdersController::class,'order_lead'])->name('orders.lead.edit');
            
        Route::get('/delete/{id}',[OrdersController::class,'destroy'])->name('orders.delete');

        Route::get('/fetch_order/{id}',[OrdersController::class,'fetch_order'])->name('orders.fetch_order');
        
        Route::get('/order_timline/{id}',[OrdersController::class,'order_timline'])->name('orders.order_timline');

        Route::post('/insert',[OrdersController::class,'store']);

        Route::post('/change_order_status/{id}',[OrdersController::class,'change_order_status']);

        Route::get('/add_feedback/{id}',[OrdersController::class,'add_feedback'])->name('orders.add_feedback');

        Route::post('/add_feedback',[OrdersController::class,'store_feedback'])->name('orders.store_feedback');
    });

    Route::group(['prefix'=>'delivery'],function(){

        Route::get('/',[OrdersController::class,'delivery'])->name('delivery.index');

    });


    Route::group(['prefix'=>'leads'],function(){

        Route::get('/',[LeadsController::class,'index'])->name('leads.home');

        Route::get('/add',[LeadsController::class,'create'])->name('leads.add');

        Route::get('/view/{id}',[LeadsController::class,'show'])->name('leads.view');

        Route::post('/insert',[LeadsController::class,'store']);

        Route::get('/add/{id}',[LeadsController::class,'edit'])->name('leads.edit');

        Route::get('/delete/{id}',[LeadsController::class,'destroy'])->name('leads.delete');

        Route::get('/fetch_lead/{id}',[LeadsController::class,'fetch_lead'])->name('leads.fetch_lead');
        
        Route::get('/all_docs/{id}',[LeadsController::class,'all_docs'])->name('leads.all_docs');
        
        Route::group(['prefix'=>'docs'],function(){

            Route::get('/delete/{id}',[LeadsController::class,'delete_docs'])->name('leads.docs.delete');
    
        });
        
        Route::get('/lead_transfers/{id}',[LeadsController::class,'lead_transfers']);

        Route::post('/lead_transfers',[LeadsController::class,'lead_transfer_update']);

        Route::get('/lead_transfers_details/{id}',[LeadsController::class,'lead_transfers_details']);

        Route::get('/convert_lead/{id}',[LeadsController::class,'convert_lead']);

    });

    Route::group(['prefix'=>'issue'],function(){

        Route::get('/',[IssueController::class,'index'])->name('issue.home');

        Route::get('/add',[IssueController::class,'create'])->name('issue.add');

        Route::post('/add',[IssueController::class,'store'])->name('issue.create');

        Route::get('/add/{id}',[IssueController::class,'edit'])->name('issue.edit');

        Route::get('/delete/{id}',[IssueController::class,'destroy'])->name('issue.delete');

        Route::get('/issues',[IssueController::class,'get_all_issues'])->name('issue.get_all_issues');

        Route::get('/fetch_issue/{id}',[IssueController::class,'get_issue'])->name('issue.get_issue');

    });

    

    Route::group(['prefix'=>'subjects'],function(){

        Route::get('/',[SubjectsController::class,'index'])->name('subjects.home');

        Route::get('/add',[SubjectsController::class,'create'])->name('subjects.add');

        Route::post('/add',[SubjectsController::class,'store'])->name('subjects.create');

        Route::get('/add/{id}',[SubjectsController::class,'edit'])->name('subjects.edit');

        Route::get('/delete/{id}',[SubjectsController::class,'destroy'])->name('subjects.delete');

        Route::get('/get_all_subjects',[SubjectsController::class,'get_all_subjects'])->name('subjects.get_all_subjects');

        Route::get('/get_subject/{id}',[SubjectsController::class,'get_subject'])->name('subjects.get_issue');

    });

    

    Route::group(['prefix'=>'currency'],function(){

        Route::get('/',[CurrencyController::class,'index'])->name('currency.home');

        Route::get('/add',[CurrencyController::class,'create'])->name('currency.add');

        Route::post('/add',[CurrencyController::class,'store'])->name('currency.create');

        Route::get('/add/{id}',[CurrencyController::class,'edit'])->name('currency.edit');

        Route::get('/delete/{id}',[CurrencyController::class,'destroy'])->name('currency.delete');

        Route::get('/get_all_subjects',[CurrencyController::class,'get_all_subjects'])->name('currency.get_all_subjects');

        Route::get('/get_subject/{id}',[CurrencyController::class,'get_subject'])->name('currency.get_issue');

        Route::get('/sync',[CurrencyController::class,'sync'])->name('currency.sync');

    });



    Route::group(['prefix'=>'websites'],function(){

        Route::get('/',[WebsiteController::class,'index'])->name('website.index');

        Route::get('/add',[WebsiteController::class,'create'])->name('website.add');

        Route::post('/add',[WebsiteController::class,'store'])->name('website.create');

        Route::get('/add/{id}',[WebsiteController::class,'edit'])->name('website.edit');

        Route::get('/delete/{id}',[WebsiteController::class,'destroy'])->name('website.delete');

        Route::get('/get_single_website/{id}',[WebsiteController::class,'get_single_website'])->name('website.get_single_website');

        Route::get('/get_website',[WebsiteController::class,'get_website'])->name('website.get_website');

        Route::get('/get_active_website',[WebsiteController::class,'get_active_website'])->name('website.get_active_website');
      
    });



    Route::group(['prefix'=>'noticeboard'],function(){

        Route::get('/',[NoticeBoardController::class,'index'])->name('noticeboard.index');
        Route::get('/add',[NoticeBoardController::class,'create'])->name('noticeboard.add');
        Route::get('/add/{id}',[NoticeBoardController::class,'edit'])->name('noticeboard.edit');
        Route::post('/update',[NoticeBoardController::class,'update'])->name('noticeboard.update');
       
        Route::get('/get_users_notice/{id}',[NoticeBoardController::class,'get_users_notice'])->name('noticeboard.get_users_notice');
       

       
    });

    Route::group(['prefix'=>'writers'],function(){

        Route::get('/',[WriterController::class,'index'])->name('writers.index');
        
        Route::get('/writers_assiged_lists/{id}',[WriterController::class,'writers_assiged_lists'])->name('writers.writers_assiged_lists');

        Route::post('/change_status/{id}',[WriterController::class,'change_status'])->name('writers.change_status');

        Route::post('/check_user_assignments/{id}',[WriterController::class,'check_user_assignments'])->name('writers.check_user_assignments');

        Route::post('/assigned_user/{id}',[WriterController::class,'assigned_user'])->name('writers.change_status');
      
        Route::get('/task_details/{id}',[WriterController::class,'task_details'])->name('writers.task_details');
        
        Route::get('/fetch_order/{id}',[WriterController::class,'fetch_order'])->name('writers.fetch_order');
        
        Route::get('/fetch_all_writers',[WriterController::class,'fetch_all_writers'])->name('writers.fetch_all_writers');
        
        Route::post('/task_update/{id}',[WriterController::class,'task_update'])->name('writers.task_update');

        Route::post('/user_task_details_update/{id}',[WriterController::class,'user_task_details_update'])->name('writers.user_task_details_update');
   
        Route::post('/delete_assigned_user',[WriterController::class,'delete_assigned_user'])->name('writers.delete_assigned_user');

        Route::post('/submit_ratings',[WriterController::class,'submit_ratings'])->name('writers.submit_ratings');
        
     });


});
// Route::view('/roles', [RolesController::class, 'index']);
