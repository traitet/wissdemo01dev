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
class IbgUpdateInfScheduleApiController extends Controller
{

// ==========================================================================
// DECLARE END POINT
// ==========================================================================
    private $ENDPOINT = 'http://10.100.1.94:8080/wissdemo01/public/api/wiss_sa_ibg_update_inf_schedule';

// ==========================================================================
// GET DATA
// ==========================================================================
    function getData(Request $req)
    {
        $this->validate($req, [
            'year' => 'string||nullable',
            'period' => 'string||nullable',
            'infDate' => 'date_format:Y-m-d||nullable',
            'infTime' => 'string||nullable'
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
            $year = $req->input('year')??'';
            $period = $req->input('period')??'';
            $infDate = str_replace('-','',$req->input('infDate')??'20220202');
            $infTime = $req->input('infTime')??'';
            $queryStr = "fiscal_year=$year&period=$period&inf_date=$infDate&inf_time=$infTime";

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
                    return view('wiss-sa-ibg-update-inf-schedule', compact('result', 'keyArray'));
                }else{
                    //need to return no data msg
                    $keyArray = [];
                }
            }
            return view('wiss-sa-ibg-update-inf-schedule');
    }
}
