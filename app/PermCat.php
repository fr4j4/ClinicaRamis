<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PermCat extends Model{
    protected $guarded=[
    'id',
    ];

    protected $table='permissionsCat';

    public function permissions(){
    	return $this->hasMany('App\Permission','cat_id','id');
    }
}
