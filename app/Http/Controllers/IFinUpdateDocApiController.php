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
use SimpleXMLElement;

// ==========================================================================
// CLASS DECLARATION
// ==========================================================================
class IFinUpdateDocApiController extends Controller
{

// ==========================================================================
// DECLARE END POINT
// ==========================================================================
    //private $ENDPOINT = 'http://localhost:8000/api/wiss_sa_ifin_get_doc_interface';
    private $ENDPOINT = 'http://10.100.1.94:8080/wissdemo01dev/public/api/wiss_sa_ifin_get_doc_interface';
    private $ENDPOINT2 = 'http://10.100.1.94:8080/wissdemo01dev/public/api/wiss_sa_ifin_update_doc_interface';
// ==========================================================================
// GET DATA
// ==========================================================================
    function getData(Request $req)
    {
        // $this->validate($req, [
        //     'docNum' => 'string||nullable'
        // ]);
        $req->validate([
            'docNum' => 'required',
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
            $permissionName = $req->permissionAuth;
            $permissionID = UserPermission::getPermissionID($permissionName);
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
                     Log::insertLog(Auth::user()->id, $permissionID,'Search '.$permissionName.' '.$optionValue.' completed');
                    return view('ifin-update-doc-interface', compact('result', 'keyArray','docNumRtv','permissionName'));
                }else{
                    //need to return no data msg
                    $keyArray = [];
                }
            }
            //dd($keyArray);
            Log::insertLog(Auth::user()->id, $permissionID,'Search '.$permissionName.' '.$optionValue.' not found');
            return view('ifin-update-doc-interface',compact('result', 'keyArray','docNumRtv','permissionName'));
    }
    function update(Request $req)
    {

        // ======================================================================
        // GET DATA FROM VIEW
        // ======================================================================
            $docId[] = $req->input('docId');
            $sapDoc[] = $req->input('sapdoc');

            $xml = new SimpleXMLElement("<?xml version='1.0'?><root></root>");
            for ($i = 0; $i < count($docId[0]); $i++){
                $xmlRow = $xml->addChild("row");
                $xmlRow->addChild("id", $docId[0][$i]);
                $xmlRow->addChild("sapdoc", $sapDoc[0][$i]);
            }

            $xmlString = $xml->asXML();
            $xmlString = str_replace("<?xml version=\"1.0\"?>\n", '', $xmlString);
            $queryStr = "data=".str_replace("\n",'',$xmlString);
            //$queryStr = "data=".$xmlString;
            // ======================================================================
            // CALL API
            // ======================================================================
            $url = $this->ENDPOINT2 ."/". $queryStr;
            dd($url);
            $response = Http::get($url);
            //dd($url);
            // ======================================================================
            // IF CALL SUCCCESS
            // ======================================================================
            if ($response->status() == 200) {
                $resultRes = json_decode($response->body(), true);
                if(!empty($resultRes)){
                    $keyArrayRes = array_keys($resultRes[0]);
                     //Log::insertLog(Auth::user()->id, $permissionID,'Search '.$permissionName.' '.$optionValue.' completed');
                    return view('ifin-update-doc-interface', compact('resultRes', 'keyArrayRes','permissionName'));
                }else{
                    //need to return no data msg
                    $keyArrayRes = [];
                }
            }
            dd($response->status());
            //Log::insertLog(Auth::user()->id, $permissionID,'Search '.$permissionName.' '.$optionValue.' not found');
            return view('ifin-update-doc-interface',compact('resultRes', 'keyArrayRes','permissionName'));

    }


}
