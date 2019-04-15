<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class chart_master
 * @package App\Models
 * @version April 2, 2019, 12:37 pm UTC
 *
 * @property string account_code2
 * @property string account_name
 * @property string account_type
 * @property boolean inactive
 */
class chart_master extends Model
{
    use SoftDeletes;

    public $table = '0_chart_master';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'account_code2',
        'account_name',
        'account_type',
        'inactive'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'account_code' => 'string',
        'account_code2' => 'string',
        'account_name' => 'string',
        'account_type' => 'string',
        'inactive' => 'boolean'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'account_code' => 'required',
        'account_code2' => 'required',
        'account_name' => 'required',
        'account_type' => 'required',
        'inactive' => 'required'
    ];

    
}
