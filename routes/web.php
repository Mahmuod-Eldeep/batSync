<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FeePresetController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ThresholdController;
use App\Http\Controllers\FeePercentageController;
use App\Http\Controllers\TransactionController;

Route::get('/', function () {
    return view('welcome');
});

// Fee Presets
Route::resource('fee-presets', FeePresetController::class);

// Services
Route::resource('services', ServiceController::class);

// Thresholds
Route::resource('thresholds', ThresholdController::class);

// Fee Percentages
Route::resource('fee-percentages', FeePercentageController::class);

// Transactions
Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions.index');
Route::post('/calculate-fee', [TransactionController::class, 'calculateFee'])->name('calculate.fee');

