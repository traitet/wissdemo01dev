<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Log extends Model
{
    use HasFactory;

    protected $fillable = [
        'emp_id', 'permission_id', 'message'
    ];

    public static function insertLog($empid, $permissionid, $message)
    {
        $Log = new log;
        $Log->emp_id = $empid;
        $Log->permission_id = $permissionid;
        $Log->message = $message;
        $Log->save();
    }

    public static function getPermissionID()
    {
        $permissionIDs = Permission::all();
        return $permissionIDs;
    }

    // GET APP LOG USAGE TOP 4 SEND TO DASHBOARD
    public static function getTopFourLogSystems()
    {
        $logUsages = log::join('permissions', 'logs.permission_id', '=', 'permissions.id')
        ->join('navigation_items', 'permissions.navigation_item_id', '=', 'navigation_items.id')
        ->join('navigation_groups', 'navigation_items.navigation_group_id', '=', 'navigation_groups.id')
        ->where('navigation_groups.id','1')
        ->orwhere('navigation_groups.id','2')
        // ->orwhere('navigation_groups.id','3')
        ->orderBy('total','desc')
        ->groupBy('navigation_items.name')
        ->selectRaw('count(*) as total, navigation_items.name')
        ->paginate(4);
        return $logUsages;
    }

        // GET LOG USER USAGE TOP 4 SEND TO DASHBOARD
        public static function getTopFourUserUsage()
        {
            $userUsages = User::join('logs', 'logs.emp_id', '=', 'users.id')
            ->join('permissions', 'logs.permission_id', '=', 'permissions.id')
            ->join('navigation_items', 'permissions.navigation_item_id', '=', 'navigation_items.id')
            ->join('navigation_groups', 'navigation_items.navigation_group_id', '=', 'navigation_groups.id')
            ->where('navigation_groups.id','1')
            ->orwhere('navigation_groups.id','2')
            // ->orwhere('navigation_groups.id','3')
            ->orderBy('total','desc')
            ->groupBy('users.first_name')
            ->selectRaw('count(*) as total, users.first_name')
            ->paginate(4);
            return $userUsages;
        }

        // GET LOG AMOUNT SEND TO DASHBOARD
    public static function getTotalLogAmount()
    {
        $totalLogs = log::selectRaw('count(id) as total')
        ->get();
        foreach($totalLogs as $value){
            return $value->total;
        }
    }

    // GET TOTAL LOG SEND TO DASHBOARD
    public static function getTotalLog()
    {
        $logUsages = log::join('permissions', 'logs.permission_id', '=', 'permissions.id')
        ->join('navigation_items', 'permissions.navigation_item_id', '=', 'navigation_items.id')
        ->join('navigation_groups', 'navigation_items.navigation_group_id', '=', 'navigation_groups.id')
        ->where('navigation_groups.id','1')
        ->orwhere('navigation_groups.id','2')
        // ->orwhere('navigation_groups.id','3')
        ->orderBy('total','desc')
        ->groupBy('navigation_items.name')
        ->selectRaw('count(*) as total, navigation_items.name')
        ->get();
        return $logUsages;
    }

    // public static function getWissUsagePerMonth()
    // {
    //     $data = log::all()->sortBy(function ($item) {
    //         return -$item->created_at->month;
    //    })->groupBy(function ($item) {
    //         return $item->created_at->format("F");
    //    })->map->count();
    //    return $data;
    // }

    public static function getWissUsagePerMonth()
    {

        // $data = log::select(
        // log::raw('count(id) as counts'),
        // log::raw("DATE_FORMAT(created_at,'%M %Y') as monthYear")
        // )
        // ->orderBy('monthYear', 'DESC')
        // ->groupBy('monthYear')
        // ->paginate(12);
        // return $data;

            $data = log::selectRaw('year(created_at) as year, monthname(created_at) as month, count(id) as counts')
            ->groupBy('year','month')
            ->orderByRaw('min(created_at) desc')
            ->paginate(12);
            return $data;
    }
}
