<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\BasicReportApiController;
use App\Http\Controllers\InterfaceSapPoApiController;
use App\Http\Controllers\InterfaceSapRecApiController;
use App\Http\Controllers\InterfaceSapInvApiController;
use App\Http\Controllers\EmfgShippingLogOkApiController;
use App\Http\Controllers\EmfgShippingLogNgApiController;
use App\Http\Controllers\EmfgShippingLogEventApiController;
use App\Http\Controllers\EmfgShippingStatusApiController;
use App\Http\Controllers\EpsBgCheckingApiController;
use App\Http\Controllers\EpsReportBudgetCheckingPrDetailApiController;
use App\Http\Controllers\EpsReportBudgetCheckingExpenseDetailApiController;
use App\Http\Controllers\EpsReportBudgetCheckingInvestmentDetailApiController;
use App\Http\Controllers\EpsPrOutstandingApiController;
use App\Http\Controllers\EpsPrPoToPlannerApiController;
use App\Http\Controllers\EpsPrErrorApiController;
use App\Http\Controllers\EpsPrProductionErrorApiController;
use App\Http\Controllers\EpsCpApprovePrApiController;
use App\Http\Controllers\EmfgInventoryStockOutErrorApiController;
use App\Http\Controllers\EdrawingCheckPasswordApiController;
use App\Http\Controllers\EmfgAtacShoppingLogApiController;
//==================================================================================================================
//                                                     Maintain
//==================================================================================================================
use App\Http\Controllers\IbgAddDeptApiController;
use App\Http\Controllers\IbgAddUserApiController;
use App\Http\Controllers\IbgUpdateInfScheduleApiController;
use App\Http\Controllers\EpsAddInvestmentApiController;
use App\Http\Controllers\EmfgAddModelApiController ;
use App\Http\Controllers\EmfgAddShelfApiController;
use App\Http\Controllers\EmfgSaAddShelfApiController;
use App\Http\Controllers\IfinRevertDocApiController;
use App\Http\Controllers\IfinRegisterAdminApiController;
use App\Http\Controllers\EmfgRevertShoppingStatusApiController;
use App\Http\Controllers\EmfgCompletePKLApiController;
use App\Http\Controllers\EmfgCreatePalletDataFromShoppingApiController;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\NavGroupController;


//==================================================================================================================
//                                                     Permission Master
//==================================================================================================================
use App\Http\Controllers\NavigationGroupController;
use App\Http\Controllers\NavigationItemController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\UserPermissionController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
// External
use App\Http\Controllers\ExternalURLController;
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

