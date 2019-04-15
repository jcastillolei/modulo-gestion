<?php

namespace App\Repositories;

use App\Models\item_codes;
use App\Repositories\BaseRepository;

/**
 * Class item_codesRepository
 * @package App\Repositories
 * @version April 2, 2019, 12:39 pm UTC
*/

class item_codesRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'item_code',
        'stock_id',
        'description',
        'category_id',
        'quantity',
        'is_foreign',
        'inactive'
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
        return item_codes::class;
    }
}
