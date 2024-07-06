@extends('layouts.admin')

@section('content')
    <div class="container mt-4">
        <h1>Courses</h1>
        <a href="{{ route('admin.courses.create') }}" class="btn btn-primary">Create New Course</a>
        <table class="table mt-4">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Category</th>
                    <th>Teacher</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($courses as $course)
                    <tr>
                        <td>{{ $course->title }}</td>
                        <td>{{ $course->description }}</td>
                        <td>{{ $course->category->name }}</td>
                        <td>{{ $course->teacher->name }}</td>
                        <td>
                            <a href="{{ route('admin.courses.edit', $course->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('admin.courses.destroy', $course->id) }}" method="POST" style="display:inline;">
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
