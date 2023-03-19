<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StaffKasirController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:staff_kasir']);
    }
}
