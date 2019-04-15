<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class stock_moves
 * @package App\Models
 * @version April 2, 2019, 12:40 pm UTC
 *
 * @property integer trans_no
 * @property string stock_id
 * @property smallInteger type
 * @property string loc_code
 * @property date tran_date
 * @property float price
 * @property string reference
 * @property float qty
 * @property float standard_cost
 */
class stock_moves extends Model
{
    use SoftDeletes;

    public $table = '0_stock_moves';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'trans_no',
        'stock_id',
        'type',
        'loc_code',
        'tran_date',
        'price',
        'reference',
        'qty',
        'standard_cost'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'trans_id' => 'integer',
        'trans_no' => 'integer',
        'stock_id' => 'string',
        'loc_code' => 'string',
        'tran_date' => 'date',
        'price' => 'float',
        'reference' => 'string',
        'qty' => 'float',
        'standard_cost' => 'float'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'trans_id' => 'required',
        'trans_no' => 'required',
        'stock_id' => 'required',
        'type' => 'required',
        'loc_code' => 'required',
        'tran_date' => 'required',
        'price' => 'required',
        'reference' => 'required',
        'qty' => 'required',
        'standard_cost' => 'required'
    ];

    
}
