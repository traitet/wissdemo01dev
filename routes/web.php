<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
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
use App\Http\Controllers\ItssSatisfactionEachDepartmentApiController;
use App\Http\Controllers\ItssPercentSatisfactionApiController;

//==================================================================================================================
//                                                     Maintain
//==================================================================================================================
use App\Http\Controllers\IbgAddDeptApiController;
use App\Http\Controllers\IbgAddUserApiController;
use App\Http\Controllers\IbgUpdateInfScheduleApiController;
use App\Http\Controllers\EpsAddInvestmentApiController;
use App\Http\Controllers\EmfgAddModelApiController;
use App\Http\Controllers\EmfgAddShelfApiController;
use App\Http\Controllers\EmfgSaAddShelfApiController;
use App\Http\Controllers\IfinRevertDocApiController;
use App\Http\Controllers\IfinRegisterAdminApiController;
use App\Http\Controllers\IFinUpdateDocApiController;
use App\Http\Controllers\EmfgRevertShoppingStatusApiController;
use App\Http\Controllers\EmfgCompletePKLApiController;
use App\Http\Controllers\EmfgCreatePalletDataFromShoppingApiController;
use App\Http\Controllers\EpsIssuePrApiController;
use App\Http\Controllers\EmfgUpdateDocksApiController;
use App\Http\Controllers\EmfgUpdateShelfsApiController;
use App\Http\Controllers\EmfgUpdateModelsApiController;
use App\Http\Controllers\EmfgUpdatePalletsApiController;

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
use App\Http\Controllers\LogController;
// External
use App\Http\Controllers\ExternalURLController;
// Authentication API
use App\Http\Controllers\AuthenticationAPIController;
use App\Http\Controllers\DeployController;

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

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/password/change', [ChangePasswordController::class, 'create'])->name('password.change');
    Route::post('/password/store', [ChangePasswordController::class, 'store'])->name('password.store');

    /*
    /-----------------------------------------------------------------------------
    // Navigation Group
    /-----------------------------------------------------------------------------
    */
    Route::get('/navigationgroups', [NavigationGroupController::class, 'index'])->name('Navigation-Group');
    Route::prefix('navigationgroups')->name('navigationgroups')->group(function () {
        // Route::get('/',[NavigationGroupController::class,'index'])->name('.index');
        Route::get('create', [NavigationGroupController::class, 'create'])->name('.create');
        Route::post('/', [NavigationGroupController::class, 'store'])->name('.store');
        Route::get('edit/{navigationGroup}', [NavigationGroupController::class, 'edit'])->name('.edit');
        Route::put('update/{navigationGroup}', [NavigationGroupController::class, 'update'])->name('.update');
        Route::delete('destroy/{navigationGroup}', [NavigationGroupController::class, 'destroy'])->name('.destroy');
        // Route::post('/action',[NavigationGroupController::class,'action'])->name('.action');
    });
    /*
    /-----------------------------------------------------------------------------
    // Navigation Item
    /-----------------------------------------------------------------------------
    */
    Route::get('/navigationitems', [NavigationItemController::class, 'index'])->name('Navigation-Item');
    Route::prefix('navigationitems')->name('navigationitems')->group(function () {
        Route::get('create', [NavigationItemController::class, 'create'])->name('.create');
        Route::post('/', [NavigationItemController::class, 'store'])->name('.store');
        Route::get('edit/{navigationItem}', [NavigationItemController::class, 'edit'])->name('.edit');
        Route::put('update/{navigationItem}', [NavigationItemController::class, 'update'])->name('.update');
        Route::delete('destroy/{navigationItem}', [NavigationItemController::class, 'destroy'])->name('.destroy');
    });
    /*
    /-----------------------------------------------------------------------------
    // Permisson
    /-----------------------------------------------------------------------------
    */
    Route::get('/permissions', [PermissionController::class, 'index'])->name('Permission');
    Route::prefix('permissions')->name('permissions')->group(function () {
        Route::get('create', [PermissionController::class, 'create'])->name('.create');
        Route::post('/', [PermissionController::class, 'store'])->name('.store');
        Route::get('edit/{permission}', [PermissionController::class, 'edit'])->name('.edit');
        Route::put('update/{permission}', [PermissionController::class, 'update'])->name('.update');
        Route::delete('destroy/{permission}', [PermissionController::class, 'destroy'])->name('.destroy');
    });
    /*
    /-----------------------------------------------------------------------------
    // User Permission comment 26/07/2022
    /-----------------------------------------------------------------------------
    */
    // Route::get('/userpermissions', [UserPermissionController::class, 'index'])->name('User-Permission');
    // Route::prefix('userpermissions')->name('userpermissions')->group(function () {
    //     Route::get('create', [UserPermissionController::class, 'create'])->name('.create');
    //     Route::post('/', [UserPermissionController::class, 'store'])->name('.store');
    //     Route::get('edit/{userPermission}', [UserPermissionController::class, 'edit'])->name('.edit');
    //     Route::put('update/{userPermission}', [UserPermissionController::class, 'update'])->name('.update');
    //     Route::delete('destroy/{userPermission}', [UserPermissionController::class, 'destroy'])->name('.destroy');
    // });
    /*
    /-----------------------------------------------------------------------------
    // Authorization
    /-----------------------------------------------------------------------------
    */
    Route::get('showauthorize/{permissionName}', [UserPermissionController::class, 'showauthorize'])->name("Authorization");
    Route::get('update/{email}', [UserPermissionController::class, 'showauthorizebypersion'])->name('Authorization.edit');


    // Route::get('/showauthorize', [UserPermissionController::class, 'showauthorize'])->name('Authorization');
    Route::get('insert/showauthorize', [UserPermissionController::class, 'insertpermission'])->name('Authorization.insertpermission');
    Route::get('delete/showauthorize', [UserPermissionController::class, 'deletepermission'])->name('Authorization.deletepermission');
    Route::post('/updateauthorize', [UserPermissionController::class, 'updateauthorize'])->name('Authorization.update');

});

