<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class HomeController extends Controller
{
    public function index(): View
    {
        return view('admin');
    }
}