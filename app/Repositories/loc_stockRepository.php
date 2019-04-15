<?php

namespace App\Repositories;

use App\Models\loc_stock;
use App\Repositories\BaseRepository;

/**
 * Class loc_stockRepository
 * @package App\Repositories
 * @version April 2, 2019, 12:40 pm UTC
*/

class loc_stockRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'stock_id',
        'reorder_level'
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
        return loc_stock::class;
    }
}
