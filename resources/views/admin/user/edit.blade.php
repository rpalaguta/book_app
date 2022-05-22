@extends('admin_template')

@section('title')
    Edit user ( id: {{ $user->id }} | {{ $user->email }})
@endsection()
@section('body')
    <form action="{{ route('admin.user.edit', $user->id) }}" method="post">
        @csrf
        <div class="row">

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Email:</strong>
                    <input type="text" name="email" value="{{ $user->email }}" class="form-control" disabled>
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Name:</strong>
                    <input type="text" name="name" value="{{ old('name') ?: $user->name }}" class="form-control @error('name') is-invalid @enderror" placeholder="Name">
                    @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Roles:</strong>
                    <select class="form-select @error('role_id') is-invalid @enderror" name="role_id[]" multiple>
                        <option value="">--</option>
                        @foreach($roles as $role)
                            <option @if($user->roles->contains($role->id)) selected @endif value="{{ $role->id }}">{{ $role->name }}</option>
                        @endforeach
                    </select>
                    @error('role_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-check">
                    <input type="checkbox" name="blocked" value="1" id="flexCheckChecked" class="form-check-input"
                       @if (old('blocked') ?: $user->blocked)
                           checked
                        @endif
                    >
                    <label class="form-check-label" for="flexCheckChecked">
                        <strong>Blocked</strong>
                    </label>
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12 text-center pt-3">
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </div>
    </form>
@endsection
