<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;
    protected $table = 'permissions';

    protected $fillable = [
        'navigation_item_id', 'name', 'sequence', 'active'
    ];

    public function active(){
        if($this->active == "1"){
            return "Active";
        }else{
            return "Inactive";
        }
    }
}
