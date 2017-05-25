<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombres', 'apellidos', 'cedula','role', 'email', 'password',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * seleccionadores
     */
    public static function selUsuario($role){
        $array['']= "seleccione...";
        $modelo = User::all()->toArray();
            foreach ($modelo as $key => $value) {
                if ($value['role']==$role) {
                    $array[$value['id']] = $value['nombres'].' '.$value['apellidos'];
                }                
            }
        return ($array);
    }
}
