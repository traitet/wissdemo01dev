<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NavigationItem extends Model
{
    use HasFactory;
    protected $table = 'navigation_items';

    protected $fillable = [
        'navigation_group_id', 'name', 'sequence', 'active'
    ];

    public function active(){
        if($this->active == "1"){
            return "Active";
        }else{
            return "Inactive";
        }
    }
}
