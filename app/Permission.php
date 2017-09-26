<?php

namespace App;

use Spatie\Permission\Models\Permission as BasePermission;

class Permission extends BasePermission {
    
    public function category(){
        return $this->belongsTo('App\PermCat','cat_id','id');
    } 
}