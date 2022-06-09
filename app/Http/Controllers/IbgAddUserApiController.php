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

// ==========================================================================
// CLASS DECLARATION
// ==========================================================================
class IbgAddUserApiController extends Controller
{

// ==========================================================================
// DECLARE END POINT
// ==========================================================================
    private $ENDPOINT = 'http://10.100.1.94:8080/wissdemo01/public/api/wiss_sa_add_ibg_user';

// ==========================================================================
// GET DATA
// ==========================================================================
    function getData(Request $req)
    {
        $this->validate($req, [
            'empId' => 'string||nullable',
            'userName' => 'string||nullable',
            'firstName' => 'string||nullable',
            'surName' => 'string||nullable',
            'level' => 'string||nullable',
            'sectId' => 'string||nullable',
            'eMail' => 'string||nullable',
            'userRole' => 'string||nullable'
        ]);
        // ==========================================================================
        // API NAME
        // ==========================================================================
        $api = '';


        // ==========================================================================
        // CHECK INPUT IF NOT EMPTY
        // ==========================================================================
            // ======================================================================
            // GET DATA
            // ======================================================================
            $empId = $req->input('empId')??'';
            $userName = $req->input('userName')??'';
            $firstName = $req->input('firstName')??'';
            $surName = $req->input('surName')??'';
            $level = $req->input('level')??'';
            $sectId = $req->input('sectId')??'';
            $eMail = $req->input('eMail')??'';
            $userRole = $req->input('userRole')??'';
            $queryStr = "emp_id=$empId&username=$userName&name=$firstName&surname=$surName&level=$level&sect_id=$sectId&email=$eMail&role=$userRole";

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
                    return view('wiss-sa-add-ibg-user', compact('result', 'keyArray'));
                }else{
                    //need to return no data msg
                    $keyArray = [];
                }
            }
            return view('wiss-sa-add-ibg-user');
    }
}
