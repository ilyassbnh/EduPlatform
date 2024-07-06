@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h1>Inscription Demands</h1>
    <a href="{{ route('admin.requests.create') }}" class="btn btn-primary mb-3">Create New Request</a>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Course</th>
                <th>Student</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($requests as $request)
            <tr>
                <td>{{ $request->id }}</td>
                <td>{{ $request->course->title }}</td>
                <td>{{ $request->student->name }}</td>
                <td>{{ $request->status }}</td>
                <td>
                    <a href="{{ route('admin.requests.show', $request->id) }}" class="btn btn-info">View</a>
                    <a href="{{ route('admin.requests.edit', $request->id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('admin.requests.destroy', $request->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
