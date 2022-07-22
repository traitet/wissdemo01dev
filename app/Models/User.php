<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'location',
        'employee_id',
        'first_name',
        'last_name',
        'section',
        'department',
        'division',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getNameAttribute(){
        return "{$this->first_name} {$this->last_name}";
    }

    public static function getPermission($permissionName, $email)
    {
        $permissions = UserPermission::join('permissions', 'user_permissions.permission_id', '=', 'permissions.id')
        ->join('navigation_items', 'permissions.navigation_item_id', '=', 'navigation_items.id')
        ->where('user_permissions.email', '=', $email)
        ->where('permissions.name', '=', $permissionName)
        ->where('permissions.active', '=', '1')
        ->where('navigation_items.active', '=', '1')
        ->orderBy('permissions.sequence', 'asc')
        ->orderBy('navigation_items.sequence', 'asc')
        ->groupBy('permissions.name')
        ->get(['permissions.name']);

        foreach($permissions as $permisson){
            if($permisson->name == $permissionName){
                return true;
            }else{
                return false;
            }
        }
    }

}
