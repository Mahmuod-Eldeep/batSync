<?php

namespace App\Services;

use App\Models\FeePercentage;
use App\Models\FeePreset;
use App\Models\Service;
use App\Models\Threshold;

class FeeCalculationService
{
    public function calculateFee(FeePreset $feePreset, Service $service, float $amount, float $totalSpent)
    {
        $threshold = Threshold::where('min_spent', '<=', $totalSpent)
            ->where(function ($query) use ($totalSpent) {
                $query->where('max_spent', '>', $totalSpent)
                    ->orWhereNull('max_spent');
            })
            ->first();

        if (!$threshold) {
            throw new \Exception('No applicable threshold found for the given total spent amount.');
        }

        $feePercentage = FeePercentage::where('fee_preset_id', $feePreset->id)
            ->where('service_id', $service->id)
            ->where('threshold_id', $threshold->id)
            ->first();

        if (!$feePercentage) {
            throw new \Exception('No applicable fee percentage found for the given combination.');
        }

        return $amount * (($feePercentage->percentage + $feePreset->base_percentage) / 100);
    }
}
