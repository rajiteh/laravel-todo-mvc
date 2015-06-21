<?php
/**
 * Created by PhpStorm.
 * User: rajiteh
 * Date: 15-06-18
 * Time: 9:08 PM
 */

namespace TodoMVC\Services\Validation;


class TaskValidator extends AbstractModelValidator {

    /**
     * @var array Validation rules for the test form, they can contain in-built Laravel rules or our custom rules
     */
    protected $rules = array(
        'title'                  => 'required',
        'check_list_id'          => 'required|numeric',
        'done'                   => 'boolean'
    );

    /**
     * @var array Custom errors for this validator
     */
    protected $custom_errors = array(
        'boolean' => 'The attribute ":attribute" must be one of "0" and "1"'
    );

}