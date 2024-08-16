<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\View;

class BaseController extends Controller
{



    public function index()
    {
        return view('index');
    }
}
