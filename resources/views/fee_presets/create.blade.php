@extends('layouts.app')

@section('content')
    <h1>Create Fee Preset</h1>
    <form action="{{ route('fee-presets.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description"></textarea>
        </div>
        <div class="mb-3">
            <label for="base_percentage" class="form-label">Base Percentage</label>
            <input type="number" class="form-control" id="base_percentage" name="base_percentage" step="0.01"
                min="0" max="100" required>
        </div>
        <button type="submit" class="btn btn-primary">Create</button>
    </form>
@endsection
