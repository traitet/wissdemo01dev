<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\NavigationItem;
use Illuminate\Http\Request;

class ExternalURLController extends Controller
{
    public function showatgn()
    {
        return redirect()->away('https://atgn-th.sdwan.kddi.com/');
    }

    public function showzabbix()
    {
        return redirect()->away('https://zabbix.atgn-monitor.net/zabbix/');
    }

    public function showsolarwinds()
    {
        return redirect()->away('https://10.122.242.248/Orion/Login.aspx');
    }

    public function shownagios()
    {
        return redirect()->away('https://bnmonitor.leapsolutions.co.th/nagiosxi/login.php');
    }

}
