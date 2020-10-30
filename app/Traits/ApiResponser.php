<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;

trait ApiResponser
{

    protected function showAll(Collection $collection)
    {
        return (['data' => $collection]);
    }

    protected function showOne(Model $instance, $message){

        return ([
            'data' => $instance,
            'message' => $message
        ]);
    }

    protected function errorResponse($message, int $code)
    {
        return response()->json([['message' => $message, 'code' => $code] , $code]);
    }

}