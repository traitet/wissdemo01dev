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
class EpsIssuePrApiController extends Controller
{

// ==========================================================================
// DECLARE END POINT
// ==========================================================================
    private $ENDPOINT = 'http://10.100.1.94:8080/wissdemo01/public/api/wiss_fix_issue_pr_not_complete';

// ==========================================================================
// GET DATA
// ==========================================================================
    function getData(Request $req)
    {
        $validateMessage = $this->validate($req, [
            'prNumber' => 'required',
            'prComment' => 'required'
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
            $optionValue = $req->input('prNumber')??'prNumber is empty';
        // ======================================================================
        // ==========================================================================
        // CHECK INPUT IF NOT EMPTY
        // ==========================================================================
            // ======================================================================
            // SET DATA RETURN TO VIEW
            // ======================================================================
            $prNumberRtv = $req->input('prNumber');
            $prCommentRtv = $req->input('prComment');
            // ======================================================================
            // GET DATA
            // ======================================================================
            $prNumber = $req->input('prNumber')??'';
            $prComment = $req->input('prComment')??'';

            $queryStr = "doc_num=$prNumber&comment=$prComment";

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
                    return view('wiss-sa-issue-pr', compact('result', 'keyArray','permissionName','prNumberRtv','prCommentRtv'));
                }else{
                    //need to return no data msg
                    $keyArray = [];
                }
            }
            Log::insertLog(Auth::user()->id, $permissionID,'Insert '.$permissionName.' '.$optionValue.' failed');
            return view('wiss-sa-issue-pr', compact('permissionName','prNumberRtv','prCommentRtv'))->with('error',$validateMessage());
    }
}
