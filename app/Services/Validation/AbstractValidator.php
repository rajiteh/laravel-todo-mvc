<?php
/**
 * Created by PhpStorm.
 * User: rajiteh
 * Date: 15-06-18
 * Time: 9:01 PM
 */

namespace TodoMVC\Services\Validation;

use Illuminate\Validation\Factory as IlluminateValidator;
use TodoMVC\Exceptions\ValidationException;
use TodoMVC\Models\Contracts\HasIdContract;

/**
 * Base Validation class. All entity specific validation classes inherit
 * this class and can override any function for respective specific needs
 */
abstract class AbstractValidator {

    /**
     * @var IlluminateValidator
     */
    protected $_validator;
    protected $rules = [];
    protected $custom_errors = [];

    public function __construct( IlluminateValidator $validator ) {
        $this->_validator = $validator;
    }

    public function validate( array $data, array $rules = array(), array $custom_errors = array() ) {

        $rules = empty($rules) ? $this->rules : $rules;
        $custom_errors = empty($custom_errors) ? $this->custom_errors : $custom_errors;

        //use Laravel's Validator and validate the data
        $validation = $this->_validator->make( $data, $rules, $custom_errors );

        if ( $validation->fails() ) {
            //validation failed, throw an exception
            throw new ValidationException( $validation->messages() );
        }

        //all good and shiny
        return true;
    }



}