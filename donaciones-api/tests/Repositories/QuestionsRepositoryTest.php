<?php namespace Tests\Repositories;

use App\Models\Questions;
use App\Repositories\QuestionsRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class QuestionsRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var QuestionsRepository
     */
    protected $questionsRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->questionsRepo = \App::make(QuestionsRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_questions()
    {
        $questions = Questions::factory()->make()->toArray();

        $createdQuestions = $this->questionsRepo->create($questions);

        $createdQuestions = $createdQuestions->toArray();
        $this->assertArrayHasKey('id', $createdQuestions);
        $this->assertNotNull($createdQuestions['id'], 'Created Questions must have id specified');
        $this->assertNotNull(Questions::find($createdQuestions['id']), 'Questions with given id must be in DB');
        $this->assertModelData($questions, $createdQuestions);
    }

    /**
     * @test read
     */
    public function test_read_questions()
    {
        $questions = Questions::factory()->create();

        $dbQuestions = $this->questionsRepo->find($questions->id);

        $dbQuestions = $dbQuestions->toArray();
        $this->assertModelData($questions->toArray(), $dbQuestions);
    }

    /**
     * @test update
     */
    public function test_update_questions()
    {
        $questions = Questions::factory()->create();
        $fakeQuestions = Questions::factory()->make()->toArray();

        $updatedQuestions = $this->questionsRepo->update($fakeQuestions, $questions->id);

        $this->assertModelData($fakeQuestions, $updatedQuestions->toArray());
        $dbQuestions = $this->questionsRepo->find($questions->id);
        $this->assertModelData($fakeQuestions, $dbQuestions->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_questions()
    {
        $questions = Questions::factory()->create();

        $resp = $this->questionsRepo->delete($questions->id);

        $this->assertTrue($resp);
        $this->assertNull(Questions::find($questions->id), 'Questions should not exist in DB');
    }
}
