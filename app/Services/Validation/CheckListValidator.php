<?php
/**
 * Created by PhpStorm.
 * User: rajiteh
 * Date: 15-06-18
 * Time: 9:08 PM
 */

namespace TodoMVC\Services\Validation;


class CheckListValidator extends AbstractModelValidator {

    /**
     * @var array Validation rules for the test form, they can contain in-built Laravel rules or our custom rules
     */
    protected $rules = array(
        'name'    => 'required',
        'user_id' => 'required',
    );

}