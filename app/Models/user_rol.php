<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class user_rol
 * @package App\Models
 * @version April 9, 2019, 2:51 pm UTC
 *
 * @property integer idUser
 * @property integer idRol
 */
class user_rol extends Model
{
    use SoftDeletes;

    public $table = 'user_rol';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'idUser',
        'idRol'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'idUser' => 'integer',
        'idRol' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'idUser' => 'required',
        'idRol' => 'required'
    ];

    
}
