<?php

namespace App\Http\Controllers;

// ==========================================================================
// IMPORT
// ==========================================================================
use Facade\FlareClient\View;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use App\Models\Log;
use App\Models\UserPermission;

// ==========================================================================
// CLASS DECLARATION 04/02/2022
// ==========================================================================
class InterfaceSapPoApiController extends Controller
{

    // ==========================================================================
    // DECLARE END POINT
    // ==========================================================================
    private $ENDPOINT = 'http://10.100.1.94:8080/wissdemo01/public/api/interface_sap_po_obj';

    // ==========================================================================
    // GET DATA
    // ==========================================================================
    function getData(Request $req)
    {
        $this->validate($req, [
            'dateStart' => 'date_format:Y-m-d||nullable',
            'dateEnd' => 'date_format:Y-m-d||nullable',
            'docNum' => 'string||nullable'
        ]);
        // ==========================================================================
        // API NAME
        // ==========================================================================
        $api = '';

        // ======================================================================
        // SET DATA WRITE LOG
        // ======================================================================
        $permissionName = $req->permissionAuth;
        $permissionID = UserPermission::getPermissionID($permissionName);
        $optionValue = $req->input('docNum') ?? 'empty';
        // =========================================================
        // ==========================================================================
        // CHECK INPUT IF NOT EMPTY
        // ==========================================================================
        // ======================================================================
        // SET DATA RETURN TO VIEW
        // ======================================================================
        $docNumRtv = $req->input('docNum');
        $dateStartRtv = $req->input('dateStart');
        $dateEndRtv = $req->input('dateEnd');
        $maxRecordRtv = $req->input('maxRecord');
        // ======================================================================
        // GET DATA
        // ======================================================================
        $dateStart = str_replace('-', '', $req->input('dateStart') ?? '20220101');
        $dateEnd = str_replace('-', '', $req->input('dateEnd') ?? '20220101');
        $maxRecord = $req->input('maxRecord') ?? '10';
        $docNum = $req->input('docNum') ?? '';
        $queryStr = "doc_num=$docNum&start_date=$dateStart&end_date=$dateEnd&max_record=$maxRecord";


        // ======================================================================
        // CALL API
        // ======================================================================
        $url = $this->ENDPOINT . $api . "/" . $queryStr;
        $response = Http::get($url);
        //error_log($url);
        // ======================================================================
        // IF CALL SUCCCESS
        // ======================================================================
        if ($response->status() == 200) {
            $result = json_decode($response->body(), true);

            if (!empty($result)) {
                $keyArray = array_keys($result[0]);
                Log::insertLog(Auth::user()->id, $permissionID, 'Search ' . $permissionName . ' ' . $optionValue . ' completed');
                return view('interface-sap-po', compact('result', 'keyArray', 'docNumRtv', 'dateStartRtv', 'dateEndRtv', 'maxRecordRtv', 'permissionName'));
            } else {
                //need to return no data msg
                $keyArray = [];
            }
        }
        Log::insertLog(Auth::user()->id, $permissionID, 'Search ' . $permissionName . ' ' . $optionValue . ' not found');
        return view('interface-sap-po', compact('result', 'keyArray', 'docNumRtv', 'dateStartRtv', 'dateEndRtv', 'maxRecordRtv', 'permissionName'));
    }
}
