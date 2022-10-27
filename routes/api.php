<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\facades\DB;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

#region [INTIAL CODE WHEN GERNATE]
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// =========================================================================================================================
// ADD WEB API
// =========================================================================================================================
Route::resource('photos', 'App\Http\Controllers\PhotoController');
Route::resource('wiss-apis', 'App\Http\Controllers\WissApiController');
#endregion


// // =========================================================================================================================
// // 1) CALL API TO SQL STORE PROCEDURE (SAMPLE CODE)
// // =========================================================================================================================
// // http://127.0.0.1:8000/api/sp1
// Route::get('sp1', function () {
//     $result = DB::select("EXEC interface_sap_po '20190101','20220101','',100");
//     return json_encode($result);
// });

// **********************************************************************************************************************************************
// PART 1 : REPORT
// **********************************************************************************************************************************************

//========================================================================
// 1) interface_sap_po_obj  (DEFAULT, SIAM_EPSINFDB)
//========================================================================
// http://10.100.1.94:8080/wissdemo01/public/api/interface_sap_po_obj/doc_num=PO19007289&start_date=20190101&end_date=20220225&max_record=100
// http://127.0.0.1:8000/api/interface_sap_po_obj/doc_num=PO19007289&start_date=20190101&end_date=20220225&max_record=100
Route::get('interface_sap_po_obj/{obj}', function ($obj) {
    parse_str($obj,$myArray);
    $doc_num = $myArray['doc_num'];
    $start_date = $myArray['start_date'];
    $end_date = $myArray['end_date'];
    $max_record = $myArray['max_record'];
    $result = DB::connection('sqlsrv_epsinfdb_db')->select("EXEC interface_sap_po '$start_date','$end_date','$doc_num',$max_record");
    return json_encode($result);
});

//========================================================================
// 2) interface_sap_rec (DEFAULT, SIAM_EPSINFDB)
//========================================================================
// http://10.100.1.94:8080/wissdemo01/public/api/interface_sap_rec_obj/doc_num=PO19007289&start_date=20190101&end_date=20220225&max_record=100
Route::get('interface_sap_rec_obj/{obj}', function ($obj) {
    parse_str($obj,$myArray);
    $doc_num = $myArray['doc_num'];
    $start_date = $myArray['start_date'];
    $end_date = $myArray['end_date'];
    $max_record = $myArray['max_record'];
    $result = DB::connection('sqlsrv_epsinfdb_db')->select("EXEC interface_sap_rec '$start_date','$end_date','$doc_num',$max_record");
    // print($obj);
    // error_log($obj);
    return json_encode($result);
});

//========================================================================
// 3) interface_sap_inv (DEFAULT, SIAM_EPSINFDB)
//========================================================================
// http://10.100.1.94:8080/wissdemo01/public/api/interface_sap_inv_obj/doc_num=PO19&start_date=20190101&end_date=20220225&max_record=100
Route::get('interface_sap_inv_obj/{obj}', function ($obj) {
    parse_str($obj,$myArray);
    $doc_num = $myArray['doc_num'];
    $start_date = $myArray['start_date'];
    $end_date = $myArray['end_date'];
    $max_record = $myArray['max_record'];
    $result = DB::connection('sqlsrv_epsinfdb_db')->select("EXEC interface_sap_inv '$start_date','$end_date','$doc_num',$max_record");
    return json_encode($result);
});

//========================================================================
// 4) emfg_shipping_log_ok (sqlsrv_shipping_db,SIAM_EPSINFDB)
//========================================================================
// http://10.100.1.94:8080/wissdemo01/public/api/emfg_shipping_log_ok_obj/doc_num=SA11AD1C5079&start_date=20190101&end_date=20220225&max_record=100
Route::get('emfg_shipping_log_ok_obj/{obj}', function ($obj) {
    parse_str($obj,$myArray);
    $doc_num = $myArray['doc_num'];
    $start_date = $myArray['start_date'];
    $end_date = $myArray['end_date'];
    $max_record = $myArray['max_record'];
    $result = DB::connection('sqlsrv_shipping_db')->select("EXEC emfg_shipping_log_ok '$start_date','$end_date','$doc_num',$max_record");
    return json_encode($result);
});

