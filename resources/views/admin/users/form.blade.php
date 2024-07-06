<form action="{{ isset($user) ? route('admin.users.update', $user->id) : route('admin.users.store') }}" method="POST">
    @csrf
    @if(isset($user))
        @method('PUT')
    @endif
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ isset($user) ? $user->name : old('name') }}" required>
        @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ isset($user) ? $user->email : old('email') }}" required>
        @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" {{ isset($user) ? '' : 'required' }}>
        @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="form-group">
        <label for="password_confirmation">Confirm Password</label>
        <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation" name="password_confirmation" {{ isset($user) ? '' : 'required' }}>
        @error('password_confirmation')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="form-group">
        <label for="roles">Roles</label>
        <select name="roles[]" id="roles" class="form-control @error('roles') is-invalid @enderror" multiple required>
            @foreach($roles as $role)
                <option value="{{ $role->id }}" {{ isset($user) && $user->roles->pluck('id')->contains($role->id) ? 'selected' : '' }}>{{ $role->display_name }}</option>
            @endforeach
        </select>
        @error('roles')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <button type="submit" class="btn btn-primary">{{ isset($user) ? 'Update' : 'Create' }}</button>
</form>
