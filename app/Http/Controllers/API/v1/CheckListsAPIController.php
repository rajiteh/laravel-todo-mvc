<?php

namespace TodoMVC\Http\Controllers\API\v1;


use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

use TodoMVC\Repositories\Contracts\CheckListRepositoryInterface as CheckListRepository;

/**
 * Class CheckListsController
 * @package TodoMVC\Http\Controllers
 */
class CheckListsAPIController extends APIController
{

    /**
     * @var CheckListRepository
     */
    private $repository;

    public function __construct(CheckListRepository $checklist) {
        $this->repository = $checklist;
    }

    /**
     * Display a listing of the resource.
     * @param Request $req
     * @return Response
     */
    public function index(Request $req)
    {
        return self::jsonResponse($req, $this->repository->all());
    }


    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  Request $req
     * @param  int  $id
     * @return Response
     */
    public function show(Request $req, $id)
    {
        return self::jsonResponse($req, $this->repository->find($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