require __DIR__ . '/auth.php';

/*
|--------------------------------------------------------------------------
|    Public routes
|--------------------------------------------------------------------------
*/
Route::get('/showatgn/{permissionName}', [ExternalURLController::class, 'showatgn'])->name('ATGN');
Route::get('/showzabbix/{permissionName}', [ExternalURLController::class, 'showzabbix'])->name('Zabbix');
Route::get('/showsolarwinds/{permissionName}', [ExternalURLController::class, 'showsolarwinds'])->name('Solarwinds');
Route::get('/shownagios/{permissionName}', [ExternalURLController::class, 'shownagios'])->name('Nagios');
//########################################################################################################################
//#                                                          Report                                                      #
//########################################################################################################################
// ==========================================================================
// ROUTE GET/POST "BASIC-REPORT-API"
// ==========================================================================
Route::view('basic-report-api', 'basic-report-api');
Route::post('basic-report-api', [BasicReportApiController::class, 'getData']);

// ========================================================================================================================
//                                                      ROUTE GET/POST "SAP"
// ========================================================================================================================
// Route::view('interface-sap-po','interface-sap-po');
// Route::get("interface-sap-po", function(){ return view("interface-sap-po");})->name("PO-Interface");
Route::get('interface-sap-po/{permissionName}', [AuthenticationAPIController::class, 'getAuthenticatePOInterfaceAPI'])->name("PO-Interface");
Route::post('interface-sap-po/{permissionAuth}', [InterfaceSapPoApiController::class, 'getData'])->name('InterfaceSAPPO.show');
Route::get('interface-sap-rec/{permissionName}', [AuthenticationAPIController::class, 'getAuthenticateRCInterfaceAPI'])->name("RC-Interface");
Route::post('interface-sap-rec/{permissionAuth}', [InterfaceSapRecApiController::class, 'getData'])->name('InterfaceSAPREC.show');
Route::get('interface-sap-inv/{permissionName}', [AuthenticationAPIController::class, 'getAuthenticateINVInterfaceAPI'])->name("INV-Interface");
Route::post('interface-sap-inv/{permissionAuth}', [InterfaceSapInvApiController::class, 'getData'])->name('InterfaceSAPINV.show');

