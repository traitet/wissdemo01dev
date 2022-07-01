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
    Route::prefix('navigationgroups')->name('navigationgroups')->group(function(){
        Route::get('/',[NavigationGroupController::class,'index'])->name('.index');
        Route::get('show/{navigationGroup}',[NavigationGroupController::class,'show'])->name('.show');
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
    Route::prefix('navigationitems')->name('navigationitems')->group(function(){
        Route::get('/',[NavigationItemController::class,'index'])->name('.index');
        Route::get('show/{navigationItem}',[NavigationItemController::class,'show'])->name('.show');
        Route::get('create',[NavigationItemController::class,'create'])->name('.create');
        Route::post('/',[NavigationItemController::class,'store'])->name('.store');
        Route::get('edit/{navigationItem}',[NavigationItemController::class,'edit'])->name('.edit');
        Route::put('update/{navigationItem}',[NavigationItemController::class,'update'])->name('.update');
        Route::delete('destroy/{navigationItem}',[NavigationItemController::class,'destroy'])->name('.destroy');
        // Route::post('/action',[NavigationItemController::class,'action'])->name('.action');
    });
    /*
    /-----------------------------------------------------------------------------
    // Permisson
    /-----------------------------------------------------------------------------
    */
    Route::prefix('permissions')->name('permissions')->group(function(){
        Route::get('/',[PermissionController::class,'index'])->name('.index');
        Route::get('show/{permission}',[PermissionController::class,'show'])->name('.show');
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
    Route::prefix('userpermissions')->name('userpermissions')->group(function(){
        Route::get('/',[UserPermissionController::class,'index'])->name('.index');
        Route::get('show/{userPermission}',[UserPermissionController::class,'show'])->name('.show');
        Route::get('create',[UserPermissionController::class,'create'])->name('.create');
        Route::post('/',[UserPermissionController::class,'store'])->name('.store');
        Route::get('edit/{userPermission}',[UserPermissionController::class,'edit'])->name('.edit');
        Route::put('update/{userPermission}',[UserPermissionController::class,'update'])->name('.update');
        Route::delete('destroy/{userPermission}',[UserPermissionController::class,'destroy'])->name('.destroy');

        Route::get('showauthorize',[UserPermissionController::class,'showauthorize'])->name('.showauthorize');

    });

});

require __DIR__.'/auth.php';

/*
|--------------------------------------------------------------------------
|    Public routes
|--------------------------------------------------------------------------
*/
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
Route::view('interface-sap-po','interface-sap-po');
Route::post('interface-sap-po',[InterfaceSapPoApiController::class,'getData']);

// ==========================================================================
// ROUTE GET/POST "BASIC-REPORT-API"
// ==========================================================================
Route::view('interface-sap-rec','interface-sap-rec');
Route::post('interface-sap-rec',[InterfaceSapRecApiController::class,'getData']);

// ==========================================================================
// ROUTE GET/POST "BASIC-REPORT-API"
// ==========================================================================
Route::view('interface-sap-inv','interface-sap-inv');
Route::post('interface-sap-inv',[InterfaceSapInvApiController::class,'getData']);


//<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<< E-MFG >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
// ==========================================================================
// ROUTE GET/POST "BASIC-REPORT-API"
// ==========================================================================
Route::view('emfg-shipping-log-ok','emfg-shipping-log-ok');
Route::post('emfg-shipping-log-ok',[EmfgShippingLogOkApiController::class,'getData']);

Route::view('emfg-shipping-log-ng','emfg-shipping-log-ng');
Route::post('emfg-shipping-log-ng',[EmfgShippingLogNgApiController::class,'getData']);

Route::view('emfg-shipping-log-event','emfg-shipping-log-event');
Route::post('emfg-shipping-log-event',[EmfgShippingLogEventApiController::class,'getData']);

Route::view('emfg-shipping-status','emfg-shipping-status');
Route::post('emfg-shipping-status',[EmfgShippingStatusApiController::class,'getData']);

Route::view('emfg-inventory-stock-out-error','emfg-inventory-stock-out-error');
Route::post('emfg-inventory-stock-out-error',[EmfgInventoryStockOutErrorApiController::class,'getData']);

Route::view('wiss-atac-emfg-shopping-log','wiss-atac-emfg-shopping-log');
Route::post('wiss-atac-emfg-shopping-log',[EmfgAtacShoppingLogApiController::class,'getData']);

//<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<< EPS >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
// ==========================================================================
// ROUTE GET/POST "BASIC-REPORT-API"
// ==========================================================================
Route::view('eps-pr-outstanding','eps-pr-outstanding');
Route::post('eps-pr-outstanding',[EpsPrOutstandingApiController::class,'getData']);

Route::view('eps-pr-po-planner','eps-pr-po-planner');
Route::post('eps-pr-po-planner',[EpsPrPoToPlannerApiController::class,'getData']);

Route::view('eps-bg-checking','eps-bg-checking');
Route::post('eps-bg-checking',[EpsBgCheckingApiController::class,'getData']);

Route::get('wiss-sa-eps-report-budget-checking-pr-detail',[EpsReportBudgetCheckingPrDetailApiController::class,'getData']);
Route::get('wiss_sa_eps_report_budget_checking_expense',[EpsReportBudgetCheckingExpenseDetailApiController::class,'getData']);
Route::get('wiss_sa_eps_report_budget_checking_investment',[EpsReportBudgetCheckingInvestmentDetailApiController::class,'getData']);

Route::view('eps-pr-error','eps-pr-error');
Route::post('eps-pr-error',[EpsPrErrorApiController::class,'getData']);

Route::view('eps-pr-production-error','eps-pr-production-error');
Route::post('eps-pr-production-error',[EpsPrProductionErrorApiController::class,'getData']);

Route::view('eps-cp-approve-pr','eps-cp-approve-pr');
Route::post('eps-cp-approve-pr',[EpsCpApprovePrApiController::class,'getData']);

//<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<< E-Drawing >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
// ==========================================================================
// ROUTE GET/POST "BASIC-REPORT-API"
// ==========================================================================
Route::view('edrawing-check-password','edrawing-check-password');
Route::post('edrawing-check-password',[EdrawingCheckPasswordApiController::class,'getData']);



//##################################################################################################################
//#                                           Maintain Program                                                     #
//##################################################################################################################
// ==========================================================================
// ROUTE GET/POST "FIX-POROGRAM-API"
// ==========================================================================
//<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<< I-BG >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
Route::view('wiss-sa-add-ibg-dept','wiss-sa-add-ibg-dept');
Route::post('wiss-sa-add-ibg-dept',[IbgAddDeptApiController::class,'getData']);

Route::view('wiss-sa-add-ibg-user','wiss-sa-add-ibg-user');
Route::post('wiss-sa-add-ibg-user',[IbgAddUserApiController::class,'getData']);

Route::view('wiss-sa-ibg-update-inf-schedule','wiss-sa-ibg-update-inf-schedule');
Route::post('wiss-sa-ibg-update-inf-schedule',[IbgUpdateInfScheduleApiController::class,'getData']);

//<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<< EPS >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
Route::view('wiss-sa-add-eps-investment','wiss-sa-add-eps-investment');
Route::post('wiss-sa-add-eps-investment',[EpsAddInvestmentApiController::class,'getData']);

//<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<< ATAC EMFG >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
Route::view('wiss-atac-emfg-add-model','wiss-atac-emfg-add-model');
Route::post('wiss-atac-emfg-add-model',[EmfgAddModelApiController::class,'getData']);

Route::view('wiss-atac-emfg-add-shelf','wiss-atac-emfg-add-shelf');
Route::post('wiss-atac-emfg-add-shelf',[EmfgAddShelfApiController::class,'getData']);

Route::view('wiss-atac-emfg-revert-shopping-status','wiss-atac-emfg-revert-shopping-status');
Route::post('wiss-atac-emfg-revert-shopping-status',[EmfgRevertShoppingStatusApiController::class,'getData']);

Route::view('wiss-atac-emfg-complete-pkl','wiss-atac-emfg-complete-pkl');
Route::post('wiss-atac-emfg-complete-pkl',[EmfgCompletePKLApiController::class,'getData']);

Route::view('wiss-atac-emfg-create-pallet-data-from-shopping','wiss-atac-emfg-create-pallet-data-from-shopping');
Route::post('wiss-atac-emfg-create-pallet-data-from-shopping',[EmfgCreatePalletDataFromShoppingApiController::class,'getData']);

//<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<< SA EMFG >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
Route::view('wiss-sa-emfg-add-shelf','wiss-sa-emfg-add-shelf');
Route::post('wiss-sa-emfg-add-shelf',[EmfgSaAddShelfApiController::class,'getData']);

//<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<< I-FIN >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
Route::view('wiss-sa-ifin-revert-doc','wiss-sa-ifin-revert-doc');
Route::post('wiss-sa-ifin-revert-doc',[IfinRevertDocApiController::class,'getData']);

Route::view('wiss-sa-ifin-register-admin','wiss-sa-ifin-register-admin');
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
