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
class MainController extends Controller
{

// ==========================================================================
// DECLARE END POINT
// ==========================================================================
    private $ENDPOINT = 'http://10.100.1.94/wiss-api';

// ==========================================================================
// GET DATA
// ==========================================================================
    function getData(Request $req)
    {
        $this->validate($req, [
            'dateStart' => 'date_format:Y-m-d||nullable',
            'dateEnd' => 'date_format:Y-m-d||nullable',
            'pdsNo' => 'string||nullable'
        ]);
        $api = '';


// ==========================================================================
// CHECK INPUT IF NOT EMPTY
// ==========================================================================
        if (!empty($req->input('dateStart')) || !empty($req->input('dateEnd')) || !empty($req->input('pdsNo'))) {

// ==========================================================================
// GET DATA
// ==========================================================================
            $dateStart = $req->input('dateStart');
            $dateEnd = $req->input('dateEnd');
            $pdsNo = $req->input('pdsNo');
            // $reportType[] = $req->input('typeOKNG');
            // $reportType[] = $req->input('typeErrorEvent');

            // ==========================================================================
// CHECK REPORT TYPE "typeOKNG"
// ==========================================================================
            if (!empty($req->input('typeOKNG'))) {
                foreach ($req->input('typeOKNG') as $value) {
                    $reportType[] = $value;
                }
            }

// ==========================================================================
// CHECK REPORT TYPE "typeErrorEvent"
// ==========================================================================
            if (!empty($req->input('typeErrorEvent'))) {
                foreach ($req->input('typeErrorEvent') as $value) {
                    $reportType[] = $value;
                }
            }
// ==========================================================================
// CHECK REPORT TYPE
// ==========================================================================
            if (!empty($reportType)) {
                foreach ($reportType as $data) {
                    switch ($data) {
                        case 'OK':
                            $api = '/OkLog';
                            break;
                        case 'NG':
                            $api = '/NgLog';
                            break;
                        case 'Error':
                            $api = '/ErrorLog';
                            break;
                        case 'Event':
                            $api = '/EventLog';
                            break;
                    }
                }
            }

// ==========================================================================
// CALL API
// ==========================================================================
            $url = $this->ENDPOINT . $api ."/". $pdsNo;
            // echo $url;
            $response = Http::get($url);
            // $response = Http::get($this->ENDPOINT . '/EventLog/1S%20SRCTBS1A4046');
// ==========================================================================
// IF CALL SUCCCESS
// ==========================================================================
            if ($response->status() == 200) {

                $result = json_decode($response->body(), true);
                if(!empty($result)){
                    $keyArray = array_keys($result[0]);
                }else{
                    //need to return no data msg
                    $keyArray = [];
                }
            }
        }
// ==========================================================================
// RETURN VIEW
// ==========================================================================
        return view('main', compact('result', 'keyArray'));
    }
}
