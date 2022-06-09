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
class EmfgCompletePKLApiController extends Controller
{

// ==========================================================================
// DECLARE END POINT
// ==========================================================================
    private $ENDPOINT = 'http://10.100.1.94:8080/wissdemo01/public/api/wiss_atac_emfg_complete_pkl';

// ==========================================================================
// GET DATA
// ==========================================================================
    function getData(Request $req)
    {
        $this->validate($req, [
            'pickingList' => 'string||nullable',
            'palletNumber' => 'string||nullable'
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
            $pickingList = $req->input('pickingList')??'';
            $palletNumber = $req->input('palletNumber')??'';
            $queryStr = "picking_list_num=$pickingList&pallet_Number=$palletNumber";

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
                    return view('wiss-atac-emfg-complete-pkl', compact('result', 'keyArray'));
                }else{
                    //need to return no data msg
                    $keyArray = [];
                }
            }
            return view('wiss-atac-emfg-complete-pkl');
    }
}
