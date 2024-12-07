@extends('layouts.app')

@section('content')
    <h1>Create Threshold</h1>
    <form action="{{ route('thresholds.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="min_spent" class="form-label">Min Amount Spent</label>
            <input type="number" class="form-control" id="min_spent" name="min_spent" step="0.01" min="0" required>
        </div>
        <div class="mb-3">
            <label for="max_spent" class="form-label">Max Amount Spent (leave empty for no limit)</label>
            <input type="number" class="form-control" id="max_spent" name="max_spent" step="0.01" min="0">
        </div>
        <button type="submit" class="btn btn-primary">Create</button>
    </form>
@endsection

