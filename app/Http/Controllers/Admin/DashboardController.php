<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Certificate;
use App\Models\ContactMessage;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        return view('admin.dashboard', [
            'certificates' => Certificate::latest()->get(),
            'messages' => ContactMessage::latest()->get(),
        ]);
    }
}
