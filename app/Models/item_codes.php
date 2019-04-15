<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class item_codes
 * @package App\Models
 * @version April 2, 2019, 12:39 pm UTC
 *
 * @property string item_code
 * @property string stock_id
 * @property string description
 * @property smallInteger category_id
 * @property float quantity
 * @property boolean is_foreign
 * @property boolean inactive
 */
class item_codes extends Model
{
    use SoftDeletes;

    public $table = '0_item_codes';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'item_code',
        'stock_id',
        'description',
        'category_id',
        'quantity',
        'is_foreign',
        'inactive'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'item_code' => 'string',
        'stock_id' => 'string',
        'description' => 'string',
        'quantity' => 'float',
        'is_foreign' => 'boolean',
        'inactive' => 'boolean'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'item_code' => 'required',
        'stock_id' => 'required',
        'description' => 'required',
        'category_id' => 'required',
        'quantity' => 'required',
        'is_foreign' => 'required',
        'inactive' => 'required'
    ];

    
}
