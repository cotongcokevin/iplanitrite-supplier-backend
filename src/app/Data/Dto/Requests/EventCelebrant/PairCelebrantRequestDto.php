<?php

namespace App\Data\Dto\Requests\EventCelebrant;

use App\Data\Dto\Requests\CelebrantRequestDto;
use Illuminate\Http\Request;

class PairCelebrantRequestDto implements EventCelebrantRequestDto
{
    private function __construct(
        public CelebrantRequestDto $first,
        public CelebrantRequestDto $second,
    ) {}

    public static function fromRequest(Request $request): PairCelebrantRequestDto
    {
        $request->validate([
            'first' => ['required'],
            'second' => ['required'],
        ]);

        return new PairCelebrantRequestDto(
            first: CelebrantRequestDto::fromRequest(new Request($request->first)),
            second: CelebrantRequestDto::fromRequest(new Request($request->second)),
        );
    }
}
