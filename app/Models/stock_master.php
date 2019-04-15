<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class stock_master
 * @package App\Models
 * @version April 2, 2019, 12:40 pm UTC
 *
 * @property integer category_id
 * @property integer tax_type_id
 * @property string description
 * @property string long_description
 * @property string units
 * @property string mb_flag
 * @property string sales_account
 * @property string cogs_account
 * @property string inventory_account
 * @property string adjustment_account
 * @property string wip_account
 * @property integer dimension_id
 * @property integer dimension2_id
 * @property float purchase_cost
 * @property float material_cost
 * @property float labour_cost
 * @property float overhead_cost
 * @property boolean inactive
 * @property boolean no_sale
 * @property boolean no_purchase
 * @property boolean editable
 * @property string depreciation_method
 * @property float depreciation_rate
 * @property float depreciation_factor
 * @property date depreciation_start
 * @property date depreciation_date
 * @property string fa_class_id
 */
class stock_master extends Model
{
    use SoftDeletes;

    public $table = '0_stock_master';

    protected $primaryKey = 'stock_id';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'stock_id',
        'category_id',
        'tax_type_id',
        'description',
        'long_description',
        'units',
        'mb_flag',
        'sales_account',
        'cogs_account',
        'inventory_account',
        'adjustment_account',
        'wip_account',
        'dimension_id',
        'dimension2_id',
        'purchase_cost',
        'material_cost',
        'labour_cost',
        'overhead_cost',
        'inactive',
        'no_sale',
        'no_purchase',
        'editable',
        'depreciation_method',
        'depreciation_rate',
        'depreciation_factor',
        'depreciation_start',
        'depreciation_date',
        'fa_class_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'stock_id' => 'string',
        'category_id' => 'integer',
        'tax_type_id' => 'integer',
        'description' => 'string',
        'long_description' => 'string',
        'units' => 'string',
        'mb_flag' => 'string',
        'sales_account' => 'string',
        'cogs_account' => 'string',
        'inventory_account' => 'string',
        'adjustment_account' => 'string',
        'wip_account' => 'string',
        'dimension_id' => 'integer',
        'dimension2_id' => 'integer',
        'purchase_cost' => 'float',
        'material_cost' => 'float',
        'labour_cost' => 'float',
        'overhead_cost' => 'float',
        'inactive' => 'boolean',
        'no_sale' => 'boolean',
        'no_purchase' => 'boolean',
        'editable' => 'boolean',
        'depreciation_method' => 'string',
        'depreciation_rate' => 'float',
        'depreciation_factor' => 'float',
        'depreciation_start' => 'date',
        'depreciation_date' => 'date',
        'fa_class_id' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'stock_id' => 'required',
        'description' => 'required',
        'inventory_account' => 'required',
        'adjustment_account' => 'required',
        'material_cost' => 'required',
    ];

    
}