//========================================================================
// 5) E-MFG emfg_shipping_log_ng (sqlsrv_shipping_db, SIAM_SHIPPINGDB )
//========================================================================
// http://10.100.1.94:8080/wissdemo01/public/api/emfg_shipping_log_ng_obj/doc_num=SA11AYHA4660&start_date=20190101&end_date=20220225&max_record=100
Route::get('emfg_shipping_log_ng_obj/{obj}', function ($obj) {
    parse_str($obj,$myArray);
    $doc_num = $myArray['doc_num'];
    $start_date = $myArray['start_date'];
    $end_date = $myArray['end_date'];
    $max_record = $myArray['max_record'];
    $result = DB::connection('sqlsrv_shipping_db')->select("EXEC emfg_shipping_log_ng '$start_date','$end_date','$doc_num',$max_record");
    return json_encode($result);
});


//========================================================================
// 6) emfg_shipping_log_event (sqlsrv_shipping_db, SIAM_SHIPPINGDB)
//========================================================================
// http://10.100.1.94:8080/wissdemo01/public/api/emfg_shipping_log_event_obj/doc_num=&start_date=20190101&end_date=20220225&max_record=100
Route::get('emfg_shipping_log_event_obj/{obj}', function ($obj) {
    parse_str($obj,$myArray);
    $doc_num = $myArray['doc_num'];
    $start_date = $myArray['start_date'];
    $end_date = $myArray['end_date'];
    $max_record = $myArray['max_record'];
    $result = DB::connection('sqlsrv_shipping_db')->select("EXEC emfg_shipping_log_event '$start_date','$end_date','$doc_num',$max_record");
    return json_encode($result);
});

//========================================================================
// 7) eps_interface_pr_po_to_planner (sqlsrv_eps_db, SIAM_EPSDB)
//========================================================================
// http://10.100.1.94:8080/wissdemo01/public/api/eps_interface_pr_po_to_planner_obj/doc_num=PO19007289&start_date=20190101&end_date=20220225&max_record=100
Route::get('eps_interface_pr_po_to_planner_obj/{obj}', function ($obj) {
    parse_str($obj,$myArray);
    $doc_num = $myArray['doc_num'];
    $start_date = $myArray['start_date'];
    $end_date = $myArray['end_date'];
    $max_record = $myArray['max_record'];
    $result = DB::connection('sqlsrv_eps_db')->select("EXEC eps_interface_pr_po_to_planner '$start_date','$end_date','$doc_num',$max_record");
    return json_encode($result);
});

//========================================================================
// 8) eps_interface_sap_pr_outstanding (sqlsrv_eps_db, SIAM_EPSDB)
// Maybe need to add EXPENSE_ID
//========================================================================
// http://10.100.1.94:8080/wissdemo01/public/api/eps_interface_sap_pr_outstanding_obj/doc_num=PR21&start_date=20190101&end_date=20220225&max_record=100
Route::get('eps_interface_sap_pr_outstanding_obj/{obj}', function ($obj) {
    parse_str($obj,$myArray);
    $doc_num = $myArray['doc_num'];
    $start_date = $myArray['start_date'];
    $end_date = $myArray['end_date'];
    $max_record = $myArray['max_record'];
    $result = DB::connection('sqlsrv_eps_db')->select("EXEC eps_interface_sap_pr_outstanding '$start_date','$end_date','$doc_num',$max_record");
    return json_encode($result);
});

