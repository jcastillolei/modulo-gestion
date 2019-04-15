<?php

namespace App\Repositories;

use App\Models\user_rol;
use App\Repositories\BaseRepository;

/**
 * Class user_rolRepository
 * @package App\Repositories
 * @version April 9, 2019, 2:51 pm UTC
*/

class user_rolRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'idUser',
        'idRol'
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
        return user_rol::class;
    }
}
