<?php namespace Tests\Repositories;

use App\Models\Estimate;
use App\Repositories\EstimateRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class EstimateRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var EstimateRepository
     */
    protected $estimateRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->estimateRepo = \App::make(EstimateRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_estimate()
    {
        $estimate = factory(Estimate::class)->make()->toArray();

        $createdEstimate = $this->estimateRepo->create($estimate);

        $createdEstimate = $createdEstimate->toArray();
        $this->assertArrayHasKey('id', $createdEstimate);
        $this->assertNotNull($createdEstimate['id'], 'Created Estimate must have id specified');
        $this->assertNotNull(Estimate::find($createdEstimate['id']), 'Estimate with given id must be in DB');
        $this->assertModelData($estimate, $createdEstimate);
    }

    /**
     * @test read
     */
    public function test_read_estimate()
    {
        $estimate = factory(Estimate::class)->create();

        $dbEstimate = $this->estimateRepo->find($estimate->id);

        $dbEstimate = $dbEstimate->toArray();
        $this->assertModelData($estimate->toArray(), $dbEstimate);
    }

    /**
     * @test update
     */
    public function test_update_estimate()
    {
        $estimate = factory(Estimate::class)->create();
        $fakeEstimate = factory(Estimate::class)->make()->toArray();

        $updatedEstimate = $this->estimateRepo->update($fakeEstimate, $estimate->id);

        $this->assertModelData($fakeEstimate, $updatedEstimate->toArray());
        $dbEstimate = $this->estimateRepo->find($estimate->id);
        $this->assertModelData($fakeEstimate, $dbEstimate->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_estimate()
    {
        $estimate = factory(Estimate::class)->create();

        $resp = $this->estimateRepo->delete($estimate->id);

        $this->assertTrue($resp);
        $this->assertNull(Estimate::find($estimate->id), 'Estimate should not exist in DB');
    }
}
