<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FeePresetController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ThresholdController;
use App\Http\Controllers\FeePercentageController;
use App\Http\Controllers\TransactionController;

Route::apiResource('fee-presets-api', FeePresetController::class);
Route::apiResource('services-api', ServiceController::class);
Route::apiResource('thresholds-api', ThresholdController::class);
Route::apiResource('fee-percentages-api', FeePercentageController::class);

Route::post('calculate-fee-api', [TransactionController::class, 'calculateFee']);
