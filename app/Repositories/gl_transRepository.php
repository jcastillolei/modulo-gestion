<?php

namespace App\Repositories;

use App\Models\gl_trans;
use App\Repositories\BaseRepository;

/**
 * Class gl_transRepository
 * @package App\Repositories
 * @version April 2, 2019, 12:38 pm UTC
*/

class gl_transRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
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
        return gl_trans::class;
    }
}
