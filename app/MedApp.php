<?php
/*medical appointment - hora medica*/
namespace App;

use Illuminate\Database\Eloquent\Model;

class MedApp extends Model{
 	
	protected $table="medical_appointments";
    public $guarded=['id',];

    public function patient(){
    	return $this->belongsTo('App\Patient','patient_id','id');
    }

    public function doctors(){
    	return $this->belongsToMany('App\User','meapps_doctors','medapp_id','doctor_id');
    }

    public function assistants(){
        return $this->belongsToMany('App\User','meapps_assistants','medapp_id','assistaint_id');
    }
}
