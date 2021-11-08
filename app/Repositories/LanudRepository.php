<?php

namespace App\Repositories;

use App\Models\Lanud;
use App\Repositories\BaseRepository;

/**
 * Class LanudRepository
 * @package App\Repositories
 * @version November 7, 2021, 2:51 pm UTC
*/

class LanudRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'initial',
        'name'
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
        return Lanud::class;
    }
}
