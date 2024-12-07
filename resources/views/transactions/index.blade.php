@extends('layouts.app')

@section('content')
    <h1>Calculate Fee</h1>
    <form id="feeCalculationForm">
        @csrf
        <div class="mb-3">
            <label for="fee_preset_id" class="form-label">Fee Preset</label>
            <select class="form-control" id="fee_preset_id" name="fee_preset_id" required>
                @foreach ($feePresets as $feePreset)
                    <option value="{{ $feePreset->id }}">{{ $feePreset->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="service_id" class="form-label">Service</label>
            <select class="form-control" id="service_id" name="service_id" required>
                @foreach ($services as $service)
                    <option value="{{ $service->id }}">{{ $service->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="amount" class="form-label">Transaction Amount</label>
            <input type="number" class="form-control" id="amount" name="amount" step="0.01" required>
        </div>
        <div class="mb-3">
            <label for="total_spent" class="form-label">Total Amount Spent</label>
            <input type="number" class="form-control" id="total_spent" name="total_spent" step="0.01" required>
        </div>
        <button type="submit" class="btn btn-primary">Calculate Fee</button>
    </form>

    <div id="result" class="mt-4"></div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#feeCalculationForm').submit(function(e) {
                e.preventDefault();
                $.ajax({
                    url: '{{ route('calculate.fee') }}',
                    method: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        $('#result').html(`
                    <div class="alert alert-success">
                        <p>Fee: $${response.fee.toFixed(2)}</p>
                        <p>Fee Percentage: ${response.fee_percentage.toFixed(2)}%</p>
                    </div>
                `);
                    },
                    error: function(xhr) {
                        $('#result').html(`
                    <div class="alert alert-danger">
                        ${xhr.responseJSON.error || 'An error occurred while calculating the fee.'}
                    </div>
                `);
                    }
                });
            });
        });
    </script>
@endpush
