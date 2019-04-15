<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class usuario_normal
 * @package App\Models
 * @version April 2, 2019, 8:28 pm UTC
 *
 * @property integer id
 * @property string nombre
 * @property string apellido
 * @property string cargo
 * @property string correo
 * @property string telefono
 * @property integer estado
 */
class usuario_normal extends Model
{
    use SoftDeletes;

    public $table = 'usuario_normals';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'id',
        'nombre',
        'apellido',
        'cargo',
        'correo',
        'telefono',
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
        'apellido' => 'string',
        'cargo' => 'string',
        'correo' => 'string',
        'telefono' => 'string',
        'estado' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'nombre' => 'required',
        'apellido' => 'required',
        'cargo' => 'required',
        'correo' => 'required',
        'telefono' => 'required',
        'estado' => 'required'
    ];

    
}
