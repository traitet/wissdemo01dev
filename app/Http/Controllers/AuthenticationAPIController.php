<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\User;
use App\Models\UserPermission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticationAPIController extends Controller
{

    // ========================================================================================================================
    //                                                      ROUTE GET/POST "SAP"
    // ========================================================================================================================
    public function getAuthenticatePOInterfaceAPI(Request $request)
    {
        if(User::getPermission($request->permissionName, Auth::user()->email))
            return view('interface-sap-po');
        else
            return abort(403);
    }
    public function getAuthenticateRCInterfaceAPI(Request $request)
    {
        if(User::getPermission($request->permissionName, Auth::user()->email))
            return view('interface-sap-rc');
        else
            return abort(403);
    }
    public function getAuthenticateINVInterfaceAPI(Request $request)
    {
        if(User::getPermission($request->permissionName, Auth::user()->email))
            return view('interface-sap-inv');
        else
            return abort(403);
    }

    // ======================================================================================================================
    //                                            Aughten "E-MFG"
    // ======================================================================================================================
    public function getAuthenticateShippingOKAPI(Request $request)
    {
        if(User::getPermission($request->permissionName, Auth::user()->email))
            return view('emfg-shipping-log-ok');
        else
            return abort(403);
    }
    public function getAuthenticateShippingNGAPI(Request $request)
    {
        if(User::getPermission($request->permissionName, Auth::user()->email))
            return view('emfg-shipping-log-ng');
        else
            return abort(403);
    }
    public function getAuthenticateShippingEventAPI(Request $request)
    {
        if(User::getPermission($request->permissionName, Auth::user()->email))
            return view('emfg-shipping-log-event');
        else
            return abort(403);
    }
    public function getAuthenticateShippingStatusAPI(Request $request)
    {
        if(User::getPermission($request->permissionName, Auth::user()->email))
            return view('emfg-shipping-status');
        else
            return abort(403);
    }
    public function getAuthenticateStockOutAPI(Request $request)
    {
        if(User::getPermission($request->permissionName, Auth::user()->email))
            return view('emfg-inventory-stock-out-error');
        else
            return abort(403);
    }
    public function getAuthenticateShoppingLogAPI(Request $request)
    {
        if(User::getPermission($request->permissionName, Auth::user()->email))
            return view('wiss-atac-emfg-shopping-log');
        else
            return abort(403);
    }
    // ========================================================================================================================
    //                                                     ROUTE GET/POST "EPS"
    // ========================================================================================================================
    public function getAuthenticatePROutstandingAPI(Request $request)
    {
        if(User::getPermission($request->permissionName, Auth::user()->email))
            return view('eps-pr-outstanding');
        else
            return abort(403);
    }
    public function getAuthenticatePRPOPlannerAPI(Request $request)
    {
        if(User::getPermission($request->permissionName, Auth::user()->email))
            return view('eps-pr-po-planner');
        else
            return abort(403);
    }
    public function getAuthenticateBGCheckingAPI(Request $request)
    {
        if(User::getPermission($request->permissionName, Auth::user()->email))
            return view('eps-bg-checking');
        else
            return abort(403);
    }
    public function getAuthenticatePRErrorAPI (Request $request)
    {
        if(User::getPermission($request->permissionName, Auth::user()->email))
            return view('eps-pr-error');
        else
            return abort(403);
    }
    public function getAuthenticatePRProductionErrorAPI (Request $request)
    {
        if(User::getPermission($request->permissionName, Auth::user()->email))
            return view('eps-pr-production-error');
        else
            return abort(403);
    }
    public function getAuthenticateCPApproveAPI (Request $request)
    {
        if(User::getPermission($request->permissionName, Auth::user()->email))
            return view('eps-cp-approve-pr');
        else
            return abort(403);
    }
    // ========================================================================================================================
    //                                                     ROUTE GET/POST "E-Drawing"
    // ========================================================================================================================
    public function getAuthenticateEdrawingPasswordAPI (Request $request)
    {
        if(User::getPermission($request->permissionName, Auth::user()->email))
            return view('edrawing-check-password');
        else
            return abort(403);
    }
    // ========================================================================================================================
    //                                                      ROUTE GET/POST "IBG"
    // ========================================================================================================================
    public function getAuthenticateAddIBGDeptAPI  (Request $request)
    {
        if(User::getPermission($request->permissionName, Auth::user()->email))
            return view('wiss-sa-add-ibg-dept');
        else
            return abort(403);
    }
    public function getAuthenticateAddIBGUserAPI  (Request $request)
    {
        if(User::getPermission($request->permissionName, Auth::user()->email))
            return view('wiss-sa-add-ibg-user');
        else
            return abort(403);
    }
    public function getAuthenticateAddIBGInterfaceAPI  (Request $request)
    {
        if(User::getPermission($request->permissionName, Auth::user()->email))
            return view('wiss-sa-ibg-update-inf-schedule');
        else
            return abort(403);
    }
    // ========================================================================================================================
    //                                                      ROUTE GET/POST "EPS"
    // ========================================================================================================================
    public function getAuthenticateAddInvestmentAPI   (Request $request)
    {
        if(User::getPermission($request->permissionName, Auth::user()->email))
            return view('wiss-sa-add-eps-investment');
        else
            return abort(403);
    }
    // ========================================================================================================================
    //                                                      ROUTE GET/POST "IFIN"
    // ========================================================================================================================
    public function getAuthenticateRevertDocAPI    (Request $request)
    {
        if(User::getPermission($request->permissionName, Auth::user()->email))
            return view('wiss-sa-ifin-revert-doc');
        else
            return abort(403);
    }
    public function getAuthenticateRegisterAdminAPI    (Request $request)
    {
        if(User::getPermission($request->permissionName, Auth::user()->email))
            return view('wiss-sa-ifin-register-admin');
        else
            return abort(403);
    }
    // ========================================================================================================================
    //                                                    ROUTE GET/POST "SA E-MFG"
    // ========================================================================================================================
    public function getAuthenticateAddShelfSAAPI(Request $request)
    {
        if(User::getPermission($request->permissionName, Auth::user()->email))
            return view('wiss-sa-emfg-add-shelf');
        else
            return abort(403);
    }
    // ========================================================================================================================
    //                                                 ROUTE GET/POST "ATAC E-MFG"
    // ========================================================================================================================
    public function getAuthenticateAddModelATACAPI (Request $request)
    {
        if(User::getPermission($request->permissionName, Auth::user()->email))
            return view('wiss-atac-emfg-add-model');
        else
            return abort(403);
    }
    public function getAuthenticateAddShelfATACAPI (Request $request)
    {
        if(User::getPermission($request->permissionName, Auth::user()->email))
            return view('wiss-atac-emfg-add-shelf');
        else
            return abort(403);
    }
    public function getAuthenticateRevertShoppingATACAPI (Request $request)
    {
        if(User::getPermission($request->permissionName, Auth::user()->email))
            return view('wiss-atac-emfg-revert-shopping-status');
        else
            return abort(403);
    }
    public function getAuthenticateCompletePklATACAPI (Request $request)
    {
        if(User::getPermission($request->permissionName, Auth::user()->email))
            return view('wiss-atac-emfg-complete-pkl');
        else
            return abort(403);
    }
    public function getAuthenticateCompletePalletATACPI (Request $request)
    {
        if(User::getPermission($request->permissionName, Auth::user()->email))
            return view('wiss-atac-emfg-create-pallet-data-from-shopping');
        else
            return abort(403);
    }
    // ========================================================================================================================
    //                                                    ROUTE GET/POST "Log"
    // ========================================================================================================================
    public function getAuthenticateLogUserAPI (Request $request)
    {
        if(User::getPermission($request->permissionName, Auth::user()->email))
            return view('logs.usage-by-user');
        else
            return abort(403);
    }
    public function getAuthenticateLogFunctionAPI (Request $request)
    {
        if(User::getPermission($request->permissionName, Auth::user()->email))
            return view('logs.usage-by-function');
        else
            return abort(403);
    }
}
