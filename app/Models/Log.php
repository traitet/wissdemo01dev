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
}
