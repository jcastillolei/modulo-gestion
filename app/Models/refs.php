<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class refs
 * @package App\Models
 * @version April 4, 2019, 12:58 pm UTC
 *
 * @property integer type
 * @property string reference
 */
class refs extends Model
{
    use SoftDeletes;

    public $table = '0_refs';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'type',
        'reference'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'type' => 'integer',
        'reference' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'type' => 'required',
        'reference' => 'required'
    ];

    
}
