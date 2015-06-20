<?php
/**
 * Created by PhpStorm.
 * User: rajiteh
 * Date: 15-06-18
 * Time: 4:01 PM
 */

namespace TodoMVC\Repositories\Contracts;

use TodoMVC\Models\ModelInterface;
use TodoMVC\Utils\PageableInterface;

/**
 * Interface RepositoryInterface
 * @package TodoMVC\Repositories\Contracts
 */
interface RepositoryInterface {

    /**
     * @return ModelInterface
     */
    public function newInstance();

    /**
     * @param PageableInterface $paging
     * @return array
     */
    public function all(PageableInterface $paging = null);

    /**
     * @param ModelInterface $model
     * @return mixed
     */
    public function save(ModelInterface &$model);

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id);

    /**
     * @param $id
     * @return ModelInterface
     */
    public function find($id);

    /**
     * @param $field
     * @param $value
     * @return ModelInterface
     */
    public function findBy($field, $value);

    /**
     * @return mixed
     */
    public function deleteAll();


}