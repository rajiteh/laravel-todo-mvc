<?php

namespace TodoMVC\Http\Controllers\API\v1;

use TodoMVC\Http\Requests;
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
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index($checkListId)
    {
        return $this->repository->ownedByCheckList($checkListId);
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($checkListId, $id)
    {
        return $this->repository->find($id);
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