// ========================================================================================================================
//                                                     ROUTE GET/POST "E-MFG"
// ========================================================================================================================
Route::get('emfg-shipping-log-ok/{permissionName}', [AuthenticationAPIController::class, 'getAuthenticateShippingOKAPI'])->name("Shipping-OK-SA");
Route::post('emfg-shipping-log-ok/{permissionAuth}', [EmfgShippingLogOkApiController::class, 'getData'])->name('ShippingLogOK.show');
Route::get('emfg-shipping-log-ng/{permissionName}', [AuthenticationAPIController::class, 'getAuthenticateShippingNGAPI'])->name("Shipping-NG-SA");
Route::post('emfg-shipping-log-ng/{permissionAuth}', [EmfgShippingLogNgApiController::class, 'getData'])->name('ShippingLogNG.show');
Route::get('emfg-shipping-log-event/{permissionName}', [AuthenticationAPIController::class, 'getAuthenticateShippingEventAPI'])->name("Shipping-Event-Log-SA");
Route::post('emfg-shipping-log-event/{permissionAuth}', [EmfgShippingLogEventApiController::class, 'getData'])->name('ShippingLogEvent.show');
Route::get('emfg-shipping-status/{permissionName}', [AuthenticationAPIController::class, 'getAuthenticateShippingStatusAPI'])->name("Shipping-Status-SA");
Route::post('emfg-shipping-status/{permissionAuth}', [EmfgShippingStatusApiController::class, 'getData'])->name('ShippingStatus.show');
Route::get('emfg-inventory-stock-out-error/{permissionName}', [AuthenticationAPIController::class, 'getAuthenticateStockOutAPI'])->name("Stock-Out-Error-SA");
Route::post('emfg-inventory-stock-out-error/{permissionAuth}', [EmfgInventoryStockOutErrorApiController::class, 'getData'])->name('InventoryStockOut.show');
Route::get('wiss-atac-emfg-shopping-log/{permissionName}', [AuthenticationAPIController::class, 'getAuthenticateShoppingLogAPI'])->name("Shopping-Log-ATAC");
Route::post('wiss-atac-emfg-shopping-log/{permissionAuth}', [EmfgAtacShoppingLogApiController::class, 'getData'])->name('ShoppingLog.show');

// ========================================================================================================================
//                                                     ROUTE GET/POST "EPS"
// ========================================================================================================================
Route::get('eps-pr-outstanding/{permissionName}', [AuthenticationAPIController::class, 'getAuthenticatePROutstandingAPI'])->name("PR-Outstanding");
Route::post('eps-pr-outstanding/{permissionAuth}', [EpsPrOutstandingApiController::class, 'getData'])->name('PROustanding.show');
Route::get('eps-pr-po-planner/{permissionName}', [AuthenticationAPIController::class, 'getAuthenticatePRPOPlannerAPI'])->name("PR-PO-Planner");
Route::post('eps-pr-po-planner/{permissionAuth}', [EpsPrPoToPlannerApiController::class, 'getData'])->name('PRPOPlanner.show');
Route::get('eps-bg-checking/{permissionName}', [AuthenticationAPIController::class, 'getAuthenticateBGCheckingAPI'])->name("BG-Checking");
Route::post('eps-bg-checking/{permissionAuth}', [EpsBgCheckingApiController::class, 'getData'])->name('BGChecking.show');

//<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<< Fix direct acccess API later >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
// Route::get('wiss-sa-eps-report-budget-checking-pr-detail',[EpsReportBudgetCheckingPrDetailApiController::class,'getData']);
Route::get('wiss-sa-eps-report-budget-checking-pr-detail/{docNum}', [EpsReportBudgetCheckingPrDetailApiController::class, 'getData'])->name("PRDetail");
Route::get('wiss_sa_eps_report_budget_checking_expense/{docNum}', [EpsReportBudgetCheckingExpenseDetailApiController::class, 'getData'])->name("ExpenseDetail");
Route::get('wiss_sa_eps_report_budget_checking_investment/{docNum}', [EpsReportBudgetCheckingInvestmentDetailApiController::class, 'getData'])->name("InvesetmentDetail");

Route::get('eps-pr-error/{permissionName}', [AuthenticationAPIController::class, 'getAuthenticatePRErrorAPI'])->name("PR-Error");
Route::post('eps-pr-error/{permissionAuth}', [EpsPrErrorApiController::class, 'getData'])->name('PRError.show');
Route::get('eps-pr-production-error/{permissionName}', [AuthenticationAPIController::class, 'getAuthenticatePRProductionErrorAPI'])->name("PR-Production-Error");
Route::post('eps-pr-production-error/{permissionAuth}', [EpsPrProductionErrorApiController::class, 'getData'])->name('PRProcuction.show');
Route::get('eps-cp-approve-pr/{permissionName}', [AuthenticationAPIController::class, 'getAuthenticateCPApproveAPI'])->name("CP-Approve-PR");
Route::post('eps-cp-approve-pr/{permissionAuth}', [EpsCpApprovePrApiController::class, 'getData'])->name('CPApprovePR.show');

