<?php

namespace App\Repositories;

use App\Models\Estimate;
use App\Repositories\BaseRepository;

/**
 * Class EstimateRepository
 * @package App\Repositories
 * @version November 8, 2021, 11:52 am UTC
*/

class EstimateRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'lanud_from',
        'lanud_to',
        'est_time'
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
        return Estimate::class;
    }
}
