<?php

namespace App\Repositories;

use App\user;
use App\Repositories\BaseRepository;

/**
 * Class userRepository
 * @package App\Repositories
 * @version April 2, 2019, 8:40 pm UTC
*/

class userRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'email',
        'email_verified_at',
        'password',
        'remember_token'
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
        return user::class;
    }
}
