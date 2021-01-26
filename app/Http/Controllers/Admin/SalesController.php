<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sale;
use Illuminate\Http\Request;

class SalesController extends Controller
{
    public function create()
    {
        return view('sales.create');
    }

    public function list()
    {
        return view('sales.list');
    }

    public function show($id)
    {
        $sale = Sale::find($id);
        return view('sales.show', ['sale' => $sale]);
    }
}
