<?php

namespace App\Repositories\Application;

use App\Models\Application\application;
use App\Repositories\BaseRepository;

/**
 * Class applicationRepository
 * @package App\Repositories\Application
 * @version June 15, 2019, 12:49 pm UTC
*/

class applicationRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'title',
        'user_id'
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
        return application::class;
    }
}
