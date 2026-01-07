<?php

use App\Http\Controllers\estimatecontroller;
use App\Http\Controllers\admincontroller;
use App\Http\Controllers\customercontroller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\salescontroller;
use App\Http\Controllers\reportcontroller;


// Route::get('/', function () {
//     return redirect()->route('estimates.index');
// });



//Sales//
Route::get('/sales',[salescontroller::class,'salesdash'])->name('salesdashboard');
Route::get('/sales-customer',[salescontroller::class,'salescus'])->name('salescustomer');
Route::get('/sales-estimate',[salescontroller::class,'addestimate'])->name('addestimate');
Route::get('/sales-lead',[salescontroller::class,'leaddash'])->name('leaddash');
Route::post('/sales-New-lead',[salescontroller::class,'addlead'])->name('addlead');
Route::post('/sales-lead-feedback',[salescontroller::class,'addfeedback'])->name('addfeedback');


// Route::get('/customers',[admincontroller::class,'cus'])->name('customers');


Route::get('/dashboard/customers',[customercontroller::class,'clients'])->name('customers');
Route::Post('/dashboard/customers',[customercontroller::class,'clientstore'])->name('addcustomers');

Route::get('/estimates',[estimatecontroller::class,'index'])->name('dashboard');

Route::get('estimates/{id}/pdf', [estimatecontroller::class, 'pdf'])
    ->name('estimates.pdf');

Route::resource('estimates', estimatecontroller::class);

/*---Admin-----*/
Route::get('/reg',[admincontroller::class,'registration'])->name('reg');
Route::post('/reg',[admincontroller::class,'regsubmission'])->name('reg1');
Route::get('/',[admincontroller::class,'login'])->name('login');
Route::post('/',[admincontroller::class,'logins'])->name('logins');
Route::get('/logout',[admincontroller::class,'logout'])->name('logout');
Route::get('/dashboard',[admincontroller::class,'dashboard'])->name('dashboard1');
Route::get('/admin-lead',[admincontroller::class,'adminlead'])->name('adminlead');
Route::get('/admin-customer',[admincontroller::class,'admincus'])->name('admincustomer');
Route::get('/admin-reports',[reportcontroller::class,'adminreport'])->name('adminreport');


