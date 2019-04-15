<?php

namespace App\Repositories;

use App\Models\stock_moves;
use App\Repositories\BaseRepository;

/**
 * Class stock_movesRepository
 * @package App\Repositories
 * @version April 2, 2019, 12:40 pm UTC
*/

class stock_movesRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'trans_no',
        'stock_id',
        'type',
        'loc_code',
        'tran_date',
        'price',
        'reference',
        'qty',
        'standard_cost'
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
        return stock_moves::class;
    }
}