// ========================================================================================================================
//                                                     ROUTE GET/POST "E-Drawing"
// ========================================================================================================================
Route::get('edrawing-check-password/{permissionName}', [AuthenticationAPIController::class, 'getAuthenticateEdrawingPasswordAPI'])->name("Password");
Route::post('edrawing-check-password/{permissionAuth}', [EdrawingCheckPasswordApiController::class, 'getData'])->name('EdrawingPassword.show');

// ========================================================================================================================
//                                                     ROUTE GET/POST "ITSS"
// ========================================================================================================================
Route::get('wiss-itss-satisfaction-each-department/{permissionName}', [AuthenticationAPIController::class, 'getAuthenticateItssSatisfactionEachDepartmentAPI'])->name("Satisfaction-Each-Dept");
Route::post('wiss-itss-satisfaction-each-department/{permissionAuth}', [ItssSatisfactionEachDepartmentApiController::class, 'getData'])->name('ItssSatisfactionEachDepartment.show');
Route::get('wiss-itss-percent-satisfaction/{permissionName}', [AuthenticationAPIController::class, 'getAuthenticateItssPercentSatisfactionAPI'])->name("Percent-Satisfaction");
Route::post('wiss-itss-percent-satisfaction/{permissionAuth}', [ItssPercentSatisfactionApiController::class, 'getData'])->name('ItssPercentSatisfaction.show');

//#########################################################################################################################
//#                                                  Maintain Program                                                     #
//#########################################################################################################################
// ========================================================================================================================
//                                                      ROUTE GET/POST "IBG"
// ========================================================================================================================
Route::get('wiss-sa-add-ibg-dept/{permissionName}', [AuthenticationAPIController::class, 'getAuthenticateAddIBGDeptAPI'])->name("Add-Department");
Route::post('wiss-sa-add-ibg-dept/{permissionAuth}', [IbgAddDeptApiController::class, 'getData'])->name('AddIBGDept.show');
Route::get('wiss-sa-add-ibg-user/{permissionName}', [AuthenticationAPIController::class, 'getAuthenticateAddIBGUserAPI'])->name("Add-User");
Route::post('wiss-sa-add-ibg-user/{permissionAuth}', [IbgAddUserApiController::class, 'getData'])->name('AddIBGUser.show');
Route::get('wiss-sa-ibg-update-inf-schedule/{permissionName}', [AuthenticationAPIController::class, 'getAuthenticateAddIBGInterfaceAPI'])->name("Add-IF-Schedule");
Route::post('wiss-sa-ibg-update-inf-schedule/{permissionAuth}', [IbgUpdateInfScheduleApiController::class, 'getData'])->name('AddIBGInterface.show');

// ========================================================================================================================
//                                                      ROUTE GET/POST "EPS"
// ========================================================================================================================
Route::get('wiss-sa-add-eps-investment/{permissionName}', [AuthenticationAPIController::class, 'getAuthenticateAddInvestmentAPI'])->name("Add-Investment");
Route::post('wiss-sa-add-eps-investment/{permissionAuth}', [EpsAddInvestmentApiController::class, 'getData'])->name('AddEPSInvestment.show');
Route::get('wiss-sa-issue-pr/{permissionName}',[AuthenticationAPIController::class, 'getAuthenticateIssuePRAPI'])->name("Issue-PR");
Route::post('wiss-sa-issue-pr/{permissionAuth}', [EpsIssuePrApiController::class, 'getData'])->name('IssuePR.show');


// ========================================================================================================================
//                                                      ROUTE GET/POST "IFIN"
// ========================================================================================================================
Route::get('wiss-sa-ifin-revert-doc/{permissionName}', [AuthenticationAPIController::class, 'getAuthenticateRevertDocAPI'])->name("Revert-Doc");
Route::post('wiss-sa-ifin-revert-doc/{permissionAuth}', [IfinRevertDocApiController::class, 'getData'])->name('IfinRevertDoc.show');
Route::get('wiss-sa-ifin-register-admin/{permissionName}', [AuthenticationAPIController::class, 'getAuthenticateRegisterAdminAPI'])->name("Register-Admin");
Route::post('wiss-sa-ifin-register-admin/{permissionAuth}', [IfinRegisterAdminApiController::class, 'getData'])->name('IfinRegisterAdmin.show');