//========================================================================
// 9) report_budget_checking (sqlsrv_eps_db,SIAM_EPSDB)
// doc_type : 1=PR, 2=PO, 0 or else =BOTH
//========================================================================
// http://10.100.1.94:8080/wissdemo01/public/api/report_budget_checking_obj/doc_num=F400&start_date=20190101&end_date=20220225&max_record=100/doc_type=0
// http://10.100.1.94:8080/wissdemo01/public/api/report_budget_checking_obj/doc_num=F400PE&start_date=20190101&end_date=20220225&max_record=100/doc_type=1
// http://10.100.1.94:8080/wissdemo01/public/api/report_budget_checking_obj/doc_num=Y21PE&start_date=20190101&end_date=20220225&max_record=100/doc_type=2
Route::get('report_budget_checking_obj/{obj}/{search}', function ($obj,$search) {
    parse_str($obj,$myArray);
    $doc_num = $myArray['doc_num'];
    $start_date = $myArray['start_date'];
    $end_date = $myArray['end_date'];
    $max_record = $myArray['max_record'];
    parse_str($search,$myArraySearch);
    $doc_type = $myArraySearch['doc_type'];
    $result = DB::connection('sqlsrv_eps_db')->select("EXEC report_budget_checking '$start_date','$end_date','$doc_num',$max_record,'$doc_type'");
    return json_encode($result);
});

//========================================================================
// 10) emfg_shipping_order_status (sqlsrv_shipping_db,SIAM_SHIPPINGDB)
//========================================================================
// http://10.100.1.94:8080/wissdemo01/public/api/emfg_shipping_order_status_obj/start_date=20210101&end_date=20220225&doc_num=SA11AP1M0147&max_record=100
Route::get('emfg_shipping_order_status_obj/{obj}', function ($obj) {
    parse_str($obj,$myArray);
    $doc_num = $myArray['doc_num'];
    $start_date = $myArray['start_date'];
    $end_date = $myArray['end_date'];
    $max_record = $myArray['max_record'];
    $result = DB::connection('sqlsrv_shipping_db')->select("EXEC emfg_shipping_order_status '$start_date','$end_date','$doc_num',$max_record");
    return json_encode($result);
});

//========================================================================
// 11) edrawing_check_password (sqlsrv_ags_j614_db,AGS_J614_J614)
//========================================================================
Route::get('edrawing_check_password_obj/{obj}', function ($obj) {
    parse_str($obj,$myArray);
    $doc_num = $myArray['doc_num'];
    $start_date = $myArray['start_date'];
    $end_date = $myArray['end_date'];
    $max_record = $myArray['max_record'];
    $result = DB::connection('sqlsrv_ags_j614_db')->select("EXEC wiss_sa_edrawing_authentication '$start_date','$end_date','$doc_num',$max_record");
    return json_encode($result);
});


//========================================================================
// 12) eps_pr_issue_error_report (sqlsrv_eps_db,SIAM_EPSDB)
//========================================================================
// http://10.100.1.94:8080/wissdemo01/public/api/eps_pr_issue_error_report_obj/doc_num=PR22&start_date=20190101&end_date=20220225&max_record=100
Route::get('eps_pr_issue_error_report_obj/{obj}', function ($obj) {
    parse_str($obj,$myArray);
    $doc_num = $myArray['doc_num'];
    $start_date = $myArray['start_date'];
    $end_date = $myArray['end_date'];
    $max_record = $myArray['max_record'];
    $result = DB::connection('sqlsrv_eps_db')->select("EXEC wiss_sa_eps_pr_issue_error '$start_date','$end_date','$doc_num',$max_record");
    return json_encode($result);
});

//========================================================================
// 13) wiss_sa_eps_pr_productionid_error (sqlsrv_eps_db,SIAM_EPSDB)
//========================================================================
// http://10.100.1.94:8080/wissdemo01/public/api/eps_pr_productionid_error_report_obj/doc_num=PR22&start_date=20190101&end_date=20220225&max_record=100
Route::get('eps_pr_productionid_error_report_obj/{obj}', function ($obj) {
    parse_str($obj,$myArray);
    $doc_num = $myArray['doc_num'];
    $start_date = $myArray['start_date'];
    $end_date = $myArray['end_date'];
    $max_record = $myArray['max_record'];
    $result = DB::connection('sqlsrv_eps_db')->select("EXEC wiss_sa_eps_pr_productionid_error '$start_date','$end_date','$doc_num',$max_record");
    return json_encode($result);
});

