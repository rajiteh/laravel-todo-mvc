<?php

namespace TodoMVC\Http\Controllers\API\v1;


use Illuminate\Http\Response;
use Illuminate\Support\Facades\App;
use TodoMVC\Http\Requests;
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
     *
     * @return Response
     */
    public function index()
    {
        return $this->repository->all();
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
     * @param  int  $id
     * @return Response
     */
    public function show($id)
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
