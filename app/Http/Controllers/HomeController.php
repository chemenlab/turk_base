<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Series;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $query = Series::query();

        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        if ($request->filled('year')) {
            $query->where('year', $request->year);
        }

        if ($request->filled('quality')) {
            $query->where('quality', $request->quality);
        }

        $series = $query->get();

        return view('home', compact('series'));
    }

    public function show($id)
    {
        $series = Series::findOrFail($id);
        return view('series.show', compact('series'));
    }
}
