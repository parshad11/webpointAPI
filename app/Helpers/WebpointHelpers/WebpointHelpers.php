<?php
namespace App\Helpers\WebpointHelpers;

use App\Http\Resources\ErrorResource;
use App\Http\Resources\SuccessResource;

class WebpointHelpers
{


    public static function successResponse($code = 200 , $data=[] , $message ='Success'){
        return response()->json(
            new SuccessResource([
                'statusCode' => $code,
                'data' => $data,
                'message' => $message,
            ]),
            $code
        );
    }

    public static function errorResponse($code = 400  , $message ='Failed'){
        return response()->json(
            new ErrorResource([
                'statusCode' => $code,
                'message' => $message,
            ]),
            $code
        );
    }
}