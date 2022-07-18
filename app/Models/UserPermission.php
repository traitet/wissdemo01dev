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
    public static function getNavigationGroup($email)
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
        ->groupBy('navigation_groups.id')
        ->get(['navigation_groups.id']);
        // ->get(['user_permissions.*','permissions.name as per_name', 'navigation_items.name as nav_item_name', 'navigation_groups.name as nav_group_name']);
        return $permissiontables;
    }

    // Get user permission active by email
    public static function getNavigationGroupName($navigationGroupId)
    {
        $navigationGroupName = NavigationGroup::where('id', '=', $navigationGroupId)
        ->get(['name']);

        foreach($navigationGroupName as $key) {
            return $key->name;
        }
        return $navigationGroupName;
    }
    // Get getNavigationItem detail by email
    public static function getNavigationItem($navigationGroupId, $email)
    {
        $permissiontables = UserPermission::join('permissions', 'user_permissions.permission_id', '=', 'permissions.id')
        ->join('navigation_items', 'permissions.navigation_item_id', '=', 'navigation_items.id')
        ->join('navigation_groups', 'navigation_items.navigation_group_id', '=', 'navigation_groups.id')
        ->where('user_permissions.email', '=', $email)
        ->where('navigation_groups.id', '=', $navigationGroupId)
        ->where('permissions.active', '=', '1')
        ->where('navigation_items.active', '=', '1')
        ->where('navigation_groups.active', '=', '1')
        ->orderBy('permissions.sequence', 'asc')
        ->orderBy('navigation_items.sequence', 'asc')
        ->orderBy('navigation_groups.sequence', 'asc')
        ->groupBy('navigation_items.id')
        ->get(['navigation_items.id']);
        // ->get(['user_permissions.*','permissions.name as per_name', 'navigation_items.name as nav_item_name', 'navigation_groups.name as nav_group_name']);
        return $permissiontables;
    }
     // Get navigation item  by navigation item
     public static function getNavigationItemName($navigationItemId)
     {
         $navigationItemName = NavigationItem::where('id', '=', $navigationItemId)
         ->get(['name']);

         foreach($navigationItemName as $key) {
             return $key->name;
         }
         return $navigationItemName;
     }

    // Get getPermission detail by email
    static function getPermission($navigationItemId, $email)
    {
        $permissiontables = UserPermission::join('permissions', 'user_permissions.permission_id', '=', 'permissions.id')
        ->join('navigation_items', 'permissions.navigation_item_id', '=', 'navigation_items.id')
        ->join('navigation_groups', 'navigation_items.navigation_group_id', '=', 'navigation_groups.id')
        ->where('user_permissions.email', '=', $email)
        ->where('navigation_items.id', '=', $navigationItemId)
        ->where('permissions.active', '=', '1')
        ->where('navigation_items.active', '=', '1')
        ->where('navigation_groups.active', '=', '1')
        ->orderBy('permissions.sequence', 'asc')
        ->orderBy('navigation_items.sequence', 'asc')
        ->orderBy('navigation_groups.sequence', 'asc')
        ->groupBy('permissions.id')
        ->get(['permissions.id']);
        return $permissiontables;
    }

    public static function getPermissionName($permissionId)
     {
         $permissionName = Permission::where('id', '=', $permissionId)
         ->get(['name']);

         foreach($permissionName as $key) {
             return $key->name;
         }
         return $permissionName;
     }
     // Get permission ID from Name
     public static function getPermissionID($perName)
     {
         $permissionID = Permission::where('name', '=', $perName)
         ->get(['id']);

         foreach($permissionID as $key) {
              return $key->id;
         }
         return $permissionID;
     }
    // Get user permission active by email
    public static function getPermissionActive($email, $permissionid)
    {
        $status = UserPermission::join('permissions', 'user_permissions.permission_id', '=', 'permissions.id')
        ->where('user_permissions.email', '=', $email)
        ->where('permissions.id', '=', $permissionid)
        ->orderBy('permissions.sequence', 'asc')
        ->get(['user_permissions.active']);

        foreach($status as $key => $val) {
            return $val->active;
        }
    }

}
