@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h1>Request Details</h1>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Request ID: {{ $request->id }}</h5>
            <p class="card-text">Course: {{ $request->course->title }}</p>
            <p class="card-text">Student: {{ $request->student->name }}</p>
            <p class="card-text">Status: {{ $request->status }}</p>
        </div>
    </div>
</div>
@endsection
