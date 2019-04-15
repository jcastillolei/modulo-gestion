<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class locations
 * @package App\Models
 * @version April 2, 2019, 12:39 pm UTC
 *
 * @property string location_name
 * @property string delivery_address
 * @property string phone
 * @property string phone2
 * @property string fax
 * @property string email
 * @property string contact
 * @property boolean fixed_asset
 * @property boolean inactive
 */
class locations extends Model
{
    use SoftDeletes;

    public $table = '0_locations';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];

    protected $primaryKey = 'loc_code';

    public $fillable = [
        'loc_code' => 'string',
        'location_name',
        'delivery_address',
        'phone',
        'phone2',
        'fax',
        'email',
        'contact',
        'fixed_asset',
        'inactive'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'loc_code' => 'string',
        'location_name' => 'string',
        'delivery_address' => 'string',
        'phone' => 'string',
        'phone2' => 'string',
        'fax' => 'string',
        'email' => 'string',
        'contact' => 'string',
        'fixed_asset' => 'boolean',
        'inactive' => 'boolean'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'loc_code' => 'required',
        'location_name' => 'required',
        'delivery_address' => 'required',
        'phone' => 'required',


        'email' => 'required',
        'contact' => 'required',

    ];

    
}
