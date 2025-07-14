<?php

declare(strict_types=1);

namespace App\Classes;

/**
 * @template T1
 * @template T2
 */
class Pair
{
    /**
     * @param  T1  $first
     * @param  T2  $second
     */
    public function __construct(
        public mixed $first,
        public mixed $second
    ) {}
}
