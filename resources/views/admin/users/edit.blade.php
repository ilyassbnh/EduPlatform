@extends('layouts.admin')

@section('content')
    <div class="container mt-4">
        <h1>Edit User</h1>
        @include('admin.users.form', ['user' => $user])
    </div>
@endsection
