<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Support\Facades\Storage;

use Spatie\Activitylog\Traits\LogsActivity;
class User extends Authenticatable
{
    use Notifiable,HasRoles,SoftDeletes,HasApiTokens,LogsActivity;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'id',
    ];
    protected $dates = ['deleted_at'];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected static $logAttributes = ['name', 'lastname','nickname','avatar','rut','phone','email','password'];

    public function get_avatar(){
        $url = Storage::disk('user_avatars')->url($this->avatar);
        return $url;
    }

    public function getLogNameToUse(string $eventName = ''): string{
        return 'user_activity';
    }


    /*devuelve horas medicas en las que haya participado como doctor*/
    public function medical_appointments_as_doctor(){
        return $this->belongsToMany('App\MedApp','meapps_doctors','doctor_id','medapp_id');
    }


    /*devuelve horas medicas en las que haya participado como asistente*/
    public function medical_appointments_as_assistant(){
        return $this->belongsToMany('App\MedApp','meapps_assistants','assistaint_id','medapp_id');
    }


}
