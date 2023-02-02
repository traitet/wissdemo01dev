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
class IFinUpdateDocApiController extends Controller
{

// ==========================================================================
// DECLARE END POINT
// ==========================================================================
    //private $ENDPOINT = 'http://localhost:8000/api/wiss_sa_ifin_get_doc_interface';
    private $ENDPOINT = 'http://10.100.1.94:8080/wissdemo01/public/api/wiss_sa_ifin_get_doc_interface';
// ==========================================================================
// GET DATA
// ==========================================================================
    function getData(Request $req)
    {
        $this->validate($req, [
            'docNum' => 'string||nullable'
        ]);
        // ==========================================================================
        // API NAME
        // ==========================================================================
        $api = '';
        // ======================================================================
            // SET DATA RETURN TO VIEW
            // ======================================================================
            $docNumRtv = $req->input('docNum');

        // ======================================================================
            // SET DATA WRITE LOG
            // ======================================================================
            //$permissionName = $req->permissionAuth;
            //$permissionID = UserPermission::getPermissionID($permissionName);
            $optionValue = $req->input('docNum')??'empty';
        // ==========================================================================
        // CHECK INPUT IF NOT EMPTY
        // ==========================================================================
            // ======================================================================
            // GET DATA
            // ======================================================================
            $docNum = $req->input('docNum')??'';
            $queryStr = "doc_num=$docNum";
            // ======================================================================
            // CALL API
            // ======================================================================
            $url = $this->ENDPOINT . $api ."/". $queryStr;
            //dd($url);
            $response = Http::get($url);
            //dd($url);
            // ======================================================================
            // IF CALL SUCCCESS
            // ======================================================================
            if ($response->status() == 200) {
                $result = json_decode($response->body(), true);
                if(!empty($result)){
                    $keyArray = array_keys($result[0]);
                     //Log::insertLog(Auth::user()->id, $permissionID,'Search '.$permissionName.' '.$optionValue.' completed');
                    return view('ifin-get-doc-interface', compact('result', 'keyArray','docNumRtv'));
                }else{
                    //need to return no data msg
                    $keyArray = [];
                }
            }
            dd($keyArray);
            //Log::insertLog(Auth::user()->id, $permissionID,'Search '.$permissionName.' '.$optionValue.' not found');
            return view('ifin-get-doc-interface',compact('result', 'keyArray','docNumRtv'));
    }
}
