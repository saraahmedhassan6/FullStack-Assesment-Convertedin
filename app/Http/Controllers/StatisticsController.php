<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Statistics;
use App\Models\User;

class StatisticsController extends Controller
{
    // get top 10 counts of users that get tasks to show it
    public function index()
    {
        $statistics = Statistics::orderBy('task_count', 'desc')->take(10)->get();
        return view('statistics.index', compact('statistics'));
    }
}
