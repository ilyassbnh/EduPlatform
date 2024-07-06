@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h1>Create Request</h1>
    <form action="{{ route('admin.requests.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="course_id">Course</label>
            <input type="number" name="course_id" class="form-control" value="{{ old('course_id') }}" required>
        </div>

        <div class="form-group">
            <label for="student_id">Student</label>
            <input type="number" name="student_id" class="form-control" value="{{ old('student_id') }}" required>
        </div>

        <div class="form-group">
            <label for="status">Status</label>
            <select name="status" class="form-control" required>
                <option value="v">V</option>
                <option value="nv">NV</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Create</button>
    </form>
</div>
@endsection
