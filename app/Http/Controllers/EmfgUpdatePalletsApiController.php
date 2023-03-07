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
class EmfgUpdatePalletsApiController extends Controller
{

// ==========================================================================
// DECLARE END POINT
// ==========================================================================
    //private $ENDPOINT = 'http://localhost:8000/api/wiss_sa_ifin_get_doc_interface';
    private $ENDPOINT = 'http://10.100.1.94:8080/wissdemo01dev/public/api/wiss_atac_emfg_get_pallet';
// ==========================================================================
// GET DATA
// ==========================================================================
    function getData(Request $req)
    {
        $this->validate($req, [
            //'docNum' => 'required|size:10',
            'dateStart' => 'date_format:Y-m-d||nullable',
            'dateEnd' => 'date_format:Y-m-d||nullable',
            'docNum' => 'required',
            'maxRecord' => 'string||nullable'

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
        $optionValue = $req->input('docNum')??'empty';
        $error = "Not found this E-MFG pallet";
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
        $queryStr = "start_date=$dateStart&end_date=$dateEnd&pallet_code=$docNum&max_record=$maxRecord";
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
                     return view('wiss-atac-emfg-update-pallets', compact('result', 'keyArray', 'docNumRtv', 'dateStartRtv', 'dateEndRtv', 'maxRecordRtv', 'permissionName'));
                }else{
                    //need to return no data msg
                    $keyArray = [];
                }
            }
            //dd($keyArray);
            Log::insertLog(Auth::user()->id, $permissionID,'Search '.$permissionName.' '.$optionValue.' not found');
            return view('wiss-atac-emfg-get-pallets', compact('result', 'keyArray', 'docNumRtv', 'dateStartRtv', 'dateEndRtv', 'maxRecordRtv', 'permissionName','error'));
    }
    function update(Request $req)
    {
        // ======================================================================
        // GET DATA FROM VIEW
        // ======================================================================
        $req->validate([
            'PALLETCODE' =>  'required',
            'PALLETTYPE' =>  'required',
            'LASTSTORELOC' =>  'required',
            'LOCCODE' =>  'required',
            'ENABLE' =>  'required',
        ]);

            $PALLETCODE  [] = $req->input('PALLETCODE');
            $PALLETTYPE  [] = $req->input('PALLETTYPE');
            $LASTSTORELOC  [] = $req->input('LASTSTORELOC');
            $LOCCODE  [] = $req->input('LOCCODE');
            $ENABLE  [] = $req->input('ENABLE');

            $optionValue = "";
            $xml = new SimpleXMLElement("<?xml version='1.0'?><root></root>");
            for ($i = 0; $i < count($PALLETCODE[0]); $i++){
                $xmlRow = $xml->addChild("row");
                $xmlRow->addChild("palletcode",$PALLETCODE[0][$i]);
                // $xmlRow->addChild("PALLETTYPE"  ,$PALLETTYPE[0][$i]);
                // $xmlRow->addChild("LASTSTORELOC"  ,$LASTSTORELOC[0][$i]);
                // $xmlRow->addChild("LOCCODE"  ,$LOCCODE[0][$i]);
                $xmlRow->addChild("enable",$ENABLE[0][$i]);
                $optionValue .= $PALLETCODE[0][$i] . " ";
            }

            $xmlString = $xml->asXML();
            $xmlString = str_replace("<?xml version=\"1.0\"?>\n", '', $xmlString);
            $queryStr = str_replace("\n",'',$xmlString);

            $permissionName = $req->permissionAuth;
            $permissionID = UserPermission::getPermissionID($permissionName);
            $userName = Auth::user()->id;

            //dd($queryStr);
            // ======================================================================
            // CALL FUNCTION
            // ======================================================================
            try{
            $result = DB::connection('sqlsrv_atac_arisa_d02_db')->select("EXEC wiss_atac_emfg_maintain_pallets_xml @data = '$queryStr', @USERNAME = '$userName'");
            $result = json_encode($result);

            // ======================================================================
            // IF CALL SUCCCESS
            // ======================================================================
            if (isset($result)) {
                $resultRes  = json_decode($result, true);
                if(!empty($resultRes)){
                    $keyArrayRes = array_keys($resultRes[0]);
                     Log::insertLog(Auth::user()->id, $permissionID,'Update '.$permissionName.' '.$optionValue.' completed');
                    return view('wiss-atac-emfg-update-pallets', compact('resultRes','keyArrayRes','permissionName'));
                }
            }
            } catch (\Exception $e) {
                $error = $e->getMessage();
                Log::insertLog(Auth::user()->id, $permissionID,'Update '.$permissionName.' '.$optionValue.' not completed');
                return view('wiss-atac-emfg-update-pallets',compact('resultRes','keyArrayRes','permissionName','error'));
            }


    }


}
