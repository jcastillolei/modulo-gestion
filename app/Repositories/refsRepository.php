<?php

namespace App\Repositories;

use App\Models\refs;
use App\Repositories\BaseRepository;

/**
 * Class refsRepository
 * @package App\Repositories
 * @version April 4, 2019, 12:58 pm UTC
*/

class refsRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'type',
        'reference'
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
        return refs::class;
    }
}
