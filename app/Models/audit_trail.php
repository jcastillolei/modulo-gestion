<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class audit_trail
 * @package App\Models
 * @version April 3, 2019, 10:14 pm UTC
 *
 * @property smallInteger type
 * @property integer trans_no
 * @property smallInteger user
 * @property string|\Carbon\Carbon stamp
 * @property string description
 * @property integer fiscal_year
 * @property date gl_date
 * @property integer gl_seq
 */
class audit_trail extends Model
{
    use SoftDeletes;

    public $table = '0_audit_trail';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'type',
        'trans_no',
        'user',
        'stamp',
        'description',
        'fiscal_year',
        'gl_date',
        'gl_seq'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'trans_no' => 'integer',
        'description' => 'string',
        'fiscal_year' => 'integer',
        'gl_date' => 'date',
        'gl_seq' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'type' => 'required',
        'trans_no' => 'required',
        'user' => 'required',
        'stamp' => 'required',
        'fiscal_year' => 'required',
        'gl_date' => 'required'
    ];

    
}