Route::get('wiss-sa-ifin-update-doc/{permissionName}', [AuthenticationAPIController::class, 'getAuthenticateUpdateDocAPI'])->name("Update-Doc");
Route::post('wiss-sa-ifin-update-doc/{permissionAuth}', [IFinUpdateDocApiController::class, 'getData'])->name('IFinGetDocInterface.show');
Route::post('wiss-sa-ifin-store-doc/{permissionAuth}', [IFinUpdateDocApiController::class, 'update'])->name('IFinGetDocInterface.update');

// Route::post('ifin-get-docs-interface/', [IFinUpdateDocApiController::class, 'getData'])->name('IFinGetDocInterface.show');


// ========================================================================================================================
//                                                    ROUTE GET/POST "SA E-MFG"
// ========================================================================================================================
Route::get('wiss-sa-emfg-add-shelf/{permissionName}', [AuthenticationAPIController::class, 'getAuthenticateAddShelfSAAPI'])->name("Add-Shelf-SA");
Route::post('wiss-sa-emfg-add-shelf/{permissionAuth}', [EmfgSaAddShelfApiController::class, 'getData'])->name('EmfgAddShelfSA.show');

// ========================================================================================================================
//                                                 ROUTE GET/POST "ATAC E-MFG"
// ========================================================================================================================
Route::get('wiss-atac-emfg-add-model/{permissionName}', [AuthenticationAPIController::class, 'getAuthenticateAddModelATACAPI'])->name("Add-Model-ATAC");
Route::post('wiss-atac-emfg-add-model/{permissionAuth}', [EmfgAddModelApiController::class, 'getData'])->name('EmfgAddModelATAC.show');
Route::get('wiss-atac-emfg-add-shelf/{permissionName}', [AuthenticationAPIController::class, 'getAuthenticateAddShelfATACAPI'])->name("Add-Shelf-ATAC");
Route::post('wiss-atac-emfg-add-shelf/{permissionAuth}', [EmfgAddShelfApiController::class, 'getData'])->name('EmfgAddShelfATAC.show');
Route::get('wiss-atac-emfg-revert-shopping-status/{permissionName}', [AuthenticationAPIController::class, 'getAuthenticateRevertShoppingATACAPI'])->name("Revert-Shopping-ATAC");
Route::post('wiss-atac-emfg-revert-shopping-status/{permissionAuth}', [EmfgRevertShoppingStatusApiController::class, 'getData'])->name('EmfgRevertShoppingATAC.show');
Route::get('wiss-atac-emfg-complete-pkl/{permissionName}', [AuthenticationAPIController::class, 'getAuthenticateCompletePklATACAPI'])->name("Complete-PKL-ATAC");
Route::post('wiss-atac-emfg-complete-pkl/{permissionAuth}', [EmfgCompletePKLApiController::class, 'getData'])->name('EmfgCompletePklATAC.show');
Route::get('wiss-atac-emfg-create-pallet-data-from-shopping/{permissionName}', [AuthenticationAPIController::class, 'getAuthenticateCompletePalletATACPI'])->name("Complete-Pallet-ATAC");
Route::post('wiss-atac-emfg-create-pallet-data-from-shopping/{permissionAuth}', [EmfgCreatePalletDataFromShoppingApiController::class, 'getData'])->name('EmfgCreatePalletATAC.show');

Route::get('wiss-atac-emfg-update-docks/{permissionName}', [AuthenticationAPIController::class, 'getAuthenticateUpdateDocksAPI'])->name("Update-Docks-ATAC");
Route::post('wiss-atac-emfg-update-docks/{permissionAuth}', [EmfgUpdateDocksApiController::class, 'getData'])->name('EmfgUpdateDocksATAC.show');
Route::post('wiss-atac-emfg-store-docks/{permissionAuth}', [EmfgUpdateDocksApiController::class, 'update'])->name('EmfgUpdateDocksATAC.update');
Route::post('wiss-atac-emfg-import-docks/{permissionAuth}', [EmfgUpdateDocksApiController::class, 'importExcel'])->name('EmfgUpdateDocksATAC.import');
Route::post('wiss-atac-emfg-export-docks/{permissionAuth}', [EmfgUpdateDocksApiController::class, 'exportExcel'])->name('EmfgUpdateDocksATAC.export');