/*
|--------------------------------------------------------------------------
|    Protected routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function(){
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/profile/edit',[ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/update',[ProfileController::class, 'update'])->name('profile.update');
    Route::get('/password/change',[ChangePasswordController::class, 'create'])->name('password.change');
    Route::post('/password/store',[ChangePasswordController::class, 'store'])->name('password.store');

    /*
    /-----------------------------------------------------------------------------
    // Navigation Group
    /-----------------------------------------------------------------------------
    */
    Route::get('/navigationgroups',[NavigationGroupController::class,'index'])->name('Navigation-Group');
    Route::prefix('navigationgroups')->name('navigationgroups')->group(function(){
        // Route::get('/',[NavigationGroupController::class,'index'])->name('.index');
        Route::get('create',[NavigationGroupController::class,'create'])->name('.create');
        Route::post('/',[NavigationGroupController::class,'store'])->name('.store');
        Route::get('edit/{navigationGroup}',[NavigationGroupController::class,'edit'])->name('.edit');
        Route::put('update/{navigationGroup}',[NavigationGroupController::class,'update'])->name('.update');
        Route::delete('destroy/{navigationGroup}',[NavigationGroupController::class,'destroy'])->name('.destroy');
        // Route::post('/action',[NavigationGroupController::class,'action'])->name('.action');
    });
    /*
    /-----------------------------------------------------------------------------
    // Navigation Item
    /-----------------------------------------------------------------------------
    */
    Route::get('/navigationitems',[NavigationItemController::class,'index'])->name('Navigation-Item');
    Route::prefix('navigationitems')->name('navigationitems')->group(function(){
        Route::get('create',[NavigationItemController::class,'create'])->name('.create');
        Route::post('/',[NavigationItemController::class,'store'])->name('.store');
        Route::get('edit/{navigationItem}',[NavigationItemController::class,'edit'])->name('.edit');
        Route::put('update/{navigationItem}',[NavigationItemController::class,'update'])->name('.update');
        Route::delete('destroy/{navigationItem}',[NavigationItemController::class,'destroy'])->name('.destroy');
    });
    /*
    /-----------------------------------------------------------------------------
    // Permisson
    /-----------------------------------------------------------------------------
    */
    Route::get('/permissions',[PermissionController::class,'index'])->name('Permission');
    Route::prefix('permissions')->name('permissions')->group(function(){
        Route::get('create',[PermissionController::class,'create'])->name('.create');
        Route::post('/',[PermissionController::class,'store'])->name('.store');
        Route::get('edit/{permission}',[PermissionController::class,'edit'])->name('.edit');
        Route::put('update/{permission}',[PermissionController::class,'update'])->name('.update');
        Route::delete('destroy/{permission}',[PermissionController::class,'destroy'])->name('.destroy');
    });
    /*
    /-----------------------------------------------------------------------------
    // User Permission
    /-----------------------------------------------------------------------------
    */
    Route::get('/userpermissions',[UserPermissionController::class,'index'])->name('User-Permission');
    Route::prefix('userpermissions')->name('userpermissions')->group(function(){
        Route::get('create',[UserPermissionController::class,'create'])->name('.create');
        Route::post('/',[UserPermissionController::class,'store'])->name('.store');
        Route::get('edit/{userPermission}',[UserPermissionController::class,'edit'])->name('.edit');
        Route::put('update/{userPermission}',[UserPermissionController::class,'update'])->name('.update');
        Route::delete('destroy/{userPermission}',[UserPermissionController::class,'destroy'])->name('.destroy');
    });
    /*
    /-----------------------------------------------------------------------------
    // Authorization
    /-----------------------------------------------------------------------------
    */
    Route::get('/showauthorize',[UserPermissionController::class,'showauthorize'])->name('Authorization');
    Route::get('insert/showauthorize',[UserPermissionController::class,'insertpermission'])->name('Authorization.insertpermission');
    Route::get('delete/showauthorize',[UserPermissionController::class,'deletepermission'])->name('Authorization.deletepermission');
    Route::post('/updateauthorize',[UserPermissionController::class,'updateauthorize'])->name('Authorization.update');


});

require __DIR__.'/auth.php';

/*
|--------------------------------------------------------------------------
|    Public routes
|--------------------------------------------------------------------------
*/
Route::get('/showatgn',[ExternalURLController::class,'showatgn'])->name('ATGN');
Route::get('/showzabbix',[ExternalURLController::class,'showzabbix'])->name('Zabbix');
Route::get('/showsolarwinds',[ExternalURLController::class,'showsolarwinds'])->name('Solarwinds');
Route::get('/shownagios',[ExternalURLController::class,'shownagios'])->name('Nagios');
//##################################################################################################################
//#                                                    Report                                                      #
//##################################################################################################################
// ==========================================================================
// ROUTE GET/POST "BASIC-REPORT-API"
// ==========================================================================
Route::view('basic-report-api','basic-report-api');
Route::post('basic-report-api',[BasicReportApiController::class,'getData']);

//<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<< SAP >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
// ==========================================================================
// ROUTE GET/POST "BASIC-REPORT-API"
// ==========================================================================
Route::get("interface-sap-po", function(){ return view("interface-sap-po");})->name("PO-Interface");
Route::post('interface-sap-po',[InterfaceSapPoApiController::class,'getData']);

