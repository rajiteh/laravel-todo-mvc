<?php
/**
 * Created by PhpStorm.
 * User: rajiteh
 * Date: 15-06-19
 * Time: 10:36 PM
 */

namespace TodoMVC\Http\Controllers\API\v1;


use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\App as App;
use Neomerx\JsonApi\Document\Error;
use Neomerx\JsonApi\Encoder\Encoder;
use Neomerx\JsonApi\Encoder\EncoderOptions;
use TodoMVC\Http\Controllers\Controller;

use TodoMVC\Utils\PageableInterface;

abstract class APIController extends Controller {

    const BASE_PATH = "api/v1";

    protected static $encoder;



    public static function getEncoderInstance(Request $request) {
        if (is_null(self::$encoder)) {
            $schemaMappings = [
                get_class(App::make('TodoMVC\Models\TaskInterface')) => 'TodoMVC\Http\Controllers\API\V1\Schemas\TaskSchema',
                get_class(App::make('TodoMVC\Models\CheckListInterface')) => 'TodoMVC\Http\Controllers\API\V1\Schemas\CheckListSchema',
                //'TodoMVC\Models\UserInterface' => 'TodoMVC\Http\Controllers\API\V1\Schemas\UserSchema',
            ];
            $encoderOptions = new EncoderOptions(JSON_PRETTY_PRINT);
            self::$encoder = Encoder::instance($schemaMappings, $encoderOptions);
        }

        return self::$encoder;
    }

    /**
     * @param Request $req
     * @param $data
     * @param PageableInterface $paging
     * @param $code
     * @return Response
     */
    public static function jsonResponse(Request $req, $data, PageableInterface $paging = null, $code = Response::HTTP_OK) {
        //TODO: Implement paging support
        return (new Response(self::getEncoderInstance($req)->encode($data)))
            ->header('Content-Type', 'application/json')->setStatusCode($code);
    }

    /**
     * @param Request $req
     * @param $message
     * @param $code
     * @return Response
     */
    public static function jsonError(Request $req, $message, $code = Response::HTTP_BAD_REQUEST ) {

        if (is_array($message))
        {
            $messages = array_map(function($msg) {
                $msg = is_array($msg) ? implode(", ", $msg) : $msg;
                return new Error(null, null, null, null, null, $msg);
            }, $message);

        } else {
            $messages = [ new Error(null, null, null, null, null, $message) ];
        }
        return (new Response(self::getEncoderInstance($req)->errors($messages)))
            ->header('Content-Type', 'application/json')->setStatusCode($code);
    }
}
