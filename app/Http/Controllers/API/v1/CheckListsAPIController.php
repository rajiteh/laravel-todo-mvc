<?php

namespace TodoMVC\Http\Controllers\API\v1;


use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

use TodoMVC\Exceptions\ValidationException;
use TodoMVC\Repositories\Contracts\CheckListRepositoryInterface as CheckListRepository;
use TodoMVC\Services\Validation\CheckListValidator;
use TodoMVC\Models\CheckListInterface;

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
    private $validator;

    public function __construct(CheckListRepository $checklist, CheckListValidator $validator) {
        $this->repository = $checklist;
        $this->validator = $validator;
    }

    /**
     * Display a listing of the resource.
     * @param Request $req
     * @return Response
     */
    public function index(Request $req)
    {
        if (($uid = $req->input('user_id')))
            return self::jsonResponse($req, $this->repository->ownedByUser($uid));
        else
            return self::jsonResponse($req, $this->repository->all());
    }


    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $req)
    {
        /* @var $checklist CheckListInterface */
        $checklist = $this->repository->newInstance();
        return $this->performEdit($req, $checklist);
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
    public function update(Request $req, $id)
    {
        /* @var $checklist CheckListInterface */
        $checklist = $this->repository->find($id);
        return $this->performEdit($req, $checklist);
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

    private function performEdit($req, CheckListInterface $checklist) {

        $requestData = array_merge($checklist->toArray(), $req->all());

        try {
            $this->validator->validateModel($requestData, $checklist);

            $checklist->setName($requestData['name']);
            $checklist->setUserId($requestData['user_id']);
            $this->repository->save($checklist);

            return $this->show($req, $checklist->getId());
        } catch (ValidationException $e) {
            return self::jsonError($req, $e->getErrors()->toArray());
        }
    }
}
