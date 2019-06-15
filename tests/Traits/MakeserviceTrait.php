<?php namespace Tests\Traits;

use Faker\Factory as Faker;
use App\Models\Service\service;
use App\Repositories\Service\serviceRepository;

trait MakeserviceTrait
{
    /**
     * Create fake instance of service and save it in database
     *
     * @param array $serviceFields
     * @return service
     */
    public function makeservice($serviceFields = [])
    {
        /** @var serviceRepository $serviceRepo */
        $serviceRepo = \App::make(serviceRepository::class);
        $theme = $this->fakeserviceData($serviceFields);
        return $serviceRepo->create($theme);
    }

    /**
     * Get fake instance of service
     *
     * @param array $serviceFields
     * @return service
     */
    public function fakeservice($serviceFields = [])
    {
        return new service($this->fakeserviceData($serviceFields));
    }

    /**
     * Get fake data of service
     *
     * @param array $serviceFields
     * @return array
     */
    public function fakeserviceData($serviceFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'title' => $fake->text,
            'application_id' => $fake->randomDigitNotNull,
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s')
        ], $serviceFields);
    }
}