// ==========================================================================
// ROUTE GET/POST "BASIC-REPORT-API"
// ==========================================================================
// Route::view('interface-sap-rec','interface-sap-rec');
Route::get("interface-sap-rec", function(){ return view("interface-sap-rec");})->name("RC-Interface");
Route::post('interface-sap-rec',[InterfaceSapRecApiController::class,'getData']);

// ==========================================================================
// ROUTE GET/POST "BASIC-REPORT-API"
// ==========================================================================
// Route::view('interface-sap-inv','interface-sap-inv');
Route::get("interface-sap-inv", function(){ return view("interface-sap-inv");})->name("INV-Interface");
Route::post('interface-sap-inv',[InterfaceSapInvApiController::class,'getData']);


//<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<< E-MFG >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
// ==========================================================================
// ROUTE GET/POST "BASIC-REPORT-API"
// ==========================================================================
// Route::view('emfg-shipping-log-ok','emfg-shipping-log-ok');
Route::get("emfg-shipping-log-ok", function(){ return view("emfg-shipping-log-ok");})->name("Shipping-OK-SA");
Route::post('emfg-shipping-log-ok',[EmfgShippingLogOkApiController::class,'getData']);

// Route::view('emfg-shipping-log-ng','emfg-shipping-log-ng');
Route::get("emfg-shipping-log-ng", function(){ return view("emfg-shipping-log-ng");})->name("Shipping-NG-SA");
Route::post('emfg-shipping-log-ng',[EmfgShippingLogNgApiController::class,'getData']);

// Route::view('emfg-shipping-log-event','emfg-shipping-log-event');
Route::get("emfg-shipping-log-event", function(){ return view("emfg-shipping-log-even");})->name("Shipping-Event-Log-SA");
Route::post('emfg-shipping-log-event',[EmfgShippingLogEventApiController::class,'getData']);

// Route::view('emfg-shipping-status','emfg-shipping-status');
Route::get("emfg-shipping-status", function(){ return view("emfg-shipping-status");})->name("Shipping-Status-SA");
Route::post('emfg-shipping-status',[EmfgShippingStatusApiController::class,'getData']);

// Route::view('emfg-inventory-stock-out-error','emfg-inventory-stock-out-error');
Route::get("emfg-inventory-stock-out-error", function(){ return view("emfg-inventory-stock-out-error");})->name("Stock-Out-Error-SA");
Route::post('emfg-inventory-stock-out-error',[EmfgInventoryStockOutErrorApiController::class,'getData']);

// Route::view('wiss-atac-emfg-shopping-log','wiss-atac-emfg-shopping-log');
Route::get("wiss-atac-emfg-shopping-log", function(){ return view("wiss-atac-emfg-shopping-log");})->name("Shopping-Log-ATAC");
Route::post('wiss-atac-emfg-shopping-log',[EmfgAtacShoppingLogApiController::class,'getData']);

//<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<< EPS >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
// ==========================================================================
// ROUTE GET/POST "BASIC-REPORT-API"
// ==========================================================================
// Route::view('eps-pr-outstanding','eps-pr-outstanding');
Route::get("eps-pr-outstanding", function(){ return view("eps-pr-outstanding");})->name("PR-Outstanding");
Route::post('eps-pr-outstanding',[EpsPrOutstandingApiController::class,'getData']);

// Route::view('eps-pr-po-planner','eps-pr-po-planner');
Route::get("eps-pr-po-planner", function(){ return view("eps-pr-po-planner");})->name("PR-PO-Planner");
Route::post('eps-pr-po-planner',[EpsPrPoToPlannerApiController::class,'getData']);

// Route::view('eps-bg-checking','eps-bg-checking');
Route::get("eps-bg-checking", function(){ return view("eps-bg-checking");})->name("BG-Checking");
Route::post('eps-bg-checking',[EpsBgCheckingApiController::class,'getData']);

