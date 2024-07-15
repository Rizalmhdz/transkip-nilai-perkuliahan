<?php

namespace App\Http\Controllers;
use Illuminate\View\View;

use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function view(Request $request): View
    {
        return view('dashboard', [
            // 'user' => $request->user(),
        ]);
    }
}
