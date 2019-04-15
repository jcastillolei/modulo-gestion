<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class sales_pos
 * @package App\Models
 * @version April 2, 2019, 12:31 pm UTC
 *
 * @property string pos_name
 * @property boolean cash_sale
 * @property boolean credit_sale
 * @property string pos_location
 * @property smallInteger pos_account
 * @property boolean inactive
 */
class sales_pos extends Model
{
    use SoftDeletes;

    public $table = '0_sales_pos';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'pos_name',
        'cash_sale',
        'credit_sale',
        'pos_location',
        'pos_account',
        'inactive'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'pos_name' => 'string',
        'cash_sale' => 'boolean',
        'credit_sale' => 'boolean',
        'pos_location' => 'string',
        'inactive' => 'boolean'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'pos_name' => 'required',
        'cash_sale' => 'required',
        'credit_sale' => 'required',
        'pos_location' => 'required',
        'pos_account' => 'required',
        'inactive' => 'required'
    ];

    
}
