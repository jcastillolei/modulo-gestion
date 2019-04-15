<?php

namespace App\Repositories;

use App\Models\log;
use App\Repositories\BaseRepository;

/**
 * Class logRepository
 * @package App\Repositories
 * @version April 2, 2019, 8:27 pm UTC
*/

class logRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id',
        'usuarioLog',
        'descripcion',
        'estado',
        'fecha'
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
        return log::class;
    }
}
