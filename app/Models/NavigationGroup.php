<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NavigationGroup extends Model
{
    use HasFactory;
    protected $table = 'navigation_groups';

    protected $fillable = [
        'name', 'sequence','active'
    ];


    public function action($data){
        $this->name = $data['name'];
        $this->sequence = $data['sequence'];
        $this->active = $data['active'];
        $this->save();
    }

    public function active(){
        if($this->active == "1"){
            return "Active";
        }else{
            return "Inactive";
        }
    }
}
