<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Questions;

class QuestionsApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_questions()
    {
        $questions = Questions::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/questions', $questions
        );

        $this->assertApiResponse($questions);
    }

    /**
     * @test
     */
    public function test_read_questions()
    {
        $questions = Questions::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/questions/'.$questions->id
        );

        $this->assertApiResponse($questions->toArray());
    }

    /**
     * @test
     */
    public function test_update_questions()
    {
        $questions = Questions::factory()->create();
        $editedQuestions = Questions::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/questions/'.$questions->id,
            $editedQuestions
        );

        $this->assertApiResponse($editedQuestions);
    }

    /**
     * @test
     */
    public function test_delete_questions()
    {
        $questions = Questions::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/questions/'.$questions->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/questions/'.$questions->id
        );

        $this->response->assertStatus(404);
    }
}
