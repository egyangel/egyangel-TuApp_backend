<?php

namespace App\Repositories\Service;

use App\Models\Service\service;
use App\Repositories\BaseRepository;

/**
 * Class serviceRepository
 * @package App\Repositories\Service
 * @version June 15, 2019, 1:30 pm UTC
*/

class serviceRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'title',
        'application_id'
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
        return service::class;
    }
}
