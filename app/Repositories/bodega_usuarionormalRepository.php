<?php

namespace App\Repositories;

use App\Models\bodega_usuarionormal;
use App\Repositories\BaseRepository;

/**
 * Class bodega_usuarionormalRepository
 * @package App\Repositories
 * @version May 23, 2019, 3:17 pm UTC
*/

class bodega_usuarionormalRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'codBodega',
        'idUsuarioNormall'
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
        return bodega_usuarionormal::class;
    }
}
