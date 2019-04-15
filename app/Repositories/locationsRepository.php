<?php

namespace App\Repositories;

use App\Models\locations;
use App\Repositories\BaseRepository;

/**
 * Class locationsRepository
 * @package App\Repositories
 * @version April 2, 2019, 12:39 pm UTC
*/

class locationsRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
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
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return locations::class;
    }
}
