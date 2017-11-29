<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DateTimeZone;
use DateTime;
use Carbon\Carbon;
class Patient extends Model{
    protected $guarded=[
    	'id',
    ];

    public function age(){
    	return Carbon::parse($this->attributes['birthday'])->age;
    	return $age;
    }

    public function medical_appointments(){
    	return $this->hasMany('App\MedApp','patient_id','id');
    }
}
