<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class item_bodega
 * @package App\Models
 * @version April 2, 2019, 8:27 pm UTC
 *
 * @property integer id
 * @property integer idItem
 * @property integer idBodega
 * @property integer stock
 * @property integer estado
 */
class item_bodega extends Model
{
    use SoftDeletes;

    public $table = 'item_bodegas';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'id',
        'idItem',
        'idBodega',
        'stock',
        'estado'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'idItem' => 'integer',
        'idBodega' => 'integer',
        'stock' => 'integer',
        'estado' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'idItem' => 'required',
        'idBodega' => 'required',
        'stock' => 'required',
        'estado' => 'required'
    ];

    
}
