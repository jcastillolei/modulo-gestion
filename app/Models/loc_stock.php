<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class loc_stock
 * @package App\Models
 * @version April 2, 2019, 12:40 pm UTC
 *
 * @property string stock_id
 * @property float reorder_level
 */
class loc_stock extends Model
{
    use SoftDeletes;

    public $table = '0_loc_stock';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $primaryKey = 'loc_code';

    protected $dates = ['deleted_at'];


    public $fillable = [
        'stock_id',
        'reorder_level'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'loc_code' => 'string',
        'stock_id' => 'string',
        'reorder_level' => 'float'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'loc_code' => 'required',
        'stock_id' => 'required',
        'reorder_level' => 'required'
    ];

    
}
