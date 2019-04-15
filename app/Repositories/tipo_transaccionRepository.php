<?php

namespace App\Repositories;

use App\Models\tipo_transaccion;
use App\Repositories\BaseRepository;

/**
 * Class tipo_transaccionRepository
 * @package App\Repositories
 * @version April 2, 2019, 8:27 pm UTC
*/

class tipo_transaccionRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id',
        'nombre',
        'estado'
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
        return tipo_transaccion::class;
    }
}
