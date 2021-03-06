<?php
/**
 * Created by PhpStorm.
 * User: rajiteh
 * Date: 15-06-20
 * Time: 10:13 AM
 */

namespace TodoMVC\Http\Controllers\API\v1\Schemas;

use Illuminate\Support\Facades\App;
use TodoMVC\Models\CheckListInterface;
use TodoMVC\Repositories\Contracts\TaskRepositoryInterface as TaskRepositoryInterface;
use Neomerx\JsonApi\Schema\SchemaProvider;

class CheckListSchema extends SchemaProvider {

    protected $isShowAttributesInIncluded = true;
    protected $isShowRelShipsInIncluded = false;

    protected $resourceType = 'checklist';
    protected $selfSubUrl   = '/checklists/';

    /**
     * Get resource identity.
     *
     * @param CheckListInterface $resource
     *
     * @return string
     */
    public function getId($resource)
    {
        return $resource->getId();
    }

    /**
     * Get resource attributes.
     *
     * @param CheckListInterface $resource
     *
     * @return array
     */
    public function getAttributes($resource)
    {
        return [
            'name' => $resource->getName(),
            'user_id' => $resource->getUserId(),
        ];
    }

    /**
     * @return array
     */
    public function getIncludePaths()
    {
        return [
            'tasks'
        ];
    }
}