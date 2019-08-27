<?php

namespace App\Repositories;

use App\Models\transacciones_usuariofinal;
use App\Repositories\BaseRepository;

/**
 * Class transacciones_usuariofinalRepository
 * @package App\Repositories
 * @version August 27, 2019, 7:20 pm UTC
*/

class transacciones_usuariofinalRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'Id_UsuarioFinal',
        'Codigo_bodega',
        'Codigo_item',
        'Descripcion_item',
        'Cantidad',
        'tipo_transaccion',
        'Fecha'
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
        return transacciones_usuariofinal::class;
    }
}
