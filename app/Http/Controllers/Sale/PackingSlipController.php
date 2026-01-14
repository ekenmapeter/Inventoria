<?php

namespace App\Http\Controllers\Sale;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PackingSlipController extends Controller
{
    public function index()
    {
        return view('packing-slips.index');
    }
}
