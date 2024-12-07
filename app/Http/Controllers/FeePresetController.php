<?php

namespace App\Http\Controllers;

use App\Models\FeePreset;
use Illuminate\Http\Request;

class FeePresetController extends Controller
{
    public function index()
    {
        $feePresets = FeePreset::all();
        return view('fee_presets.index', compact('feePresets'));
    }

    public function create()
    {
        return view('fee_presets.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:fee_presets',
            'description' => 'nullable',
            'base_percentage' => 'required|numeric|min:0|max:100',
        ]);

        FeePreset::create([
            'name' => $request->name,
            'description' => $request->description,
            'base_percentage' => $request->base_percentage,
        ]);

        return redirect()->route('fee-presets.index')->with('success', 'Fee Preset created successfully.');
    }

    public function edit(FeePreset $feePreset)
    {
        return view('fee_presets.edit', compact('feePreset'));
    }

    public function update(Request $request, FeePreset $feePreset)
    {
        $request->validate([
            'name' => 'required|unique:fee_presets,name,' . $feePreset->id,
            'description' => 'nullable',
            'base_percentage' => 'required|numeric|min:0|max:100',
        ]);

        $feePreset->update($request->all());

        return redirect()->route('fee_presets.index')->with('success', 'Fee Preset updated successfully.');
    }

    public function destroy(FeePreset $feePreset)
    {
        $feePreset->delete();

        return redirect()->route('fee_presets.index')->with('success', 'Fee Preset deleted successfully.');
    }
}

