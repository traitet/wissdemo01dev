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
        return redirect()->away('https://atgn-th.sdwan.kddi.com/');
    }

    public function showsolarwinds()
    {
        return redirect()->away('https://atgn-th.sdwan.kddi.com/');
    }

    public function shownagios()
    {
        return redirect()->away('https://atgn-th.sdwan.kddi.com/');
    }

}
