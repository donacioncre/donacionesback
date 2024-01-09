<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\ConvocationRepository;
use Exception;
use Illuminate\Http\Request;

class ConvocationController extends Controller
{

    private $errorStatus = 500;
    protected $convocation;

    public function __construct(ConvocationRepository $convocation)
    {
        $this->convocation = $convocation;
    }

    public function index()
    {
        try {
            $data = $this->convocation->list();
            return response()->json(['status' => true, 'data' => $data]);
        } catch (Exception $ex) {
            return response()->json(['status' => false, 'error' => 'Algo a sucedido por favor intente después de unos minutos', 'message' => $ex->getMessage()], $this->errorStatus);
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $data = $this->convocation->show($id);
            return response()->json(['status' => true, 'data' => $data]);
        } catch (Exception $ex) {
            return response()->json(['status' => false, 'error' => 'Algo a sucedido por favor intente después de unos minutos', 'message' => $ex->getMessage()], $this->errorStatus);
        }
    }
}
