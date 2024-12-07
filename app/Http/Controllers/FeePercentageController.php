<?php

namespace App\Http\Controllers;

use App\Models\FeePercentage;
use App\Models\FeePreset;
use App\Models\Service;
use App\Models\Threshold;
use Illuminate\Http\Request;

class FeePercentageController extends Controller
{
    public function index()
    {
        $feePercentages = FeePercentage::with(['feePreset', 'service', 'threshold'])->get();
        return view('fee_percentages.index', compact('feePercentages'));
    }

    public function create()
    {
        $feePresets = FeePreset::all();
        $services = Service::all();
        $thresholds = Threshold::all();
        return view('fee_percentages.create', compact('feePresets', 'services', 'thresholds'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'fee_preset_id' => 'required|exists:fee_presets,id',
            'service_id' => 'required|exists:services,id',
            'threshold_id' => 'required|exists:thresholds,id',
            'percentage' => 'required|numeric|min:0|max:100',
        ]);

        FeePercentage::create($request->all());

        return redirect()->route('fee-percentages.index')->with('success', 'Fee Percentage created successfully.');
    }

    public function edit(FeePercentage $feePercentage)
    {
        $feePresets = FeePreset::all();
        $services = Service::all();
        $thresholds = Threshold::all();
        return view('fee_percentages.edit', compact('feePercentage', 'feePresets', 'services', 'thresholds'));
    }

    public function update(Request $request, FeePercentage $feePercentage)
    {
        $request->validate([
            'fee_preset_id' => 'required|exists:fee_presets,id',
            'service_id' => 'required|exists:services,id',
            'threshold_id' => 'required|exists:thresholds,id',
            'percentage' => 'required|numeric|min:0|max:100',
        ]);

        $feePercentage->update($request->all());

        return redirect()->route('fee-percentages.index')->with('success', 'Fee Percentage updated successfully.');
    }

    public function destroy(FeePercentage $feePercentage)
    {
        $feePercentage->delete();

        return redirect()->route('fee-percentages.index')->with('success', 'Fee Percentage deleted successfully.');
    }
}

