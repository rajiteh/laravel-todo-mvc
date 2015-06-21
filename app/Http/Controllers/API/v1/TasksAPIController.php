<?php

namespace TodoMVC\Http\Controllers\API\v1;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\App;
use TodoMVC\Exceptions\ValidationException;
use TodoMVC\Repositories\Contracts\TaskRepositoryInterface as TaskRepository;
use TodoMVC\Services\Validation\TaskValidator as TaskValidator;
use TodoMVC\Models\TaskInterface as TaskInterface;

class TasksAPIController extends APIController
{

    /**
     * @var TaskRepository
     */
    private $repository;

    /**
     * @var TaskValidator
     */
    private $validator;

    public function __construct(TaskRepository $checklist, TaskValidator $validator) {
        $this->repository = $checklist;
        $this->validator = $validator;
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
    public function store(Request $req, $checklistId)
    {
        /* @var $task TaskInterface */
        $task = $this->repository->newInstance();
        return $this->performEdit($req, $task, $checklistId);
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
    public function update(Request $req, $checklistId, $taskId)
    {

        /* @var $task TaskInterface */
        $task = $this->repository->find($taskId);

        if (is_null($task)) {
            return self::jsonError($req, "Task does not exist.");
        }
        if ($task->getCheckListId() != $checklistId) {
            return self::jsonError($req, "Task does not belong to the checklist.");
        }

        return $this->performEdit($req, $task, $checklistId);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($checkListId, $id)
    {
        $this->repository->delete($id);
        return (new Response())->setStatusCode(Response::HTTP_OK);
    }

    private function performEdit($req, $task, $checklistId) {

        $requestData = array_merge($task->toArray(), $req->all());
        $requestData['check_list_id'] = $checklistId;

        try {
            $this->validator->validateModel($requestData, $task);

            $task->setCheckListId($requestData['check_list_id']);

            $task->setTitle($requestData['title']);
            $task->setDescription(isset($requestData['description']) ?: '');
            $task->setDone(isset($requestData['done']) ?: "0");
            $this->repository->save($task);

            return $this->show($req, $checklistId, $task->getId());
        } catch (ValidationException $e) {
            return self::jsonError($req, $e->getErrors()->toArray());
        }
    }
}
