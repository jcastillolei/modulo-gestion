<?php

namespace App\Repositories;

use App\Models\item_bodega;
use App\Repositories\BaseRepository;

/**
 * Class item_bodegaRepository
 * @package App\Repositories
 * @version April 2, 2019, 8:27 pm UTC
*/

class item_bodegaRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id',
        'idItem',
        'idBodega',
        'stock',
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
        return item_bodega::class;
    }
}
