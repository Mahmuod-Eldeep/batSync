@extends('layouts.app')

@section('content')
    <h1>Thresholds</h1>
    <a href="{{ route('thresholds.create') }}" class="btn btn-primary mb-3">Create New Threshold</a>
    <table class="table">
        <thead>
            <tr>
                <th>Min Amount Spent</th>
                <th>Max Amount Spent</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($thresholds as $threshold)
                <tr>
                    <td>{{ $threshold->min_spent }}</td>
                    <td>{{ $threshold->max_spent ?? 'No limit' }}</td>
                    <td>
                        <a href="{{ route('thresholds.edit', $threshold) }}" class="btn btn-sm btn-primary">Edit</a>
                        <form action="{{ route('thresholds.destroy', $threshold) }}" method="POST" class="d-inline">
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

