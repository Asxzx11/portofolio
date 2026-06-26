<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        return view('welcome', [
            'certificates' => Certificate::latest()->get(),
        ]);
    }
}
