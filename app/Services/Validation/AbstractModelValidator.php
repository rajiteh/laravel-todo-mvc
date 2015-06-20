<?php
/**
 * Created by PhpStorm.
 * User: rajiteh
 * Date: 15-06-18
 * Time: 9:01 PM
 */

namespace TodoMVC\Services\Validation;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Factory as IlluminateValidator;
use TodoMVC\Exceptions\InvalidValidationRuleException;
use TodoMVC\Exceptions\NullModelToParseRulesException;
use TodoMVC\Exceptions\ValidationException;
use TodoMVC\Models\Contracts\HasIdContract;
use TodoMVC\Models\ModelInterface;

/**
 * Base Validation class. All entity specific validation classes inherit
 * this class and can override any function for respective specific needs
 */
abstract class AbstractModelValidator extends AbstractValidator {

    public function validateModel( array $data, ModelInterface $model, array $rules = [], array $custom_errors = [] ) {
        return $this->validate($data, $rules, $custom_errors, $model);
    }
    public function validate( array $data, array $rules = array(), array $custom_errors = array(), ModelInterface $model = null) {

        $rules = $this->parseRules(empty($rules) ? $this->rules : $rules, $model);
        return parent::validate($data, $rules, $custom_errors);
    }


    public function parseRules( array $rules , ModelInterface $model = null) {

        array_walk_recursive($rules, function (&$item, $key) use ($model) {

            preg_match_all("/{[A-z0-9]+}/U", $item, $matches, PREG_PATTERN_ORDER);

            if (!empty($matches)) {

                if (is_null($model)) {
                    throw new NullModelToParseRulesException();
                }

                foreach (array_shift($matches) as $match) {
                    $getter = $this->resolveGetter(substr($match, 1, -1), $model);
                    $item = str_replace($match, $getter , $item);
                }

            }

        });
        return $rules;
    }

    /**
     * @param string $keyword
     * @param ModelInterface $model
     * @return string
     * @throws InvalidValidationRuleException
     */
    private function resolveGetter($keyword, ModelInterface $model) {
        $methodName = "get{$keyword}";
        if (method_exists($model, $methodName)) {
            return (string) call_user_func_array([$model, $methodName], []);
        } else {
            throw new InvalidValidationRuleException($keyword, get_class($model));
        }
    }


}