//========================================================================
// 14) emfg_inventory_stock_out_error_obj (sqlsrv_siam_arisa_p01_db,SIAM_ARISA_P01)
//========================================================================
// http://10.100.1.94:8080/wissdemo01/public/api/emfg_inventory_stock_out_error_obj/doc_num=T344&start_date=20220101&end_date=20990101&max_record=100
// doc_num is PARTCODE
Route::get('emfg_inventory_stock_out_error_obj/{obj}', function ($obj) {
    parse_str($obj,$myArray);
    $doc_num = $myArray['doc_num'];
    $start_date = $myArray['start_date'];
    $end_date = $myArray['end_date'];
    $max_record = $myArray['max_record'];
    $result = DB::connection('sqlsrv_siam_arisa_p01_db')->select("EXEC wiss_sa_emfg_inventory_stock_out_error '$start_date','$end_date','$doc_num',$max_record");
    return json_encode($result);
});


//========================================================================
// 15) eps_pr_for_cp_report (sqlsrv_eps_db,SIAM_EPSDB)
//========================================================================
// http://10.100.1.94:8080/wissdemo01/public/api/eps_interface_pr_po_to_planner_obj/doc_num=PR22&start_date=20190101&end_date=20220225&max_record=100
Route::get('eps_pr_for_cp_report_obj/{obj}', function ($obj) {
    parse_str($obj,$myArray);
    $doc_num = $myArray['doc_num'];
    $start_date = $myArray['start_date'];
    $end_date = $myArray['end_date'];
    $max_record = $myArray['max_record'];
    $result = DB::connection('sqlsrv_eps_db')->select("EXEC wiss_sa_eps_pr_for_cp '$start_date','$end_date','$doc_num',$max_record");
    return json_encode($result);
});

//=========================================================================
// 16) Drill down from PRNUM
// wiss_sa_eps_report_budget_checking_pr_detail (sqlsrv_eps_db,SIAM_EPSDB)
//=========================================================================
// http://10.100.1.94:8080/wissdemo01/public/api/wiss_sa_eps_report_budget_checking_pr_detail/doc_num=PR22000571
Route::get('wiss_sa_eps_report_budget_checking_pr_detail/{obj}', function ($obj) {
    parse_str($obj,$myArray);
    $doc_num = $myArray['doc_num'];
    $result = DB::connection('sqlsrv_eps_db')->select("EXEC wiss_sa_eps_report_budget_checking_pr_detail '$doc_num'");
    return json_encode($result);
});

//=========================================================================
// 17) Drill down from INVESTMENT
// wiss_sa_eps_report_budget_checking_investment (sqlsrv_eps_db,SIAM_EPSDB)
//=========================================================================
// http://10.100.1.94:8080/wissdemo01/public/api/wiss_sa_eps_report_budget_checking_investment/doc_num=Y22IT017CO01&period=SAP
Route::get('wiss_sa_eps_report_budget_checking_investment/{obj}', function ($obj) {
    parse_str($obj,$myArray);
    $doc_num = $myArray['doc_num'];
    $period = $myArray['period'];
    $result = DB::connection('sqlsrv_eps_db')->select("EXEC wiss_sa_eps_report_budget_checking_investment '$doc_num','$period'");
    return json_encode($result);
});

//=========================================================================
// 18) Drill down from EXPENSE
// wiss_sa_eps_report_budget_checking_expense (sqlsrv_eps_db,SIAM_EPSDB)
//=========================================================================
// http://10.100.1.94:8080/wissdemo01/public/api/wiss_sa_eps_report_budget_checking_expense/doc_num=61830-B200&period=SAP
Route::get('wiss_sa_eps_report_budget_checking_expense/{obj}', function ($obj) {
    parse_str($obj,$myArray);
    $doc_num = $myArray['doc_num'];
    $period = $myArray['period'];
    $result = DB::connection('sqlsrv_eps_db')->select("EXEC wiss_sa_eps_report_budget_checking_expense '$doc_num','$period'");
    return json_encode($result);
});

