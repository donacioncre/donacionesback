<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\API\CreateNewCallAPIRequest;
use App\Http\Requests\API\UpdateNewCallAPIRequest;
use App\Models\NewCall;
use App\Repositories\NewCallRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class NewCallController
 * @package App\Http\Controllers\API
 */

class NewCallAPIController extends AppBaseController
{
    /** @var  NewCallRepository */
    private $newCallRepository;

    public function __construct(NewCallRepository $newCallRepo)
    {
        $this->newCallRepository = $newCallRepo;
    }

    /**
     * Display a listing of the NewCall.
     * GET|HEAD /newCalls
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $data=[];
        $newCalls = $this->newCallRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );  

        foreach($newCalls as $key => $value){

            $data[]=[
                'title' => $value->title,
                'description' => $value->description,
                'image' => $value->image,
                'author' => $value->user->firstname . ' ' . $value->user->lastname,
                'created_at' => $value->created_at->format('Y-m-d')
            ];
           
        }
        

        return $this->sendResponse($data, 'New Calls retrieved successfully');
    }

    /**
     * Store a newly created NewCall in storage.
     * POST /newCalls
     * 
     * @param CreateNewCallAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateNewCallAPIRequest $request)
    {
        $input = $request->all();

        $newCall = $this->newCallRepository->create($input);

        return $this->sendResponse($newCall->toArray(), 'New Call saved successfully');
    }

    /**
     * Display the specified NewCall.
     * GET|HEAD /newCalls/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var NewCall $newCall */
        $newCall = $this->newCallRepository->find($id);

        if (empty($newCall)) {
            return $this->sendError('New Call not found');
        }

        return $this->sendResponse($newCall->toArray(), 'New Call retrieved successfully');
    }

    /**
     * Update the specified NewCall in storage.
     * PUT/PATCH /newCalls/{id}
     *
     * @param int $id
     * @param UpdateNewCallAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateNewCallAPIRequest $request)
    {
        $input = $request->all();

        /** @var NewCall $newCall */
        $newCall = $this->newCallRepository->find($id);

        if (empty($newCall)) {
            return $this->sendError('New Call not found');
        }

        $newCall = $this->newCallRepository->update($input, $id);

        return $this->sendResponse($newCall->toArray(), 'NewCall updated successfully');
    }

    /**
     * Remove the specified NewCall from storage.
     * DELETE /newCalls/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var NewCall $newCall */
        $newCall = $this->newCallRepository->find($id);

        if (empty($newCall)) {
            return $this->sendError('New Call not found');
        }

        $newCall->delete();

        return $this->sendSuccess('New Call deleted successfully');
    }
}
