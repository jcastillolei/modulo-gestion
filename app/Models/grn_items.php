<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class grn_items
 * @package App\Models
 * @version April 2, 2019, 12:38 pm UTC
 *
 * @property integer grn_batch_id
 * @property integer po_detail_item
 * @property string item_code
 * @property string description
 * @property float qty_recd
 * @property float quantity_inv
 */
class grn_items extends Model
{
    use SoftDeletes;

    public $table = '0_grn_items';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'grn_batch_id',
        'po_detail_item',
        'item_code',
        'description',
        'qty_recd',
        'quantity_inv'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'grn_batch_id' => 'integer',
        'po_detail_item' => 'integer',
        'item_code' => 'string',
        'description' => 'string',
        'qty_recd' => 'float',
        'quantity_inv' => 'float'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'po_detail_item' => 'required',
        'item_code' => 'required',
        'qty_recd' => 'required',
        'quantity_inv' => 'required'
    ];

    
}
