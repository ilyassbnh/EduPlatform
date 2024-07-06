@extends('layouts.admin')

@section('content')
    <h1>Edit Course</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.courses.update', $course->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" class="form-control" id="title" value="{{ old('title', $course->title) }}">
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" class="form-control" id="description">{{ old('description', $course->description) }}</textarea>
        </div>
        <div class="form-group">
            <label for="category_id">Category</label>
            <select name="category_id" class="form-control" id="category_id">
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ $course->category_id == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="teacher_id">Teacher</label>
            <select name="teacher_id" class="form-control" id="teacher_id">
                @foreach($teachers as $teacher)
                    <option value="{{ $teacher->id }}" {{ $course->teacher_id == $teacher->id ? 'selected' : '' }}>
                        {{ $teacher->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="image_path">Image URL</label>
            <input type="text" name="image" class="form-control" id="image" value="{{ old('image', $course->image) }}">
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
@endsection
