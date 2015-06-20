<?php
/**
 * Created by PhpStorm.
 * User: rajiteh
 * Date: 15-06-20
 * Time: 9:54 AM
 */

namespace TodoMVC\Http\Controllers\API\v1\Schemas;


use TodoMVC\Models\TaskInterface;
use Neomerx\JsonApi\Schema\SchemaProvider;

class TaskSchema extends SchemaProvider{

    protected $resourceType = 'task';
    protected $selfSubUrl   = '/tasks/';

    /**
     * Get resource identity.
     *
     * @param TaskInterface $resource
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
     * @param TaskInterface $resource
     *
     * @return array
     */
    public function getAttributes($resource)
    {
        return [
            'title' => $resource->getTitle(),
            'description' => $resource->getDescription(),
            'checklist_id' => $resource->getCheckListId()
        ];
    }


}