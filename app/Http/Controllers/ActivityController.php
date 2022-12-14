<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use Illuminate\Http\Request;

class ActivityController extends Controller
{


    public function __invoke()
    {
        $logs = ActivityLog::with('user')->orderBy('id', 'DESC')->paginate(20);

        return view('logs.index', compact('logs'));
    }
}
