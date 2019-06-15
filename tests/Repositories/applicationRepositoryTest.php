<?php namespace Tests\Repositories;

use App\Models\Application\application;
use App\Repositories\Application\applicationRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeapplicationTrait;
use Tests\ApiTestTrait;

class applicationRepositoryTest extends TestCase
{
    use MakeapplicationTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var applicationRepository
     */
    protected $applicationRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->applicationRepo = \App::make(applicationRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_application()
    {
        $application = $this->fakeapplicationData();
        $createdapplication = $this->applicationRepo->create($application);
        $createdapplication = $createdapplication->toArray();
        $this->assertArrayHasKey('id', $createdapplication);
        $this->assertNotNull($createdapplication['id'], 'Created application must have id specified');
        $this->assertNotNull(application::find($createdapplication['id']), 'application with given id must be in DB');
        $this->assertModelData($application, $createdapplication);
    }

    /**
     * @test read
     */
    public function test_read_application()
    {
        $application = $this->makeapplication();
        $dbapplication = $this->applicationRepo->find($application->id);
        $dbapplication = $dbapplication->toArray();
        $this->assertModelData($application->toArray(), $dbapplication);
    }

    /**
     * @test update
     */
    public function test_update_application()
    {
        $application = $this->makeapplication();
        $fakeapplication = $this->fakeapplicationData();
        $updatedapplication = $this->applicationRepo->update($fakeapplication, $application->id);
        $this->assertModelData($fakeapplication, $updatedapplication->toArray());
        $dbapplication = $this->applicationRepo->find($application->id);
        $this->assertModelData($fakeapplication, $dbapplication->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_application()
    {
        $application = $this->makeapplication();
        $resp = $this->applicationRepo->delete($application->id);
        $this->assertTrue($resp);
        $this->assertNull(application::find($application->id), 'application should not exist in DB');
    }
}
