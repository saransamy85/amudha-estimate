<?php

use App\Http\Controllers\Purchase\PurchaseDashboardController;
use App\Http\Controllers\Purchase\PurchaseOrderController;
use App\Http\Controllers\Purchase\VendorController;
use App\Http\Controllers\Reception\dashboardcontroller;
use App\Http\Controllers\Reception\MaterialItemController;
use App\Http\Controllers\Reception\MaterialReturnController;
use App\Http\Controllers\Reception\ReceptionReportController;
use App\Http\Controllers\admincontroller;
use App\Http\Controllers\customercontroller;
use App\Http\Controllers\estimatecontroller;
use App\Http\Controllers\greetingcontroller;
use App\Http\Controllers\LeadActivitycontroller;
use App\Http\Controllers\pocontroller;
use App\Http\Controllers\reportcontroller;
use App\Http\Controllers\salescontroller;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return redirect()->route('estimates.index');
// });

// purchase//

// end purchase//
Route::get('/purchase/dashboard', [pocontroller::class, 'podashboard'])->name('podash');
Route::get('/purchase/PO', [pocontroller::class, 'poviews'])->name('poview');
// Sales//
Route::get('/sales', [salescontroller::class, 'salesdash'])->name('salesdashboard');
Route::get('/sales-customer', [salescontroller::class, 'salescus'])->name('salescustomer');
Route::get('/sales-estimate', [salescontroller::class, 'addestimate'])->name('addestimate');
Route::get('/sales-lead', [salescontroller::class, 'leaddash'])->name('leaddash');
Route::post('/sales-New-lead', [salescontroller::class, 'addlead'])->name('addlead');
Route::post('/sales-lead-feedback', [salescontroller::class, 'addfeedback'])->name('addfeedback');
Route::get('/sales-greetings', [salescontroller::class, 'salesgreetings'])->name('salesgreetings');

// Route::get('/customers',[admincontroller::class,'cus'])->name('customers');

Route::get('/dashboard/customers', [customercontroller::class, 'clients'])->name('customers');
Route::Post('/dashboard/customers', [customercontroller::class, 'clientstore'])->name('addcustomers');

Route::get('/estimates', [estimatecontroller::class, 'index'])->name('dashboard');

Route::get('estimates/{id}/pdf', [estimatecontroller::class, 'pdf'])
    ->name('estimates.pdf');

Route::resource('estimates', estimatecontroller::class);

/* ---Admin----- */
Route::get('/reg', [admincontroller::class, 'registration'])->name('reg');
Route::post('/reg', [admincontroller::class, 'regsubmission'])->name('reg1');
Route::get('/', [admincontroller::class, 'login'])->name('login');
Route::post('/', [admincontroller::class, 'logins'])->name('logins');
Route::get('/logout', [admincontroller::class, 'logout'])->name('logout');
Route::get('/dashboard', [admincontroller::class, 'dashboard'])->name('dashboard1');
Route::get('/admin-lead', [admincontroller::class, 'adminlead'])->name('adminlead');
Route::get('/admin-customer', [admincontroller::class, 'admincus'])->name('admincustomer');
Route::get('/admin-reports', [reportcontroller::class, 'adminreport'])->name('adminreport');
Route::put('/customer/status/{id}', [customercontroller::class, 'updateStatus'])->name('customerstatusupdate');
Route::get('/admin/po-orders', [admincontroller::class, 'po_orders'])->name('admin.po_orders');

/* ---Greeting mail--- */
Route::post('/greeting', [greetingcontroller::class, 'sendGreeting'])->name('greetings');
Route::get('/greeting', [greetingcontroller::class, 'sendmail'])->name('mail');

Route::get('/admin/leadactivity', [LeadActivitycontroller::class, 'create'])->name('leadactivity');
Route::post('/admin/leadactivity', [LeadActivitycontroller::class, 'store'])->name('activitystore');

Route::get('/daily-report-pdf', [admincontroller::class, 'dailyReportPdf'])->name('dailyreport');
Route::get('/weekly-report-pdf', [admincontroller::class, 'weeklyReportPdf'])->name('weeklyreport');
Route::get('/reports/custom', [reportcontroller::class, 'customReportForm'])->name('monthlyreport');
Route::post('/reports/custom', [reportcontroller::class, 'customReportPdf'])->name('customreport.pdf');

/* ---Receptionist---- */
Route::get('/reception-dashboard', [dashboardcontroller::class, 'index'])->name('receptiondashboard');
Route::get('/reception-sites', [dashboardcontroller::class, 'sites'])->name('receptionsites');
Route::get('/reception-materialitems', [MaterialItemController::class, 'index'])->name('receptionmaterialitems');
Route::post('/addmaterialitems', [MaterialItemController::class, 'store'])->name('addmaterialitems');
Route::get('/site-timeline/{id}', [dashboardcontroller::class, 'siteTimeline'])->name('sitetimeline');
Route::get('/reception/reports', [ReceptionReportController::class, 'dashboard'])->name('reception.reports');
/* return */
Route::get('/material-return', [MaterialReturnController::class, 'index'])->name('materialreturn');

Route::get('/material-return/items/{customer}', [MaterialReturnController::class, 'getDispatchItems'])->name('materialreturn.items');
Route::post('/material-return/store', [MaterialReturnController::class, 'store'])->name('materialreturn.store');
Route::get('/material-return/history', [dashboardcontroller::class, 'history'])->name('materialreturn.history');
Route::get('/material-return/view/{id}', [dashboardcontroller::class, 'returnview'])->name('materialreturn.view');

Route::prefix('purchase')->group(function () {
    Route::get('/dashboard', [PurchaseDashboardController::class, 'index'])->name('purchasedashboard');

    Route::get('/vendors', [VendorController::class, 'index'])->name('vendors');

    Route::post('/vendors/store', [VendorController::class, 'store'])->name('vendor.store');

    Route::post('/vendors/update/{id}', [VendorController::class, 'update'])->name('vendor.update');

    Route::get('/vendors/delete/{id}', [VendorController::class, 'destroy'])->name('vendor.delete');

    Route::get('/purchase-orders', [PurchaseOrderController::class, 'index'])->name('purchase.index');

    Route::get('/purchase-order/create', [PurchaseOrderController::class, 'create'])->name('purchase.create');

    Route::post('/purchase-order/store', [PurchaseOrderController::class, 'store'])->name('purchase.store');

    Route::get('/purchase-orders/view/{id}', [PurchaseOrderController::class, 'view'])->name('purchase.view');

    Route::get('/purchase-orders/edit/{id}', [PurchaseOrderController::class, 'edit'])->name('purchase.edit');

    Route::post('/purchase-orders/update/{id}', [PurchaseOrderController::class, 'update'])->name('purchase.update');

    Route::delete('/purchase/delete/{id}', [PurchaseOrderController::class, 'destroy'])->name('purchase.delete');
});
Route::get('/purchase/template/{template}', [PurchaseOrderController::class, 'loadTemplate']);
Route::get('/purchase/pdf/{id}', [PurchaseOrderController::class, 'pdf'])->name('purchase.pdf');
