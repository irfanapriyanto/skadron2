<?php namespace Tests\Repositories;

use App\Models\Lanud;
use App\Repositories\LanudRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class LanudRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var LanudRepository
     */
    protected $lanudRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->lanudRepo = \App::make(LanudRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_lanud()
    {
        $lanud = factory(Lanud::class)->make()->toArray();

        $createdLanud = $this->lanudRepo->create($lanud);

        $createdLanud = $createdLanud->toArray();
        $this->assertArrayHasKey('id', $createdLanud);
        $this->assertNotNull($createdLanud['id'], 'Created Lanud must have id specified');
        $this->assertNotNull(Lanud::find($createdLanud['id']), 'Lanud with given id must be in DB');
        $this->assertModelData($lanud, $createdLanud);
    }

    /**
     * @test read
     */
    public function test_read_lanud()
    {
        $lanud = factory(Lanud::class)->create();

        $dbLanud = $this->lanudRepo->find($lanud->id);

        $dbLanud = $dbLanud->toArray();
        $this->assertModelData($lanud->toArray(), $dbLanud);
    }

    /**
     * @test update
     */
    public function test_update_lanud()
    {
        $lanud = factory(Lanud::class)->create();
        $fakeLanud = factory(Lanud::class)->make()->toArray();

        $updatedLanud = $this->lanudRepo->update($fakeLanud, $lanud->id);

        $this->assertModelData($fakeLanud, $updatedLanud->toArray());
        $dbLanud = $this->lanudRepo->find($lanud->id);
        $this->assertModelData($fakeLanud, $dbLanud->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_lanud()
    {
        $lanud = factory(Lanud::class)->create();

        $resp = $this->lanudRepo->delete($lanud->id);

        $this->assertTrue($resp);
        $this->assertNull(Lanud::find($lanud->id), 'Lanud should not exist in DB');
    }
}
