<?php

namespace App\Repositories;

use App\Models\chart_master;
use App\Repositories\BaseRepository;

/**
 * Class chart_masterRepository
 * @package App\Repositories
 * @version April 2, 2019, 12:37 pm UTC
*/

class chart_masterRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'account_code2',
        'account_name',
        'account_type',
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
        return chart_master::class;
    }
}
