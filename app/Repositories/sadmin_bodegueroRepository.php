<?php

namespace App\Repositories;

use App\Models\sadmin_bodeguero;
use App\Repositories\BaseRepository;

/**
 * Class sadmin_bodegueroRepository
 * @package App\Repositories
 * @version May 23, 2019, 3:18 pm UTC
*/

class sadmin_bodegueroRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'idSadmin',
        'idBodeguero'
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
        return sadmin_bodeguero::class;
    }
}
