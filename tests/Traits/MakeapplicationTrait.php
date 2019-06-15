<?php namespace Tests\Traits;

use Faker\Factory as Faker;
use App\Models\Application\application;
use App\Repositories\Application\applicationRepository;

trait MakeapplicationTrait
{
    /**
     * Create fake instance of application and save it in database
     *
     * @param array $applicationFields
     * @return application
     */
    public function makeapplication($applicationFields = [])
    {
        /** @var applicationRepository $applicationRepo */
        $applicationRepo = \App::make(applicationRepository::class);
        $theme = $this->fakeapplicationData($applicationFields);
        return $applicationRepo->create($theme);
    }

    /**
     * Get fake instance of application
     *
     * @param array $applicationFields
     * @return application
     */
    public function fakeapplication($applicationFields = [])
    {
        return new application($this->fakeapplicationData($applicationFields));
    }

    /**
     * Get fake data of application
     *
     * @param array $applicationFields
     * @return array
     */
    public function fakeapplicationData($applicationFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'title' => $fake->text,
            'user_id' => $fake->word,
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s')
        ], $applicationFields);
    }
}
