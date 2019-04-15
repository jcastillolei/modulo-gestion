<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class log
 * @package App\Models
 * @version April 2, 2019, 8:27 pm UTC
 *
 * @property integer id
 * @property string usuarioLog
 * @property string descripcion
 * @property integer estado
 * @property string fecha
 */
class log extends Model
{
    use SoftDeletes;

    public $table = 'logs';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'id',
        'usuarioLog',
        'descripcion',
        'estado',
        'fecha'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'usuarioLog' => 'string',
        'descripcion' => 'string',
        'estado' => 'integer',
        'fecha' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'usuarioLog' => 'required',
        'descripcion' => 'required'
    ];

    
}
