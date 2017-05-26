<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class cuadro
 * @package App\Models
 * @version May 26, 2017, 12:55 am UTC
 */
class cuadro extends Model
{
    use SoftDeletes;

    public $table = 'cuadros';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'nombre_cuadro',
        'numero',
        'correo'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'nombre_cuadro' => 'string',
        'numero' => 'integer',
        'correo' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'nombre_cuadro' => 'alpha',
        'numero' => 'integer',
        'correo' => 'email'
    ];

    
}
