<?php
namespace App\Helpers\WebpointHelpers;

use App\Http\Resources\ErrorResource;
use App\Http\Resources\SuccessResource;
use GuzzleHttp\Client;

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

    public static function getQuote(){
        $client = new Client([
            'verify' => false
        ]);
        $count = 5;
        $quoteCollector = [];
        for($i=0; $i < $count; $i++){
            $response = $client->request('GET', config('app.quotes_api'));
            $statusCode = $response->getStatusCode();
            $body = $response->getBody()->getContents();
            array_push($quoteCollector,json_decode($body)->quote);
        }
        return $quoteCollector;
    }
}