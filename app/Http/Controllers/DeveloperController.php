<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class DeveloperController extends Controller
{
    public function index(): View
    {
        return view('backend.developers.index');
    }
}
