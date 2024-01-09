<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\API\CreateQuestionsAPIRequest;
use App\Http\Requests\API\UpdateQuestionsAPIRequest;
use App\Models\Questions;
use App\Repositories\QuestionsRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class QuestionsController
 * @package App\Http\Controllers\API
 */

class QuestionsAPIController extends AppBaseController
{
    /** @var  QuestionsRepository */
    private $questionsRepository;

    public function __construct(QuestionsRepository $questionsRepo)
    {
        $this->questionsRepository = $questionsRepo;
    }

    /**
     * Display a listing of the Questions.
     * GET|HEAD /questions
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $questions = $this->questionsRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($questions->toArray(), 'Questions retrieved successfully');
    }
}