//========================================================================
// 19) wiss_atac_emfg_shopping_log  (sqlsrv_atac_arisa_p02_db, ATAC_ARISA_P02)
//========================================================================
// http://10.100.1.94:8080/wissdemo01/public/api/wiss_atac_emfg_shopping_log/doc_num=P325A559860&start_date=20190101&end_date=20220525&max_record=100
Route::get('wiss_atac_emfg_shopping_log/{obj}', function ($obj) {
    parse_str($obj,$myArray);
    $doc_num = $myArray['doc_num'];
    $start_date = $myArray['start_date'];
    $end_date = $myArray['end_date'];
    $max_record = $myArray['max_record'];
    $result = DB::connection('sqlsrv_atac_arisa_p02_db')->select("EXEC wiss_atac_emfg_shopping_log '$start_date','$end_date','$doc_num',$max_record");
    return json_encode($result);
});



// **********************************************************************************************************************************************
// PART 2 : FIX PROGRAM
// **********************************************************************************************************************************************
//========================================================================
// 1.wiss_sa_add_ibg_dept (sqlsrv_siam_arisa_p01_db,SIAM_ARISA_P01)
//========================================================================
// http://10.100.1.94:8080/wissdemo01/public/api/wiss_sa_add_ibg_dept/emp_id=999&dept_code=A100&is_readonly=N
Route::get('wiss_sa_add_ibg_dept/{obj}', function ($obj) {
    parse_str($obj,$myArray);
    $emp_id = $myArray['emp_id'];
    $dept_code = $myArray['dept_code'];
    $is_readonly = $myArray['is_readonly'];
    $result = DB::connection('sqlsrv_siam_arisa_p01_db')->select("EXEC wiss_sa_add_ibg_dept '$emp_id','$dept_code','$is_readonly'");
    return json_encode($result);
});

//========================================================================
// 2.wiss_sa_add_ibg_user (sqlsrv_siam_arisa_p01_db,SIAM_ARISA_P01)
//========================================================================
// http://10.100.1.94:8080/wissdemo01/public/api/wiss_sa_add_ibg_user/emp_id=9999&username=satit_po&name=satit&surname=pongpimol&level=LV0040&sect_id=A100&email=satit_po@aisin-ap.com&role=1
// --level LV0040: <Section, LV0050:Section Mgr, LV0060:Dept Mgr, LV0070:Div Mgr, LV0080:DMD, LV0090:MD
// --role: 1) Normal user read only 2) Nomal user can edit 3) CP user read only 4) CP user can edit
Route::get('wiss_sa_add_ibg_user/{obj}', function ($obj) {
    parse_str($obj,$myArray);
    $emp_id = $myArray['emp_id'];
    $username = $myArray['username'];
    $name = $myArray['name'];
    $surname = $myArray['surname'];
    $level = $myArray['level'];
    $sect_id = $myArray['sect_id'];
    $email = $myArray['email'];
    $role = $myArray['role'];
    $result = DB::connection('sqlsrv_siam_arisa_p01_db')->select("EXEC wiss_sa_add_ibg_user '$emp_id','$username','$name','$surname','$level','$sect_id','$email','$role'");
    return json_encode($result);
});

//========================================================================
// 3.wiss_sa_add_eps_investment (sqlsrv_eps_db, SIAM_EPSDB)
//========================================================================
// http://10.100.1.94:8080/wissdemo01/public/api/wiss_sa_add_eps_investment/investment_id=S21PE064AS01
Route::get('wiss_sa_add_eps_investment/{obj}', function ($obj) {
    parse_str($obj,$myArray);
    $investment_id = $myArray['investment_id'];
    $result = DB::connection('sqlsrv_eps_db')->select("EXEC wiss_sa_add_eps_investment '$investment_id'");
    return json_encode($result);
});

//========================================================================
// 4.wiss_atac_emfg_add_model (sqlsrv_atac_arisa_p02_db, ATAC_ARISA_P02)
//========================================================================
// http://10.100.1.94:8080/wissdemo01/public/api/wiss_atac_emfg_add_model/model_code=MD00000170&model_name=TCC [D41E]&pdt_grp_code=PG00000001

Route::get('wiss_atac_emfg_add_model/{obj}', function ($obj) {
    parse_str($obj,$myArray);
    $model_code = $myArray['model_code'];
    $model_name = $myArray['model_name'];
    $pdt_grp_code = $myArray['pdt_grp_code'];
    $result = DB::connection('sqlsrv_atac_arisa_p02_db')->select("EXEC wiss_atac_emfg_add_model @model_code = '$model_code', @model_name ='$model_name', @pdt_grp_code = '$pdt_grp_code'");
    return json_encode($result);
});

