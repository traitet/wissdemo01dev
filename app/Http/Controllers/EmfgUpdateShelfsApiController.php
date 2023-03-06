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
class EmfgUpdateShelfsApiController extends Controller
{

// ==========================================================================
// DECLARE END POINT
// ==========================================================================
    //private $ENDPOINT = 'http://localhost:8000/api/wiss_sa_ifin_get_doc_interface';
    private $ENDPOINT = 'http://10.100.1.94:8080/wissdemo01dev/public/api/wiss_atac_emfg_get_shelf';
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
        $error = "Not found this E-MFG shelf";
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
        $queryStr = "start_date=$dateStart&end_date=$dateEnd&doc_num=$docNum&max_record=$maxRecord";
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
                     return view('wiss-atac-emfg-update-shelfs', compact('result', 'keyArray', 'docNumRtv', 'dateStartRtv', 'dateEndRtv', 'maxRecordRtv', 'permissionName'));
                }else{
                    //need to return no data msg
                    $keyArray = [];
                }
            }
            //dd($keyArray);
            Log::insertLog(Auth::user()->id, $permissionID,'Search '.$permissionName.' '.$optionValue.' not found');
            return view('wiss-atac-emfg-get-shelfs', compact('result', 'keyArray', 'docNumRtv', 'dateStartRtv', 'dateEndRtv', 'maxRecordRtv', 'permissionName','error'));
    }
    function update(Request $req)
    {
        // ======================================================================
        // GET DATA FROM VIEW
        // ======================================================================
        $req->validate([
            'SHELFCODE' =>  'required',
            'SHELFNAME' =>  'required',
            'SLOCCODE' =>  'required',
            'BOXBALANCE' =>  'required',
            'BOXMAX' =>  'required',
            'BOXMIN' =>  'required',
            'BOXTOTAL' =>  'required',
            'PCSBALANCE' =>  'required',
            'PCSMAX' =>  'required',
            'DESCRIPTION' =>  'required',
            'COMPCODE' =>  'required',
            'PLANTCODE' =>  'required',
            'STATUS' =>  'required',
            'ENABLE' =>  'required',

        ]);

            $SHELFCODE[] = $req->input('SHELFCODE');
            $SHELFNAME[] = $req->input('SHELFNAME');
            $SLOCCODE[] = $req->input('SLOCCODE');
            $BOXBALANCE[] = $req->input('BOXBALANCE');
            $BOXMAX[] = $req->input('BOXMAX');
            $BOXMIN[] = $req->input('BOXMIN');
            $BOXTOTAL[] = $req->input('BOXTOTAL');
            $PCSBALANCE[] = $req->input('PCSBALANCE');
            $PCSMAX[] = $req->input('PCSMAX');
            $DESCRIPTION[] = $req->input('DESCRIPTION');
            $COMPCODE[] = $req->input('COMPCODE');
            $PLANTCODE[] = $req->input('PLANTCODE');
            $STATUS[] = $req->input('STATUS');
            $ENABLE[] = $req->input('ENABLE');



            $optionValue = "";
            $xml = new SimpleXMLElement("<?xml version='1.0'?><root></root>");
            for ($i = 0; $i < count($SHELFCODE[0]); $i++){
                $xmlRow = $xml->addChild("row");
                $xmlRow->addChild("SHELFCODE",$SHELFCODE[0][$i]);
                $xmlRow->addChild("SHELFNAME",$SHELFNAME[0][$i]);
                $xmlRow->addChild("SLOCCODE",$SLOCCODE[0][$i]);
                $xmlRow->addChild("BOXBALANCE",$BOXBALANCE[0][$i]);
                $xmlRow->addChild("BOXMAX",$BOXMAX[0][$i]);
                $xmlRow->addChild("BOXMIN",$BOXMIN[0][$i]);
                $xmlRow->addChild("BOXTOTAL",$BOXTOTAL[0][$i]);
                $xmlRow->addChild("PCSBALANCE",$PCSBALANCE[0][$i]);
                $xmlRow->addChild("PCSMAX",$PCSMAX[0][$i]);
                $xmlRow->addChild("DESCRIPTION",$DESCRIPTION[0][$i]);
                $xmlRow->addChild("COMPCODE",$COMPCODE[0][$i]);
                $xmlRow->addChild("PLANTCODE",$PLANTCODE[0][$i]);
                $xmlRow->addChild("STATUS",$STATUS[0][$i]);
                $xmlRow->addChild("ENABLE",$ENABLE[0][$i]);
                $optionValue .= $SHELFCODE[0][$i] . " ";
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
            $result = DB::connection('sqlsrv_atac_arisa_d02_db')->select("EXEC wiss_atac_emfg_maintain_shelf_xml @data = '$queryStr', @USERNAME = '$userName'");
            $result = json_encode($result);

            // ======================================================================
            // IF CALL SUCCCESS
            // ======================================================================
            if (isset($result)) {
                $resultRes  = json_decode($result, true);
                if(!empty($resultRes)){
                    $keyArrayRes = array_keys($resultRes[0]);
                     Log::insertLog(Auth::user()->id, $permissionID,'Update '.$permissionName.' '.$optionValue.' completed');
                    return view('wiss-atac-emfg-update-shelfs', compact('resultRes','keyArrayRes','permissionName'));
                }
            }
            } catch (\Exception $e) {
                $error = $e->getMessage();
                Log::insertLog(Auth::user()->id, $permissionID,'Update '.$permissionName.' '.$optionValue.' not completed');
                return view('wiss-atac-emfg-update-shelfs',compact('resultRes','keyArrayRes','permissionName','error'));
            }


    }


}
