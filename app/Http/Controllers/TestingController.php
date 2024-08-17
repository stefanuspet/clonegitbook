<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TestingController extends Controller
{
    public function __construct()
    {
        if (Auth::user()->role !== 'admin') {
            abort(403);
        }
    }

    public function index()
    {
        $test = Auth::user();
        return view('testing', ['role' => $test->role]);
    }
}
