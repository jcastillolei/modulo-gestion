<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class transacciones_usuariofinal
 * @package App\Models
 * @version August 27, 2019, 7:20 pm UTC
 *
 * @property string Id_UsuarioFinal
 * @property string Codigo_bodega
 * @property string Codigo_item
 * @property string Descripcion_item
 * @property integer Cantidad
 * @property string tipo_transaccion
 * @property date Fecha
 */
class transacciones_usuariofinal extends Model
{
    use SoftDeletes;

    public $table = 'transacciones_usuariofinal';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'Id_UsuarioFinal',
        'Codigo_bodega',
        'Codigo_item',
        'Descripcion_item',
        'Cantidad',
        'tipo_transaccion',
        'Fecha'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'Id_UsuarioFinal' => 'string',
        'Codigo_bodega' => 'string',
        'Codigo_item' => 'string',
        'Descripcion_item' => 'string',
        'Cantidad' => 'integer',
        'tipo_transaccion' => 'string',
        'Fecha' => 'date'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'Id_UsuarioFinal' => 'required',
        'Codigo_bodega' => 'required',
        'Codigo_item' => 'required',
        'Descripcion_item' => 'required',
        'Cantidad' => 'required',
        'tipo_transaccion' => 'required'
    ];

    
}
