<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class gl_trans
 * @package App\Models
 * @version April 2, 2019, 12:38 pm UTC
 *
 * @property smallInteger type
 * @property integer type_no
 * @property date tran_date
 * @property string account
 * @property string memo_
 * @property float amount
 * @property integer dimension_id
 * @property integer dimension2_id
 * @property integer person_type_id
 * @property string person_id
 */
class gl_trans extends Model
{
    use SoftDeletes;

    public $table = '0_gl_trans';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'type',
        'type_no',
        'tran_date',
        'account',
        'memo_',
        'amount',
        'dimension_id',
        'dimension2_id',
        'person_type_id',
        'person_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'counter' => 'integer',
        'type_no' => 'integer',
        'tran_date' => 'date',
        'account' => 'string',
        'memo_' => 'string',
        'amount' => 'float',
        'dimension_id' => 'integer',
        'dimension2_id' => 'integer',
        'person_type_id' => 'integer',
        'person_id' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'counter' => 'required',
        'type' => 'required',
        'type_no' => 'required',
        'tran_date' => 'required',
        'account' => 'required',
        'memo_' => 'required',
        'amount' => 'required',
        'dimension_id' => 'required',
        'dimension2_id' => 'required'
    ];

    
}
