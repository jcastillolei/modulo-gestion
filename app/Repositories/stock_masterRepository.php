<?php

namespace App\Repositories;

use App\Models\stock_master;
use App\Repositories\BaseRepository;

/**
 * Class stock_masterRepository
 * @package App\Repositories
 * @version April 2, 2019, 12:40 pm UTC
*/

class stock_masterRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'stock_id',
        'category_id',
        'tax_type_id',
        'description',
        'long_description',
        'units',
        'mb_flag',
        'sales_account',
        'cogs_account',
        'inventory_account',
        'adjustment_account',
        'wip_account',
        'dimension_id',
        'dimension2_id',
        'purchase_cost',
        'material_cost',
        'labour_cost',
        'overhead_cost',
        'inactive',
        'no_sale',
        'no_purchase',
        'editable',
        'depreciation_method',
        'depreciation_rate',
        'depreciation_factor',
        'depreciation_start',
        'depreciation_date',
        'fa_class_id'
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
        return stock_master::class;
    }
}
