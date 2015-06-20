<?php

namespace TodoMVC\Http\Controllers\API\v1;

use Illuminate\Http\Request;
use TodoMVC\Repositories\Contracts\TaskRepositoryInterface as TaskRepository;

class TasksAPIController extends APIController
{

    /**
     * @var TaskRepository
     */
    private $repository;

    public function __construct(TaskRepository $checklist) {
        $this->repository = $checklist;
    }


    /**
     * @param Request $req
     * @param $checkListId
     * @return \Illuminate\Http\Response
     */
    public function index(Request $req, $checkListId)
    {
        return self::jsonResponse($req, $this->repository->ownedByCheckList($checkListId));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        //
    }


    /**
     * @param Request $req
     * @param $checkListId
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $req, $checkListId, $id)
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
        //
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
