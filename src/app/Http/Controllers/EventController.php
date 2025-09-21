<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class EventController
{

    public function store(
        Request $request
    ): JsonResponse {
        return transaction(function () use ($request) {

        });
    }

}