//========================================================================
// 5.wiss_atac_emfg_add_shelf (sqlsrv_atac_arisa_p02_db, ATAC_ARISA_P02)
//========================================================================
// http://10.100.1.94:8080/wissdemo01/public/api/wiss_atac_emfg_add_shelf/sloc_code=ATA400S01&shelf_name=MA0450&shelf_code=SH-MA450
Route::get('wiss_atac_emfg_add_shelf/{obj}', function ($obj) {
    parse_str($obj,$myArray);
    $sloc_code = $myArray['sloc_code'];
    $shelf_name = $myArray['shelf_name'];
    $shelf_code = $myArray['shelf_code'];
    $result = DB::connection('sqlsrv_atac_arisa_p02_db')->select("EXEC wiss_atac_emfg_add_shelf @sloc_code ='$sloc_code', @shelf_name = '$shelf_name', @shelf_code = '$shelf_code'");
    return json_encode($result);
});

//========================================================================
// 6.wiss_sa_ifin_revert_doc (sqlsrv_siam_laser_p01_db, SIAM_LASER_P01)
//========================================================================
// http://10.100.1.94:8080/wissdemo01/public/api/wiss_sa_ifin_revert_doc/doc_num=AV20000001
Route::get('wiss_sa_ifin_revert_doc/{obj}', function ($obj) {
    parse_str($obj,$myArray);
    $doc_num  = $myArray['doc_num'];
    $result = DB::connection('sqlsrv_siam_laser_p01_db')->select("EXEC wiss_sa_ifin_revert_doc @doc_num  = '$doc_num'");
    return json_encode($result);
});

//========================================================================
// 7.wiss_sa_ifin_register_admin (sqlsrv_siam_laser_p01_db, SIAM_LASER_P01)
//========================================================================
// http://10.100.1.94:8080/wissdemo01/public/api/wiss_sa_ifin_register_admin/group_code=CP03&username=SUCHART_AU
Route::get('wiss_sa_ifin_register_admin/{obj}', function ($obj) {
    parse_str($obj,$myArray);
    $group_code = $myArray['group_code'];
    $username = $myArray['username'];
    $result = DB::connection('sqlsrv_siam_laser_p01_db')->select("EXEC wiss_sa_ifin_register_admin @group_code = '$group_code', @username = '$username'");
    return json_encode($result);
});

//========================================================================
// 8.wiss_sa_emfg_add_shelf (sqlsrv_sa_arisa_p01_db, SIAM_ARISA_P01)
//========================================================================
// http://10.100.1.94:8080/wissdemo01/public/api/wiss_sa_emfg_add_shelf/sloc_code=SARSE5200&shelf_name=T999&shelf_code=T999
Route::get('wiss_sa_emfg_add_shelf/{obj}', function ($obj) {
    parse_str($obj,$myArray);
    $sloc_code = $myArray['sloc_code'];
    $shelf_name = $myArray['shelf_name'];
    $shelf_code = $myArray['shelf_code'];
    $result = DB::connection('sqlsrv_siam_arisa_p01_db')->select("EXEC wiss_sa_emfg_add_shelf @sloc_code = '$sloc_code', @shelf_code = '$shelf_code', @shelf_name = '$shelf_name'");
    return json_encode($result);
});

//========================================================================
// 9.wiss_sa_ibg_update_inf_schedule (sqlsrv_sa_arisa_p01_db, SIAM_ARISA_P01)
//========================================================================
// http://10.100.1.94:8080/wissdemo01/public/api/wiss_sa_ibg_update_inf_schedule/fiscal_year=2022&period=1&inf_date=20220501&inf_time=230000
Route::get('wiss_sa_ibg_update_inf_schedule/{obj}', function ($obj) {
    parse_str($obj,$myArray);
    $fiscal_year = $myArray['fiscal_year'];
    $period = $myArray['period'];
    $inf_date = $myArray['inf_date'];
    $inf_time = $myArray['inf_time'];
    $result = DB::connection('sqlsrv_siam_arisa_p01_db')->select("EXEC wiss_sa_ibg_update_inf_schedule @fiscal_year = '$fiscal_year', @period = '$period', @inf_date = '$inf_date', @inf_time = '$inf_time'");
    return json_encode($result);
});

