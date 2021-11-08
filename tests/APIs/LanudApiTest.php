<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Lanud;

class LanudApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_lanud()
    {
        $lanud = factory(Lanud::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/lanuds', $lanud
        );

        $this->assertApiResponse($lanud);
    }

    /**
     * @test
     */
    public function test_read_lanud()
    {
        $lanud = factory(Lanud::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/lanuds/'.$lanud->id
        );

        $this->assertApiResponse($lanud->toArray());
    }

    /**
     * @test
     */
    public function test_update_lanud()
    {
        $lanud = factory(Lanud::class)->create();
        $editedLanud = factory(Lanud::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/lanuds/'.$lanud->id,
            $editedLanud
        );

        $this->assertApiResponse($editedLanud);
    }

    /**
     * @test
     */
    public function test_delete_lanud()
    {
        $lanud = factory(Lanud::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/lanuds/'.$lanud->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/lanuds/'.$lanud->id
        );

        $this->response->assertStatus(404);
    }
}
