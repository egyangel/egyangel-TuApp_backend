<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeapplicationTrait;
use Tests\ApiTestTrait;

class applicationApiTest extends TestCase
{
    use MakeapplicationTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_application()
    {
        $application = $this->fakeapplicationData();
        $this->response = $this->json('POST', '/api/application/applications', $application);

        $this->assertApiResponse($application);
    }

    /**
     * @test
     */
    public function test_read_application()
    {
        $application = $this->makeapplication();
        $this->response = $this->json('GET', '/api/application/applications/'.$application->id);

        $this->assertApiResponse($application->toArray());
    }

    /**
     * @test
     */
    public function test_update_application()
    {
        $application = $this->makeapplication();
        $editedapplication = $this->fakeapplicationData();

        $this->response = $this->json('PUT', '/api/application/applications/'.$application->id, $editedapplication);

        $this->assertApiResponse($editedapplication);
    }

    /**
     * @test
     */
    public function test_delete_application()
    {
        $application = $this->makeapplication();
        $this->response = $this->json('DELETE', '/api/application/applications/'.$application->id);

        $this->assertApiSuccess();
        $this->response = $this->json('GET', '/api/application/applications/'.$application->id);

        $this->response->assertStatus(404);
    }
}