Route::get('wiss-sa-eps-report-budget-checking-pr-detail',[EpsReportBudgetCheckingPrDetailApiController::class,'getData']);
Route::get('wiss_sa_eps_report_budget_checking_expense',[EpsReportBudgetCheckingExpenseDetailApiController::class,'getData']);
Route::get('wiss_sa_eps_report_budget_checking_investment',[EpsReportBudgetCheckingInvestmentDetailApiController::class,'getData']);

// Route::view('eps-pr-error','eps-pr-error');
Route::get("eps-pr-error", function(){ return view("eps-pr-error");})->name("PR-Error");
Route::post('eps-pr-error',[EpsPrErrorApiController::class,'getData']);

// Route::view('eps-pr-production-error','eps-pr-production-error');
Route::get("eps-pr-production-error", function(){ return view("eps-pr-production-error");})->name("PR-Production-Error");
Route::post('eps-pr-production-error',[EpsPrProductionErrorApiController::class,'getData']);

// Route::view('eps-cp-approve-pr','eps-cp-approve-pr');
Route::get("eps-cp-approve-pr", function(){ return view("eps-cp-approve-pr");})->name("CP-Approve-PR");
Route::post('eps-cp-approve-pr',[EpsCpApprovePrApiController::class,'getData']);

//<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<< E-Drawing >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
// ==========================================================================
// ROUTE GET/POST "BASIC-REPORT-API"
// ==========================================================================
// Route::view('edrawing-check-password','edrawing-check-password');
Route::get("edrawing-check-password", function(){ return view("edrawing-check-password");})->name("Password");
Route::post('edrawing-check-password',[EdrawingCheckPasswordApiController::class,'getData']);



//##################################################################################################################
//#                                           Maintain Program                                                     #
//##################################################################################################################
// ==========================================================================
// ROUTE GET/POST "FIX-POROGRAM-API"
// ==========================================================================
//<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<< I-BG >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
// Route::view('wiss-sa-add-ibg-dept','wiss-sa-add-ibg-dept');
Route::get("wiss-sa-add-ibg-dept", function(){ return view("wiss-sa-add-ibg-dept");})->name("Add-Department");
Route::post('wiss-sa-add-ibg-dept',[IbgAddDeptApiController::class,'getData']);

// Route::view('wiss-sa-add-ibg-user','wiss-sa-add-ibg-user');
Route::get("wiss-sa-add-ibg-user", function(){ return view("wiss-sa-add-ibg-user");})->name("Add-User");
Route::post('wiss-sa-add-ibg-user',[IbgAddUserApiController::class,'getData']);

// Route::view('wiss-sa-ibg-update-inf-schedule','wiss-sa-ibg-update-inf-schedule');
Route::get("wiss-sa-ibg-update-inf-schedule", function(){ return view("wiss-sa-ibg-update-inf-schedule");})->name("Add-IF-Schedule");
Route::post('wiss-sa-ibg-update-inf-schedule',[IbgUpdateInfScheduleApiController::class,'getData']);

//<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<< EPS >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
// Route::view('wiss-sa-add-eps-investment','wiss-sa-add-eps-investment');
Route::get("wiss-sa-add-eps-investment", function(){ return view("wiss-sa-add-eps-investment");})->name("Add-Investment");
Route::post('wiss-sa-add-eps-investment',[EpsAddInvestmentApiController::class,'getData']);

//<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<< ATAC EMFG >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
// Route::view('wiss-atac-emfg-add-model','wiss-atac-emfg-add-model');
Route::get("wiss-atac-emfg-add-model", function(){ return view("wiss-atac-emfg-add-model");})->name("Add-Model-ATAC");
Route::post('wiss-atac-emfg-add-model',[EmfgAddModelApiController::class,'getData']);

