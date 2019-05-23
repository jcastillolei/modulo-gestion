<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class bodega_usuarionormal
 * @package App\Models
 * @version May 23, 2019, 3:17 pm UTC
 *
 * @property string codBodega
 * @property bigInteger idUsuarioNormall
 */
class bodega_usuarionormal extends Model
{
    use SoftDeletes;

    public $table = 'bodega_usuarionormal';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'codBodega',
        'idUsuarioNormall'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'codBodega' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'codBodega' => 'required',
        'idUsuarioNormall' => 'required'
    ];

    
}
