<?php

namespace App\Repositories;

use App\Models\usuario_bodega;
use App\Repositories\BaseRepository;

/**
 * Class usuario_bodegaRepository
 * @package App\Repositories
 * @version April 2, 2019, 8:28 pm UTC
*/

class usuario_bodegaRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id',
        'idUsuario',
        'idBodega',
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
        return usuario_bodega::class;
    }
}
