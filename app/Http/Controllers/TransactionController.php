<?php

namespace App\Http\Controllers;

use App\Models\FeePreset;
use App\Models\Service;
use App\Services\FeeCalculationService;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    protected $feeCalculationService;

    public function __construct(FeeCalculationService $feeCalculationService)
    {
        $this->feeCalculationService = $feeCalculationService;
    }

    public function index()
    {
        $feePresets = FeePreset::all();
        $services = Service::all();
        return view('transactions.index', compact('feePresets', 'services'));
    }

    public function calculateFee(Request $request)
    {
        $request->validate([
            'fee_preset_id' => 'required|exists:fee_presets,id',
            'service_id' => 'required|exists:services,id',
            'amount' => 'required|numeric|min:0',
            'total_spent' => 'required|numeric|min:0',
        ]);

        $feePreset = FeePreset::findOrFail($request->fee_preset_id);
        $service = Service::findOrFail($request->service_id);

        try {
            $fee = $this->feeCalculationService->calculateFee(
                $feePreset,
                $service,
                $request->amount,
                $request->total_spent
            );

            return response()->json([
                'fee' => $fee,
                'fee_percentage' => ($fee / $request->amount) * 100,
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}

