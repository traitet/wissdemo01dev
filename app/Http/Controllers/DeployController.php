<?php

namespace App\Http\Controllers;

use App\Models\Log;
use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\UserPermission;

class DeployController extends Controller
{
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
    public function update(Request $request)
    {
        // ======================================================================
        // SET DATA WRITE LOG
        // ======================================================================
        $output = '';
        $permissionName = $request->permissionAuth;
        $permissionID = UserPermission::getPermissionID($permissionName);
        $optionValue = $request->input('comment') ?? '';
        // ======================================================================
        if ($optionValue != "") {
            $runCMD = 'c:\DeployWissdemo01dev.bat';
            $output = shell_exec($runCMD);
            Log::insertLog(Auth::user()->id, $permissionID, 'Deploy ' . $permissionName . ' ' . $optionValue . ' completed');
            return view('deploy-code', compact('output', 'permissionName'));
        } else {
            $output = 'Could not deploy ' . $optionValue .', Please fill deploy comment.';
            Log::insertLog(Auth::user()->id, $permissionID, 'Deploy ' . $permissionName . ' ' . $optionValue . ' failed');
            return view('deploy-code', compact('output', 'permissionName'));
        }
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
