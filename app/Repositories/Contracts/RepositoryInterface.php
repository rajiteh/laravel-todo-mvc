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

interface RepositoryInterface {

    public function all(PageableInterface $paging = null);

    public function save(ModelInterface $model);

    public function delete($id);

    public function find($id);

    public function findBy($field, $value);

    public function deleteAll();


}