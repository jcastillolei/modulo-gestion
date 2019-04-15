<?php

namespace App\Repositories;

use App\Models\usuario_normal;
use App\Repositories\BaseRepository;

/**
 * Class usuario_normalRepository
 * @package App\Repositories
 * @version April 2, 2019, 8:28 pm UTC
*/

class usuario_normalRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id',
        'nombre',
        'apellido',
        'cargo',
        'correo',
        'telefono',
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
        return usuario_normal::class;
    }
}
