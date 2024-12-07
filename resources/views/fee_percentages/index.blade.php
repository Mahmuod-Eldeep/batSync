@extends('layouts.app')

@section('content')
    <h1>Fee Percentages</h1>
    <a href="{{ route('fee-percentages.create') }}" class="btn btn-primary mb-3">Create New Fee Percentage</a>
    <table class="table">
        <thead>
            <tr>
                <th>Fee Preset</th>
                <th>Service</th>
                <th>Threshold</th>
                <th>Percentage</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($feePercentages as $feePercentage)
                <tr>
                    <td>{{ $feePercentage->feePreset->name }}</td>
                    <td>{{ $feePercentage->service->name }}</td>
                    <td>{{ $feePercentage->threshold->min_spent }} - {{ $feePercentage->threshold->max_spent ?? 'No limit' }}</td>
                    <td>{{ $feePercentage->percentage }}%</td>
                    <td>
                        <a href="{{ route('fee-percentages.edit', $feePercentage) }}" class="btn btn-sm btn-primary">Edit</a>
                        <form action="{{ route('fee-percentages.destroy', $feePercentage) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection

