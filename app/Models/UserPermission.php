<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPermission extends Model
{
    use HasFactory;

    protected $table = 'user_permissions';

    protected $fillable = [
        'email', 'permission_id', 'active'
    ];

    public function active(){
        if($this->active == "1"){
            return "Active";
        }else{
            return "Inactive";
        }
    }


    // Get getNavigationGroup detail by email
    static function getNavigationGroup($email)
    {
        $permissiontables = UserPermission::join('permissions', 'user_permissions.permission_id', '=', 'permissions.id')
        ->join('navigation_items', 'permissions.navigation_item_id', '=', 'navigation_items.id')
        ->join('navigation_groups', 'navigation_items.navigation_group_id', '=', 'navigation_groups.id')
        ->where('user_permissions.email', '=', $email)
        ->where('permissions.active', '=', '1')
        ->where('navigation_items.active', '=', '1')
        ->where('navigation_groups.active', '=', '1')
        ->orderBy('permissions.sequence', 'asc')
        ->orderBy('navigation_items.sequence', 'asc')
        ->orderBy('navigation_groups.sequence', 'asc')
        ->groupBy('navigation_group_name')
        ->get(['navigation_groups.name as navigation_group_name']);
        // ->get(['user_permissions.*','permissions.name as per_name', 'navigation_items.name as nav_item_name', 'navigation_groups.name as nav_group_name']);
        return $permissiontables;
    }

    // Get getNavigationItem detail by email
    public static function getNavigationItem($navigationGroup, $email)
    {
        $permissiontables = UserPermission::join('permissions', 'user_permissions.permission_id', '=', 'permissions.id')
        ->join('navigation_items', 'permissions.navigation_item_id', '=', 'navigation_items.id')
        ->join('navigation_groups', 'navigation_items.navigation_group_id', '=', 'navigation_groups.id')
        ->where('user_permissions.email', '=', $email)
        ->where('navigation_groups.name', '=', $navigationGroup)
        ->where('permissions.active', '=', '1')
        ->where('navigation_items.active', '=', '1')
        ->where('navigation_groups.active', '=', '1')
        ->orderBy('permissions.sequence', 'asc')
        ->orderBy('navigation_items.sequence', 'asc')
        ->orderBy('navigation_groups.sequence', 'asc')
        ->groupBy('navigation_item_name')
        ->get(['navigation_items.name as navigation_item_name']);
        // ->get(['user_permissions.*','permissions.name as per_name', 'navigation_items.name as nav_item_name', 'navigation_groups.name as nav_group_name']);
        return $permissiontables;
    }

    // Get getPermission detail by email
    static function getPermission($navigationItem, $email)
    {
        $permissiontables = UserPermission::join('permissions', 'user_permissions.permission_id', '=', 'permissions.id')
        ->join('navigation_items', 'permissions.navigation_item_id', '=', 'navigation_items.id')
        ->join('navigation_groups', 'navigation_items.navigation_group_id', '=', 'navigation_groups.id')
        ->where('user_permissions.email', '=', $email)
        ->where('navigation_items.name', '=', $navigationItem)
        ->where('permissions.active', '=', '1')
        ->where('navigation_items.active', '=', '1')
        ->where('navigation_groups.active', '=', '1')
        ->orderBy('permissions.sequence', 'asc')
        ->orderBy('navigation_items.sequence', 'asc')
        ->orderBy('navigation_groups.sequence', 'asc')
        ->groupBy('permission_name')
        ->get(['permissions.name as permission_name']);
        return $permissiontables;
    }

}
