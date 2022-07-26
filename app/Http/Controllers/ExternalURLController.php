<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\NavigationItem;
use App\Models\User;
use App\Models\Log;
use App\Models\UserPermission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class ExternalURLController extends Controller
{
    public function showatgn(Request $request)
    {
        // ======================================================================
            // SET DATA WRITE LOG
            // ======================================================================
            $permissionName = $request->permissionName;
            $permissionID = UserPermission::getPermissionID($permissionName);
        // ======================================================================
        if(User::getPermission($request->permissionName, Auth::user()->email)){
            Log::insertLog(Auth::user()->id, $permissionID,'Access to '.$permissionName.' web portal completed');
            return redirect()->away('https://atgn-th.sdwan.kddi.com/');
        }else{
            Log::insertLog(Auth::user()->id, $permissionID,'Access to '.$permissionName.' web portal failed (No authorization)');
            return abort(403);
        }
    }

    public function showzabbix(Request $request)
    {
        // ======================================================================
            // SET DATA WRITE LOG
            // ======================================================================
            $permissionName = $request->permissionName;
            $permissionID = UserPermission::getPermissionID($permissionName);
        // ======================================================================
        if(User::getPermission($request->permissionName, Auth::user()->email)){
            Log::insertLog(Auth::user()->id, $permissionID,'Access to '.$permissionName.' web portal completed');
            return redirect()->away('https://zabbix.atgn-monitor.net/zabbix/');
        }else{
            Log::insertLog(Auth::user()->id, $permissionID,'Access to '.$permissionName.' web portal failed (No authorization)');
            return abort(403);
        }
    }

    public function showsolarwinds(Request $request)
    {
        // ======================================================================
            // SET DATA WRITE LOG
            // ======================================================================
            $permissionName = $request->permissionName;
            $permissionID = UserPermission::getPermissionID($permissionName);
        // ======================================================================
        if(User::getPermission($request->permissionName, Auth::user()->email)){
            Log::insertLog(Auth::user()->id, $permissionID,'Access to '.$permissionName.' web portal completed');
            return redirect()->away('https://10.122.242.248/Orion/Login.aspx');
        }else{
            Log::insertLog(Auth::user()->id, $permissionID,'Access to '.$permissionName.' web portal failed (No authorization)');
            return abort(403);
        }
    }

    public function shownagios(Request $request)
    {
        // ======================================================================
            // SET DATA WRITE LOG
            // ======================================================================
            $permissionName = $request->permissionName;
            $permissionID = UserPermission::getPermissionID($permissionName);
        // ======================================================================
        if(User::getPermission($request->permissionName, Auth::user()->email)){
            Log::insertLog(Auth::user()->id, $permissionID,'Access to '.$permissionName.' web portal completed');
            return redirect()->away('https://bnmonitor.leapsolutions.co.th/nagiosxi/login.php');
        }else{
            Log::insertLog(Auth::user()->id, $permissionID,'Access to '.$permissionName.' web portal failed (No authorization)');
            return abort(403);
        }
    }

}
