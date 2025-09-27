<?php

namespace App\Data\Dto\Requests\EventCelebrant;

use App\Data\Dto\Requests\CelebrantRequestDto;
use Illuminate\Http\Request;

class SingleCelebrantRequestDto implements EventCelebrantRequest
{
    private function __construct(
        public CelebrantRequestDto $data
    ) {}

    public static function fromRequest(Request $request): SingleCelebrantRequestDto
    {
        $request->validate(['data' => ['required']]);

        return new SingleCelebrantRequestDto(
            data: CelebrantRequestDto::fromRequest(new Request($request->data))
        );
    }
}
