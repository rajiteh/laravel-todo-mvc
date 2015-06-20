<?php
/**
 * Created by PhpStorm.
 * User: rajiteh
 * Date: 15-06-18
 * Time: 9:00 PM
 */

namespace TodoMVC\Exceptions;


class InvalidValidationRuleException extends BaseException {

    public function __construct(\string $keyword, \string $class, $code = 0, Exception $previous = null ) {
        $message = "Invalid keyword '{$keyword}' for class '{$class}'.";
        parent::__construct( $message, $code, $previous );
    }
}