<?php namespace Tests\Repositories;

use App\Models\Service\service;
use App\Repositories\Service\serviceRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeserviceTrait;
use Tests\ApiTestTrait;

class serviceRepositoryTest extends TestCase
{
    use MakeserviceTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var serviceRepository
     */
    protected $serviceRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->serviceRepo = \App::make(serviceRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_service()
    {
        $service = $this->fakeserviceData();
        $createdservice = $this->serviceRepo->create($service);
        $createdservice = $createdservice->toArray();
        $this->assertArrayHasKey('id', $createdservice);
        $this->assertNotNull($createdservice['id'], 'Created service must have id specified');
        $this->assertNotNull(service::find($createdservice['id']), 'service with given id must be in DB');
        $this->assertModelData($service, $createdservice);
    }

    /**
     * @test read
     */
    public function test_read_service()
    {
        $service = $this->makeservice();
        $dbservice = $this->serviceRepo->find($service->id);
        $dbservice = $dbservice->toArray();
        $this->assertModelData($service->toArray(), $dbservice);
    }

    /**
     * @test update
     */
    public function test_update_service()
    {
        $service = $this->makeservice();
        $fakeservice = $this->fakeserviceData();
        $updatedservice = $this->serviceRepo->update($fakeservice, $service->id);
        $this->assertModelData($fakeservice, $updatedservice->toArray());
        $dbservice = $this->serviceRepo->find($service->id);
        $this->assertModelData($fakeservice, $dbservice->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_service()
    {
        $service = $this->makeservice();
        $resp = $this->serviceRepo->delete($service->id);
        $this->assertTrue($resp);
        $this->assertNull(service::find($service->id), 'service should not exist in DB');
    }
}
