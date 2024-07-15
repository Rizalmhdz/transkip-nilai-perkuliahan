<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class MataKuliahController extends Controller
{
    public function view(Request $request): View
    {
        return view('dashboard', [
            // 'user' => $request->user(),
        ]);
    }
}
