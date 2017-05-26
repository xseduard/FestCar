<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class triangulo
 * @package App\Models
 * @version May 26, 2017, 12:17 am UTC
 */
class triangulo extends Model
{
    use SoftDeletes;

    public $table = 'triangulos';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'texto',
        'numero'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'texto' => 'string',
        'numero' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'texto' => 'required',
        'numero' => 'numeric'
    ];

    
}
