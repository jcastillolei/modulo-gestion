<?php

namespace App\Repositories;

use App\Models\audit_trail;
use App\Repositories\BaseRepository;

/**
 * Class audit_trailRepository
 * @package App\Repositories
 * @version April 3, 2019, 10:14 pm UTC
*/

class audit_trailRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
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
        return audit_trail::class;
    }
}
