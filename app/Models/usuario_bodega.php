<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class usuario_bodega
 * @package App\Models
 * @version April 2, 2019, 8:28 pm UTC
 *
 * @property integer id
 * @property integer idUsuario
 * @property integer idBodega
 * @property integer estado
 */
class usuario_bodega extends Model
{
    use SoftDeletes;

    public $table = 'usuario_bodegas';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'idUsuario',
        'idBodega',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'idUsuario' => 'integer',
        'idBodega' => 'string',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'idUsuario' => 'required',
        'idBodega' => 'required',
    ];

    
}
