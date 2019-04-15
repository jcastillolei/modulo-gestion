<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class tipo_transaccion
 * @package App\Models
 * @version April 2, 2019, 8:27 pm UTC
 *
 * @property integer id
 * @property string nombre
 * @property integer estado
 */
class tipo_transaccion extends Model
{
    use SoftDeletes;

    public $table = 'tipo_transaccions';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'id',
        'nombre',
        'estado'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'nombre' => 'string',
        'estado' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'nombre' => 'required',
        'estado' => 'required'
    ];

    
}
