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
    	return $this->belongsToMany('App\MedApp','meapps_doctors','meapp_id','doctor_id');
    }

    public function assistants(){
    	return $this->belongsToMany('App\MedApp','meapps_assistants','meapp_id','assistant_id');
    }
}
