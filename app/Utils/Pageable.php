<?php
/**
 * Created by PhpStorm.
 * User: rajiteh
 * Date: 15-06-19
 * Time: 9:27 PM
 */

namespace TodoMVC\Utils;


class Pageable implements PageableInterface {

    protected $page;
    protected $perPage;

    /**
     * @return mixed
     */
    public function getPage()
    {
        return $this->page;
    }

    /**
     * @param mixed $page
     */
    public function setPage($page)
    {
        $this->page = $page;
    }

    /**
     * @return mixed
     */
    public function getPerPage()
    {
        return $this->perPage;
    }

    /**
     * @param mixed $perPage
     */
    public function setPerPage($perPage)
    {
        $this->perPage = $perPage;
    }



}