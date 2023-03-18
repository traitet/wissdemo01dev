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
            //'docNum' => 'required',
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
            $userName = Auth::user()->name;

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
    } // END FUNCTION UPDATE
    public function importExcel(Request $request)
    {
        if(!empty($request->file('import_excel'))){
            $allowedFileType = [
                'application/vnd.ms-excel',
                'text/xls',
                'text/xlsx',
                'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
            ];

            if (in_array($request->file('import_excel')->getMimeType(), $allowedFileType)) {
                $file = $request->file('import_excel');
                $Reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();

                $spreadSheet = $Reader->load($file);
                $excelSheet = $spreadSheet->getActiveSheet();
                //00 = A1 , 01 = B1 , 02 = C1
                //10 = A2 , 11 = B2 , 12 = C2
                $spreadSheetAry = $excelSheet->toArray();
                $rowCount = count($spreadSheetAry);//จำนวน row
                $columnCount = count($spreadSheetAry[0]); //จำนวน column

                $optionValue = $file;
                $permissionName = $request->permissionAuth;
                $permissionID = UserPermission::getPermissionID($permissionName);
                $userName = Auth::user()->name;

                //VALIDATE INTERNAL FILE
                if(($columnCount > 14) || empty($spreadSheetAry[0][0]) || ($spreadSheetAry[0][0] <> "SHELFCODE")
                || empty($spreadSheetAry[0][1]) || ($spreadSheetAry[0][1] <> "SHELFNAME")
                || empty($spreadSheetAry[0][2]) || ($spreadSheetAry[0][2] <> "SLOCCODE")
                || empty($spreadSheetAry[0][3]) || ($spreadSheetAry[0][3] <> "BOXBALANCE")
                || empty($spreadSheetAry[0][4]) || ($spreadSheetAry[0][4] <> "BOXMAX")
                || empty($spreadSheetAry[0][5]) || ($spreadSheetAry[0][5] <> "BOXMIN")
                || empty($spreadSheetAry[0][6]) || ($spreadSheetAry[0][6] <> "BOXTOTAL")
                || empty($spreadSheetAry[0][7]) || ($spreadSheetAry[0][7] <> "PCSBALANCE")
                || empty($spreadSheetAry[0][8]) || ($spreadSheetAry[0][8] <> "PCSMAX")
                || empty($spreadSheetAry[0][9]) || ($spreadSheetAry[0][9] <> "DESCRIPTION")
                || empty($spreadSheetAry[0][10]) || ($spreadSheetAry[0][10] <> "COMPCODE")
                || empty($spreadSheetAry[0][11]) || ($spreadSheetAry[0][11] <> "PLANTCODE")
                || empty($spreadSheetAry[0][12]) || ($spreadSheetAry[0][12] <> "STATUS")
                || empty($spreadSheetAry[0][13]) || ($spreadSheetAry[0][13] <> "ENABLE")){
                    $error = "Excel template incorrect!";
                    Log::insertLog(Auth::user()->id, $permissionID,'Update '.$permissionName.' '.$optionValue.' not completed');
                    return view('wiss-atac-emfg-update-shelfs',compact('permissionName','error'));
                }else{
                    $xml = new SimpleXMLElement("<?xml version='1.0'?><root></root>");

                    for ($row = 1; $row <= $rowCount-1; $row ++) {//start row 2
                        $column = 0;
                        if(empty($spreadSheetAry[$row][$column]) || empty($spreadSheetAry[$row][$column+1]) || !is_numeric($spreadSheetAry[$row][$column+3]) || !is_numeric($spreadSheetAry[$row][$column+4]) ||
                        !is_numeric($spreadSheetAry[$row][$column+5]) || !is_numeric($spreadSheetAry[$row][$column+6]) || !is_numeric($spreadSheetAry[$row][$column+7]) || !is_numeric($spreadSheetAry[$row][$column+8]) ||
                        (($spreadSheetAry[$row][$column+13] <> "D") && ($spreadSheetAry[$row][$column+13] <> "N") && ($spreadSheetAry[$row][$column+13] <> "Y"))) continue;
                        $xmlRow = $xml->addChild("row");
                        $xmlRow->addChild("SHELFCODE",$spreadSheetAry[$row][$column]);
                        $xmlRow->addChild("SHELFNAME",$spreadSheetAry[$row][$column+1]);
                        $xmlRow->addChild("SLOCCODE",$spreadSheetAry[$row][$column+2]);
                        $xmlRow->addChild("BOXBALANCE",$spreadSheetAry[$row][$column+3]);
                        $xmlRow->addChild("BOXMAX",$spreadSheetAry[$row][$column+4]);
                        $xmlRow->addChild("BOXMIN",$spreadSheetAry[$row][$column+5]);
                        $xmlRow->addChild("BOXTOTAL",$spreadSheetAry[$row][$column+6]);
                        $xmlRow->addChild("PCSBALANCE",$spreadSheetAry[$row][$column+7]);
                        $xmlRow->addChild("PCSMAX",$spreadSheetAry[$row][$column+8]);
                        $xmlRow->addChild("DESCRIPTION",$spreadSheetAry[$row][$column+9]);
                        $xmlRow->addChild("COMPCODE",$spreadSheetAry[$row][$column+10]);
                        $xmlRow->addChild("PLANTCODE",$spreadSheetAry[$row][$column+11]);
                        $xmlRow->addChild("STATUS",$spreadSheetAry[$row][$column+12]);
                        $xmlRow->addChild("ENABLE",$spreadSheetAry[$row][$column+13]);
                    }
                    $xmlString = $xml->asXML();
                    $xmlString = str_replace("<?xml version=\"1.0\"?>\n", '', $xmlString);
                    $queryStr = str_replace("\n",'',$xmlString);
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
            } // END IF ALLOW FILE TYPE
        } // END IF CHECK EMPTY FILE
    } // END PUBLIC FUNCTION IMPORT

    public function exportExcel()
    {
    	$file= public_path(). "/download/Shelf Master.xlsx";
    	return response()->download($file);
    }
}
