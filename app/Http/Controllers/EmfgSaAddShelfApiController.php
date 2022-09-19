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
// CLASS DECLARATION
// ==========================================================================
class EmfgSaAddShelfApiController extends Controller
{

// ==========================================================================
// DECLARE END POINT
// ==========================================================================
    private $ENDPOINT = 'http://10.100.1.94:8080/wissdemo01/public/api/wiss_sa_emfg_add_shelf';

// ==========================================================================
// GET DATA
// ==========================================================================
    function getData(Request $req)
    {
        $this->validate($req, [
            'slocCode' => 'string||nullable',
            'shelfName' => 'string||nullable',
            'shelfCode' => 'string||nullable'
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
    $optionValue = $req->input('slocCode')??'slocCode is empty' . $req->input('shelfName')??', shelfName is empty';
    // ======================================================================
        // ==========================================================================
        // CHECK INPUT IF NOT EMPTY
        // ==========================================================================
            // ======================================================================
            // GET DATA
            // ======================================================================
            $slocCode = $req->input('slocCode')??'';
            $shelfName = $req->input('shelfName')??'';
            $shelfCode = $req->input('shelfCode')??'';
            $queryStr = "sloc_code=$slocCode&shelf_name=$shelfName&shelf_code=$shelfCode";

            // ======================================================================
            // CALL API
            // ======================================================================
            $url = $this->ENDPOINT . $api ."/". $queryStr;
            $response = Http::get($url);
            error_log($url);
            // ======================================================================
            // IF CALL SUCCCESS
            // ======================================================================
            if ($response->status() == 200) {
                $result = json_decode($response->body(), true);
                if(!empty($result)){
                    $keyArray = array_keys($result[0]);
                    Log::insertLog(Auth::user()->id, $permissionID,'Insert '.$permissionName.' '.$optionValue.' completed');
                    return view('wiss-sa-emfg-add-shelf', compact('result', 'keyArray','permissionName'));
                }else{
                    //need to return no data msg
                    $keyArray = [];
                }
            }
            Log::insertLog(Auth::user()->id, $permissionID,'Insert '.$permissionName.' '.$optionValue.' failed');
            return view('wiss-sa-emfg-add-shelf', compact('permissionName'));
    }
}
