<?php
/**
 * Created by PhpStorm.
 * User: rajiteh
 * Date: 15-06-18
 * Time: 4:26 PM
 */

namespace TodoMVC\Repositories\Eloquent;

use Illuminate\Pagination\LengthAwarePaginator;
use TodoMVC\Models\ModelInterface;
use TodoMVC\Repositories\Contracts;
use TodoMVC\Repositories\Eloquent\Models\AbstractModel;
use TodoMVC\Utils\PageableInterface;


/**
 * Class AbstractRepository
 * @package TodoMVC\Repositories\Eloquent
 */
abstract class AbstractRepository implements Contracts\RepositoryInterface {

    /**
     * @var AbstractModel
     */
    protected $model;

    /**
     * @param AbstractModel $model
     */
    public function __construct(AbstractModel $model) {
        $this->model = $model;
    }

    /**
     * @return ModelInterface
     */
    public function newInstance()
    {
        return new $this->model();
    }


    /**
     * @param PageableInterface $paging
     * @return array
     */
    public function all(PageableInterface $paging = null)
    {

        if (is_null($paging)) {
            return $this->model->all()->reverse()->all();
        } else {
            $query = $this->model->newQueryWithoutScopes();
            return $this->paginated($query, $paging->getPerPage(), $paging->getPage())->reverse()->all();
        }

    }

    public function save(ModelInterface &$data)
    {
        $expectedClass = get_class($this->model);
        $receivedClass = get_class($data);
        if ($expectedClass == $receivedClass) {
            return $data->save();
        } else {
            throw new \InvalidArgumentException(
                "Wrong Model sent to Repository. Expected '{$expectedClass}', got '{$receivedClass}"
            );
        }
    }

    public function delete($id)
    {
        return $this->model->destroy($id);
    }

    public function find($id)
    {
        return $this->model->find($id);
    }

    public function findBy($field, $value)
    {
        return $this->model->where($field, '=', $value)->first();
    }

    public function deleteAll() {
        return $this->model->truncate();
    }

    protected function paginated($query, $limit, $page)
    {
        $count = $query->getQuery()->getCountForPagination();
        $paginator = new LengthAwarePaginator($query, $count, $limit, $page);
        return $paginator->getCollection();
    }

}