Route::get('wiss-atac-emfg-update-shelfs/{permissionName}', [AuthenticationAPIController::class, 'getAuthenticateUpdateShelfsAPI'])->name("Update-Shelfs-ATAC");
Route::post('wiss-atac-emfg-update-shelfs/{permissionAuth}', [EmfgUpdateShelfsApiController::class, 'getData'])->name('EmfgUpdateShelfsATAC.show');
Route::post('wiss-atac-emfg-store-shelfs/{permissionAuth}', [EmfgUpdateShelfsApiController::class, 'update'])->name('EmfgUpdateShelfsATAC.update');
Route::post('wiss-atac-emfg-import-shelfs/{permissionAuth}', [EmfgUpdateShelfsApiController::class, 'importExcel'])->name('EmfgUpdateShelfsATAC.import');
Route::post('wiss-atac-emfg-export-shelfs/{permissionAuth}', [EmfgUpdateShelfsApiController::class, 'exportExcel'])->name('EmfgUpdateShelfsATAC.export');

Route::get('wiss-atac-emfg-update-models/{permissionName}', [AuthenticationAPIController::class, 'getAuthenticateUpdateModelsAPI'])->name("Update-Models-ATAC");
Route::post('wiss-atac-emfg-update-models/{permissionAuth}', [EmfgUpdateModelsApiController::class, 'getData'])->name('EmfgUpdateModelsATAC.show');
Route::post('wiss-atac-emfg-store-models/{permissionAuth}', [EmfgUpdateModelsApiController::class, 'update'])->name('EmfgUpdateModelsATAC.update');
Route::post('wiss-atac-emfg-import-models/{permissionAuth}', [EmfgUpdateModelsApiController::class, 'importExcel'])->name('EmfgUpdateModelsATAC.import');
Route::post('wiss-atac-emfg-export-models/{permissionAuth}', [EmfgUpdateModelsApiController::class, 'exportExcel'])->name('EmfgUpdateModelsATAC.export');

Route::get('wiss-atac-emfg-update-pallets/{permissionName}', [AuthenticationAPIController::class, 'getAuthenticateUpdatePalletsAPI'])->name("Update-Pallets-ATAC");
Route::post('wiss-atac-emfg-update-pallets/{permissionAuth}', [EmfgUpdatePalletsApiController::class, 'getData'])->name('EmfgUpdatePalletsATAC.show');
Route::post('wiss-atac-emfg-store-pallets/{permissionAuth}', [EmfgUpdatePalletsApiController::class, 'update'])->name('EmfgUpdatePalletsATAC.update');
Route::post('wiss-atac-emfg-import-pallets/{permissionAuth}', [EmfgUpdatePalletsApiController::class, 'importExcel'])->name('EmfgUpdatePalletsATAC.import');
Route::post('wiss-atac-emfg-export-pallets/{permissionAuth}', [EmfgUpdatePalletsApiController::class, 'exportExcel'])->name('EmfgUpdatePalletsATAC.export');

// ========================================================================================================================
//                                                    ROUTE GET/POST "Logs"
// ========================================================================================================================
Route::get('usage-by-user/{permissionName}', [AuthenticationAPIController::class, 'getAuthenticateLogUserAPI'])->name("Log-User");
Route::post('usage-by-user/{permissionAuth}', [LogController::class, 'getLogUser'])->name('UserLog.index');
Route::get('usage-by-function/{permissionName}', [AuthenticationAPIController::class, 'getAuthenticateLogFunctionAPI'])->name("Log-Function");
Route::post('usage-by-function/{permissionAuth}', [LogController::class, 'getLogFunction'])->name('FunctionLog.index');


// ==========================================================================
// ROUTE GET/POST "MAIN"
// ==========================================================================
Route::view('main', 'main');
Route::post('main', [MainController::class, 'getData']);

// ========================================================================================================================
//                                                    ROUTE GET/POST "Deploy"
// ========================================================================================================================
Route::get('deploy-code/{permissionName}', [AuthenticationAPIController::class, 'getAuthenticateDeployAPI'])->name("deploy-code");
Route::post('deploy-code/{permissionAuth}', [DeployController::class, 'update'])->name('deploy-code.update');

//  Route::get('/deploy-code/{permissionName}', function () {
//      return view('deploy-code.update');
// });

// Route::get('/deploy-code', function () {
//     return view('deploy-code');
// });

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


// ==========================================================================
// TEST ROUTE VIEW DASHBOARD
// ==========================================================================
//   Route::get('/ifin', function () {
//       return view('ifin-get-doc-interface');
//   });
