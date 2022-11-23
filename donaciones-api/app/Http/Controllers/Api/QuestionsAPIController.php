<?php

namespace App\Http\Controllers\API;

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

    /**
     * Store a newly created Questions in storage.
     * POST /questions
     *
     * @param CreateQuestionsAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateQuestionsAPIRequest $request)
    {
        $input = $request->all();

        $questions = $this->questionsRepository->create($input);

        return $this->sendResponse($questions->toArray(), 'Questions saved successfully');
    }

    /**
     * Display the specified Questions.
     * GET|HEAD /questions/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Questions $questions */
        $questions = $this->questionsRepository->find($id);

        if (empty($questions)) {
            return $this->sendError('Questions not found');
        }

        return $this->sendResponse($questions->toArray(), 'Questions retrieved successfully');
    }

    /**
     * Update the specified Questions in storage.
     * PUT/PATCH /questions/{id}
     *
     * @param int $id
     * @param UpdateQuestionsAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateQuestionsAPIRequest $request)
    {
        $input = $request->all();

        /** @var Questions $questions */
        $questions = $this->questionsRepository->find($id);

        if (empty($questions)) {
            return $this->sendError('Questions not found');
        }

        $questions = $this->questionsRepository->update($input, $id);

        return $this->sendResponse($questions->toArray(), 'Questions updated successfully');
    }

    /**
     * Remove the specified Questions from storage.
     * DELETE /questions/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Questions $questions */
        $questions = $this->questionsRepository->find($id);

        if (empty($questions)) {
            return $this->sendError('Questions not found');
        }

        $questions->delete();

        return $this->sendSuccess('Questions deleted successfully');
    }
}
