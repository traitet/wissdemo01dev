<?php

namespace App\Http\Controllers;

use App\Models\Log;
use Illuminate\Http\Request;

class LogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
         // ======================================================================
        // GET DATA
        // ======================================================================
            $dateStart = str_replace('-','',$request->input('dateStart')??'20220101');
            $dateEnd = str_replace('-','',$request->input('dateEnd')??'20220101');
            $maxRecord = $request->input('maxRecord')??'10';
            $docNum = $request->input('docNum')??'';

        $result = log::join('permissions', 'logs.permission_id', '=', 'permissions.id')
            ->orderBy('logs.id', 'asc')
            ->get(['logs.*', 'permissions.name as permission_name']);


        // ======================================================================
        // SET DATA RETURN TO VIEW
        // ======================================================================
            $docNumRtv = $request->input('docNum');
            $dateStartRtv = $request->input('dateStart');
            $dateEndRtv = $request->input('dateEnd');
            $maxRecordRtv = $request->input('maxRecord');


        return view('logs.usage-by-user', compact('result','docNumRtv','dateStartRtv','dateEndRtv','maxRecordRtv'));
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
