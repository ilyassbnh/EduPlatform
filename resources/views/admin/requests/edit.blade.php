@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h1>Edit Request</h1>
    <form action="{{ route('admin.requests.update', $request->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="course_id">Course</label>
            <input type="number" name="course_id" class="form-control" value="{{ $request->course_id }}" required>
        </div>

        <div class="form-group">
            <label for="student_id">Student</label>
            <input type="number" name="student_id" class="form-control" value="{{ $request->student_id }}" required>
        </div>

        <div class="form-group">
            <label for="status">Status</label>
            <select name="status" class="form-control" required>
                <option value="valide" {{ $request->status == 'v' ? 'selected' : '' }}>V</option>
                <option value="notvalide" {{ $request->status == 'nv' ? 'selected' : '' }}>NV</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Update</button>
    </form>
</div>
@endsection
