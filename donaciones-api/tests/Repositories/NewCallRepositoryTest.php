<?php namespace Tests\Repositories;

use App\Models\NewCall;
use App\Repositories\NewCallRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class NewCallRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var NewCallRepository
     */
    protected $newCallRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->newCallRepo = \App::make(NewCallRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_new_call()
    {
        $newCall = NewCall::factory()->make()->toArray();

        $createdNewCall = $this->newCallRepo->create($newCall);

        $createdNewCall = $createdNewCall->toArray();
        $this->assertArrayHasKey('id', $createdNewCall);
        $this->assertNotNull($createdNewCall['id'], 'Created NewCall must have id specified');
        $this->assertNotNull(NewCall::find($createdNewCall['id']), 'NewCall with given id must be in DB');
        $this->assertModelData($newCall, $createdNewCall);
    }

    /**
     * @test read
     */
    public function test_read_new_call()
    {
        $newCall = NewCall::factory()->create();

        $dbNewCall = $this->newCallRepo->find($newCall->id);

        $dbNewCall = $dbNewCall->toArray();
        $this->assertModelData($newCall->toArray(), $dbNewCall);
    }

    /**
     * @test update
     */
    public function test_update_new_call()
    {
        $newCall = NewCall::factory()->create();
        $fakeNewCall = NewCall::factory()->make()->toArray();

        $updatedNewCall = $this->newCallRepo->update($fakeNewCall, $newCall->id);

        $this->assertModelData($fakeNewCall, $updatedNewCall->toArray());
        $dbNewCall = $this->newCallRepo->find($newCall->id);
        $this->assertModelData($fakeNewCall, $dbNewCall->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_new_call()
    {
        $newCall = NewCall::factory()->create();

        $resp = $this->newCallRepo->delete($newCall->id);

        $this->assertTrue($resp);
        $this->assertNull(NewCall::find($newCall->id), 'NewCall should not exist in DB');
    }
}