// Route::view('wiss-atac-emfg-add-shelf','wiss-atac-emfg-add-shelf');
Route::get("wiss-atac-emfg-add-shelf", function(){ return view("wiss-atac-emfg-add-shelf");})->name("Add-Shelf-ATAC");
Route::post('wiss-atac-emfg-add-shelf',[EmfgAddShelfApiController::class,'getData']);

// Route::view('wiss-atac-emfg-revert-shopping-status','wiss-atac-emfg-revert-shopping-status');
Route::get("wiss-atac-emfg-revert-shopping-status", function(){ return view("wiss-atac-emfg-revert-shopping-status");})->name("Revert-Shopping-ATAC");
Route::post('wiss-atac-emfg-revert-shopping-status',[EmfgRevertShoppingStatusApiController::class,'getData']);

// Route::view('wiss-atac-emfg-complete-pkl','wiss-atac-emfg-complete-pkl');
Route::get("wiss-atac-emfg-complete-pkl", function(){ return view("wiss-atac-emfg-complete-pkl");})->name("Complete-PKL-ATAC");
Route::post('wiss-atac-emfg-complete-pkl',[EmfgCompletePKLApiController::class,'getData']);

// Route::view('wiss-atac-emfg-create-pallet-data-from-shopping','wiss-atac-emfg-create-pallet-data-from-shopping');
Route::get("wiss-atac-emfg-create-pallet-data-from-shopping", function(){ return view("wiss-atac-emfg-create-pallet-data-from-shopping");})->name("Complete-Pallet-ATAC");
Route::post('wiss-atac-emfg-create-pallet-data-from-shopping',[EmfgCreatePalletDataFromShoppingApiController::class,'getData']);

//<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<< SA EMFG >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
// Route::view('wiss-sa-emfg-add-shelf','wiss-sa-emfg-add-shelf');
Route::get("wiss-sa-emfg-add-shelf", function(){ return view("wiss-sa-emfg-add-shelf");})->name("Add-Shelf-SA");
Route::post('wiss-sa-emfg-add-shelf',[EmfgSaAddShelfApiController::class,'getData']);

//<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<< I-FIN >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
// Route::view('wiss-sa-ifin-revert-doc','wiss-sa-ifin-revert-doc');
Route::get("wiss-sa-ifin-revert-doc", function(){ return view("wiss-sa-ifin-revert-doc");})->name("Revert-Doc");
Route::post('wiss-sa-ifin-revert-doc',[IfinRevertDocApiController::class,'getData']);

// Route::view('wiss-sa-ifin-register-admin','wiss-sa-ifin-register-admin');
Route::get("wiss-sa-ifin-register-admin", function(){ return view("wiss-sa-ifin-register-admin");})->name("Register-Admin");
Route::post('wiss-sa-ifin-register-admin',[IfinRegisterAdminApiController::class,'getData']);

// ==========================================================================
// ROUTE GET/POST "MAIN"
// ==========================================================================
Route::view('main','main');
Route::post('main',[MainController::class,'getData']);



// ==========================================================================
// ROUTE VIEW
// ==========================================================================
Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/menu', function () {
    return view('menu');
});
// ==========================================================================
// ROUTE VIEW DASHBOARD
// ==========================================================================
Route::get('/', function () {
    return view('index');
});
// Add index 11/06/2022
Route::get('/index', function () {
    return view('index');
});
Route::get('/index', function () {
    return view('index');
})->name('index');

Route::get('/demo', function () {
    return view('demo');
});

Route::get('/basic-report', function () {
    return view('basic-report');
});

Route::get('/basic-report-api', function () {
    return view('basic-report-api');
});

Route::get('/deploy-code', function () {
    return view('deploy-code');
});


// ==========================================================================
// TEST ROUTE VIEW DASHBOARD
// ==========================================================================
// Route::get('/userpermissions', function () {
//     return view('userpermissions');
// });
