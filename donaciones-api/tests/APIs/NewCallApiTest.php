<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\NewCall;

class NewCallApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_new_call()
    {
        $newCall = NewCall::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/new_calls', $newCall
        );

        $this->assertApiResponse($newCall);
    }

    /**
     * @test
     */
    public function test_read_new_call()
    {
        $newCall = NewCall::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/new_calls/'.$newCall->id
        );

        $this->assertApiResponse($newCall->toArray());
    }

    /**
     * @test
     */
    public function test_update_new_call()
    {
        $newCall = NewCall::factory()->create();
        $editedNewCall = NewCall::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/new_calls/'.$newCall->id,
            $editedNewCall
        );

        $this->assertApiResponse($editedNewCall);
    }

    /**
     * @test
     */
    public function test_delete_new_call()
    {
        $newCall = NewCall::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/new_calls/'.$newCall->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/new_calls/'.$newCall->id
        );

        $this->response->assertStatus(404);
    }
}
