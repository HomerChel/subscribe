<?php

namespace App\Http\Controllers;

use App\PagesStats;
use Illuminate\Http\Request;

class TargetController extends Controller
{
    public function target($number = false)
    {
        $stat = new PagesStats;
        $stat->target_number = $number;
        $stat->save();

        return view('target', ['number' => $number]);
    }
}