//========================================================================
// 10.wiss-atac-emfg-revert-shopping-status (sqlsrv_atac_arisa_p02_db, ATAC_ARISA_P02)
//========================================================================
// http://10.100.1.94:8080/wissdemo01/public/api/wiss_atac_emfg_revert_shopping_status/picking_list_num=P301A841520&pallet_Number=PL-01-1162
Route::get('wiss_atac_emfg_revert_shopping_status/{obj}', function ($obj) {
    parse_str($obj,$myArray);
    $picking_list_num = $myArray['picking_list_num'];
    $pallet_Number = $myArray['pallet_Number'];
    $result = DB::connection('sqlsrv_atac_arisa_p02_db')->select("EXEC wiss_atac_emfg_revert_shopping_status @picking_list_num ='$picking_list_num', @pallet_Number = '$pallet_Number'");
    return json_encode($result);
});

//========================================================================
// 11.wiss-atac-emfg-complete-pkl (sqlsrv_atac_arisa_p02_db, ATAC_ARISA_P02)
//========================================================================
// http://10.100.1.94:8080/wissdemo01/public/api/wiss_atac_emfg_complete_pkl/picking_list_num=P323A470640&pallet_Number=PAL-01|0117|20191029
// http://10.100.1.94:8080/wissdemo01/public/api/wiss_atac_emfg_complete_pkl/picking_list_num=P323A470640&pallet_Number=htmlentities(PAL-01|0117|20191029)
// http://10.100.1.94:8080/wissdemo01/public/api/wiss_atac_emfg_complete_pkl/picking_list_num=P323A470640&pallet_Number=urlencode(PAL-01|0117|20191029)
    Route::get('wiss_atac_emfg_complete_pkl/{obj}', function ($obj) {
    parse_str($obj,$myArray);
    $picking_list_num = $myArray['picking_list_num'];
    $pallet_Number = $myArray['pallet_Number'];
    $result = DB::connection('sqlsrv_atac_arisa_p02_db')->select("EXEC wiss_atac_emfg_complete_pkl @picking_list_num ='$picking_list_num', @pallet_Number = '$pallet_Number'");
    return json_encode($result);
});



//========================================================================
// 12.wiss_atac_emfg_create_pallet_data_from_shopping (sqlsrv_atac_arisa_p02_db, ATAC_ARISA_P02)
//========================================================================
// http://10.100.1.94:8080/wissdemo01/public/api/wiss_atac_emfg_create_pallet_data_from_shopping/picking_list_num=P325A567860&pallet_Number=R008-0|00|20200822
Route::get('wiss_atac_emfg_create_pallet_data_from_shopping/{obj}', function ($obj) {
    parse_str($obj,$myArray);
    $picking_list_num = $myArray['picking_list_num'];
    $pallet_Number = $myArray['pallet_Number'];
    $result = DB::connection('sqlsrv_atac_arisa_p02_db')->select("EXEC wiss_atac_emfg_create_pallet_data_from_shopping @picking_list_num ='$picking_list_num', @pallet_Number = '$pallet_Number'");
    return json_encode($result);
});

//========================================================================
// 13.wiss_sa_issue_pr (sqlsrv_eps_db, SIAM_EPSDB)
//========================================================================
// http://10.100.1.94:8080/wissdemo01/public/api/wiss_sa_issue_pr/doc_num=PR22011422&comment=ReissuePR
Route::get('wiss_sa_issue_pr/{obj}', function ($obj) {
    parse_str($obj,$myArray);
    $doc_num = $myArray['doc_num'];
    $comment = $myArray['comment'];
    $result = DB::connection('sqlsrv_eps_db')->select("EXEC SP_FIX_ISSUE_PR_NOT_COMPLETE @DOC_NUM ='$doc_num', @COMMENT = '$comment'");
    return json_encode($result);
});
