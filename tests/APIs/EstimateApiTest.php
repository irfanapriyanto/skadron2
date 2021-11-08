<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Estimate;

class EstimateApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_estimate()
    {
        $estimate = factory(Estimate::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/estimates', $estimate
        );

        $this->assertApiResponse($estimate);
    }

    /**
     * @test
     */
    public function test_read_estimate()
    {
        $estimate = factory(Estimate::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/estimates/'.$estimate->id
        );

        $this->assertApiResponse($estimate->toArray());
    }

    /**
     * @test
     */
    public function test_update_estimate()
    {
        $estimate = factory(Estimate::class)->create();
        $editedEstimate = factory(Estimate::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/estimates/'.$estimate->id,
            $editedEstimate
        );

        $this->assertApiResponse($editedEstimate);
    }

    /**
     * @test
     */
    public function test_delete_estimate()
    {
        $estimate = factory(Estimate::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/estimates/'.$estimate->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/estimates/'.$estimate->id
        );

        $this->response->assertStatus(404);
    }
}
