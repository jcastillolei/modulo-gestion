<?php

namespace App\Repositories;

use App\Models\sales_pos;
use App\Repositories\BaseRepository;

/**
 * Class sales_posRepository
 * @package App\Repositories
 * @version April 2, 2019, 12:31 pm UTC
*/

class sales_posRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'pos_name',
        'cash_sale',
        'credit_sale',
        'pos_location',
        'pos_account',
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
        return sales_pos::class;
    }
}
