@extends('layouts.app')

@section('content')
    <h1>Fee Presets</h1>
    <a href="{{ route('fee-presets.create') }}" class="btn btn-primary mb-3">Create New Fee Preset</a>
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Base Percentage</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($feePresets as $feePreset)
                <tr>
                    <td>{{ $feePreset->name }}</td>
                    <td>{{ $feePreset->description }}</td>
                    <td>{{ $feePreset->base_percentage }}%</td>
                    <td>
                        <a href="{{ route('fee-presets.edit', $feePreset) }}" class="btn btn-sm btn-primary">Edit</a>
                        <form action="{{ route('fee-presets.destroy', $feePreset) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger"
                                onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
