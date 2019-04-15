<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Transacciones
 * @package App\Models
 * @version April 8, 2019, 5:46 pm UTC
 *
 * @property string tipoTransaccion
 * @property string Bodega
 * @property string Item
 * @property string UsuarioSolicitud
 * @property integer cantidad
 * @property string descripcion
 * @property string responsable
 * @property string autorizadoPor
 * @property string cargo
 * @property integer estado
 */
class Transacciones extends Model
{
    use SoftDeletes;

    public $table = 'transaccions';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'tipoTransaccion',
        'Bodega',
        'Item',
        'UsuarioSolicitud',
        'cantidad',
        'descripcion',
        'responsable',
        'autorizadoPor',
        'cargo',
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
        'tipoTransaccion' => 'string',
        'Bodega' => 'string',
        'Item' => 'string',
        'UsuarioSolicitud' => 'string',
        'cantidad' => 'integer',
        'descripcion' => 'string',
        'responsable' => 'string',
        'autorizadoPor' => 'string',
        'cargo' => 'string',
        'estado' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'tipoTransaccion' => 'required',
        'Bodega' => 'required',
        'Item' => 'required',
        'UsuarioSolicitud' => 'required',
        'cantidad' => 'required',
        'descripcion' => 'required',
        'responsable' => 'required',
        'autorizadoPor' => 'required',
        'cargo' => 'required'
    ];

    
}
