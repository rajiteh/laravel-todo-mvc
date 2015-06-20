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
     * @return Response
     */
    public static function jsonResponse(Request $req, $data, PageableInterface $paging = null) {
        //TODO: Implement paging support
        return (new Response(self::getEncoderInstance($req)->encode($data)))
            ->header('Content-Type', 'application/json');
    }

    /**
     * @param Request $req
     * @param $message
     * @return Response
     */
    public static function jsonError(Request $req, $message) {
        return (new Response(self::getEncoderInstance($req)->error(new Error($message))))
            ->header('Content-Type', 'application/json');
    }
}
