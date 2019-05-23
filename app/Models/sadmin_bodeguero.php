<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class sadmin_bodeguero
 * @package App\Models
 * @version May 23, 2019, 3:18 pm UTC
 *
 * @property bigInteger idSadmin
 * @property bigInteger idBodeguero
 */
class sadmin_bodeguero extends Model
{
    use SoftDeletes;

    public $table = 'sadmin_bodeguero';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'idSadmin',
        'idBodeguero'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'idSadmin' => 'required',
        'idBodeguero' => 'required'
    ];

    
}
