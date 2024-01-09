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

}
