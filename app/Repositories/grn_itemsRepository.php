<?php

namespace App\Repositories;

use App\Models\grn_items;
use App\Repositories\BaseRepository;

/**
 * Class grn_itemsRepository
 * @package App\Repositories
 * @version April 2, 2019, 12:38 pm UTC
*/

class grn_itemsRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'grn_batch_id',
        'po_detail_item',
        'item_code',
        'description',
        'qty_recd',
        'quantity_inv'
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
        return grn_items::class;
    }
}
