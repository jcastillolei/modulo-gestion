<?php

namespace App\Repositories;

use App\Models\Transacciones;
use App\Repositories\BaseRepository;

/**
 * Class TransaccionesRepository
 * @package App\Repositories
 * @version April 8, 2019, 5:46 pm UTC
*/

class TransaccionesRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'tipoTransaccion',
        'Bodega',
        'Item',
        'UsuarioSolicitud',
        'cantidad',
        'descripcion',
        'responsable',
        'autorizadoPor',
        'cargo',
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
        return Transacciones::class;
    }
}
