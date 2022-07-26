<?php

namespace App\Http\Controllers;

use App\Models\Log;
use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\UserPermission;

class LogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getLogUser(Request $request)
    {
        $result = null;
        $docNum = null;
        // ======================================================================
    // SET DATA WRITE LOG
    // ======================================================================
    $permissionName = $request->permissionAuth;
    $permissionID = UserPermission::getPermissionID($permissionName);
    $optionValue = $request->input('docNum')??'User is empty';
// ======================================================================
        // ======================================================================
        // GET DATA AND WHERE CONDITION
        // ======================================================================
        $dateStart = str_replace('-', '', $request->input('dateStart') ?? '20220101');
        $dateEnd = str_replace('-', '', $request->input('dateEnd') ?? '20220101');
        $maxRecord = $request->input('maxRecord') ?? '10';
        $docNum = $request->input('docNum') ?? '';

        if ($docNum != "") {
            $result = log::join('permissions', 'logs.permission_id', '=', 'permissions.id')
                ->join('users', 'logs.emp_id', '=', 'users.id')
                ->join('navigation_items', 'permissions.navigation_item_id', '=', 'navigation_items.id')
                ->where('users.first_name', 'like', '%' . $docNum . '%')
                ->whereDate('logs.created_at', '>=', $dateStart)
                ->whereDate('logs.created_at', '<=', $dateEnd)
                ->orderBy('logs.created_at', 'desc')
                ->take($maxRecord)
                ->get(['logs.*', 'navigation_items.name', 'users.first_name', 'permissions.name as permission_name']);
        }

        // ======================================================================
        // SET DATA RETURN TO VIEW
        // ======================================================================
        $docNumRtv = $request->input('docNum');
        $dateStartRtv = $request->input('dateStart');
        $dateEndRtv = $request->input('dateEnd');
        $maxRecordRtv = $request->input('maxRecord');

        Log::insertLog(Auth::user()->id, $permissionID,'Search '.$permissionName.' '.$optionValue.' completed');
        return view('logs.usage-by-user', compact('result', 'docNumRtv', 'dateStartRtv', 'dateEndRtv', 'maxRecordRtv','permissionName'));
    }

    public function getLogFunction(Request $request)
    {
        $result = null;
        $permissionID = null;
        // ======================================================================
    // SET DATA WRITE LOG
    // ======================================================================
    $permissionName = $request->permissionAuth;
    $permissionID = UserPermission::getPermissionID($permissionName);
    $optionValue = $request->input('docNum')??'Function is empty';
// ======================================================================
        // ======================================================================
        // GET DATA AND WHERE CONDITION
        // ======================================================================
        $dateStart = str_replace('-', '', $request->input('dateStart') ?? '20220101');
        $dateEnd = str_replace('-', '', $request->input('dateEnd') ?? '20220101');
        $maxRecord = $request->input('maxRecord') ?? '10';
        $permissionID = $request->input('permissionID') ?? '';

        if ($permissionID != "") {
            $result = log::join('permissions', 'logs.permission_id', '=', 'permissions.id')
                ->join('users', 'logs.emp_id', '=', 'users.id')
                ->join('navigation_items', 'permissions.navigation_item_id', '=', 'navigation_items.id')
                ->where('permissions.id', '=', $permissionID)
                ->whereDate('logs.created_at', '>=', $dateStart)
                ->whereDate('logs.created_at', '<=', $dateEnd)
                ->orderBy('logs.created_at', 'desc')
                ->take($maxRecord)
                ->get(['logs.*', 'navigation_items.name', 'users.first_name', 'permissions.name as permission_name']);
        }

        // ======================================================================
        // SET DATA RETURN TO VIEW
        // ======================================================================
        $docNumRtv = $request->input('docNum');
        $dateStartRtv = $request->input('dateStart');
        $dateEndRtv = $request->input('dateEnd');
        $permissionID = $request->input('permissionID');
        Log::insertLog(Auth::user()->id, $permissionID,'Search '.$permissionName.' '.$optionValue.' completed');
        return view('logs.usage-by-function', compact('result', 'docNumRtv', 'dateStartRtv', 'dateEndRtv', 'permissionID','permissionName'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Log  $log
     * @return \Illuminate\Http\Response
     */
    public function show(Log $log)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Log  $log
     * @return \Illuminate\Http\Response
     */
    public function edit(Log $log)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Log  $log
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Log $log)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Log  $log
     * @return \Illuminate\Http\Response
     */
    public function destroy(Log $log)
    {
        //
    }
}
