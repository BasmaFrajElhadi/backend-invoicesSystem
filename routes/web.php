<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\invoicesReport;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CustomersReport;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\InvoicesController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\PermissionsController;
use App\Http\Controllers\InvoiceArchiveController;
use App\Http\Controllers\InvoicesDetailsController;
use App\Http\Controllers\InvoicesAttachmentsController;

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
Auth::routes(['register'=>false]);

Route::get('/', function () {
    return view('auth.login');
});

Route::group(['middleware' => ['auth']], function() {
    /**
     * Logout Routes
     */
    Route::get('/logout', 'LogoutController@perform')->name('logout.perform');
    /**
     * User Routes
     */
    Route::resource('user', UserController::class);
    Route::resource('roles', RolesController::class);
    Route::resource('permissions', PermissionsController::class);
});
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/MarkAsRead_all', [InvoicesController::class, 'markAsRead_all'])->name('MarkAsRead_all');
Route::get('/showNotification/{id}', [InvoicesController::class, 'showNotification'])->name('showNotification');
Route::resource('invoices', InvoicesController::class);
Route::resource('sections', SectionController::class);
Route::resource('products', ProductsController::class);
Route::resource('invoiceArchive', InvoiceArchiveController::class);
Route::get('InvoicesReport' , [invoicesReport::class,'index']);
Route::get('customersReport' , [CustomersReport::class,'index']);
Route::post('search_invoices' , [invoicesReport::class,'search_invoices']);
Route::post('search_customers' , [CustomersReport::class,'search_customers']);
Route::get('statusShow/{id}',[InvoicesDetailsController::class,'statusShow']);
Route::post('statusUpdate',[InvoicesDetailsController::class,'statusUpdate']);
Route::delete('invoicesArchive',[InvoicesController::class,'invoicesArchive']);
Route::get('invoicesPaid',[InvoicesController::class,'invoicesPaid']);
Route::get('invoicesUnpaid',[InvoicesController::class,'invoicesUnpaid']);
Route::get('invoicesPartialPaid',[InvoicesController::class,'invoicesPartialPaid']);
Route::get('section/{id}',[InvoicesController::class,'getProducts']);
Route::get('InvoicesDetails/{id}',[InvoicesController::class,'showDetails']);
Route::get('Print_invoice/{id}',[InvoicesController::class,'Print_invoice']);
Route::get('/{page}',[AdminController::class, 'index']);
Route::get('download/{invoice_number}/{file_name}', [InvoicesDetailsController::class,'get_file']);
Route::get('View_file/{invoice_number}/{file_name}', [InvoicesDetailsController::class ,'open_file']);
Route::post('delete_file', [InvoicesDetailsController::class,'destroy'])->name('delete_file');
Route::resource('InvoiceAttachments',InvoicesAttachmentsController::class);

