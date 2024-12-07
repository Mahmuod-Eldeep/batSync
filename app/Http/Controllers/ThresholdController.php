<?php

namespace App\Http\Controllers;

use App\Models\Threshold;
use Illuminate\Http\Request;

class ThresholdController extends Controller
{
    public function index()
    {
        $thresholds = Threshold::all();
        return view('thresholds.index', compact('thresholds'));
    }

    public function create()
    {
        return view('thresholds.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'min_spent' => 'required|numeric|min:0',
            'max_spent' => 'nullable|numeric|gt:min_spent',
        ]);

        Threshold::create($request->all());

        return redirect()->route('thresholds.index')->with('success', 'Threshold created successfully.');
    }

    public function edit(Threshold $threshold)
    {
        return view('thresholds.edit', compact('threshold'));
    }

    public function update(Request $request, Threshold $threshold)
    {
        $request->validate([
            'min_spent' => 'required|numeric|min:0',
            'max_spent' => 'nullable|numeric|gt:min_spent',
        ]);

        $threshold->update($request->all());

        return redirect()->route('thresholds.index')->with('success', 'Threshold updated successfully.');
    }

    public function destroy(Threshold $threshold)
    {
        $threshold->delete();

        return redirect()->route('thresholds.index')->with('success', 'Threshold deleted successfully.');
    }
}

