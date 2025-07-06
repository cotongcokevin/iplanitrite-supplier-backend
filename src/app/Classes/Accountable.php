<?php

declare(strict_types=1);

namespace App\Classes;

use App\Models\Admin\Admin;

class Accountable
{
    /**
     * @var Admin
     */
    public $admin;

    public function __construct()
    {
        $this->admin = auth()->user();
    }
}
