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
        if(User::getPermission($request->permissionName, Auth::user()->email)){
            $permissionName = $request->permissionName;
            return view('interface-sap-po',compact('permissionName'));
        }
        else{
            return abort(403);
        }
    }
    public function getAuthenticateRCInterfaceAPI(Request $request)
    {
        if(User::getPermission($request->permissionName, Auth::user()->email)){
            $permissionName = $request->permissionName;
            return view('interface-sap-rec',compact('permissionName'));
        }else{
            return abort(403);
        }
    }
    public function getAuthenticateINVInterfaceAPI(Request $request)
    {
        if(User::getPermission($request->permissionName, Auth::user()->email)){
            $permissionName = $request->permissionName;
            return view('interface-sap-inv',compact('permissionName'));
        }else{
            return abort(403);
        }
    }

    // ======================================================================================================================
    //                                            Aughten "E-MFG"
    // ======================================================================================================================
    public function getAuthenticateShippingOKAPI(Request $request)
    {
        if(User::getPermission($request->permissionName, Auth::user()->email)){
            $permissionName = $request->permissionName;
            return view('emfg-shipping-log-ok',compact('permissionName'));
        }else{
            return abort(403);
        }
    }
    public function getAuthenticateShippingNGAPI(Request $request)
    {
        if(User::getPermission($request->permissionName, Auth::user()->email)){
            $permissionName = $request->permissionName;
            return view('emfg-shipping-log-ng',compact('permissionName'));
        }else{
            return abort(403);
        }
    }
    public function getAuthenticateShippingEventAPI(Request $request)
    {
        if(User::getPermission($request->permissionName, Auth::user()->email)){
            $permissionName = $request->permissionName;
            return view('emfg-shipping-log-event',compact('permissionName'));
        }else{
            return abort(403);
        }
    }
    public function getAuthenticateShippingStatusAPI(Request $request)
    {
        if(User::getPermission($request->permissionName, Auth::user()->email)){
            $permissionName = $request->permissionName;
            return view('emfg-shipping-status',compact('permissionName'));
        }else{
            return abort(403);
        }
    }
    public function getAuthenticateStockOutAPI(Request $request)
    {
        if(User::getPermission($request->permissionName, Auth::user()->email)){
            $permissionName = $request->permissionName;
            return view('emfg-inventory-stock-out-error',compact('permissionName'));
        }else{
            return abort(403);
        }
    }
    public function getAuthenticateShoppingLogAPI(Request $request)
    {
        if(User::getPermission($request->permissionName, Auth::user()->email)){
            $permissionName = $request->permissionName;
            return view('wiss-atac-emfg-shopping-log',compact('permissionName'));
        }else{
            return abort(403);
        }
    }
    // ========================================================================================================================
    //                                                     ROUTE GET/POST "EPS"
    // ========================================================================================================================
    public function getAuthenticatePROutstandingAPI(Request $request)
    {
        if(User::getPermission($request->permissionName, Auth::user()->email)){
            $permissionName = $request->permissionName;
            return view('eps-pr-outstanding',compact('permissionName'));
        }else{
            return abort(403);
        }
    }
    public function getAuthenticatePRPOPlannerAPI(Request $request)
    {
        if(User::getPermission($request->permissionName, Auth::user()->email)){
            $permissionName = $request->permissionName;
            return view('eps-pr-po-planner',compact('permissionName'));
        }else{
            return abort(403);
        }
    }
    public function getAuthenticateBGCheckingAPI(Request $request)
    {
        if(User::getPermission($request->permissionName, Auth::user()->email)){
            $permissionName = $request->permissionName;
            return view('eps-bg-checking',compact('permissionName'));
        }else{
            return abort(403);
        }
    }
    public function getAuthenticatePRErrorAPI (Request $request)
    {
        if(User::getPermission($request->permissionName, Auth::user()->email)){
            $permissionName = $request->permissionName;
            return view('eps-pr-error',compact('permissionName'));
        }else{
            return abort(403);
        }
    }
    public function getAuthenticatePRProductionErrorAPI (Request $request)
    {
        if(User::getPermission($request->permissionName, Auth::user()->email)){
            $permissionName = $request->permissionName;
            return view('eps-pr-production-error',compact('permissionName'));
        }else{
            return abort(403);
        }
    }
    public function getAuthenticateCPApproveAPI (Request $request)
    {
        if(User::getPermission($request->permissionName, Auth::user()->email)){
            $permissionName = $request->permissionName;
            return view('eps-cp-approve-pr',compact('permissionName'));
        }else{
            return abort(403);
        }
    }
    // ========================================================================================================================
    //                                                     ROUTE GET/POST "E-Drawing"
    // ========================================================================================================================
    public function getAuthenticateEdrawingPasswordAPI (Request $request)
    {
        if(User::getPermission($request->permissionName, Auth::user()->email)){
            $permissionName = $request->permissionName;
            return view('edrawing-check-password',compact('permissionName'));
        }else{
            return abort(403);
        }

    }
    // ========================================================================================================================
    //                                                      ROUTE GET/POST "IBG"
    // ========================================================================================================================
    public function getAuthenticateAddIBGDeptAPI  (Request $request)
    {
        if(User::getPermission($request->permissionName, Auth::user()->email)){
            $permissionName = $request->permissionName;
            return view('wiss-sa-add-ibg-dept',compact('permissionName'));
        }else{
            return abort(403);
        }
    }
    public function getAuthenticateAddIBGUserAPI  (Request $request)
    {
        if(User::getPermission($request->permissionName, Auth::user()->email)){
            $permissionName = $request->permissionName;
            return view('wiss-sa-add-ibg-user',compact('permissionName'));
        }else{
            return abort(403);
        }
    }
    public function getAuthenticateAddIBGInterfaceAPI  (Request $request)
    {
        if(User::getPermission($request->permissionName, Auth::user()->email)){
            $permissionName = $request->permissionName;
            return view('wiss-sa-ibg-update-inf-schedule',compact('permissionName'));
        }else{
            return abort(403);
        }
    }
    // ========================================================================================================================
    //                                                      ROUTE GET/POST "EPS"
    // ========================================================================================================================
    public function getAuthenticateAddInvestmentAPI   (Request $request)
    {
        if(User::getPermission($request->permissionName, Auth::user()->email)){
            $permissionName = $request->permissionName;
            return view('wiss-sa-add-eps-investment',compact('permissionName'));
        }else{
            return abort(403);
        }
    }
    // ========================================================================================================================
    //                                                      ROUTE GET/POST "IFIN"
    // ========================================================================================================================
    public function getAuthenticateRevertDocAPI    (Request $request)
    {
        if(User::getPermission($request->permissionName, Auth::user()->email)){
            $permissionName = $request->permissionName;
            return view('wiss-sa-ifin-revert-doc',compact('permissionName'));
        }else{
            return abort(403);
        }
    }
    public function getAuthenticateRegisterAdminAPI    (Request $request)
    {
        if(User::getPermission($request->permissionName, Auth::user()->email)){
            $permissionName = $request->permissionName;
            return view('wiss-sa-ifin-register-admin',compact('permissionName'));
        }else{
            return abort(403);
        }
    }
    // ========================================================================================================================
    //                                                    ROUTE GET/POST "SA E-MFG"
    // ========================================================================================================================
    public function getAuthenticateAddShelfSAAPI(Request $request)
    {
        if(User::getPermission($request->permissionName, Auth::user()->email)){
            $permissionName = $request->permissionName;
            return view('wiss-sa-emfg-add-shelf',compact('permissionName'));
        }else{
            return abort(403);
        }
    }
    // ========================================================================================================================
    //                                                 ROUTE GET/POST "ATAC E-MFG"
    // ========================================================================================================================
    public function getAuthenticateAddModelATACAPI (Request $request)
    {
        if(User::getPermission($request->permissionName, Auth::user()->email)){
            $permissionName = $request->permissionName;
            return view('wiss-atac-emfg-add-model',compact('permissionName'));
        }else{
            return abort(403);
        }
    }
    public function getAuthenticateAddShelfATACAPI (Request $request)
    {
        if(User::getPermission($request->permissionName, Auth::user()->email)){
            $permissionName = $request->permissionName;
            return view('wiss-atac-emfg-add-shelf',compact('permissionName'));
        }else{
            return abort(403);
        }
    }
    public function getAuthenticateRevertShoppingATACAPI (Request $request)
    {
        if(User::getPermission($request->permissionName, Auth::user()->email)){
            $permissionName = $request->permissionName;
            return view('wiss-atac-emfg-revert-shopping-status',compact('permissionName'));
        }else{
            return abort(403);
        }
    }
    public function getAuthenticateCompletePklATACAPI (Request $request)
    {
        if(User::getPermission($request->permissionName, Auth::user()->email)){
            $permissionName = $request->permissionName;
            return view('wiss-atac-emfg-complete-pkl',compact('permissionName'));
        }else{
            return abort(403);
        }
    }
    public function getAuthenticateCompletePalletATACPI (Request $request)
    {
        if(User::getPermission($request->permissionName, Auth::user()->email)){
            $permissionName = $request->permissionName;
            return view('wiss-atac-emfg-create-pallet-data-from-shopping',compact('permissionName'));
        }else{
            return abort(403);
        }
    }
    // ========================================================================================================================
    //                                                    ROUTE GET/POST "Log"
    // ========================================================================================================================
    public function getAuthenticateLogUserAPI (Request $request)
    {
        if(User::getPermission($request->permissionName, Auth::user()->email)){
            $permissionName = $request->permissionName;
            return view('logs.usage-by-user',compact('permissionName'));
        }else{
            return abort(403);
        }
    }
    public function getAuthenticateLogFunctionAPI (Request $request)
    {
        if(User::getPermission($request->permissionName, Auth::user()->email)){
            $permissionName = $request->permissionName;
            return view('logs.usage-by-function',compact('permissionName'));
        }else{
            return abort(403);
        }
    }

    // ========================================================================================================================
    //                                                    ROUTE GET/POST "Deploy"
    // ========================================================================================================================
    public function getAuthenticateDeployAPI (Request $request)
    {
        if(User::getPermission($request->permissionName, Auth::user()->email)){
            $permissionName = $request->permissionName;
            return view('deploy-code',compact('permissionName'));
        }else{
            return abort(403);
        }
    }
}
