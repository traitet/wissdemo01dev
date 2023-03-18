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
use Illuminate\Support\facades\DB;

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
            'docNum' => 'required|size:10',
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
            $error = "Not found this SAP document";
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
            return view('ifin-get-doc-interface',compact('docNumRtv','permissionName','error'));
    }
    function update(Request $req)
    {

        // ======================================================================
        // GET DATA FROM VIEW
        // ======================================================================
        $req->validate([
            'sapDoc' => 'required',
        ]);

            $docId[] = $req->input('docId');
            $sapDoc[] = $req->input('sapDoc');

            $optionValue = "";
            $xml = new SimpleXMLElement("<?xml version='1.0'?><root></root>");
            for ($i = 0; $i < count($docId[0]); $i++){
                $xmlRow = $xml->addChild("row");
                $xmlRow->addChild("id", $docId[0][$i]);
                $xmlRow->addChild("docsap", $sapDoc[0][$i]);
                $optionValue .= $docId[0][$i] . " ";
            }

            $xmlString = $xml->asXML();
            $xmlString = str_replace("<?xml version=\"1.0\"?>\n", '', $xmlString);
            $queryStr = str_replace("\n",'',$xmlString);

            //dd($queryStr);
            $permissionName = $req->permissionAuth;
            $permissionID = UserPermission::getPermissionID($permissionName);
            // ======================================================================
            // CALL FUNCTION
            // ======================================================================
            try{
            $result = DB::connection('sqlsrv_siam_laser_d01_db')->select("EXEC wiss_sa_ifin_update_doc_sap @data = '$queryStr'");
            $result = json_encode($result);

            // ======================================================================
            // IF CALL SUCCCESS
            // ======================================================================
            if (isset($result)) {
                $resultRes  = json_decode($result, true);
                if(!empty($resultRes)){
                    $keyArrayRes = array_keys($resultRes[0]);
                     Log::insertLog(Auth::user()->id, $permissionID,'Search '.$permissionName.' '.$optionValue.' completed');
                    return view('ifin-update-doc-interface', compact('resultRes','keyArrayRes','permissionName'));
                }
            }
            } catch (\Exception $e) {
                $error = $e->getMessage();
                Log::insertLog(Auth::user()->id, $permissionID,'Search '.$permissionName.' '.$optionValue.' not found');
                return view('ifin-update-doc-interface',compact('resultRes','keyArrayRes','permissionName','error'));
            }

    }


}
