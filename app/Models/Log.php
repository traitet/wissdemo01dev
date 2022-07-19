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
        log::insert([
            'emp_id' => $empid,
            'permission_id' => $permissionid,
            'message' => $message,

        ]);

        // $request->validate([
        //     'email' => 'required',
        //     'permission_id' => 'required',
        //     'message' => 'required',
        // ]);


        //     log::create($request->all());


    }
}
