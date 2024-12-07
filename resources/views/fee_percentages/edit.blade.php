@extends('layouts.app')

@section('content')
    <h1>Edit Fee Percentage</h1>
    <form action="{{ route('fee-percentages.update', $feePercentage) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="fee_preset_id" class="form-label">Fee Preset</label>
            <select class="form-control" id="fee_preset_id" name="fee_preset_id" required>
                @foreach($feePresets as $feePreset)
                    <option value="{{ $feePreset->id }}" {{ $feePercentage->fee_preset_id == $feePreset->id ? 'selected' : '' }}>
                        {{ $feePreset->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="service_id" class="form-label">Service</label>
            <select class="form-control" id="service_id" name="service_id" required>
                @foreach($services as $service)
                    <option value="{{ $service->id }}" {{ $feePercentage->service_id == $service->id ? 'selected' : '' }}>
                        {{ $service->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="threshold_id" class="form-label">Threshold</label>
            <select class="form-control" id="threshold_id" name="threshold_id" required>
                @foreach($thresholds as $threshold)
                    <option value="{{ $threshold->id }}" {{ $feePercentage->threshold_id == $threshold->id ? 'selected' : '' }}>
                        {{ $threshold->min_spent }} - {{ $threshold->max_spent ?? 'No limit' }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="percentage" class="form-label">Percentage</label>
            <input type="number" class="form-control" id="percentage" name="percentage" step="0.01" min="0" max="100" value="{{ $feePercentage->percentage }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
@endsection

